<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationVue.php
//
// Description : Retourne la liste des reservations
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/ListeReservationControleur.php");
	
	$lControleur = new ListeReservationControleur();	
	echo $lControleur->getListeReservationEnCours()->exportToJson();

	$lLogger->log("Affichage de la vue ListeReservation par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeReservation",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
