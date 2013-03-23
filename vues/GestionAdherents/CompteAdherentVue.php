<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : CompteAdherentVue.php
//
// Description : Script de Compte d'un Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ADHERENTS]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	// Test qu'un identifiant d'un compte est bien demandé
	if( isset( $_POST['pParam'] ) ) {		
		$lParam = json_decode($_POST['pParam'],true);		
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ADHERENTS . "/CompteAdherentControleur.php");
			$lCompteControleur = new CompteAdherentControleur();
				
				
			switch($lParam["fonction"]) {
				case "afficher":
					echo $lCompteControleur->Afficher($lParam)->exportToJson();
					$lLogger->log("Affichage du compte de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
		
				default:
					$lLogger->log("Demande d'accés à compte Adherent sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
				
		} else {
			$lLogger->log("Demande d'accés sans fonction à compte adhérent",PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'affichage d'un compte adhérent sans transmettre de paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à un compte d'adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
