<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/01/2012
// Fichier : IdentificationVue.php
//
// Description : Script d'identification des Adherents
//
//****************************************************************

// Si le login et la pass sont transmit alors on essaye l'identification sinon on affiche le formulaire de connexion
if( isset($_POST["login"]) && isset($_POST["pass"])) {
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_IDENTIFICATION . "/IdentificationControleur.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
	
	// Création du controleur
	$lControleur = new IdentificationControleur();
	
	// Identification
	$lParam = array("login" => $_POST["login"], "pass" => $_POST["pass"]);
	$lVr = $lControleur->identifier($lParam);
	//echo $lVr->exportToJson();
	
	// Authentification Réussite -> Redirection vers la vue du compte de l'utilisateur
	if ( $lVr->getValid() ) {
		$lLogger->log("Réussite de l'authentification pour l'utilisateur : " .  $_SESSION[ID_CONNEXION],PEAR_LOG_INFO); // Maj des logs
		if($lVr->getType() == 1) {
			header('location:./index.php?m=MonCompteHTML&v=MonCompte');
		} else {		
			// Retour à Mon Compte avec le message de confirmation
			include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
			include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_336_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_336_MSG);
			$lVr->getLog()->addErreur($lErreur);
			$_SESSION['msg'] = $lVr->exportToArray();
			
			header('location:./index.php');
		}
	} else {
		if($lVr->getLog()->getValid()) {
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_222_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_222_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}
		
		$_SESSION['msg'] = $lVr->exportToArray();
		$_SESSION['val'] = $lParam;
		
		$lLogger->log("Echec de l'authentification pour l'utilisateur.",PEAR_LOG_INFO); // Maj des logs
		header('location:./index.php');
	}
}
// Affichage du formulaire de connexion
else {
	$lLogger->log("Demande d'identification sans paramètre.",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php');
}
?>