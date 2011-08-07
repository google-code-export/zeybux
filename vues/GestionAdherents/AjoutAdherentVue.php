<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AjoutAdherentVue.php
//
// Description : Script d'ajout d'Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ADHERENTS]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ADHERENTS . "/AjoutAdherentControleur.php");
	// Création du controleur
	$lControleur = new AjoutAdherentControleur();
	
	if(isset( $_POST['pParam'] )) {
		$lParam = json_decode($_POST['pParam'],true);
		$lResponse = $lControleur->ajoutAdherent($lParam);
		echo $lResponse->exportToJson();
		
		if($lResponse->getValid()) {
			$lLogger->log("Ajout de l'adhérent " . $lResponse->getId() . " par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		} else {
			$lLogger->log("Echec de l'Ajout d'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		}
	} else {		
		// Chargement de la liste des modules
		echo $lControleur->getListeModule()->exportToJson();
		$lLogger->log("Affichage du formulaire d'ajout d'adhérent par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à l'ajout d'adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
