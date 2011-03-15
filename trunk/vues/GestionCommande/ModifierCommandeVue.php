<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/11/2010
// Fichier : ModifierCommandeVue.php
//
// Description : La vue de modification des commandes
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	if(isset($_POST['pParam'])) {
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMMANDE . "/ModifierCommandeControleur.php");
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam['form'])) {
			
			if($lParam['form'] == 1) {
				$lLogger->log("Demande d'ajout d'un nouveau produit par l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
				
				$lControleur = new ModifierCommandeControleur();					
				$lResponse = $lControleur->AjouterProduit($lParam);
			
				echo $lResponse->exportToJson();
				if($lResponse->getValid()) {
					$lLogger->log("Création d'un nouveau produit.",PEAR_LOG_INFO);	// Maj des logs
				} else {				
					$lLogger->log("Echec de la création d'un nouveau produit.",PEAR_LOG_INFO);	// Maj des logs
				}
				$lLogger->log("Ajout d'un nouveau produit : " . $lResponse->getNom() . " par l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs			
			} else if($lParam['form'] == 2 && isset($lParam['commande'])) {	
				$lLogger->log("Demande d'ajout d'une nouvelle commande par l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			
				$lControleur = new ModifierCommandeControleur();				
				$lVr = $lControleur->ModifierCommande($lParam);
				
				echo $lVr->exportToJson();
				
				if($lVr->getValid()) {
					$lLogger->log("Modification de la commande " . $lParam['commande']['id'] . ".",PEAR_LOG_INFO);	// Maj des logs
				} else {				
					$lLogger->log("Echec de la modification de la commande " . $lParam['commande']['id'] . ".",PEAR_LOG_INFO);	// Maj des logs
				}
			} else {
				$lLogger->log("Demande d'accés au form de ModifierCommande avec un mauvais form par l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
			}			
		} else if(isset($lParam['id_commande'])) {			
			$lControleur = new ModifierCommandeControleur();
			echo $lControleur->getInfoCommande($lParam)->exportToJson();
			$lLogger->log("Affichage de la vue ModifierCommande pour la commande " . $lParam['id_commande'] . " par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Demande d'accés sans paramètre à ModifierCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php?cx=1');
		}
	} else {
		$lLogger->log("Demande d'accés sans paramètre à ModifierCommande par le compte de l'Adhérent : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php?cx=1');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à ModifierCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>