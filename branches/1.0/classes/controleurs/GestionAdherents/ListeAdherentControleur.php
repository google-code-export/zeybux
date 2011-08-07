<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/01/2010
// Fichier : ListeAdherentControleur.php
//
// Description : Classe ListeAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/ListeAdherentResponse.php" );

/**
 * @name ListeAdherentControleur
 * @author Julien PIERRE
 * @since 31/01/2010
 * @desc Classe controleur d'une liste d'adherent
 */
class ListeAdherentControleur
{	
	/**
	* @name getListeAdherent()
	* @return ListeAdherentResponse
	* @desc Recherche la liste des adherents
	*/
	public function getListeAdherent() {		
		// Lancement de la recherche
		$lResponse = new ListeAdherentResponse();
		$lResponse->setListeAdherent(ListeAdherentViewManager::selectAll());
		return $lResponse;
	}
}
?>
