<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/04/2012
// Fichier : ListeAchatMarcheVue.php
//
// Description : Retourne les détails des achats
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ListeAchatMarcheControleur.php");						
			$lControleur = new ListeAchatMarcheControleur();
			
			switch($lParam["fonction"]) {
				case "afficher":
						echo $lControleur->getListeAchatEtReservation($lParam)->exportToJson();
						$lLogger->log("Affichage de la liste des réservation et achats : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à ListeAchatMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ListeAchatMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	} else if(isset($_POST['fonction'])) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ListeAchatMarcheControleur.php");						
		$lControleur = new ListeAchatMarcheControleur();
		
		switch($_POST['fonction']) {					
			case "exportAchatEtReservation":
					if(isset($_POST['id_marche']) ) {
						$lParam = array();
						$lParam['id_marche'] = $_POST['id_marche'];				
						echo $lControleur->getListeAchatEtReservationCSV($lParam);
						$lLogger->log("Export de la liste des achats et reservations par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Demande d'accés à EditerCommande pour export des réservations sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					}
				break;

			default:
				$lLogger->log("Demande d'accés à ListeAchatMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}		
	} else {
		$lLogger->log("Demande d'accés à ListeAchatMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeAchatMarche",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>