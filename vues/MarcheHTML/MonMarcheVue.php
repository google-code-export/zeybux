<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MonMarcheVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/MonMarcheControleur.php");

	$lControleur = new MonMarcheControleur();	
	$lPage = $lControleur->getListe();
	
	$lLogger->log("Affichage de la vue MonMarche par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_UTILS . "Template.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
	include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");

	// Constante de titre de la page
	define("TITRE", ZEYBUX_TITRE_DEBUT . "Mon Marché - " . ZEYBUX_TITRE_FIN);
	
	// Préparation de l'affichage
	$lTemplate = new Template(CHEMIN_TEMPLATE);	
	
	// Entete
	$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
	$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
	InfobullesUtils::generer(&$lTemplate); // Messages d'erreur
	$lTemplate->assign_var_from_handle('ENTETE', 'entete');
	
	// Menu
	$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
	$lTemplate->assign_vars( array( 'menu-Marche' => "ui-state-active") );	
	$lTemplate->assign_var_from_handle('MENU', 'menu');
	
	// Body
	$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'MonMarche.html') );
	
	// Les Réservations
	$lListeReservation = $lPage->getReservations();
	if(!is_null($lListeReservation[0]->getComId())) {
		$lTemplate->set_filenames( array('listeReservation' => MOD_COMMANDE . '/' . 'ListeReservation.html') );

		foreach($lListeReservation as $lReservation) {
			$lTemplate->assign_block_vars('reservation', array(
						'numero' => $lReservation->getComNumero(),
						'dateFinReservation' => StringUtils::extractDate($lReservation->getComDateFinReservation()),
						'heureFinReservation' => StringUtils::extractDbHeure($lReservation->getComDateFinReservation()),
						'minuteFinReservation'  => StringUtils::extractDbMinute($lReservation->getComDateFinReservation() ),
						'dateMarcheDebut' => StringUtils::extractDate($lReservation->getComDateMarcheDebut()),
						'heureMarcheDebut' => StringUtils::extractDbHeure($lReservation->getComDateMarcheDebut()),
						'minuteMarcheDebut'  => StringUtils::extractDbMinute($lReservation->getComDateMarcheDebut() ),
						'heureMarcheFin' => StringUtils::extractDbHeure($lReservation->getComDateMarcheFin()),
						'minuteMarcheFin'  => StringUtils::extractDbMinute($lReservation->getComDateMarcheFin() ),
						'idMarche' => $lReservation->getComId() ));
			
		}
	
	} else {
		$lTemplate->set_filenames( array('listeReservation' => MOD_COMMANDE . '/' . 'ListeReservationVide.html') );
	}
	$lTemplate->assign_var_from_handle('LISTE_RESERVATION', 'listeReservation');
	
	// Les Marchés
	$lListeMarche = $lPage->getMarches();
	if(!is_null($lListeMarche[0]->getId())) {
		$lTemplate->set_filenames( array('listeMarche' => MOD_COMMANDE . '/' . 'ListeMarche.html') );
		
		foreach($lListeMarche as $lMarche) {
			$lTemplate->assign_block_vars('marche', array(
						'numero' => $lMarche->getNumero(),
						'dateFinReservation' => StringUtils::extractDate($lMarche->getDateFinReservation()),
						'heureFinReservation' => StringUtils::extractDbHeure($lMarche->getDateFinReservation()),
						'minuteFinReservation'  => StringUtils::extractDbMinute($lMarche->getDateFinReservation() ),
						'dateMarcheDebut' => StringUtils::extractDate($lMarche->getDateMarcheDebut()),
						'heureMarcheDebut' => StringUtils::extractDbHeure($lMarche->getDateMarcheDebut()),
						'minuteMarcheDebut'  => StringUtils::extractDbMinute($lMarche->getDateMarcheDebut() ),
						'heureMarcheFin' => StringUtils::extractDbHeure($lMarche->getDateMarcheFin()),
						'minuteMarcheFin'  => StringUtils::extractDbMinute($lMarche->getDateMarcheFin() ),
						'idMarche' => $lMarche->getId() ));
			
		}
	
	} else {
		$lTemplate->set_filenames( array('listeMarche' => MOD_COMMANDE . '/' . 'ListeMarcheVide.html') );
	}
	$lTemplate->assign_var_from_handle('LISTE_MARCHE', 'listeMarche');
	
	// Pied de Page
	$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
	$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');

	// Affichage
	$lTemplate->pparse('body');
	
	
} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=2');
}
?>