<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2010
// Fichier : index.php
//
// Description : Page d'index
//
//****************************************************************
session_start();

// Permet de calculer le temps d'exécution du script
$lTempsDepart = microtime(true);

// Inclusion de la config
include_once("./configuration/Maintenance.php"); // Etat de maintenance du zeybux
if(MAINTENANCE == 1) {
	include_once("./configuration/Chemin.php"); // Les constantes de chemin
	include_once(CHEMIN_CONFIGURATION . "Localisation.php"); // Les informations de localisation
	include_once(CHEMIN_CONFIGURATION . "Identification.php"); // Définition des constantes pour les droits
	include_once(CHEMIN_CONFIGURATION . "Modules.php"); // Définition des constantes de module
	include_once(CHEMIN_CONFIGURATION . "Version.php"); // La version
	include_once(CHEMIN_CONFIGURATION . "Titre.php"); // Définition des constantes de titre
	include_once(CHEMIN_CLASSES_UTILS . "Log.php"); // La classe de Log
	include_once(CHEMIN_CONFIGURATION . "LogLevel.php"); // Définition du level de log
	
	
	//define("LOG_LEVEL",PEAR_LOG_INFO);
	//define("LOG_LEVEL",PEAR_LOG_DEBUG);
	
	// Mise en place du fichier de log
	// initialisation du logger pour écriture dans le dossier /Logs/ avec comme nom de fichier la date
	$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
	$lLogger->setMask(Log::MAX(LOG_LEVEL));

	// Inclusion de la vue demandée
	if ( isset($_GET['m']) && isset($_GET['v'])) {
		$lVue = CHEMIN_VUES . $_GET['m'] . "/" . $_GET['v'] . "Vue.php";
		if(file_exists($lVue)) {
			include($lVue);
		}
		else {
			if(isset($_SESSION[DROIT_ID])) {
				header('location:./index.php?cx=1');
			} else {
				// Affichage du formulaire d'identification
				include(CHEMIN_VUES . MOD_IDENTIFICATION . "/IdentificationVue.php");
			}
		}
	} // Si c'est un problème de connexion
	else if(isset($_GET['cx'])) {
		include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
		include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_116_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_116_MSG);
		$lVr->getLog()->addErreur($lErreur);
		if($_GET['cx'] == 1) {
			// Retour erreur en json
			echo $lVr->exportToJson();
		} else if($_GET['cx'] == 2) {
			$_SESSION['msg'] = $lVr->exportToArray();				
			// Affichage du formulaire d'identification
			include(CHEMIN_VUES . MOD_IDENTIFICATION . "/IdentificationVue.php");
		}
	}
	else {
		// Affichage du formulaire d'identification
		include(CHEMIN_VUES . MOD_IDENTIFICATION . "/IdentificationVue.php");
	}
	
	// Calcul du temps d'exécution du script
	$lTempsFin = microtime(true);
	$lTemps = $lTempsFin - $lTempsDepart;
	$lLogger->log("Affichage de la page en : " . substr($lTemps,0,5) . " secondes !!",PEAR_LOG_DEBUG);	// Maj des logs

} else {
	// Affichage de la maintenance
	include("./Maintenance/Maintenance.html");
}
?>
