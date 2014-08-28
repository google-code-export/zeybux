<?php
if(isset($_SESSION['cx']) && $_SESSION['cx'] == 1) {
	// Inclusion de la config
	define("CHEMIN_RACINE", "../");
	// Définition des constantes de chemin
	define("CHEMIN_CLASSES", CHEMIN_RACINE . "/classes/");
	define("CHEMIN_CLASSES_UTILS", CHEMIN_CLASSES . "utils/");
	define("CHEMIN_CLASSES_PO", CHEMIN_CLASSES . "po/");
	define("CHEMIN_CLASSES_VO", CHEMIN_CLASSES . "vo/");
	define("CHEMIN_CLASSES_VIEW_VO", CHEMIN_CLASSES . "viewVO/");
	define("CHEMIN_CLASSES_MANAGERS", CHEMIN_CLASSES . "managers/");
	define("CHEMIN_CLASSES_VIEW_MANAGER", CHEMIN_CLASSES . "viewManager/");
	define("CHEMIN_CLASSES_CONTROLEURS", CHEMIN_CLASSES . "controleurs/");
	define("CHEMIN_CLASSES_VR", CHEMIN_CLASSES . "vr/");
	define("CHEMIN_CLASSES_VALIDATEUR", CHEMIN_CLASSES . "validateur/");
	define("CHEMIN_CLASSES_TOVO", CHEMIN_CLASSES . "toVO/");
	define("CHEMIN_CLASSES_RESPONSE", CHEMIN_CLASSES . "response/");
	define("CHEMIN_CLASSES_SERVICE", CHEMIN_CLASSES . "service/");
	
	define("CHEMIN_VUES", CHEMIN_RACINE . "/vues/");
	define("CHEMIN_TEMPLATE", CHEMIN_RACINE . "/html/");
	define("COMMUN_TEMPLATE", "Commun/");
	define("CHEMIN_CONFIGURATION", CHEMIN_RACINE . "/configuration/");
	define("CHEMIN_JS", CHEMIN_RACINE . "/js/");
	define("CHEMIN_TEMPORAIRE", CHEMIN_RACINE . "/tmp/");
	
	define("CHEMIN_FICHIER_LOGS", CHEMIN_RACINE . "/logs/" . date('Ymd') . ".log");
	
	include_once(CHEMIN_CONFIGURATION . "Localisation.php"); // Les informations de localisation
	include_once(CHEMIN_CONFIGURATION . "Identification.php"); // Définition des constantes pour les droits
	include_once(CHEMIN_CONFIGURATION . "Modules.php"); // Définition des constantes de module
	include_once(CHEMIN_CONFIGURATION . "Version.php"); // La version
	include_once(CHEMIN_CONFIGURATION . "Titre.php"); // Définition des constantes de titre
	include_once(CHEMIN_CLASSES_UTILS . "Log.php"); // La classe de Log
	include_once(CHEMIN_CONFIGURATION . "LogLevel.php"); // Définition du level de log
	include_once(CHEMIN_CONFIGURATION . "Proprietaire.php"); // Définition du level de log
	
	// Inclusion des classes
	//include_once(CHEMIN_CLASSES_UTILS."/Log.php");
		
	include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
	include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
	include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
	include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
	include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
	include_once(CHEMIN_CLASSES_UTILS . "MotDePasseUtils.php" );
	include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");
	include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
	include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");
	
	// Téléchargement du fichier csv
	if( isset($_FILES["compte"]) ) {
		if($_FILES["compte"]["error"] == UPLOAD_ERR_OK) {
	        $tmp_name = $_FILES["compte"]["tmp_name"];
	        $name = $_FILES["compte"]["name"];
	        move_uploaded_file($tmp_name, './compte');		
		}
		$lResultat = "";
		$lNbOK = 0;
		$lNbKO = 0;
		if(file_exists('./compte') ) {
			
			$lResultat = "<table>
							<tr>
								<th>Adhérent</th>
								<th>Statut</th>
							</tr>";
			if (($handle = fopen("compte", "r")) !== FALSE) {
			    while (($data = fgetcsv($handle)) !== FALSE) {		    	
			    	$lNumero = $data[1];
			    	$lNom = $data[2];
			    	$lPrenom = $data[3];
			    	$lCourrielP = $data[4];
			    	$lCourrielS = $data[5];
			    	$lTelephoneP = $data[6];
			    	$lTelephoneS = $data[7];
			    	$lAdresse = $data[8];
			    	
			    	$lCoord = explode(" ", $data[9]);		    	
			    	$lCodePostal = $lCoord[0];
			    	$lVille = $lCoord[1];
			    	
			    	$lDateNaissance = StringUtils::FORMAT_DATE_NULLE;
			    	
			   		if(empty($data[10])) {
							$lDateAdhesion = StringUtils::FORMAT_DATE_NULLE;
					} else {
			    		$lDateAdhesion = '20' . $data[10][0] . $data[10][1] . '-' . $data[10][2] . $data[10][3] . '-' . $data[10][4] . $data[10][5];
					}
					$lCompteLabel = $data[11];
			    	$lCommentaire = $data[12];
			    	$lCompteSolde = $data[13];
	
			    	if(!empty($lCompteLabel) && !empty($lNumero)) { // Pas d'import si pas de compte ou pas de numéro d'adhérent
			    		// Le Compte
			    		$lCompte = CompteManager::selectByLabel($lCompteLabel);
			    		$lCompte = $lCompte[0];
			    		$lIdCompte = $lCompte->getId();
			    		$lSolde = $lCompte->getSolde();
			    		if(is_null($lIdCompte)) { // Création d'un nouveau compte, si il n'existe pas déjà
							$lCompte = new CompteVO();
							$lCompte->setLabel($lCompteLabel);
							$lSolde = str_replace(",", ".", $lCompteSolde);
							$lCompte->setSolde($lSolde);
							$lIdCompte = CompteManager::insert($lCompte);
							
							// Initialisation du compte si c'est un nouveau compte
							$lOperation = new OperationVO();
							$lOperation->setIdCompte($lIdCompte);
							$lOperation->setMontant($lSolde);
							$lOperation->setLibelle("Création du compte");
							$lOperation->setDate(StringUtils::dateAujourdhuiDb());
							//$lOperation->setType(1);
							$lOperation->setIdCommande(0);
							$lOperation->setTypePaiement(-1);				
							OperationManager::insert($lOperation);
			    		}
			    		
			    		//L'adhérent
			    		$lAdherent = new AdherentVO();				
						$lAdherent->setIdCompte($lIdCompte);			
						$lAdherent->setNumero($lNumero);				
						$lAdherent->setNom(StringUtils::formaterNom(trim($lNom)));
						$lAdherent->setPrenom(StringUtils::formaterPrenom(trim($lPrenom)));
						$lAdherent->setCourrielPrincipal(trim($lCourrielP));
						$lAdherent->setCourrielSecondaire(trim($lCourrielS));
						$lAdherent->setTelephonePrincipal(trim($lTelephoneP));
						$lAdherent->setTelephoneSecondaire(trim($lTelephoneS));
						$lAdherent->setAdresse(trim($lAdresse));
						$lAdherent->setCodePostal(trim($lCodePostal));
						$lAdherent->setVille(StringUtils::formaterVille(trim($lVille)));
						$lAdherent->setDateNaissance($lDateNaissance);
						$lAdherent->setDateAdhesion($lDateAdhesion); 
						$lAdherent->setDateMaj(StringUtils::dateTimeAujourdhuiDb());
						$lAdherent->setCommentaire(trim($lCommentaire));
						$lAdherent->setEtat(1);
											
						// Protection des dates vides
						if($lAdherent->getDateNaissance() == '') {
							$lAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
						}
											
						$lRequete =
						"INSERT INTO " . AdherentManager::TABLE_ADHERENT . "
							(" . AdherentManager::CHAMP_ADHERENT_ID . "
							," . AdherentManager::CHAMP_ADHERENT_NUMERO . "
							," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . "
							," . AdherentManager::CHAMP_ADHERENT_NOM . "
							," . AdherentManager::CHAMP_ADHERENT_PRENOM . "
							," . AdherentManager::CHAMP_ADHERENT_COURRIEL_PRINCIPAL . "
							," . AdherentManager::CHAMP_ADHERENT_COURRIEL_SECONDAIRE . "
							," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_PRINCIPAL . "
							," . AdherentManager::CHAMP_ADHERENT_TELEPHONE_SECONDAIRE . "
							," . AdherentManager::CHAMP_ADHERENT_ADRESSE . "
							," . AdherentManager::CHAMP_ADHERENT_CODE_POSTAL . "
							," . AdherentManager::CHAMP_ADHERENT_VILLE . "
							," . AdherentManager::CHAMP_ADHERENT_DATE_NAISSANCE . "
							," . AdherentManager::CHAMP_ADHERENT_DATE_ADHESION . "
							," . AdherentManager::CHAMP_ADHERENT_DATE_MAJ . "
							," . AdherentManager::CHAMP_ADHERENT_COMMENTAIRE . "				
							," . AdherentManager::CHAMP_ADHERENT_ETAT . ")
							VALUES (NULL
								,'" . StringUtils::securiser( $lAdherent->getNumero() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getIdCompte() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getNom() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getPrenom() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getCourrielPrincipal() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getCourrielSecondaire() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getTelephonePrincipal() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getTelephoneSecondaire() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getAdresse() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getCodePostal() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getVille() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getDateNaissance() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getDateAdhesion() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getDateMaj() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getCommentaire() ) . "'
								,'" . StringUtils::securiser( $lAdherent->getEtat() ) . "')";
				
						$lId = Dbutils::executerRequeteInsertRetourId($lRequete); // Execution de la requete et récupération de l'Id généré par la BDD
			    		
						// Les modules autorisés des adhérents
						$lAutorisation = new AutorisationVO();
						$lAutorisation->setIdAdherent($lId);
						$lAutorisation->setIdModule(1);	
						AutorisationManager::insert($lAutorisation);
						$lAutorisation = new AutorisationVO();
						$lAutorisation->setIdAdherent($lId);
						$lAutorisation->setIdModule(3);	
						AutorisationManager::insert($lAutorisation);
	
						// Insertion des informations de connexion
						$lMdp = MotDePasseUtils::generer();	
						$lIdentification = new IdentificationVO();
						$lIdentification->setIdLogin($lId);
						$lIdentification->setLogin($lAdherent->getNumero());
						$lIdentification->setPass( md5( $lMdp ) );
						$lIdentification->setType(1);
						$lIdentification->setAutorise(1);
						IdentificationManager::insert( $lIdentification );
						
						// Ajout à la mailing liste
						$lMailingListeService = new MailingListeService();
						if($lAdherent->getCourrielPrincipal() != "") {
							$lMailingListeService->insert($lAdherent->getCourrielPrincipal());	
						}
						if($lAdherent->getCourrielSecondaire() != "") {
							$lMailingListeService->insert($lAdherent->getCourrielSecondaire());			
						}	
						
						// Envoi du mail de confirmation		
						if($lAdherent->getCourrielPrincipal() != "") {
							$lTo = $lAdherent->getCourrielPrincipal();
						} else if($lAdherent->getCourrielSecondaire() != "") {
							$lTo = $lAdherent->getCourrielSecondaire();			
						} else { // Pas de mail sur le compte : Envoi au gestionnaire
							$lTo = MAIL_SUPPORT;				
						}			
						$lFrom  = MAIL_SUPPORT;  
			
						$jour  = date("d-m-Y");
						$heure = date("H:i");			
						$lSujet = "Votre Compte zeybux";
			
						$lContenu = file_get_contents(CHEMIN_TEMPLATE . MOD_GESTION_ADHERENTS . "/" . "MailAjoutAdherent.html");
						$lContenu = str_replace(array("{LOGIN}", "{MOT_PASSE}", "{PROP_NOM}", "{ZEYBUX_ADRESSE_SITE}"), array($pAdherent->getNumero(), $lMdp, PROP_NOM, ZEYBUX_ADRESSE_SITE), $lContenu);
						
						$lHeaders = file_get_contents(CHEMIN_TEMPLATE . COMMUN_TEMPLATE . "/" . "EnteteMail.html");
						$lHeaders = str_replace("{FROM}", $lFrom, $lHeaders);
						
						$VerifEnvoiMail = TRUE;			
						$VerifEnvoiMail = @mail ($lTo, $lSujet, $lContenu, $lHeaders);
					
						if ($VerifEnvoiMail === FALSE) {	
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_118_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_118_MSG);
							$lVr->getLog()->addErreur($lErreur);				
							//$lLogger->log("Erreur d'envoi du mail de création de l'adhérent " . $pParam['numero'] . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
							$lStatut = "KO";
							$lNbKO++;
						} else {
							//$lLogger->log("Envoi du mail de création de l'adhérent " . $pParam['numero'] . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
							$lStatut = "OK";
							$lNbOK++;
						}
						$lResultat .= 	"<tr>
											<td>" . $lAdherent->getNumero() . " : " . $lAdherent->getNom() . " " . $lAdherent->getPrenom() . "</td>
											<td>" . $lStatut . "</td>
										</tr>";
					
			    	} else {
			    		$lNbKO++;
			    		$lResultat .= 	"<tr>
										<td>   : " . $lNom . " " . $lPrenom . "</td>
										<td>KO : Pas de N° de compte ou pas de N° d'adhérent</td>
									</tr>";
			    	}
			    }
			    fclose($handle);
			}		
			// Suppression du fichier
			unlink('./compte');
		}
		$lResultat .= "</table>";
		?>
		<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
			<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Import des comptes</div>
			<div class="com-center">Import terminé.</div>
			Import OK : <?php echo $lNbOK;?><br/>
			Import KO : <?php echo $lNbKO;?>
		</div>
		<div class="com-widget-window ui-widget-content menu-lien btn-menu ui-corner-all">
			<div class="com-widget-window ui-widget ui-widget-header ui-corner-all">Comptes Importés</div>
			<?php echo $lResultat;?>
		</div>
		<?php 
	}
}
?>