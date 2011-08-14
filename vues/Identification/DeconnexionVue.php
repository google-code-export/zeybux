<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/01/2010
// Fichier : DeconnexionVue.php
//
// Description : Script de deconnexion de l'Adherent
//
//****************************************************************
// Test si l'adherent est connecté
if( isset($_SESSION[DROIT_ID]) ) {
	$lLogger->log("Déconnexion de l'utilisateur ayant pour ID : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO); // Maj des logs		
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_IDENTIFICATION . "/DeconnexionControleur.php");
	$lControleur = new DeconnexionControleur();
	$lControleur->deconnecter();
} else {
	$lLogger->log("Demande d'accés sans autorisation à Deconnexion",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php');
}
?>