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
if( isset($_SESSION['id']) ) {
	$lLogger->log("Déconnexion de l'utilisateur ayant pour ID : " . $_SESSION['id'],PEAR_LOG_INFO); // Maj des logs

	session_unset();
	session_destroy();
}
header('location:./index.php');
?>
