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
include_once("./configuration/Maintenance.php");
if(MAINTENANCE == 1) {

	include_once("./configuration/Chemin.php");
	include_once("./configuration/Localisation.php");
	
	// Définition des constantes de chemin
	define("CHEMIN_CLASSES", CHEMIN_RACINE . "/classes/");
	define("CHEMIN_CLASSES_UTILS", CHEMIN_RACINE . "/classes/utils/");
	define("CHEMIN_CLASSES_PO", CHEMIN_RACINE . "/classes/po/");
	define("CHEMIN_CLASSES_VO", CHEMIN_RACINE . "/classes/vo/");
	define("CHEMIN_CLASSES_VIEW_VO", CHEMIN_RACINE . "/classes/viewVO/");
	define("CHEMIN_CLASSES_MANAGERS", CHEMIN_RACINE . "/classes/managers/");
	define("CHEMIN_CLASSES_VIEW_MANAGER", CHEMIN_RACINE . "/classes/viewManager/");
	define("CHEMIN_CLASSES_CONTROLEURS", CHEMIN_RACINE . "/classes/controleurs/");
	define("CHEMIN_CLASSES_VR", CHEMIN_RACINE . "/classes/vr/");
	define("CHEMIN_CLASSES_VALIDATEUR", CHEMIN_RACINE . "/classes/validateur/");
	define("CHEMIN_CLASSES_TOVO", CHEMIN_RACINE . "/classes/toVO/");
	define("CHEMIN_CLASSES_RESPONSE", CHEMIN_RACINE . "/classes/response/");
	
	define("CHEMIN_VUES", CHEMIN_RACINE . "/vues/");
	define("CHEMIN_TEMPLATE", CHEMIN_RACINE . "/html/");
	define("COMMUN_TEMPLATE", "Commun/");
	define("CHEMIN_CSS", "./css/");
	define("COMMUN_CSS", "Commun/");
	define("CHEMIN_CONFIGURATION", CHEMIN_RACINE . "/configuration/");
	
	define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");
	
	// Définition des constantes pour les droits
	define("DROIT_ID", "id");
	define("ID_COMPTE", "id_compte");
	define("DROIT_SUPER_ZEYBU", "superzeybu");
	
	// Définition des constantes de module
	define("MOD_IDENTIFICATION", "Identification");
	define("MOD_MON_COMPTE", "MonCompte");
	define("MOD_GESTION_ADHERENTS", "GestionAdherents");
	define("MOD_COMMANDE", "Commande");
	define("MOD_GESTION_COMMANDE", "GestionCommande");
	define("MOD_GESTION_PRODUCTEUR", "GestionProducteur");
	define("MOD_COMPTE_ZEYBU", "CompteZeybu");	
	define("MOD_RECHARGEMENT_COMPTE", "RechargementCompte");
	
	// Définition des constantes de titre
	include_once("./configuration/Version.php");
	define("ZEYBUX_TITRE_DEBUT","");
	define("ZEYBUX_TITRE_FIN","Zeybux " . ZEYBUX_VERSION . " - Outil de gestion du Zeybu");
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_UTILS."Logging/Log.php");
	
	// Définition du level de log
	//define("LOG_LEVEL",PEAR_LOG_INFO);
	define("LOG_LEVEL",PEAR_LOG_DEBUG);
	
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
		// Retour erreur en json
		include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
		include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_116_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_116_MSG);
		$lVr->getLog()->addErreur($lErreur);
		echo $lVr->exportToJson();
	}
	else {
		// Affichage du formulaire d'identification
		include(CHEMIN_VUES . MOD_IDENTIFICATION . "/IdentificationVue.php");
	}

} else {
	// Affichage de la maintenance
	include("./Maintenance/Maintenance.html");
}

// Calcul du temps d'exécution du script
$lTempsFin = microtime(true);
$lTemps = $lTempsFin - $lTempsDepart;

// Affiche le temps d'exécution du script
//echo "<div class=\"ui-priority-primary\" >Temps d'exécution : ". substr($lTemps,0,5) . " secondes.</div>";
//if(LOG_LEVEL == PEAR_LOG_DEBUG) {
if(false) {
	echo "<div class=\"ui-widget\" style=\"position:absolute; top:0px; right:20px; width:180px; font-size:10.5pt;\" >
		<div class=\"ui-state-highlight ui-corner-all\" style=\"margin-top: 20px; padding: 0 .7em;\"> 
			<p style=\"margin:5px;\"><span class=\"ui-icon ui-icon-info\" style=\"float: left; margin-right: .3em;\"></span>
	
			Temps d'exécution<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" .substr($lTemps,0,5) ." secondes !!</p>
		</div>
	</div>";
}
?>




