<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AjoutAdherentControleur.php
//
// Description : Classe AjoutAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/ListeAdherentResponse.php" );

/**
 * @name AjoutAdherentControleur
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe controleur d'un Ajout d'adherent
 */
class AjoutAdherentControleur
{
	/**
	 * @name getListeAdherent()
	 * @return ListeAdherentResponse
	 * @desc Recherche la liste des adherents
	 */
	public function getListeAdherent() {
		// Lancement de la recherche
		$lResponse = new ListeAdherentResponse();
		$lAdherentService = new AdherentService();
		$lResponse->setListeAdherent($lAdherentService->getAllActif());
		return $lResponse;
	}
	
	/**
	* @name ajoutAdherent($pAdherent)
	* @return string
	* @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	*/
	public function ajoutAdherent($pAdherent) {				
		$lVr = AdherentValid::validAjout($pAdherent);
		if($lVr->getValid()) {			
			$lAdherent = AdherentToVO::convertFromArray($pAdherent);			
			$lAdherentService = new AdherentService();
			$lAdherent = $lAdherentService->set($lAdherent);
			
			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lAdherent->getId());
			return $lResponse;						
		}	
		return $lVr;
	}
}
?>