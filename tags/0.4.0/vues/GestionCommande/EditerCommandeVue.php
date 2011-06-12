<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : EditerCommandeVue.php
//
// Description : Retourne les infos sur la commande
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		if(isset($pParam["id_commande"]) && isset($pParam["export_type"])) {	
			if($pParam["export_type"] == 0) {	
				include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/EditerCommandeControleur.php");
					
				$lControleur = new EditerCommandeControleur();
				echo $lControleur->getInfoCommande($pParam)->exportToJson();
			
				$lLogger->log("Affichage de la vue EditerCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Demande d'accés à EditerCommande sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
			}
		} else if($_POST['pParam'] == 1) {
			if(isset($_POST['id_commande']) && isset($_POST['id_produits']) && isset($_POST['export_type']) && isset($_POST['format'])) {
				if($_POST['export_type'] == 1) {
					include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/EditerCommandeControleur.php");
					$pParam = array();
					$pParam['id_commande'] = $_POST['id_commande'];
					$pParam['id_produits'] = explode(',',urldecode($_POST['id_produits']));
								
					$lControleur = new EditerCommandeControleur();
					
					if($_POST['format'] == 0) {					
						echo $lControleur->getListeReservationPdf($pParam);
					} else if ($_POST['format'] == 1) {					
						echo $lControleur->getListeReservationCSV($pParam);						
					} else {
						$lLogger->log("Demande d'accés à EditerCommande pour export des réservations sans format valide par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					}
				} else {
					$lLogger->log("Demande d'accés à EditerCommande pour export des réservations sans identifiant par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
				}				
			} else {
				$lLogger->log("Demande d'accés à EditerCommande pour export des réservations sans identifiant par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
			}
		} else {
			$lLogger->log("Demande d'accés à EditerCommande sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à EditerCommande sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');		
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à EditerCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>