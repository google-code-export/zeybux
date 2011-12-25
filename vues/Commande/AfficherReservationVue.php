<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/10/2010
// Fichier : AfficherReservationVue.php
//
// Description : Retourne les détails d'une réservation
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/AfficherReservationControleur.php");						
			$lControleur = new AfficherReservationControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getReservation($lParam)->exportToJson();
						$lLogger->log("Affichage de la vue AfficherReservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "detailProduit":
						echo $lControleur->getDetailProduit($lParam)->exportToJson();
						$lLogger->log("Affichage du détail produit dans AfficherReservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
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
					$lLogger->log("Demande d'accés à AfficherReservation sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à AfficherReservation sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	
	}
		
	/*if(isset($_POST["id_commande"])) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/AfficherReservationControleur.php");
		$lParam["id_adherent"] = $_SESSION[DROIT_ID];
		$lParam["id_commande"] = $_POST["id_commande"];
		$lControleur = new AfficherReservationControleur();	
		echo $lControleur->getReservation($lParam)->exportToJson();
	
		$lLogger->log("Affichage de la vue AfficherReservation par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	} else if(isset($_POST["reservation"])) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/AfficherReservationControleur.php");
		$lParam["reservation"] = json_decode($_POST["reservation"],true);
		$lParam["id_compte"] = $_SESSION['id_compte'];
		$lControleur = new AfficherReservationControleur();	
		echo $lControleur->modifierReservation($lParam)->exportToJson();		
	} */
} else {
	$lLogger->log("Demande d'accés sans autorisation à AfficherReservation",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>