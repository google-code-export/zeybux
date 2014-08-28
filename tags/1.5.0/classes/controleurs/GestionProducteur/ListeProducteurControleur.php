<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ListeProducteurControleur.php
//
// Description : Classe ListeProducteurControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/ListeProducteurResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/ProducteurValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/AjoutProducteurResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/ModifierProducteurResponse.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/DetailProducteurResponse.php" );

/**
 * @name ListeProducteurControleur
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe controleur d'une liste des producteurs d'une ferme
 */
class ListeProducteurControleur
{	
	/**
	* @name getListeProducteur()
	* @return ListeProducteurResponse
	* @desc Recherche la liste des producteurs de la ferme
	*/
	public function getListeProducteur($pParam) {	
		$lVr = FermeValid::validDelete($pParam);	
		if($lVr->getValid()) {
			// Lancement de la recherche
			$lResponse = new ListeProducteurResponse();
			$lResponse->setListeProducteur(ListeProducteurViewManager::select($pParam["id"]));
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name ajouterProducteur($pParam)
	* @return string
	* @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	*/
	public function ajouterProducteur($pParam) {				
		$lVr = ProducteurValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lProducteur = new ProducteurVO();
			$lProducteur->setIdFerme($pParam["idFerme"]);
			$lProducteur->setNom($pParam["nom"]);
			$lProducteur->setPrenom($pParam["prenom"]);
			$lProducteur->setCourrielPrincipal($pParam["courrielPrincipal"]);
			$lProducteur->setCourrielSecondaire($pParam["courrielSecondaire"]);
			$lProducteur->setTelephonePrincipal($pParam["telephonePrincipal"]);
			$lProducteur->setTelephoneSecondaire($pParam["telephoneSecondaire"]);
			$lProducteur->setAdresse($pParam["adresse"]);
			$lProducteur->setCodePostal($pParam["codePostal"]);
			$lProducteur->setVille($pParam["ville"]);
			$lProducteur->setDateNaissance($pParam["dateNaissance"]);
			$lProducteur->setCommentaire($pParam["commentaire"]);
			
			
			// Insertion de la date de création
			$lProducteur->setDateCreation( StringUtils::dateAujourdhuiDb() );
						
			// Insertion de la première mise à jour
			$lProducteur->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
			
			// Le producteur n'est pas supprimé
			$lProducteur->setEtat(0);
						
			// Enregistre le poducteur dans la BDD
			$lId = ProducteurManager::insert( $lProducteur );
						
			$lResponse = new AjoutProducteurResponse();
			$lResponse->setId($lId);
			$lProducteur = ProducteurManager::select($lId);
			$lResponse->setNumero($lProducteur->getNumero());
			
			return $lResponse;
		}	
		return $lVr;
	}
	
	/**
	* @name supprimerProducteur($pParam)
	* @desc Passe le producteur en état supprimé
	*/
	public function supprimerProducteur($pParam) {				
		$lVr = ProducteurValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lProducteur = ProducteurManager::select( $pParam['id'] );					
			// Change l'état
			$lProducteur->setEtat(1);
			ProducteurManager::update( $lProducteur );
				
			$lResponse = new ModifierProducteurResponse();
			$lResponse->setNumero($lProducteur->getNumero());			
			return $lResponse;
		}	
		return $lVr;
	}
	
	/**
	* @name detailProducteur($pParam)
	* @desc Passe le producteur en état supprimé
	*/
	public function detailProducteur($pParam) {		
		$lVr = ProducteurValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lProducteur = ProducteurViewManager::select( $pParam['id'] );
				
			$lResponse = new DetailProducteurResponse();
			$lResponse->setProducteur( $lProducteur[0] );			
			return $lResponse;
		}	
		return $lVr;
	}
	
	/**
	* @name modifierProducteur($pParam)
	* @desc Met à jour les informations du Producteur ainsi que ses autorisations
	*/
	public function modifierProducteur($pParam) {		
		$lVr = ProducteurValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lProducteur = new ProducteurVO();
			$lProducteur->setId($pParam["id"]);
			$lProducteur->setIdFerme($pParam["idFerme"]);
			$lProducteur->setNom($pParam["nom"]);
			$lProducteur->setPrenom($pParam["prenom"]);
			$lProducteur->setCourrielPrincipal($pParam["courrielPrincipal"]);
			$lProducteur->setCourrielSecondaire($pParam["courrielSecondaire"]);
			$lProducteur->setTelephonePrincipal($pParam["telephonePrincipal"]);
			$lProducteur->setTelephoneSecondaire($pParam["telephoneSecondaire"]);
			$lProducteur->setAdresse($pParam["adresse"]);
			$lProducteur->setCodePostal($pParam["codePostal"]);
			$lProducteur->setVille($pParam["ville"]);
			$lProducteur->setDateNaissance($pParam["dateNaissance"]);
			$lProducteur->setCommentaire($pParam["commentaire"]);
						
			// Insertion de la date de mise à jour
			$lProducteur->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
						
			// On reporte le numero dans la maj
			$lProducteurActuel = ProducteurManager::select( $lProducteur->getId() );
			$lProducteur->setNumero($lProducteurActuel->getNumero());
						
			// L'adherent n'est pas supprimé
			$lProducteur->setEtat(0);
						
			// Maj du producteur dans la BDD
			ProducteurManager::update( $lProducteur );
						
			$lResponse = new ModifierProducteurResponse();
			$lResponse->setNumero($lProducteur->getNumero());
			
			return $lResponse;
				
		}	
		return $lVr;										
	}
}
?>