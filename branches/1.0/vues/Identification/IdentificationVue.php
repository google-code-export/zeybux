<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : IdentificationVue.php
//
// Description : Script d'identification des Adherents
//
//****************************************************************

// Si le login et la pass sont transmit alors on essaye l'identification sinon on affiche le formulaire de connexion
if( isset($_POST["pParam"]) ) {	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_IDENTIFICATION . "/IdentificationControleur.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
	
	// Création du controleur
	$lIdentificationControleur = new IdentificationControleur();
	$lParam = json_decode($_POST["pParam"],true);
	
	// Identification
	$lVr = $lIdentificationControleur->identifier($lParam);
	
	echo $lVr->exportToJson();
	
	// Authentification Réussite -> Redirection vers la vue du compte de l'utilisateur
	if ( $lVr->getValid() ) {
		$lLogger->log("Réussite de l'authentification pour l'utilisateur : " . $lParam["login"] ,PEAR_LOG_INFO); // Maj des logs
	} else {
		$lLogger->log("Echec de l'authentification pour l'utilisateur.",PEAR_LOG_INFO); // Maj des logs
	}
} 
// Affichage du formulaire de connexion
else {
	// Constante de titre de la page
	define("IDE_TITRE", ZEYBUX_TITRE_DEBUT . ZEYBUX_TITRE_FIN);
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_UTILS . "Template.php");

	// Préparation de l'affichage
	$lTemplate = new Template(CHEMIN_TEMPLATE);	
	$lTemplate->set_filenames( array('index' =>  './index.html') );
	$lTemplate->assign_vars( array( 'TITRE' => IDE_TITRE) );
	
	// Affichage des templates
	$lTemplate->pparse('index');
	
	$lLogger->log("Affichage du formulaire de connexion",PEAR_LOG_INFO); // Maj des logs
}
?>