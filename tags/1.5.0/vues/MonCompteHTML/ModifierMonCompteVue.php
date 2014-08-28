<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/01/2012
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
		include_once(CHEMIN_CLASSES_UTILS . "InfobullesUtils.php");
		include_once(CHEMIN_CLASSES_UTILS . "Template.php");		
		include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
				
		// Constante de titre de la page
		define("TITRE", ZEYBUX_TITRE_DEBUT . "Mon Compte - " . ZEYBUX_TITRE_FIN);
		
		$lControleur = new ModifierMonCompteControleur();
		switch($_GET["fonction"]) {					
			case "formPass":				
				// Préparation de l'affichage
				$lTemplate = new Template(CHEMIN_TEMPLATE);	
				
				// Entete
				$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
				$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
				InfobullesUtils::generer($lTemplate); // Messages d'erreur
				$lTemplate->assign_var_from_handle('ENTETE', 'entete');
				
				// Menu
				$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
				$lTemplate->assign_vars( array( 'menu-MonCompte' => "ui-state-active") );	
				$lTemplate->assign_var_from_handle('MENU', 'menu');
				
				// Body
				$lTemplate->set_filenames( array('body' => MOD_MON_COMPTE . '/' . 'EditerPassForm.html') );
				//InfobullesUtils::genererValeur(&$lTemplate); // Valeur des champs du formulaire
				
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
					
					InfobullesUtils::init();
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
						$_SESSION['msg'] = $lVr->exportToArray();					
						header('location:./index.php?m=MonCompteHTML&v=MonCompte');						
					} else {
						// Affichage des messages d'erreur
						$lParam = array(
									"motPasse" => $_POST['pass'],
									"motPasseNouveau" => $_POST['pass_nouveau'],
									"motPasseConfirm" => $_POST['pass_confirm']);
						
						$_SESSION['msg'] = $lVr->exportToArray();
						$_SESSION['val'] = $lParam;
						header('location:./index.php?m=MonCompteHTML&v=ModifierMonCompte&fonction=formPass');
					}
				} else {
					$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					header('location:./index.php');
				}
				break;
				
				
			case "formInformation":			
				include_once(CHEMIN_CLASSES_CONTROLEURS . MOD_MON_COMPTE . "/MonCompteControleur.php");
				$lControleur = new MonCompteControleur();
				$lParam['id_adherent'] = $_SESSION[DROIT_ID];
				
				$lCompte = $lControleur->getInfoAdherent($lParam);
				$lLogger->log("Affichage du formulaire de modification des informations de l'adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs

				// Préparation de l'affichage
				$lTemplate = new Template(CHEMIN_TEMPLATE);	
				
				// Entete
				$lTemplate->set_filenames( array('entete' =>  COMMUN_TEMPLATE . 'Entete.html') );
				$lTemplate->assign_vars( array( 'TITRE' => TITRE) );
				$lTemplate->assign_var_from_handle('ENTETE', 'entete');
				
				// Menu
				$lTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );				
				$lTemplate->assign_vars( array( 'menu-MonCompte' => "ui-state-active") );	
				$lTemplate->assign_var_from_handle('MENU', 'menu');
				
				// Body
				$lTemplate->set_filenames( array('body' => MOD_MON_COMPTE . '/' . 'EditerInformationForm.html') );
				$lAdherent = $lCompte->getAdherent();
				
				$lAdherentCompte = $lCompte->getAdherentCompte();
				if(count($lAdherentCompte) == 1) {
					$lTemplate->set_filenames( array('listeAdherent' => MOD_MON_COMPTE . '/AdherentPrincipal.html') );
					$lTemplate->assign_vars( array( 
								'id' => $lAdherent->getAdhId(),
								'numero' => $lAdherent->getAdhNumero(),
								'nom'  => $lAdherent->getAdhNom(),
								'prenom' => $lAdherent->getAdhPrenom() ));
				} else if(count($lAdherentCompte) > 1) {
					$lTemplate->set_filenames( array('listeAdherent' => MOD_MON_COMPTE . '/SelectListeAdherent.html') );
					foreach($lAdherentCompte as $lAdh) {
						if($lAdh->getId() == $lAdherent->getCptIdAdherentPrincipal()) {
							$lSelected = 'selected="selected"';
						} else {
							$lSelected = '';
						}
						
						$lTemplate->assign_block_vars('adherent', array(
							'id' => $lAdh->getId(),
							'numero' => $lAdh->getNumero(),
							'nom' => $lAdh->getNom(),
							'prenom' => $lAdh->getPrenom(),
							'selected' => $lSelected ));
					}
				} 
				$lTemplate->assign_var_from_handle('ADHERENT_PRINCIPAL', 'listeAdherent');
				
				
				$lTemplate->assign_vars( array( 
								'nom'  => $lAdherent->getAdhNom(),
								'prenom' => $lAdherent->getAdhPrenom(),
								'courrielPrincipal' => $lAdherent->getAdhCourrielPrincipal(),
								'courrielSecondaire' => $lAdherent->getAdhCourrielSecondaire(),
								'telephonePrincipal' => $lAdherent->getAdhTelephonePrincipal(),
								'telephoneSecondaire' => $lAdherent->getAdhTelephoneSecondaire(),
								'adresse' => $lAdherent->getAdhAdresse(),
								'codePostal' => $lAdherent->getAdhCodePostal(),
								'ville' => $lAdherent->getAdhVille(),
								'commentaire' => $lAdherent->getAdhCommentaire() ));
				
				
				InfobullesUtils::generer($lTemplate); // Messages d'erreur
				
			
				// Affichage des dates si elles ne sont pas nulle
				if(!StringUtils::dateEstNulle($lAdherent->getAdhDateNaissance())) {
					$lTemplate->assign_vars( array('dateNaissance' => StringUtils::dateDbToFr($lAdherent->getAdhDateNaissance()) ) );
				}
				
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
				$lTemplate->pparse('body');
				break;
		
			case "information":				
					if(isset($_POST['idAdherentPrincipal']) 
					&& isset($_POST['nom']) 
					&& isset($_POST['prenom']) 
					&& isset($_POST['date_naissance']) 
					&& isset($_POST['commentaire']) 
					&& isset($_POST['courriel_principal'])
					&& isset($_POST['courriel_secondaire']) 
					&& isset($_POST['telephone_principal']) 
					&& isset($_POST['telephone_secondaire']) 
					&& isset($_POST['adresse']) 
					&& isset($_POST['code_postal']) 
					&& isset($_POST['ville'])  ) {
						
					$lParam = array("id_adherent" => $_SESSION[DROIT_ID],
									"idAdherentPrincipal" => $_POST['idAdherentPrincipal'],
									"nom" => $_POST['nom'],
									"prenom" => $_POST['prenom'],
									"dateNaissance" => StringUtils::dateFrToDb($_POST['date_naissance']),
									"commentaire" => $_POST['commentaire'],
									"courrielPrincipal" => $_POST['courriel_principal'],
									"courrielSecondaire" => $_POST['courriel_secondaire'],
									"telephonePrincipal" => $_POST['telephone_principal'],
									"telephoneSecondaire" => $_POST['telephone_secondaire'],
									"adresse" => $_POST['adresse'],
									"codePostal" => $_POST['code_postal'],
									"ville" => $_POST['ville']);
					$lVr = $lControleur->modifierInformation($lParam);		
									
					$lLogger->log("Modification des informations du compte de l'Adhérent : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					
					InfobullesUtils::init();
					if($lVr->getValid()) {
						// Retour à Mon Compte avec le message de confirmation
						include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
						include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_316_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_316_MSG);
						$lVr->getLog()->addErreur($lErreur);
						$_SESSION['msg'] = $lVr->exportToArray();					
						header('location:./index.php?m=MonCompteHTML&v=MonCompte');						
					} else {
						// Affichage des messages d'erreur
						$lParam = array("nom" => $_POST['nom'],
									"prenom" => $_POST['prenom'],
									"dateNaissance" => StringUtils::dateFrToDb($_POST['date_naissance']),
									"commentaire" => $_POST['commentaire'],
									"courrielPrincipal" => $_POST['courriel_principal'],
									"courrielSecondaire" => $_POST['courriel_secondaire'],
									"telephonePrincipal" => $_POST['telephone_principal'],
									"telephoneSecondaire" => $_POST['telephone_secondaire'],
									"adresse" => $_POST['adresse'],
									"codePostal" => $_POST['code_postal'],
									"ville" => $_POST['ville']);
						
						$_SESSION['msg'] = $lVr->exportToArray();
						$_SESSION['val'] = $lParam;
						header('location:./index.php?m=MonCompteHTML&v=ModifierMonCompte&fonction=formInformation');
					}
				} else {
					$lLogger->log("Demande d'accés à ModifierMonCompte sans identifiant commande par : " . $_SESSION[ID_CONNEXION],PEAR_LOG_INFO);	// Maj des logs
					//header('location:./index.php');
				}
					
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
	header('location:./index.php?cx=2');
}
?>