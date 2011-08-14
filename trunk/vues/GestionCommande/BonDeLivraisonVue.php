<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : BonDeLivraisonVue.php
//
// Description : Edition du bon de livraison
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/BonDeLivraisonControleur.php");
			$lControleur = new BonDeLivraisonControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getInfoLivraison($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue BonDeLivraison par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
			
				case "afficherProducteur":
						echo $lControleur->getListeProduitLivraison($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue BonDeCommande -> Liste des produits par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "enregistrer":
						echo $lControleur->enregistrerBonDeLivraison($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue BonDeLivraison -> Liste des produits par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à BonDeCommande sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à BonDeLivraison sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}		
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['id_commande']) && isset($_POST['format'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/BonDeLivraisonControleur.php");						
			$lControleur = new BonDeLivraisonControleur();
			
			switch($_POST['fonction']) {					
				case "export":
						$lParam = array();
						$lParam['id_commande'] = $_POST['id_commande'];
						
						if($_POST['format'] == 0) {					
							echo $lControleur->getBComPdf($lParam);
						} else if ($_POST['format'] == 1) {					
							echo $lControleur->getBComCSV($lParam);						
						} else {
							$lLogger->log("Demande d'accés à BonDeLivraison pour export sans format valide par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
							header('location:./index.php');
						}
					break;
	
				default:
					$lLogger->log("Demande d'accés à BonDeLivraison sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à BonDeLivraison pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
		
		
	} else {
		$lLogger->log("Demande d'accés à BonDeLivraison sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');		
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à BonDeLivraison",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>