<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2010
// Fichier : Chemin.php
//
// Description : Informations sur le chemin absolu de la racine du site
//
//****************************************************************
define("CHEMIN_RACINE", ".");
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
define("CHEMIN_CLASSES_SERVICE", CHEMIN_RACINE . "/classes/service/");

define("CHEMIN_VUES", CHEMIN_RACINE . "/vues/");
define("CHEMIN_TEMPLATE", CHEMIN_RACINE . "/html/");
define("COMMUN_TEMPLATE", "Commun/");
define("CHEMIN_CSS", "./css/");
define("COMMUN_CSS", "Commun/");
define("CHEMIN_CONFIGURATION", CHEMIN_RACINE . "/configuration/");

define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");
?>
