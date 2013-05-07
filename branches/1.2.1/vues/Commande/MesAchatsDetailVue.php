<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/10/2011
// Fichier : MesAchatsDetailVue.php
//
// Description : Retourne les infos sur l'achat d'un adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_POST['pParam'])) {
		$pParam = json_decode($_POST["pParam"],true);
		
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/MesAchatsControleur.php");
	
		$lControleur = new MesAchatsControleur();
		echo $lControleur->getDetail($pParam)->exportToJson();	
	
		$lLogger->log("Affichage de la vue MesAchatsDetail par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	} else {
		$lLogger->log("Demande d'accés à MesAchatsDetail sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à MesAchatsDetail",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>