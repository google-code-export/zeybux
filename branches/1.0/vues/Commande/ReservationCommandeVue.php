<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : ReservationCommandeVue.php
//
// Description : Script de la vue d'affichage et d'enregistrement d'une réservation
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ReservationCommandeControleur.php");						
			$lControleur = new ReservationCommandeControleur();
			
			switch($lParam["fonction"]) {					
				case "detailMarche":
						echo $lControleur->getReservation($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue ReservationCommande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "reservationMarche":
						echo $lControleur->enregistrerReservation($lParam)->exportToJson();	
						$lLogger->log("Réalisation d'une réservation de commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à ReservationCommande sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ReservationCommande sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	}

	/*
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST['pParam'],true);
		if(isset($lParam["id_commande"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ReservationCommandeControleur.php");
			$lParam["id_compte"] = $_SESSION[ID_COMPTE];
			$lParam["id_adherent"] = $_SESSION[DROIT_ID];
			$lControleur = new ReservationCommandeControleur();	
			echo $lControleur->getReservation($lParam)->exportToJson();
		
			$lLogger->log("Affichage de la vue ReservationCommande par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Demande d'accés à ReservationCommande sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			//header('location:./index.php');
		}
	} else if(isset($_POST["reservation"])) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ReservationCommandeControleur.php");
		$lParam["reservation"] = json_decode($_POST["reservation"],true);
		$lParam["id_compte"] = $_SESSION[ID_COMPTE];
		$lControleur = new ReservationCommandeControleur();	
		echo $lControleur->enregistrerReservation($lParam)->exportToJson();	
		
		$lLogger->log("Réalisation d'une réservation de commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	} else {
		$lLogger->log("Demande d'accés à ReservationCommande sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}*/
} else {
	$lLogger->log("Demande d'accés sans autorisation à ReservationCommande.",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>