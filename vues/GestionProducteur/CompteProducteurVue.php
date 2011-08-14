<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : CompteProducteurVue.php
//
// Description : Script de Compte d'un Producteur
//
//****************************************************************

// Vérification de la bonne connexion de l'Adhérent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	// Test qu'un identifiant d'un compte est bien demandé
	if( isset( $_POST['pParam'] ) ) {		
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/CompteProducteurControleur.php");
		
		$lParam = json_decode($_POST['pParam'],true);
		$lCompteControleur = new CompteProducteurControleur();
		$lResponse = $lCompteControleur->Afficher($lParam);		
		echo $lResponse->exportToJson();
			
		$lLogger->log("Affichage du compte du producteur : par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

	} else {
		$lLogger->log("Demande d'affichage d'un compte producteur sans transmettre de paramètre par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à un compte producteur",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
