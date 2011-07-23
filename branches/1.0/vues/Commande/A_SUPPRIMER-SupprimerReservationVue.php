<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2011
// Fichier : SupprimerReservationVue.php
//
// Description : Supprime la réservation d'un adhérent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/AfficherReservationControleur.php");							
			$lControleur = new AfficherReservationControleur();
			
			switch($pParam["fonction"]) {					
				case "supprimerReservation":
						$pParam["id_adherent"] = $_SESSION[DROIT_ID];
						echo $lControleur->supprimerReservation($pParam)->exportToJson();
						$lLogger->log("Suppression de la réservation par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à SupprimerReservation sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à SupprimerReservation sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à SupprimerReservation sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à SupprimerReservation",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>