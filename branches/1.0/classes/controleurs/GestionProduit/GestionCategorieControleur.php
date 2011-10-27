<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : GestionCategorieControleur.php
//
// Description : Classe GestionCategorieControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUIT ."/ListeCategorieResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUIT ."/AutorisationSupprimerCategorieResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CategorieProduitActiveViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUIT . "/CategorieProduitValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "CategorieProduitToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");

/**
 * @name GestionCategorieControleur
 * @author Julien PIERRE
 * @since 09/10/2011
 * @desc Classe controleur d'une GestionCategorieControleur
 */
class GestionCategorieControleur
{		
	/**
	* @name getCategorie()
	* @return ListeCategorieResponse
	* @desc Retourne la liste des categories
	*/
	public function getCategorie() {
		$lResponse = new ListeCategorieResponse();
		$lResponse->setListeCategorie( CategorieProduitActiveViewManager::selectAll() );
		return $lResponse;
	}
	
	/**
	* @name ajouterCategorie($lParam)
	* @return CategorieProduitVR
	* @desc Ajoute une categorie et retourne son nom et ID
	*/
	public function ajouterCategorie($lParam) {	
		$lVr = CategorieProduitValid::validAjout($lParam);
		
		if($lVr->getValid()) {
			$lCategorieProduitVO = CategorieProduitToVO::convertFromArray( $lParam['categorieProduit']);
			CategorieProduitManager::insert($lCategorieProduitVO);
		}		
		return $lVr;
	}
	
	/**
	* @name modifierCategorie($lParam)
	* @return CategorieProduitVR
	* @desc Modifie une categorie et retourne son nom et ID
	*/
	public function modifierCategorie($lParam) {	
		$lVr = CategorieProduitValid::validUpdate($lParam);		
		if($lVr->getValid()) {
			$lCategorieProduitVO = CategorieProduitToVO::convertFromArray( $lParam['categorieProduit']);
			CategorieProduitManager::update($lCategorieProduitVO);
		}		
		return $lVr;
	}
	
	/**
	* @name supprimerCategorie($lParam)
	* @return CategorieProduitVR
	* @desc Supprime une categorie
	*/
	public function supprimerCategorie($lParam) {	
		$lVr = CategorieProduitValid::validDelete($lParam);		
		if($lVr->getValid()) {
			$lAutorisation = GestionCategorieControleur::autorisationSupprimerCategorie($lParam);			
			if($lAutorisation->getValid() && $lAutorisation->getAutorisation()) {		
				$lCategorie = CategorieProduitManager::select($lParam['id']);
				$lCategorie->setEtat(1);
				CategorieProduitManager::update($lCategorie);
			}
			return $lAutorisation;
		}		
		return $lVr;
	}
	
	/**
	* @name autorisationSupprimerCategorie($lParam)
	* @return CategorieProduitVR
	* @desc Retourne l'autorisation de supprimer une categorie ainsi que le nombre de produit associé à la catégorie
	*/
	public function autorisationSupprimerCategorie($lParam) {	
		$lVr = CategorieProduitValid::validDelete($lParam);		
		if($lVr->getValid()) {
			$lReponse = new AutorisationSupprimerCategorieResponse();
			$lProduits = GestionCategorieControleur::listeProduitCategorie($lParam['id']);		
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
	* @name listeProduitCategorie($pId)
	* @return array(NomProduitVO)
	* @desc Retourne la liste des produits liés à la catégorie
	*/
	private function listeProduitCategorie($pId) {
		return NomProduitManager::selectByIdCategorie($pId);
	}
	
	/**
	* @name exportProduitCategorie($lParam)
	* @return CSV
	* @desc Retourne la liste des produits liés à la catégorie
	*/	
	public function exportProduitCategorie($lParam) {
		$lVr = CategorieProduitValid::validDelete($lParam);		
		if($lVr->getValid()) {
			$lCategorie = CategorieProduitManager::select($lParam['id']);
			$lProduits = GestionCategorieControleur::listeProduitCategorie($lParam['id']);
			
			$lCSV = new CSV();
			$lCSV->setNom($lCategorie->getNom() . '_:_Liste_des_produits.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Nom du Produit");
			$lCSV->setEntete($lEntete);
			
			$lContenuTableau = array();
			foreach($lProduits as $lProduit) {
				array_push($lContenuTableau,array($lProduit->getNom()));
			}
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		}		
		return $lVr;
	}
	
}
?>