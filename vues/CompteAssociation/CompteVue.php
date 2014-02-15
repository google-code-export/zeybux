<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/02/2014
// Fichier : CompteVue.php
//
// Description : Script d'affichage du Compte Association
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMPTE_ASSOCIATION]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	if(isset($_POST['pParam'])) {
		$lParam = json_decode($_POST["pParam"],true);

		if(isset($lParam["fonction"])) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/CompteAssociationControleur.php");
			$lControleur = new CompteAssociationControleur();

			switch($lParam["fonction"]) {
				case "afficher":
					echo $lControleur->getInfoCompte()->exportToJson();	
					$lLogger->log("Affichage de la vue Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "rechercher":
					echo $lControleur->getRechercheOperation($lParam)->exportToJson();
					$lLogger->log("Affichage de la vue recherche Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;g("Affichage de la vue Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "infoOperation":
					echo $lControleur->getInfoOperation()->exportToJson();
					$lLogger->log("Affichage de la vue infoOperation Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "ajoutOperation":
					echo $lControleur->ajoutOperation($lParam)->exportToJson();
					$lLogger->log("Affichage de la vue ajoutOperation Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
						
				case "ajoutVirement":
					echo $lControleur->ajoutVirement($lParam)->exportToJson();
					$lLogger->log("Affichage de la vue ajoutVirement Compte Association par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
					
				default:
					$lLogger->log("Demande d'accés à Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else if(isset($_POST['fonction'])) {	
		if(isset($_POST['dateDebut']) && isset($_POST['dateFin']) ) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMPTE_ASSOCIATION . "/CompteAssociationControleur.php");						
			$lControleur = new CompteAssociationControleur();
			
			switch($_POST['fonction']) {					
				case "export":
						$lParam = array();
						$lParam['dateDebut'] = $_POST['dateDebut'];
						$lParam['dateFin'] = $_POST['dateFin'];
									
						echo $lControleur->exportOperation($lParam);
						$lLogger->log("Export des operations du Compte Association par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
	
				default:
					$lLogger->log("Demande d'accés à Compte Association sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Compte Association pour export sans identifiant par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Compte Association sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation au Compte Association",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>