<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeVue.php
//
// Description : Retourne les infos sur la commande en archive
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		if(isset($pParam["fonction"])) {
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/InfoCommandeArchiveControleur.php");							
			$lControleur = new InfoCommandeArchiveControleur();
			
			switch($pParam["fonction"]) {
				case "afficherCommande":
					echo $lControleur->getInfoCommandeArchive($pParam)->exportToJson();					
					$lLogger->log("Affichage de la vue InfoCommandeArchive par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
					break;
			}
		} else {
			$lLogger->log("Demande d'accés à InfoCommandeArchive sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés à InfoCommandeArchive sans identifiant commande par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à InfoCommandeArchive",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>