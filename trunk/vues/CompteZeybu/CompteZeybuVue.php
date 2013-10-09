<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : CompteZeybuVue.php
//
// Description : Script d'affichage du Compte Zeybu
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ZEYBU]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);

		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ZEYBU . "/CompteZeybuControleur.php");
			$lControleur = new CompteZeybuControleur();

			switch($lParam["fonction"]) {
				case "afficher":
					echo $lControleur->getInfoCompte()->exportToJson();	
					$lLogger->log("Affichage de la vue Compte Zeybu par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "rechercher":
					echo $lControleur->getRechercheOperation($lParam)->exportToJson();
					$lLogger->log("Affichage de la vue recherche Compte Zeybu par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à Compte Zeybu sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Compte Zeybu sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['dateDebut']) && isset($_POST['dateFin']) && isset($_POST['idMarche'])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ZEYBU . "/CompteZeybuControleur.php");						
			$lControleur = new CompteZeybuControleur();
			
			switch($_POST['fonction']) {					
				case "export":
						$lParam = array();
						$lParam['dateDebut'] = $_POST['dateDebut'];
						$lParam['dateFin'] = $_POST['dateFin'];
						$lParam['idMarche'] = $_POST['idMarche'];
									
						echo $lControleur->exportOperation($lParam);
						$lLogger->log("Export des operations du Compte Zeybu par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
	
				default:
					$lLogger->log("Demande d'accés à Compte Zeybu sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Compte Zeybu pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Compte Zeybu sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation au Compte Zeybu",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>