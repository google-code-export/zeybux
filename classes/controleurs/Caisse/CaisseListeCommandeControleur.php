<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseListeCommandeControleur.php
//
// Description : Classe CaisseListeCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionListeCommandeEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "CaisseListeCommandeResponse.php" );

/**
 * @name CaisseListeCommandeControleur
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe controleur d'une CaisseListeCommandeControleur
 */
class CaisseListeCommandeControleur
{		
	/**
	* @name getListeCommandeEnCours()
	* @return CaisseListeCommandeResponse
	* @desc Retourne la liste des commandes en cours
	*/
	public function getListeCommandeEnCours() {
		$lListeCommande = new CaisseListeCommandeResponse();
		$lListeCommande->setListeCommande( GestionListeCommandeEnCoursViewManager::selectAll() );
		return $lListeCommande;
	}
}
?>
