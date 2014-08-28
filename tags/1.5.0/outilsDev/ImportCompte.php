<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
                      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Zeybux - Import des Comptes</title>
</head>
<body>
<div>
	<a href="./index.php">Retour</a><br/>
</div>
<?php 

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
	if(file_exists('./compte') ) {
		
		$lResultat = "<table>
						<tr>
							<th>Adhérent</th>
							<th>Statut</th>
						</tr>";
		$lNbOK = 0;
		$lNbKO = 0;
		$row = 1;
		if (($handle = fopen("compte", "r")) !== FALSE) {
		    while (($data = fgetcsv($handle)) !== FALSE) {
		    	
		    	// Création d'un nouveau compte
				$lCompte = new CompteVO();
				$lCompte->setLabel($data[11]);
				$lCompte->setSolde(str_replace(",", ".", $data[13]));
				$lIdCompte = CompteManager::insert($lCompte);
		    	
		    	$lAdherent = new AdherentVO();				
				$lAdherent->setIdCompte($lIdCompte);			
				$lAdherent->setNumero($data[1]);				
				$lAdherent->setNom($data[2]);
				$lAdherent->setPrenom($data[3]);
				$lAdherent->setCourrielPrincipal($data[4]);
				$lAdherent->setCourrielSecondaire($data[5]);
				$lAdherent->setTelephonePrincipal($data[6]);
				$lAdherent->setTelephoneSecondaire($data[7]);
				$lAdherent->setAdresse($data[8]);
				$lVille = explode(" ", $data[9]);
				$lAdherent->setCodePostal($lVille[0]);
				$lAdherent->setVille($lVille[1]);
				$lAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
				$lDateAdhesion = '20' . $data[10][0] . $data[10][1] . '-' . $data[10][2] . $data[10][3] . '-' . $data[10][4] . $data[10][5];
				$lAdherent->setDateAdhesion($lDateAdhesion); 
				$lAdherent->setDateMaj(StringUtils::dateTimeAujourdhuiDb());
				$lAdherent->setCommentaire($data[12]);
				$lAdherent->setEtat(1);
		    	
			    // Enregistre l'adherent dans la BDD
				//$lId = AdherentManager::insert( $lAdherent );
				
				// Mise en forme des données
				$lAdherent->setNom(StringUtils::formaterNom(trim($lAdherent->getNom())));
				$lAdherent->setPrenom(StringUtils::formaterPrenom(trim($lAdherent->getPrenom())));
				$lAdherent->setCourrielPrincipal(trim($lAdherent->getCourrielPrincipal()));
				$lAdherent->setCourrielSecondaire(trim($lAdherent->getCourrielSecondaire()));
				$lAdherent->setTelephonePrincipal(trim($lAdherent->getTelephonePrincipal()));
				$lAdherent->setTelephoneSecondaire(trim($lAdherent->getTelephoneSecondaire()));
				$lAdherent->setAdresse(trim($lAdherent->getAdresse()));
				$lAdherent->setCodePostal(trim($lAdherent->getCodePostal()));
				$lAdherent->setVille(StringUtils::formaterVille(trim($lAdherent->getVille())));
				$lAdherent->setCommentaire(trim($lAdherent->getCommentaire()));
				
				// Protection des dates vides
				if($lAdherent->getDateNaissance() == '') {
					$lAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
				}
				if($lAdherent->getDateAdhesion() == '') {
					$lAdherent->getDateAdhesion(StringUtils::FORMAT_DATE_NULLE);
				}
				if($lAdherent->getDateMaj() == '') {
					$lAdherent->getDateMaj(StringUtils::FORMAT_DATE_NULLE);
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
			
				//$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
				$lId = Dbutils::executerRequeteInsertRetourId($lRequete); // Execution de la requete et récupération de l'Id généré par la BDD

				// Ajout des autorisations du compte
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule(1);	
				AutorisationManager::insert($lAutorisation);
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule(3);	
				AutorisationManager::insert($lAutorisation);
				
				// Initialisation du compte
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompte);
				$lOperation->setMontant(0);
				$lOperation->setLibelle("Création du compte");
				$lOperation->setDate(StringUtils::dateAujourdhuiDb());
				//$lOperation->setType(1);
				$lOperation->setIdCommande(0);
				$lOperation->setTypePaiement(-1);				
				OperationManager::insert($lOperation);
				
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
		    }
		    fclose($handle);
		}		
	}
	// Suppression du fichier
	unlink('./compte');
	$lResultat .= "</table>";
	?>
	<h2>Import des comptes terminé.</h2>
	<div>
		Import OK : <?php echo $lNbOK;?><br/>
		Import KO : <?php echo $lNbKO;?>
	</div>
	<?php 
	echo $lResultat;
} else {
	?>
	<form method="post" action="./ImportCompte.php" enctype="multipart/form-data">
		<span>Les comptes à insérer en BDD : </span>
		<input type="file" name="compte"/><br/>
		<input type=submit value="Importer">
	</form>	
	<?php	
}
?>
</body>
</html>