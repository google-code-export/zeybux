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
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/ListeProducteurResponse.php" );

/**
 * @name ListeProducteurControleur
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe controleur d'une liste des producteurs
 */
class ListeProducteurControleur
{	
	/**
	* @name getListeProducteur()
	* @return ListeProducteurResponse
	* @desc Recherche la liste des producteurs
	*/
	public function getListeProducteur() {		
		// Lancement de la recherche
		$lResponse = new ListeProducteurResponse();
		$lResponse->setListeProducteur(ProducteurViewManager::selectAll());
		return $lResponse;
	}
}
?>
