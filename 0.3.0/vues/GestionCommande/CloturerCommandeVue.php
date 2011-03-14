<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/11/2010
// Fichier : CloturerCommandeVue.php
//
// Description : La vue de modification des commandes
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/CloturerCommandeControleur.php");
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam['id_commande'])) {			
			$lControleur = new CloturerCommandeControleur();
			$lResponse = $lControleur->cloturerCommande($lParam);
			
			echo $lResponse->exportToJson();
			
			if($lResponse->getValid()) {
				$lLogger->log("Cloture de la commande " . $lParam['id_commande'] . " par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Echec de la cloture de la commande " . $lParam['id_commande'] . " par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			}			
		} else {
			$lLogger->log("Demande d'accés sans paramètre à CloturerCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'accés sans paramètre à CloturerCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à CloturerCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>