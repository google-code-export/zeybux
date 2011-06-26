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
define("CHEMIN_CLASSES_UTILS", CHEMIN_CLASSES . "utils/");
define("CHEMIN_CLASSES_PO", CHEMIN_CLASSES . "po/");
define("CHEMIN_CLASSES_VO", CHEMIN_CLASSES . "vo/");
define("CHEMIN_CLASSES_VIEW_VO", CHEMIN_CLASSES . "viewVO/");
define("CHEMIN_CLASSES_MANAGERS", CHEMIN_CLASSES . "managers/");
define("CHEMIN_CLASSES_VIEW_MANAGER", CHEMIN_CLASSES . "viewManager/");
define("CHEMIN_CLASSES_CONTROLEURS", CHEMIN_CLASSES . "controleurs/");
define("CHEMIN_CLASSES_VR", CHEMIN_CLASSES . "vr/");
define("CHEMIN_CLASSES_VALIDATEUR", CHEMIN_CLASSES . "validateur/");
define("CHEMIN_CLASSES_TOVO", CHEMIN_CLASSES . "toVO/");
define("CHEMIN_CLASSES_RESPONSE", CHEMIN_CLASSES . "response/");
define("CHEMIN_CLASSES_SERVICE", CHEMIN_CLASSES . "service/");

define("CHEMIN_VUES", CHEMIN_RACINE . "/vues/");
define("CHEMIN_TEMPLATE", CHEMIN_RACINE . "/html/");
define("CHEMIN_CONFIGURATION", CHEMIN_RACINE . "/configuration/");

define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");
?>