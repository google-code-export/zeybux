<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/10/2010
// Fichier : ReservationMarcheVue.php
//
// Description : Retourne les détails d'une réservation
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ReservationMarcheControleur.php");						
			$lControleur = new ReservationMarcheControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getReservation($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue ReservationMarche par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProduit":
						echo $lControleur->getDetailProduit($lParam)->exportToJson();
						$lLogger->log("Affichage du détail produit dans ReservationMarche par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->modifierReservation($lParam)->exportToJson();
						$lLogger->log("Modification de reservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
				
				case "supprimer":
						echo $lControleur->supprimerReservation($lParam)->exportToJson();
						$lLogger->log("Suppression de reservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à ReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à ReservationMarche sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ReservationMarche",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>