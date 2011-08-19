<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : ListeCommandeVue.php
//
// Description : Retourne la liste des commandes
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/GestionListeCommandeControleur.php");

	if(isset($_POST['pParam'])) { 
		$lParam = json_decode($_POST['pParam'],true);
		if($lParam['archive'] == 1) {
			$lControleur = new GestionListeCommandeControleur();	
			echo $lControleur->getListeCommandeArchive()->exportToJson();
			
			$lLogger->log("Affichage de la vue ListeCommandeArchive par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Demande d'accés sans Paramètre à ListeCommandeArchive",PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}		
	} else {
		$lControleur = new GestionListeCommandeControleur();	
		echo $lControleur->getListeCommandeEnCours()->exportToJson();
		
		$lLogger->log("Affichage de la vue ListeCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
