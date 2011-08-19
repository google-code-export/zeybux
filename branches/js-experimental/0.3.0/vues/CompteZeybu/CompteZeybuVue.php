<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybu.php
//
// Description : Script d'affichage du Compte Zeybu
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ZEYBU]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ZEYBU . "/CompteZeybuControleur.php");

	$lControleur = new CompteZeybuControleur();
	echo $lControleur->getInfoCompte()->exportToJson();	
	
	$lLogger->log("Affichage de la vue CompteZeybu par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs

} else {
	$lLogger->log("Demande d'accés sans autorisation au Compte Zeybu",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>