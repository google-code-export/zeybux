<?php 
session_start(); 

if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	// Inclusion de la config
	define("CHEMIN_RACINE", "../../");
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
	define("COMMUN_TEMPLATE", "Commun/");
	define("CHEMIN_CONFIGURATION", CHEMIN_RACINE . "/configuration/");
	define("CHEMIN_JS", CHEMIN_RACINE . "/js/");
	define("CHEMIN_TEMPORAIRE", CHEMIN_RACINE . "/tmp/");
	
	define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");
	
	include_once(CHEMIN_CONFIGURATION . "Localisation.php"); // Les informations de localisation
	include_once(CHEMIN_CONFIGURATION . "Identification.php"); // Définition des constantes pour les droits
	include_once(CHEMIN_CONFIGURATION . "Modules.php"); // Définition des constantes de module
	include_once(CHEMIN_CONFIGURATION . "Version.php"); // La version
	include_once(CHEMIN_CONFIGURATION . "Titre.php"); // Définition des constantes de titre
	include_once(CHEMIN_CLASSES_UTILS . "Log.php"); // La classe de Log
	
	// Définition du level de log
	define("LOG_LEVEL",PEAR_LOG_DEBUG);
	
	include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
	include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
	
	$lAdherents = AdherentViewManager::selectAll();
	
	$lCSV = new CSV();
	$lCSV->setNom('Adherents.csv'); // Le Nom
		
	// L'entete
	$lEntete = array("N°","Nom","Prénom","Courriel 1","Courriel 2","Téléphone 1","Téléphone 2","Adresse","Code Postal","Ville","Date de Naissance","Date d'Adhésion","Commentaire","Compte","Solde");
	$lCSV->setEntete($lEntete);
	
	// Les données
	$lContenuTableau = array();
	foreach($lAdherents as $lAdh) {
		if($lAdh->getAdhId() != NULL && $lAdh->getAdhEtat() == 1) { // Pas de ligne Vide ni d'adhérent supprimé	
			$lDateNaissance = StringUtils::dateDbToFr(htmlspecialchars_decode($lAdh->getAdhDateNaissance(), ENT_QUOTES));
			if($lDateNaissance == "00/00/0000") {$lDateNaissance = "";}
			
			$lDateAdhesion = StringUtils::dateDbToFr(htmlspecialchars_decode($lAdh->getAdhDateAdhesion(), ENT_QUOTES));
			if($lDateAdhesion == "00/00/0000") {$lDateAdhesion = "";}
			
			$lLignecontenu = array(	htmlspecialchars_decode($lAdh->getAdhNumero(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhNom(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhPrenom(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhCourrielPrincipal(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhCourrielSecondaire(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhTelephonePrincipal(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhTelephoneSecondaire(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhAdresse(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhCodePostal(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getAdhVille(), ENT_QUOTES),
									$lDateNaissance,
									$lDateAdhesion,
									htmlspecialchars_decode($lAdh->getAdhCommentaire(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getCptLabel(), ENT_QUOTES),
									htmlspecialchars_decode($lAdh->getCptSolde(), ENT_QUOTES)
									);
			
			array_push($lContenuTableau,$lLignecontenu);
		}
	} 
	$lCSV->setData($lContenuTableau);
	
	// Export en CSV
	$lCSV->output();
}
?>