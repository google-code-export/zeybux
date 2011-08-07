<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseCommandeVue.php
//
// Description : Retourne la liste des commandes
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_CAISSE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_CAISSE . "/CaisseListeCommandeControleur.php");

	$lControleur = new CaisseListeCommandeControleur();	
	echo $lControleur->getListeCommandeEnCours()->exportToJson();
		
	$lLogger->log("Affichage de la vue ListeCommande par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
