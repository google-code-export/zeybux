<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : GestionCaracteristiqueControleur.php
//
// Description : Classe GestionCaracteristiqueControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUIT ."/ListeCaracteristiqueResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeCaracteristiqueViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CaracteristiqueViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProduitCaracteristiqueViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUIT . "/CaracteristiqueValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUIT ."/AutorisationSupprimerCaracteristiqueResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUIT ."/DetailCaracteristiqueResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CaracteristiqueProduitManager.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");

/**
 * @name GestionCaracteristiqueControleur
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe controleur d'une GestionCaracteristiqueControleur
 */
class GestionCaracteristiqueControleur
{		
	/**
	* @name getCaracteristique()
	* @return ListeCaracteristiqueResponse
	* @desc Retourne la liste des caractéristiques
	*/
	public function getCaracteristique() {
		$lResponse = new ListeCaracteristiqueResponse();
		$lResponse->setListeCaracteristique( ListeCaracteristiqueViewManager::selectAll() );
		return $lResponse;
	}
	
	/**
	* @name getDetailCaracteristique($pParam)
	* @return DetailCaracteristiqueResponse
	* @desc Retourne le détail d'une caractéristique
	*/
	public function getDetailCaracteristique($pParam) {
		$lVr = CaracteristiqueValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lCaracteristique = CaracteristiqueViewManager::select($pParam["id"]);
			$lResponse = new DetailCaracteristiqueResponse();
			$lResponse->setCaracteristique( $lCaracteristique[0] );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name ajouterCaracteristique($pParam)
	* @return CaracteristiqueVR
	* @desc Ajoute une caracteristique
	*/
	public function ajouterCaracteristique($pParam) {	
		$lVr = CaracteristiqueValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lCaracteristique = new CaracteristiqueVO();
			$lCaracteristique->setNom($pParam['nom']);
			$lCaracteristique->setDescription($pParam['description']);
			$lCaracteristique->setEtat(0);
			CaracteristiqueManager::insert($lCaracteristique);
		}		
		return $lVr;
	}
	
	/**
	* @name modifierCaracteristique($pParam)
	* @return CaracteristiqueVR
	* @desc Modifie une caracteristique
	*/
	public function modifierCaracteristique($pParam) {	
		$lVr = CaracteristiqueValid::validUpdate($pParam);		
		if($lVr->getValid()) {
			$lCaracteristique = new CaracteristiqueVO();
			$lCaracteristique->setId($pParam['id']);
			$lCaracteristique->setNom($pParam['nom']);
			$lCaracteristique->setDescription($pParam['description']);
			$lCaracteristique->setEtat(0);
			CaracteristiqueManager::update($lCaracteristique);
		}		
		return $lVr;
	}
	
	/**
	* @name supprimerCaracteristique($pParam)
	* @return CaracteristiqueVR
	* @desc Supprime une caracteristique
	*/
	public function supprimerCaracteristique($pParam) {	
		$lVr = CaracteristiqueValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lAutorisation = GestionCaracteristiqueControleur::autorisationSupprimerCaracteristique($pParam);			
			if($lAutorisation->getValid() && $lAutorisation->getAutorisation()) {		
				$lCaracteristique = CaracteristiqueManager::select($pParam['id']);
				$lCaracteristique->setEtat(1);
				CaracteristiqueManager::update($lCaracteristique);
			}
			return $lAutorisation;
		}		
		return $lVr;
	}
	
	/**
	* @name autorisationSupprimerCaracteristique($lParam)
	* @return CaracteristiqueVR
	* @desc Retourne l'autorisation de supprimer une caracteristique ainsi que le nombre de produit associé à la caracteristique
	*/
	public function autorisationSupprimerCaracteristique($pParam) {	
		$lVr = CaracteristiqueValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lReponse = new AutorisationSupprimerCaracteristiqueResponse();
			$lProduits = GestionCaracteristiqueControleur::listeProduitCaracteristique($pParam['id']);		
			$lId = $lProduits[0]->getId();
			if(count($lProduits) == 1 && empty($lId) ) { // Le manager retourne un tableau avec un objet vide -> Pas de produit
				$lReponse->setNbProduit(0);
				$lReponse->setAutorisation(true);
			} else {				
				$lReponse->setNbProduit(count($lProduits));
				$lReponse->setAutorisation(false);
			}
			return $lReponse;
		}		
		return $lVr;
	}
	
	/**
	* @name listeProduitCaracteristique($pId)
	* @return array(CaracteristiqueProduitVO)
	* @desc Retourne la liste des produits liés à la caracteristique
	*/
	private function listeProduitCaracteristique($pId) {
		return CaracteristiqueProduitManager::selectByIdCaracteristique($pId);
	}
	
	/**
	* @name exportProduitCaracteristique($pParam)
	* @return CSV
	* @desc Retourne la liste des produits liés à la caracteristique
	*/	
	public function exportProduitCaracteristique($pParam) {
		$lVr = CaracteristiqueValid::validDelete($pParam);		
		if($lVr->getValid()) {
			$lCaracteristique = CaracteristiqueManager::select($pParam['id']);
			$lProduits = ListeProduitCaracteristiqueViewManager::select($pParam['id']);
			
			$lCSV = new CSV();
			$lTitre = str_replace(" ", "_", $lCaracteristique->getNom());
			$lCSV->setNom( $lTitre . '_:_Liste_des_produits.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Nom du Produit");
			$lCSV->setEntete($lEntete);
			
			$lContenuTableau = array();
			foreach($lProduits as $lProduit) {
				array_push($lContenuTableau,array($lProduit->getNproNom()));
			}
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		}		
		return $lVr;
	}
	
}
?>