<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/06/2011
// Fichier : GestionCaisseVue.php
//
// Description : Permet de gérer les accès à la caisse
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_CAISSE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_CAISSE . "/GestionCaisseControleur.php");							
			$lControleur = new GestionCaisseControleur();
			
			switch($pParam["fonction"]) {					
				case "etatCaisse":
						echo $lControleur->getEtatCaisse()->exportToJson();
						$lLogger->log("Affichage de l'état de la caisse : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				/*case "infoRechargement":
						echo $lControleur->getInfoRechargement($pParam)->exportToJson();
						$lLogger->log("Affichage des infos de rechargement : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "rechargerCompte":
						echo $lControleur->rechargerCompte($pParam)->exportToJson();
						$lLogger->log("Rechargement de compte par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;*/
					
				default:
					$lLogger->log("Demande d'accés à GestionCaisseVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à GestionCaisseVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à GestionCaisseVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à GestionCaisseVue",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>