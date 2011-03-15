<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/01/2010
// Fichier : MonCompteVue.php
//
// Description : Script de vue du compte Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_MON_COMPTE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_MON_COMPTE . "/MonCompteControleur.php");

	$lControleur = new MonCompteControleur();
	$lParam['id_adherent'] = $_SESSION[DROIT_ID];
	echo $lControleur->getInfoCompte($lParam)->exportToJson();
		
	$lLogger->log("Affichage du compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
} else {
	$lLogger->log("Demande d'affichage sans autorisation du compte de l'Adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
