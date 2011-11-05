<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : AjoutProducteurVue.php
//
// Description : Script d'ajout d'un Producteur
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/AjoutProducteurControleur.php");
	// Création du controleur
	$lControleur = new AjoutProducteurControleur();
	
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		$lResponse = $lControleur->ajoutProducteur($lParam); // Ajout
		echo $lResponse->exportToJson(); // Affichage
		
		if($lResponse->getValid()) {
			$lLogger->log("Ajout du Producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Echec de l'Ajout d'un Producteur par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		}
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à l'ajout d'un producteur.",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
