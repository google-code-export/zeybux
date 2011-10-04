<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsControleur.php
//
// Description : Classe MesAchatsControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/MesAchatsResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MesAchatsViewManager.php");

/**
 * @name MesAchatsControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une MesAchats
 */
class MesAchatsControleur
{	
	/**
	* @name getListe()
	* @return MesAchatsResponse
	* @desc Retourne la liste des achats
	*/
	public function getListe() {		
		$lResponse = new MesAchatsResponse();
		$lResponse->setAchats( MesAchatsViewManager::select($_SESSION[ID_COMPTE]) );
		return $lResponse;
	}
}
?>