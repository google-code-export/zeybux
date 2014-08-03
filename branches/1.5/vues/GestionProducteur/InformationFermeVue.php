<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/10/2011
// Fichier : InformationFermeVue.php
//
// Description : Script de listing des Producteurs
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);	
		
		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/InformationFermeControleur.php");
			// Récupère les données à afficher
			$lControleur = new InformationFermeControleur();
			
			switch($lParam["fonction"]) {					
				case "afficher":
						echo $lControleur->getInformationFerme($lParam)->exportToJson();	
						$lLogger->log("Affichage des information sur une fermes par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
						echo $lControleur->modifierFerme($lParam)->exportToJson();	
						$lLogger->log("Modification de ferme par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "supprimer":
						echo $lControleur->supprimerFerme($lParam)->exportToJson();	
						$lLogger->log("Suppression de ferme par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
						$lLogger->log("Demande d'accés à information Ferme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à information Ferme sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à information Ferme sans fonction par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à information Ferme",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>