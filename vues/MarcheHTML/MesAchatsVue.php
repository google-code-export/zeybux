<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/01/2012
// Fichier : MesAchatsVue.php
//
// Description : À REMPLIR
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {

	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/MesAchatsControleur.php");
	include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
	include_once(CHEMIN_CLASSES_UTILS . "Template.php");		
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

	$lControleur = new MesAchatsControleur();
	$lPage = $lControleur->getListe();	
	
	$lLogger->log("Affichage de la vue MesAchats par le compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	
	// Constante de titre de la page
	define("TITRE", ZEYBUX_TITRE_DEBUT . "Mes Achats - " . ZEYBUX_TITRE_FIN);
	
	$lTemplate = new Template(CHEMIN_TEMPLATE);	
	// Entete
	$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
	$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
	InfobullesUtils::generer(&$lTemplate); // Messages d'erreur
	$lTemplate->assign_var_from_handle('ENTETE', 'entete');
	
	// Menu
	$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
	$lTemplate->assign_vars( array( 'menu-MesAchats' => "ui-state-active") );	
	$lTemplate->assign_var_from_handle('MENU', 'menu');
	
	// Body
	$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'MesAchats.html') );

	$lListeAchat = $lPage->getAchats();
	if(!is_null($lListeAchat[0]->getOpeIdCompte())) {
		$lTemplate->set_filenames( array('listeAchat' => MOD_COMMANDE . '/' . 'ListeAchat.html') );
		
		foreach($lListeAchat as $lAchat) {
			$lTemplate->assign_block_vars('achat', array(
						'numero' => $lAchat->getComNumero(),
						'dateMarcheDebut' => StringUtils::extractDate($lAchat->getComDateMarcheDebut()),
						'idCommande' => $lAchat->getComId() ));
			
		}
		
		$lTemplate->assign_var_from_handle('LISTE_ACHAT', 'listeAchat');
	} else {
		$lTemplate->set_filenames( array('listeAchat' => MOD_COMMANDE . '/' . 'ListeAchatVide.html') );
		$lTemplate->assign_var_from_handle('LISTE_ACHAT', 'listeAchat');
	}

	// Pied de Page
	$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
	$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
	
	// Affichage
	$lTemplate->pparse('body');

} else {
	$lLogger->log("Demande d'accés sans autorisation à ListeCommande",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>