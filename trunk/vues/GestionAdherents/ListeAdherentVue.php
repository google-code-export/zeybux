<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : ListeAdherentVue.php
//
// Description : Script de listing des Adherents
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_ADHERENTS]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_ADHERENTS . "/ListeAdherentControleur.php");	
	
	// Récupère les données à afficher
	$lListeAdherentControleur = new ListeAdherentControleur();
	// Lancement de la recherche
	echo $lListeAdherentControleur->getListeAdherent()->exportToJson();	

	$lLogger->log("Affichage de la liste des adhérents par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
} else {
	$lLogger->log("Demande d'accés sans autorisation à liste des adhérents",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
