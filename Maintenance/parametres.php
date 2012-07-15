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
define("DOSSIER_SITE", "../");
define("FILE_UPDATE_BDD", DOSSIER_EXTRACT . "/update.sql");

// Configuration
define("DOSSIER_CONFIGURATION", "./configuration");
define("DOSSIER_SITE_CONFIGURATION", DOSSIER_SITE . "configuration");

define("DOSSIER_SITE_UTILS", DOSSIER_SITE . "classes/utils/");
define("DOSSIER_SITE_LOGS", DOSSIER_SITE . "logs/");
?>
