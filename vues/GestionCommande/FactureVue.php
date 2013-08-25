<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2013
// Fichier : FactureVue.php
//
// Description : Retourne les infos sur les factures
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/FactureControleur.php");							
			$lControleur = new FactureControleur();
			
			switch($pParam["fonction"]) {
				case "afficher":
						echo $lControleur->getListeMarche()->exportToJson();					
						$lLogger->log("Affichage de la vue Facture liste des marchés par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "rechercher":
						echo $lControleur->getListeFacture($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue Facture par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeFerme":
						echo $lControleur->getListeFerme()->exportToJson();					
						$lLogger->log("Affichage de la vue Facture : Liste Ferme par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "listeProduitFerme":
						echo $lControleur->getListeProduitFerme($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue Facture : Liste Produit Ferme par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "uniteProduit":
						echo $lControleur->getUniteProduit($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue Facture : Unite Produit par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "enregistrer":
						echo $lControleur->enregistrerFacture($pParam)->exportToJson();					
						$lLogger->log("Ajout d'une facture par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "afficherFacture":
						echo $lControleur->getFacture($pParam)->exportToJson();					
						$lLogger->log("Affiche une facture par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimer":
						echo $lControleur->deleteFacture($pParam)->exportToJson();					
						$lLogger->log("Supprimer une facture par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
						$lLogger->log("Demande d'accés à Facture sans paramètree par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Facture sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['id']) && isset($_POST['format'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/FactureControleur.php");						
			$lControleur = new FactureControleur();
			
			switch($_POST['fonction']) {					
				case "export":
						$lParam = array();
						$lParam['id'] = $_POST['id'];
						
						if($_POST['format'] == 0) {					
							echo $lControleur->getFacturePdf($lParam);
						} else if ($_POST['format'] == 1) {					
							echo $lControleur->getFactureCSV($lParam);						
						} else {
							$lLogger->log("Demande d'accés à Facture pour export sans format valide par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
							header('location:./index.php');
						}
					break;
	
				default:
					$lLogger->log("Demande d'accés à Facture sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Facture pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
		
		
	} else {
		$lLogger->log("Demande d'accés à Facture sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Facture",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}