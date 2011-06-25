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
// Définition des constantes

// Constante de titre de la page
define("IDE_TITRE", ZEYBUX_TITRE_DEBUT . ZEYBUX_TITRE_FIN);

// Constantes des messages d'erreurs
//define("IDE_MSG_INFORMATION", "Erreur de connexion");

// Constantes css
//define("FORMULAIRE_IDENTIFICATION_CSS", CHEMIN_CSS . COMMUN_CSS . "FormulaireIdentification.css");
//define("IDENTIFICATION_CSS", CHEMIN_CSS . MOD_IDENTIFICATION . "/Identification.css");

// Constantes du formulaire
/*define("IDE_ACTION", "./index.php");
define("IDE_METHOD", "post");
define("IDE_LOGIN", "login");
define("IDE_PASS", "pass");*/

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
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_UTILS . "Template.php");

	// Préparation de l'affichage
	$lTemplate = new Template(CHEMIN_TEMPLATE);
	
	// Entete
	$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
	$lTemplate->assign_vars( array( 'TITRE' => IDE_TITRE) );
	
	$lTemplate->assign_var_from_handle('ENTETE', 'entete');
	
	// Body
	$lTemplate->set_filenames( array('body' => MOD_IDENTIFICATION . '/' . 'Identification.html') );
	
	// Pied de page
	$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );	
	$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
	
	// Affichage des templates
	$lTemplate->pparse('body');
	
	$lLogger->log("Affichage du formulaire de connexion",PEAR_LOG_INFO); // Maj des logs
}
?>
