<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : ListeCompteVue.php
//
// Description : Affiche la liste des comptes spéciaux
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_COMPTES_SPECIAUX]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_COMPTES_SPECIAUX . "/ListeCompteControleur.php");

	$lControleur = new ListeCompteControleur();
	echo $lControleur->getListeCompte()->exportToJson();	
	
	$lLogger->log("Affichage de la vue Liste des comptes spéciaux par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

} else {
	$lLogger->log("Demande d'accés sans autorisation à Gestion des comptes spéciaux",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>