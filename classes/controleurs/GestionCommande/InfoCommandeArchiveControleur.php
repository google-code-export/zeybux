<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeArchiveControleur.php
//
// Description : Classe InfoCommandeArchiveControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoCommandeViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "InfoCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "InfoCommandeValid.php" );

/**
 * @name InfoCommandeArchiveControleur
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe controleur d'une InfoCommandeArchive
 */
class InfoCommandeArchiveControleur
{	
	/**
	* @name getInfoCommandeArchive()
	* @return InfoCommandeResponse
	* @desc Retourne les infos sur la commande archivée
	*/
	public function getInfoCommandeArchive($pParam) {
		$lVr = InfoCommandeValid::get($pParam);		
		if($lVr->getValid()) {
			$lResponse = new InfoCommandeResponse();
			$lResponse->setInfoCommande( InfoCommandeViewManager::select($pParam['id_commande']) );
			$lResponse->setDetailMarche( CommandeManager::select($pParam['id_commande']) );
			return $lResponse;
		}
		return $lVr;
	}
}
?>