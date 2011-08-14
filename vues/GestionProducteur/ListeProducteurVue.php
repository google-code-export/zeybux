<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ListeProducteurVue.php
//
// Description : Script de listing des Producteurs
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_GESTION_PRODUCTEUR]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_GESTION_PRODUCTEUR . "/ListeProducteurControleur.php");	
	
	// Récupère les données à afficher
	$lListeProducteurControleur = new ListeProducteurControleur();
	// Lancement de la recherche
	echo $lListeProducteurControleur->getListeProducteur()->exportToJson();	

	$lLogger->log("Affichage de la liste des producteurs par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
} else {
	$lLogger->log("Demande d'accés sans autorisation à liste des producteurs",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>