<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/01/2010
// Fichier : MonCompteVue.php
//
// Description : Script de vue du compte Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_MON_COMPTE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_MON_COMPTE . "/MonCompteControleur.php");

	$lControleur = new MonCompteControleur();
	$lParam['id_adherent'] = $_SESSION[DROIT_ID];
	//echo $lControleur->getInfoCompte($lParam)->exportToJson();
	$lCompte = $lControleur->getInfoCompte($lParam);
	$lLogger->log("Affichage du compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
	
	
	
	// Inclusion des classes
	include_once(CHEMIN_CLASSES_UTILS . "Template.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
	include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");

	// Constante de titre de la page
	define("MON_COMPTE_TITRE", ZEYBUX_TITRE_DEBUT . "Mon Compte - " . ZEYBUX_TITRE_FIN);
	define("COMMUN_TEMPLATE", "Commun/");
	// Nombre d'opération par page
	define("NB_OPE_PAGE" , 15);
	define("SOLDE_CIBLE" , 5);
	
	// Préparation de l'affichage
	$lTemplate = new Template(CHEMIN_TEMPLATE);	
//	$lTemplate->set_filenames( array('index' =>  './index.html') );
//	$lTemplate->assign_vars( array( 'TITRE' => IDE_TITRE) );
	
	// Entete
	$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
	$lTemplate->assign_vars( array( 'TITRE' => MON_COMPTE_TITRE) );
	if(isset($_GET['msg'])) { // Message d'erreur			
		InfobullesUtils::genererMessage($_GET['msg'],&$lTemplate);
	}
	$lTemplate->assign_var_from_handle('ENTETE', 'entete');
	
	// Menu
	$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
	$lTemplate->assign_var_from_handle('MENU', 'menu');
	
	// Body
	$lTemplate->set_filenames( array('body' => MOD_MON_COMPTE . '/' . 'MonCompte.html') );
	
	$lTemplate->set_filenames( array('infoAdherent' => COMMUN_TEMPLATE . 'InfoCompteSoldeAdherent.html') );
	$lAdherent = $lCompte->getAdherent();
	$lTemplate->assign_vars( array( 
					'adhNumero' => $lAdherent->getAdhNumero(),
					'adhNom'  => $lAdherent->getAdhNom(),
					'cptLabel'  => $lAdherent->getCptLabel(),
					'adhPrenom' => $lAdherent->getAdhPrenom(),
					'adhCourrielPrincipal' => $lAdherent->getAdhCourrielPrincipal(),
					'adhCourrielSecondaire' => $lAdherent->getAdhCourrielSecondaire(),
					'adhTelephonePrincipal' => $lAdherent->getAdhTelephonePrincipal(),
					'adhTelephoneSecondaire' => $lAdherent->getAdhTelephoneSecondaire(),
					'adhAdresse' => $lAdherent->getAdhAdresse(),
					'adhCOdePostal' => $lAdherent->getAdhCodePostal(),
					'adhVille' => $lAdherent->getAdhVille(),
					'adhCommentaire' => $lAdherent->getAdhCommentaire() ));

	// Affichage des dates si elles ne sont pas nulle
	if(!StringUtils::dateEstNulle($lAdherent->getAdhDateNaissance())) {
		$lTemplate->assign_vars( array('adhDateNaissance' => StringUtils::dateDbToFr($lAdherent->getAdhDateNaissance()) ) );
	}
	
	if(!StringUtils::dateEstNulle($lAdherent->getAdhDateAdhesion())) {
		$lTemplate->assign_vars( array('adhDateAdhesion' => StringUtils::dateDbToFr($lAdherent->getAdhDateAdhesion()) ) );
	}
	
	if(!StringUtils::dateEstNulle($lAdherent->getAdhDateMaj())) {
		$lTemplate->assign_vars( array('adhDateMaj' => StringUtils::dateDbToFr($lAdherent->getAdhDateMaj()) ) );
	}
	
	// Ajout des informations du compte dans le body
	$lTemplate->assign_var_from_handle('INFO_COMPTE_SOLDE_ADHERENT', 'infoAdherent');
	
	
	$lTemplate->set_filenames( array('listeOperationAdherent' => COMMUN_TEMPLATE . 'ListeOperationAdherent.html') );
	$lTemplate->assign_vars( array( 'sigleMonetaire' => SIGLE_MONETAIRE , 'cptSolde' => StringUtils::affichageMonetaireFr($lAdherent->getCptSolde()) ) );
	
	
	$lListeOperation = $lCompte->getOperationPassee();

	// Pagination des opérations
	$lNombreDePages = ceil(count($lListeOperation)/NB_OPE_PAGE);
	
	if( isset($_GET['po']) ) // Si la variable $_GET['page'] existe...
	{
	     $lPageOperationActuelle = intval( $_GET['po'] );
	     
	     if($lPageOperationActuelle > $lNombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
	     {
	          $lPageOperationActuelle = $lNombreDePages;
	     }
	}
	else // Sinon
	{
	     $lPageOperationActuelle = 1; // La page actuelle est la n°1    
	}
	
	// Dans le cas où il n'y a pas d'opération
	if($lNombreDePages == 0) {
		$lPageOperationActuelle = 0;
	}
			
	// Affichage des informations de pagination
	$lTemplate->assign_vars( array( 	'PAGE_ACTUELLE_OPERATION' => $lPageOperationActuelle,
										'NOMBRE_PAGE_OPERATION' => $lNombreDePages ));
	
	// Génération des liens de pagination suivant et précédent
	$lPoPrecedent = $lPageOperationActuelle - 1;
	if($lPoPrecedent > 0) {
		$lTemplate->assign_vars( array( 'LIEN_OPERATION_PRECEDENT' => '"./index.php?m=' . MOD_MON_COMPTE_HTML . '&amp;v=MonCompte&amp;po=' . $lPoPrecedent . '"'));
	} else {
		$lTemplate->assign_vars( array( 'LIEN_OPERATION_PRECEDENT' => '"./index.php?m=' . MOD_MON_COMPTE_HTML . '&amp;v=MonCompte"' ));
	}
	
	$lPoSuivant = $lPageOperationActuelle + 1;
	if($lPoSuivant <= $lNombreDePages) {
		$lTemplate->assign_vars( array( 'LIEN_OPERATION_SUIVANT' => '"./index.php?m=' . MOD_MON_COMPTE_HTML . '&amp;v=MonCompte&amp;po=' . $lPoSuivant . '"' ));	
	} else {
		$lTemplate->assign_vars( array( 'LIEN_OPERATION_SUIVANT' => '"./index.php?m=' . MOD_MON_COMPTE_HTML . '&amp;v=MonCompte&amp;po=' . $lPageOperationActuelle . '"' ));
	}
	
	// Affichage des opérations
	$lPremiereEntree = ($lPageOperationActuelle - 1) * NB_OPE_PAGE; // On calcul la première entrée à lire
		
	$i = $lPremiereEntree;
	while( isset($lListeOperation[$i]) && $i <  ($lPremiereEntree + NB_OPE_PAGE) ) {
		$lOperation = $lListeOperation[$i];

		if( $lOperation->getOpeMontant() > 0 ) {
			$lTemplate->assign_block_vars('operationPassee', array(
						'opeLibelle' => $lOperation->getOpeLibelle(),
						'opeDate' => StringUtils::dateDbToFr($lOperation->getOpeDate()),
						'tppType' => $lOperation->getTppType(),
						'credit'  => StringUtils::affichageMonetaireFr($lOperation->getOpeMontant() )));
		} else {
			$lTemplate->assign_block_vars('operationPassee', array(
					'opeLibelle' => $lOperation->getOpeLibelle(),
					'opeDate' => StringUtils::dateDbToFr($lOperation->getOpeDate()),
					'tppType' => $lOperation->getTppType(),
					'debit' => StringUtils::affichageMonetaireFr( $lOperation->getOpeMontant() * -1 )));
		}
		$i++;
	}
	
	$lListeOperationAvenir = $lCompte->getOperationAvenir();
	$lSolde = $lAdherent->getCptSolde();
	$lRechargementPrecedent = 0;
	foreach($lListeOperationAvenir as $lOperationAvenir) {
		$lSolde	+= $lOperationAvenir->getOpeMontant();	
		$lRechargement = 0;	
		if($lSolde < SOLDE_CIBLE) {
			$lRechargement = (ceil((SOLDE_CIBLE-$lSolde)/SOLDE_CIBLE) * SOLDE_CIBLE) - $lRechargementPrecedent;
		}
		$lRechargementPrecedent += $lRechargement;
		$lTemplate->assign_block_vars('operationAvenir', array(
					'opeLibelle' => $lOperationAvenir->getOpeLibelle(),
					'opeDate' => StringUtils::dateDbToFr($lOperationAvenir->getOpeDate()),
					'comDateMarche' => StringUtils::dateDbToFr($lOperationAvenir->getComDateMarche()),
					'opeMontant'  => StringUtils::affichageMonetaireFr($lOperationAvenir->getOpeMontant() * -1 ),
					'nouveauSolde' => StringUtils::affichageMonetaireFr( $lSolde),
					'rechargement' => StringUtils::affichageMonetaireFr( $lRechargement) ));
		
	}
	$lTemplate->assign_var_from_handle('LISTE_OPERATION_ADHERENT', 'listeOperationAdherent');
	
	// Pied de Page
	$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
	$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
	
	// Affichage
	$lTemplate->pparse('body');
} else {
	$lLogger->log("Demande d'affichage sans autorisation du compte de l'Adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
