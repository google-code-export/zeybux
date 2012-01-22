<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : AfficherReservationVue.php
//
// Description : Retourne les détails d'une réservation
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_COMMANDE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_GET['id']) ) {	
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_COMMANDE . "/AfficherReservationControleur.php");						
		$lControleur = new AfficherReservationControleur();
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_UTILS . "Template.php");
		include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
		include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php");
		include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
		
		// Constante de titre de la page
		define("TITRE", ZEYBUX_TITRE_DEBUT . "Marche - " . ZEYBUX_TITRE_FIN);
					
		$lParam = array("id" => $_GET["id"]); 
		$lPage = $lControleur->getDetailProduit($lParam);
		$lLogger->log("Affichage du détail produit dans DetailProduit par l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

		// Préparation de l'affichage
		$lTemplate = new Template(CHEMIN_TEMPLATE);	
		
		// Entete
		$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
		$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
		InfobullesUtils::generer(&$lTemplate); // Messages d'erreur
		$lTemplate->assign_var_from_handle('ENTETE', 'entete');
		
		// Body		
		$lTemplate->set_filenames( array('body' => MOD_COMMANDE . '/' . 'InfoProduit.html') );
		
		$lTemplate->assign_vars( array( 'nom' => $lPage->getProduit()->getNom(),
										'cproNom' => $lPage->getProduit()->getCproNom(),
										'description' => $lPage->getProduit()->getDescription()));	
		
		$lProducteurs = $lPage->getProduit()->getProducteurs();
		if(!is_null($lProducteurs[0]->getPrdtId())) {
			$lTemplate->set_filenames( array('producteurs' => MOD_COMMANDE . '/' .  'InfoProduitProducteurs.html') );
			foreach($lProducteurs as $lProducteur) {
				$lTemplate->assign_block_vars('producteurs', array(
					"prdtPrenom" => $lProducteur->getPrdtPrenom(),
					"prdtNom" => $lProducteur->getPrdtNom()
				));
			}
			$lTemplate->assign_var_from_handle('PRODUCTEURS', 'producteurs');
		}
		
		$lCaracteristiques = $lPage->getProduit()->getCaracteristiques();
		if(!is_null($lCaracteristiques[0]->getCarId())) {
			$lTemplate->set_filenames( array('caracteristiques' => MOD_COMMANDE . '/' .  'InfoProduitCaracteristiques.html') );
			foreach($lCaracteristiques as $lCaracteristique) {
				$lTemplate->assign_block_vars('caracteristiques', array(
					"carNom" => $lCaracteristique->getCarNom()
				));
			}
			$lTemplate->assign_var_from_handle('CARACTERISTIQUES', 'caracteristiques');
		}
		
		// Pied de Page
		$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
		$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
		
		
		$lTemplate->set_filenames( array('page' => 'Page.html') );
		$lTemplate->assign_var_from_handle('CONTENU', 'body');
		
		// Affichage
		$lTemplate->pparse('page');
	} else {
		$lLogger->log("Demande d'accés à DetailProduit sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');
	}
} else {
	$lLogger->log("Demande d'accés sans autorisation à DetailProduit",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=2');
}
?>