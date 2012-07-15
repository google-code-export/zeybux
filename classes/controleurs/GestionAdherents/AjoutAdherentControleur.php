<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AjoutAdherentControleur.php
//
// Description : Classe AjoutAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AfficheAjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_UTILS . "MotDePasseUtils.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");

/**
 * @name AjoutAdherentControleur
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe controleur d'un Ajout d'adherent
 */
class AjoutAdherentControleur
{

	/**
	* @name getListeModule()
	* @desc Retourne l'ensemble des modules
	*/
	public function getListeModule() {
		$lResponse = new AfficheAjoutAdherentResponse();
		$lResponse->setModules(ModuleManager::selectAllVisible());
		return $lResponse;
	}
	
	/**
	* @name ajoutAdherent($pParam)
	* @return string
	* @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	*/
	public function ajoutAdherent($pParam) {		
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
				
		$lVr = AdherentValid::validAjout($pParam);
		if($lVr->getValid()) {			
			include_once(CHEMIN_CONFIGURATION . "Mail.php"); // Les Constantes de mail
			
			$lAdherent = AdherentToVO::convertFromArray($pParam);
			
			$lAdherentCompte = $pParam['compte'];
			$lCompte = CompteManager::selectByLabel($lAdherentCompte);	
			if(empty($lAdherentCompte) || is_null($lCompte[0]->getId())) {
				// Création d'un nouveau compte
				$lCompte = new CompteVO();
				$lIdCompte = CompteManager::insert($lCompte);
				// Le label est l'id du compte par défaut
				$lCompte->setId($lIdCompte);
				$lCompte->setLabel('C' . $lIdCompte);
				CompteManager::update($lCompte);
				
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
				
				$lAdherent->setIdCompte($lIdCompte);
			} else {									
				$lAdherent->setIdCompte($lCompte[0]->getId());
			}
						
			// Insertion de la première mise à jour
			$lAdherent->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
			
			// L'adherent n'est pas supprimé
			$lAdherent->setEtat(1);
			
			// Enregistre l'adherent dans la BDD
			$lId = AdherentManager::insert( $lAdherent );
			
			// Ajout des autorisations du compte
			foreach( $lAdherent->getListeModule() as $lIdModule) {
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule($lIdModule);
	
				AutorisationManager::insert($lAutorisation);
			}
			
			$lAdherent = AdherentManager::select($lId);
			
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
			$lContenu = str_replace(array("{LOGIN}", "{MOT_PASSE}"), array($lAdherent->getNumero(), $lMdp), $lContenu);
			
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
				$lLogger->log("Erreur d'envoi du mail de création de l'adhérent " . $pParam['numero'] . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
				return $lVr;
			} else {
				$lLogger->log("Envoi du mail de création de l'adhérent " . $pParam['numero'] . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
			}
			
			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lId);			
			$lResponse->setNumero($lAdherent->getNumero());
			return $lResponse;
						
		}	
		return $lVr;
	}
}
?>
