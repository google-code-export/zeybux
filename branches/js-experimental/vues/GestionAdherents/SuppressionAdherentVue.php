<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/02/2010
// Fichier : SuppressionAdherentVue.php
//
// Description : Script de Suppression d'un Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ADHERENTS]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	// Test qu'un identifiant d'un compte est bien demandé
	if( isset( $_POST['pParam'] ) ) {
		$lParam = json_decode($_POST['pParam'],true);
		if($lParam['id_adherent']) {
			// Inclusion des classes
			include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ADHERENTS . "/SuppressionAdherentControleur.php");

			$lControleur = new SuppressionAdherentControleur();
			$lResponse = $lControleur->supprimerAdherent($lParam);
			
			echo $lResponse->exportToJson();
			
			if($lResponse->getValid()) {
				$lLogger->log("Suppression de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			} else {
				$lLogger->log("Echec de la suppression de l'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			}
		} else {
			$lLogger->log("Demande d'accés sans id d'adherent à la suppression des adhérents par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
			header('location:./index.php');
		}		
	} else {
		$lLogger->log("Demande d'accés sans paramètre d'adherent à la suppression des adhérents par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à la supression des adhérents",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
