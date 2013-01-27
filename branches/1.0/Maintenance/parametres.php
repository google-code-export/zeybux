<?php
include("./DB.php");

// Dump MySQL et File
//define("MYSQL_DUMP", "./dump/");
define("FILE_DUMP", "./ancien");

// Upload
define("DOSSIER_UPLOAD", "./archive/");

// Extraction
define("DOSSIER_EXTRACT", "./nouveau");
define("LOG_EXTRACT", "./logs/");

// Déploiement
define("DOSSIER_SITE", "..");
define("DOSSIER_UPDATE_BDD", DOSSIER_EXTRACT . "/bdd");

// Configuration
define("DOSSIER_CONFIGURATION", "./configuration");
define("DOSSIER_SITE_CONFIGURATION", DOSSIER_SITE . "/configuration");

define("DOSSIER_SITE_UTILS", DOSSIER_SITE . "/classes/utils/");
define("DOSSIER_SITE_LOGS", DOSSIER_SITE . "/logs/");

// La version actuelle du site
include(DOSSIER_SITE_CONFIGURATION . "/Version.php");
// Si la version technique n'existe pas définition à 0
if(!defined( ZEYBUX_VERSION_TECHNIQUE ) ) {
	define("ZEYBUX_VERSION_TECHNIQUE", 0);
}
?>