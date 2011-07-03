<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireVue.php
//
// Description : Permet de gérer le compte solidaire
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_SOLIDAIRE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_SOLIDAIRE . "/CompteSolidaireControleur.php");							
			$lControleur = new CompteSolidaireControleur();
			
			switch($pParam["fonction"]) {					
				case "compte":
						echo $lControleur->getCompte()->exportToJson();
						$lLogger->log("Affichage de l'état du compte solidaire : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifierVirement":
						echo $lControleur->modifierVirement($pParam)->exportToJson();
						$lLogger->log("Demande de modification de virement par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimerVirement":
						echo $lControleur->supprimerVirement($pParam)->exportToJson();
						$lLogger->log("Demande de suppression de virement par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à CompteSolidaireVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à CompteSolidaireVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à CompteSolidaireVue sans identifiant commande par : " . $_SESSION[DROIT_ID],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à CompteSolidaireVue",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>