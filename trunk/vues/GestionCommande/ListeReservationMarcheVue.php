<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/03/2012
// Fichier : ListeReservationMarcheVue.php
//
// Description : Retourne les détails d'une réservation
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ListeReservationMarcheControleur.php");						
			$lControleur = new ListeReservationMarcheControleur();
			
			switch($lParam["fonction"]) {				
				case "afficher":
						echo $lControleur->getListeAdherent()->exportToJson();
						$lLogger->log("Affichage de la vue ListeReservationMarche par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
								
				/*case "detailMarche":
						echo $lControleur->getDetailMarche($lParam)->exportToJson();
						$lLogger->log("Affichage des infos du marche de la vue ListeReservationMarche par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;*/

				default:
					$lLogger->log("Demande d'accés à ListeReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ListeReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	} else if(isset($_POST['fonction'])) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ListeReservationMarcheControleur.php");						
		$lControleur = new ListeReservationMarcheControleur();
		
		switch($_POST['fonction']) {					
			case "exportReservation":
					if(isset($_POST['id_commande']) && isset($_POST['id_produits']) && isset($_POST['format'])) {
						$lParam = array();
						$lParam['id_commande'] = $_POST['id_commande'];
						$lParam['id_produits'] = explode(',',urldecode($_POST['id_produits']));
						
						if($_POST['format'] == 0) {					
							echo $lControleur->getListeReservationPdf($lParam);
						} else if ($_POST['format'] == 1) {					
							echo $lControleur->getListeReservationCSV($lParam);						
						} else {
							$lLogger->log("Demande d'accés à ListeReservationMarche pour export des réservations sans format valide par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
							header('location:./index.php');
						}
					} else {
						$lLogger->log("Demande d'accés à ListeReservationMarche pour export des réservations sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					}
				break;

			default:
				$lLogger->log("Demande d'accés à ListeReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}		
	} else {
		$lLogger->log("Demande d'accés à ListeReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeReservationMarche",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>