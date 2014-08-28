<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : AchatVue.php
//
// Description : Retourne les infos sur les Achats
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/AchatControleur.php");							
			$lControleur = new AchatControleur();
			
			switch($pParam["fonction"]) {	
				case "afficher":
						echo $lControleur->getListeMarche()->exportToJson();					
						$lLogger->log("Affichage de la vue Achat liste des marchés par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;
									
				case "rechercher":
						echo $lControleur->getListeAchat($pParam)->exportToJson();					
						$lLogger->log("Affichage de la vue recherche Achat par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					break;					
				default:
						$lLogger->log("Demande d'accés à Achat sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
						header('location:./index.php');
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à Achat sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à Achat sans paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à Achat",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}