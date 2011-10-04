<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : MonCompteVue.php
//
// Description : Script de vue du compte Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_MON_COMPTE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);
		
		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_MON_COMPTE . "/ModifierMonCompteControleur.php");
		
			$lControleur = new ModifierMonCompteControleur();
			$lParam['id_adherent'] = $_SESSION[DROIT_ID];
			switch($lParam["fonction"]) {					
				case "pass":
						echo $lControleur->modifierPass($lParam)->exportToJson();						
						$lLogger->log("Modification du pass de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
			
				case "information":
						echo $lControleur->modifierInformation($lParam)->exportToJson();						
						$lLogger->log("Modification du compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;

				default:
					$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		
		} else {
			$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}	
	} else {
		$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');		
	}
} else {
	$lLogger->log("Demande d'affichage sans autorisation du compte de l'Adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
