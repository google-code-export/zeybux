<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : ModificationProducteurVue.php
//
// Description : Script de Modification d'un Producteur
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {	
	if(isset( $_POST['pParam'] )) {
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/ModificationProducteurControleur.php");
		// Création du controleur
		$lControleur = new ModificationProducteurControleur();
		$lParam = json_decode($_POST['pParam'],true);
		
		if(isset($lParam['id_producteur']) && !empty($lParam['id_producteur'])) {
			echo $lControleur->getProducteur($lParam)->exportToJson();
			$lLogger->log("Affichage de la vue modification du producteur " . $lParam['id_producteur'] . " par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		} else if(isset($lParam['id']) && !empty($lParam['id'])) {
			
			$lResponse = $lControleur->modifierProducteur($lParam);
			echo $lResponse->exportToJson();
			
			if($lResponse->getValid()) {
				$lLogger->log("Modification du producteur " . $lParam['id'] . " par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Echec de la modification du producteur " . $lParam['id'] . " par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			}
			
		} else {
			$lLogger->log("Demande d'accés sans paramètre à la modification des producteurs par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}
	} else {
		$lLogger->log("Demande d'accés sans paramètre à la modification des producteurs par : " . $_SESSION['id'],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à la modification des producteurs",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>