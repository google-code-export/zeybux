<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : GestionListeCommandeControleur.php
//
// Description : Classe GestionListeCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionListeCommandeEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionListeCommandeArchiveViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/GestionListeCommandeResponse.php" );

/**
 * @name GestionListeCommandeControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une GestionListeCommande
 */
class GestionListeCommandeControleur
{	
	/**
	* @name getListeCommandeArchive()
	* @return GestionListeCommandeResponse
	* @desc Retourne la liste des commandes en archive
	*/
	public function getListeCommandeArchive() {
		$lListeCommande = new GestionListeCommandeResponse();
		$lListeCommande->setListeCommande( GestionListeCommandeArchiveViewManager::selectAll() );
		return $lListeCommande;		
	}
	
	/**
	* @name getListeCommandeEnCours()
	* @return GestionListeCommandeResponse
	* @desc Retourne la liste des commandes en cours
	*/
	public function getListeCommandeEnCours() {
		$lListeCommande = new GestionListeCommandeResponse();
		$lListeCommande->setListeCommande( GestionListeCommandeEnCoursViewManager::selectAll() );
		return $lListeCommande;
	}
}
?>
