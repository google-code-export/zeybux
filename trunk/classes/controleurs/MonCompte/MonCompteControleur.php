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
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationAvenirViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationPasseeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "InfoCompteResponse.php" );

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
		$lResponse->setOperationAvenir( OperationAvenirViewManager::select( $lAdherent->getAdhIdCompte() ));
		$lResponse->setOperationPassee( OperationPasseeViewManager::select( $lAdherent->getAdhIdCompte() ));
		return $lResponse;
	}
}
?>
