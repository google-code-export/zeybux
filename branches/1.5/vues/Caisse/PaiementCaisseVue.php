<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2014
// Fichier : PaiementCaisseVue.php
//
// Description : Script de gestion des adhésions
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_CAISSE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam["fonction"])) {
			
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_CAISSE . "/PaiementCaisseControleur.php");
			// Création du controleur
			$lControleur = new PaiementCaisseControleur();
			switch($lParam["fonction"]) {
				case "listeMarche":
					echo $lControleur->getListeMarche()->exportToJson();
					break;
					
				case "listePaiement":
					echo $lControleur->getListePaiement($lParam)->exportToJson();
					break;

				default:
					$lLogger->log("Demande d'accés à PaiementCaisse sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
			
		} else {
			$lLogger->log("Demande d'accés à PaiementCaisse sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['id']) && isset($_POST['type'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_CAISSE . "/PaiementCaisseControleur.php");					
			$lControleur = new PaiementCaisseControleur();
			$lParam = array();
			$lParam['id'] = $_POST['id'];
			$lParam['type'] = $_POST['type'];
			
			switch($_POST['fonction']) {					
				case "export":
					echo $lControleur->getListePaiementExport($lParam);
					break;
					
				default:
					$lLogger->log("Demande d'accés à PaiementCaisse sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à PaiementCaisse pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés sans parametre à PaiementCaisse",PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à PaiementCaisse",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>