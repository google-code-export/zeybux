<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/01/2010
// Fichier : MonCompteControleur.php
//
// Description : Classe MonCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_MON_COMPTE . "/InfoCompteResponse.php" );

/**
 * @name MonCompteControleur
 * @author Julien PIERRE
 * @since 29/01/2010
 * @desc Classe controleur d'un compte
 */
class MonCompteControleur
{	
	/**
	* @name getInfoCompte($pParam)
	* @return InfoCompteResponse
	* @desc Renvoie le Compte de l'adherent après avoir récupérer les informations en fonction de l'ID.
	*/
	public function getInfoCompte($pParam) {
		$lResponse = new InfoCompteResponse();
		$lIdAdherent = $pParam['id_adherent'];
		$lAdherent = AdherentViewManager::select( $lIdAdherent );
		$lResponse->setAdherent($lAdherent);
		$lOperationService = new OperationService();
		$lResponse->setOperationAvenir( $lOperationService->getOperationAvenir( $lAdherent->getAdhIdCompte() ));
		$lResponse->setOperationPassee( $lOperationService->getOperationPassee( $lAdherent->getAdhIdCompte() ));
		return $lResponse;
	}
	
	/**
	* @name getInfoAdherent($pParam)
	* @return InfoCompteResponse
	* @desc Renvoie le Compte de l'adherent après avoir récupérer les informations en fonction de l'ID.
	*/
	public function getInfoAdherent($pParam) {
		$lResponse = new InfoCompteResponse();
		$lIdAdherent = $pParam['id_adherent'];
		$lAdherent = AdherentViewManager::select( $lIdAdherent );
		$lResponse->setAdherent($lAdherent);
		return $lResponse;
	}
}
?>
