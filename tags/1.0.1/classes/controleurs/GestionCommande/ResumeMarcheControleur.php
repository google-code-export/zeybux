<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : ResumeMarcheControleur.php
//
// Description : Classe ResumeMarcheControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoCommandeViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/InfoCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/InfoCommandeValid.php" );

/**
 * @name ResumeMarcheControleur
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe controleur d'une ResumeMarche
 */
class ResumeMarcheControleur
{	
	/**
	* @name getInfoMarche()
	* @return InfoCommandeResponse
	* @desc Retourne les infos sur la commande archivée
	*/
	public function getInfoMarche($pParam) {
		$lVr = InfoCommandeValid::get($pParam);		
		if($lVr->getValid()) {
			$lResponse = new InfoCommandeResponse();
			$lResponse->setInfoCommande( InfoCommandeViewManager::select($pParam['id_marche']) );
			$lResponse->setDetailMarche( CommandeManager::select($pParam['id_marche']) );
			return $lResponse;
		}
		return $lVr;
	}
}
?>