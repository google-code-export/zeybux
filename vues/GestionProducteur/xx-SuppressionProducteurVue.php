<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : SuppressionProducteurVue.php
//
// Description : Script de Suppression d'un Producteur
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	// Test qu'un identifiant d'un compte est bien demandé
	if( isset( $_POST['pParam'] ) ) {
		$lParam = json_decode($_POST['pParam'],true);
		if($lParam['id_producteur']) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/SuppressionProducteurControleur.php");

			$lControleur = new SuppressionProducteurControleur();
			$lResponse = $lControleur->supprimerProducteur($lParam);
			
			echo $lResponse->exportToJson();
			
			if($lResponse->getValid()) {
				$lLogger->log("Suppression du producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Echec de la suppression du producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			}
		} else {
			$lLogger->log("Demande d'accés sans id producteur à la suppression des producteurs par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}		
	} else {
		$lLogger->log("Demande d'accés sans paramètre de producteur à la suppression des producteurs par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à la supression des producteurs",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>