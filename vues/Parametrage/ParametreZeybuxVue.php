<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/05/2014
// Fichier : ParametreZeybuxVue.php
//
// Description : Vue du paramétrage des ParametresZeybux
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_PARAMETRAGE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam["fonction"])) {
			
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_PARAMETRAGE . "/ParametreZeybuxControleur.php");
			// Création du controleur
			$lControleur = new ParametreZeybuxControleur();
			switch($lParam["fonction"]) {
				case "detail":
					echo $lControleur->getParametreZeybux($lParam)->exportToJson();
					$lLogger->log("Affichage du détail de ParametreZeybux par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				case "modifier":
					$lResponse = $lControleur->modifierParametreZeybux($lParam);
					echo $lResponse->exportToJson();
						
					if($lResponse->getValid()) {
						$lLogger->log("Modification de la ParametreZeybux " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					} else {
						$lLogger->log("Echec de la modification de la ParametreZeybux " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					}
					break;
					
				default:
					$lLogger->log("Demande d'accés au paramétrage ParametreZeybux sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés sans fonction au paramétrage ParametreZeybux",PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'accés sans parametre au paramétrage ParametreZeybux",PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation au paramétrage ParametreZeybux",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>