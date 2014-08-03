<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/01/2012
// Fichier : MotDePasseVue.php
//
// Description : Script de réinitialisation de mot de passe adhérent
//
//****************************************************************

	
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "Template.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php");
include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
	
// Constante de titre de la page
define("TITRE", ZEYBUX_TITRE_DEBUT . "Mot de Passe - " . ZEYBUX_TITRE_FIN);

// Préparation de l'affichage
$lTemplate = new Template(CHEMIN_TEMPLATE);	
$lTemplate->set_filenames( array('page' => 'Page.html') );

// Entete
$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
InfobullesUtils::generer($lTemplate); // Messages d'erreur
$lTemplate->assign_var_from_handle('ENTETE', 'entete');	

if(isset($_POST['numero']) && isset($_POST['mail'])) {
	include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_IDENTIFICATION . "/MotDePasseControleur.php");						
	$lControleur = new MotDePasseControleur();
	
	$lParam = array("numero" => $_POST['numero'],"mail"=>$_POST['mail']);
	$lPage = $lControleur->reinitier($lParam);

	if($lPage->getValid()) {
		// Body		
		$lTemplate->set_filenames( array('body' => MOD_IDENTIFICATION . '/' . 'MotDePasseConfirm.html') );
	} else {
		$_SESSION['val'] = $lParam;
		$_SESSION['msg'] = $lPage->exportToArray();
		header('location:./index.php?m=IdentificationHTML&v=MotDePasse');
	}	
} else {
	// Body		
	$lTemplate->set_filenames( array('body' => MOD_IDENTIFICATION . '/' . 'MotDePasseForm.html') );
}

$lTemplate->assign_var_from_handle('CONTENU', 'body');	

// Pied de Page
$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
$lTemplate->assign_vars( array( 
		'PROP_NOM' =>	PROP_NOM,
		'PROP_ADRESSE' =>	PROP_ADRESSE,
		'PROP_CODE_POSTAL' =>	PROP_CODE_POSTAL,
		'PROP_VILLE' =>	PROP_VILLE,
		'PROP_TEL' =>	PROP_TEL,
		'PROP_MEL' =>	PROP_MEL,
		'ZEYBUX_TITRE_SITE' =>	ZEYBUX_TITRE_SITE) );

$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');

// Affichage
$lTemplate->pparse('page');

?>