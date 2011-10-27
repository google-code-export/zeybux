<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/10/2011
// Fichier : InformationFermeControleur.php
//
// Description : Classe InformationFermeControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "FermeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/InformationFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/AjoutFermeResponse.php" );
/*include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");*/
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationPasseeViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_PRODUCTEUR . "/FermeValid.php");

/**
 * @name InformationFermeControleur
 * @author Julien PIERRE
 * @since 26/10/2011
 * @desc Classe controleur d'une liste des Fermes
 */
class InformationFermeControleur
{	
	/**
	* @name getInformationFerme()
	* @return InformationFermeResponse
	* @desc Recherche la liste des Fermes
	*/
	public function getInformationFerme($pParam) {
		$lVr = FermeValid::validAfficherInformation($pParam);
		if($lVr->getValid()) {
			$lResponse = new InformationFermeResponse();
			$lFerme = FermeViewManager::select($pParam["id_ferme"]);
			$lResponse->setFerme($lFerme);
			$lResponse->setOperationPassee( OperationPasseeViewManager::select( $lFerme[0]->getFerIdCompte() ));
			$lResponse->setTypePaiement( TypePaiementManager::selectAll() );
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name modifierFerme($pParam)
	* @return AjoutFermeResponse
	* @desc Modifie une ferme
	*/
	public function modifierFerme($pParam) {	
		$lVr = FermeValid::validUpdate($pParam);
		if($lVr->getValid()) {
			
			$lFerme = FermeManager::select($pParam['id']);
			$lFerme->setNom($pParam["nom"]);
			$lFerme->setSiren($pParam["siren"]);
			$lFerme->setAdresse($pParam["adresse"]);
			$lFerme->setCodePostal($pParam["codePostal"]);
			$lFerme->setVille($pParam["ville"]);
			$lFerme->setDateAdhesion($pParam["dateAdhesion"]);
			$lFerme->setDescription($pParam["description"]);
			$lFerme->setEtat(0);			
			FermeManager::update($lFerme);
			
			$lResponse = new AjoutFermeResponse();
			$lResponse->setId($lFerme->getId());
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name supprimerFerme($pParam)
	* @return AjoutFermeResponse
	* @desc Supprime une ferme
	*/
	public function supprimerFerme($pParam) {	
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {			
			$lFerme = FermeManager::select($pParam['id']);
			$lFerme->setEtat(1);			
			FermeManager::update($lFerme);
			
			$lResponse = new AjoutFermeResponse();
			$lResponse->setId($lFerme->getId());
			return $lResponse;
		}
		return $lVr;
	}
}
?>