<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuVue.php
//
// Description : Retourne le menu du compte
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) ) {
	
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_IDENTIFICATION . "/MenuControleur.php");
	$lControleur = new MenuControleur();
	echo $lControleur->getMenu()->exportToJson();

	$lLogger->log("Affichage de la vue Menu par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
} else {
	$lLogger->log("Demande d'accés sans autorisation à Menu",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>