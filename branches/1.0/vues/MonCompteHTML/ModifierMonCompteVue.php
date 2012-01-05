<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : MonCompteVue.php
//
// Description : Script de vue du compte Adherent
//
//****************************************************************

// Vérification de la bonne connexion de l'adherent dans le cas contraire redirection vers le formulaire de connexion
if( isset($_SESSION[DROIT_ID]) && ( isset($_SESSION[MOD_MON_COMPTE]) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) ) {
	if(isset($_GET['fonction'])) {
		
		// Inclusion des classes
		include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_MON_COMPTE . "/ModifierMonCompteControleur.php");
		$lControleur = new ModifierMonCompteControleur();
		switch($_GET["fonction"]) {					
			case "formPass":
				// Inclusion des classes
				include_once(CHEMIN_CLASSES_UTILS . "Template.php");
				include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
				
				// Constante de titre de la page
				define("TITRE", ZEYBUX_TITRE_DEBUT . "Mon Compte - " . ZEYBUX_TITRE_FIN);
				define("COMMUN_TEMPLATE", "Commun/");
				
				// Préparation de l'affichage
				$lTemplate = new Template(CHEMIN_TEMPLATE);	
				
				// Entete
				$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
				$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
				if(isset($_GET['msg'])) { // Message d'erreur					
					InfobullesUtils::genererMessage($_GET['msg'],&$lTemplate);
				}
				$lTemplate->assign_var_from_handle('ENTETE', 'entete');
				
				// Menu
				$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
				$lTemplate->assign_var_from_handle('MENU', 'menu');
				
				// Body
				$lTemplate->set_filenames( array('body' => MOD_MON_COMPTE . '/' . 'EditerPassForm.html') );
				if(isset($_GET['val'])) { // Valeur des champs du formulaire
					InfobullesUtils::genererValeur($_GET['val'],&$lTemplate);
				}
				
				// Pied de Page
				$lTemplate->set_filenames( array('piedPage' => COMMUN_TEMPLATE . 'PiedPage.html') );
				$lTemplate->assign_var_from_handle('PIED_PAGE', 'piedPage');
				
				// Affichage
				$lTemplate->pparse('body');
				break;
				
			case "pass":
				if(isset($_POST['pass']) && isset($_POST['pass_nouveau']) && isset($_POST['pass_confirm'])) {
					$lParam = array("id_adherent" => $_SESSION[DROIT_ID],
									"motPasse" => $_POST['pass'],
									"motPasseNouveau" => $_POST['pass_nouveau'],
									"motPasseConfirm" => $_POST['pass_confirm']);
					$lVr = $lControleur->modifierPass($lParam);						
					$lLogger->log("Modification du pass de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					
					if($lVr->getValid()) {
						// Retour à Mon Compte avec le message de confirmation
						include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
						include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_302_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_302_MSG);
						$lVr->getLog()->addErreur($lErreur);						
						header('location:./index.php?m=MonCompteHTML&v=MonCompte&msg=' . $lVr->exportToJson());						
					} else {
						// Affichage des messages d'erreur
						$lParam = array(
									"motPasse" => $_POST['pass'],
									"motPasseNouveau" => $_POST['pass_nouveau'],
									"motPasseConfirm" => $_POST['pass_confirm']);
						header('location:./index.php?m=MonCompteHTML&v=ModifierMonCompte&fonction=formPass&val=' . json_encode($lParam) . '&msg=' . $lVr->exportToJson() );
					}
				} else {
					$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
				}
				break;
		
			case "information":
					echo $lControleur->modifierInformation($lParam)->exportToJson();						
					$lLogger->log("Modification du compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				break;

			default:
				$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
				header('location:./index.php');
				break;
		}	
	} else {
		$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
		header('location:./index.php');		
	}
} else {
	$lLogger->log("Demande d'affichage sans autorisation du compte de l'Adhérent",PEAR_LOG_INFO);	// Maj des logs
	header('location:./index.php?cx=1');
}
?>
