<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/MesAchatsControleur.php");

	$lControleur = new MesAchatsControleur();
	echo $lControleur->getListe()->exportToJson();	
	
	$lLogger->log("Affichage de la vue MesAchats par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>