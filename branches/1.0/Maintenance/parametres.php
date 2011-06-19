<?php

define("MYSQL_HOST", "localhost");
define("MYSQL_LOGIN", "zeybu");
define("MYSQL_PASS", "zeybu");
define("MYSQL_DBNOM", "zeybu");

// Dump MySQL et File
define("MYSQL_DUMP", "./dump/");
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
?>
