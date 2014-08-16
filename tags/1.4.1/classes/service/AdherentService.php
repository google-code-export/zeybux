<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/12/2012
// Fichier : AdherentService.php
//
// Description : Classe AdherentService
//
//****************************************************************


// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/AdherentValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/AdhesionAdherentValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");

include_once(CHEMIN_CONFIGURATION . "Mail.php"); // Les Constantes de mail

include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_UTILS . "MotDePasseUtils.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ModuleService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdhesionService.php");

/**
 * @name AdherentService
 * @author Julien PIERRE
 * @since 28/12/2012
 * @desc Classe Service des Adherents
 */
class AdherentService
{
	/**
	 * @name set($pAdherent)
	 * @param AdherentVO
	 * @return AdherentVO
	 * @desc Ajoute ou modifie un adherent
	 */
	public function set($pAdherent) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if($lAdherentValid->insert($pAdherent)) {
			return $this->insert($pAdherent);
		} else if($lAdherentValid->update($pAdherent)) {
			return $this->update($pAdherent);
		} else {
			return false;
		}
	}
	
	/**
	 * @name insert($pAdherent)
	 * @param AdherentVO
	 * @return AdherentVO
	 * @desc Ajoute un adherent
	 */
	private function insert($pAdherent) {
		
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
		// Si pas de liaison création d'un nouveau compte
		$lNvCompte = false;
		if($pAdherent->getIdCompte() == 0) {
			// Création d'un nouveau compte			
			$lCompte = new CompteVO();
			$lCompteService = new CompteService();
			$lCompte = $lCompteService->set($lCompte);		
			$pAdherent->setIdCompte($lCompte->getId());  // Laision avec l'adhérent
			$lNvCompte = true;
		}
		
		// Insertion de la première mise à jour
		$pAdherent->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
		// L'adherent n'est pas supprimé
		$pAdherent->setEtat(1);
		
		// Mise en forme des données
		$pAdherent->setNom(StringUtils::formaterNom(trim($pAdherent->getNom())));
		$pAdherent->setPrenom(StringUtils::formaterPrenom(trim($pAdherent->getPrenom())));
		$pAdherent->setCourrielPrincipal(trim($pAdherent->getCourrielPrincipal()));
		$pAdherent->setCourrielSecondaire(trim($pAdherent->getCourrielSecondaire()));
		$pAdherent->setTelephonePrincipal(trim($pAdherent->getTelephonePrincipal()));
		$pAdherent->setTelephoneSecondaire(trim($pAdherent->getTelephoneSecondaire()));
		$pAdherent->setAdresse(trim($pAdherent->getAdresse()));
		$pAdherent->setCodePostal(trim($pAdherent->getCodePostal()));
		$pAdherent->setVille(StringUtils::formaterVille(trim($pAdherent->getVille())));
		$pAdherent->setCommentaire(trim($pAdherent->getCommentaire()));
		
		// Protection des dates vides
		if($pAdherent->getDateNaissance() == '') {
			$pAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pAdherent->getDateAdhesion() == '') {
			$pAdherent->setDateAdhesion(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pAdherent->getDateMaj() == '') {
			$pAdherent->setDateMaj(StringUtils::FORMAT_DATE_NULLE);
		}
		
		// Enregistre l'adherent dans la BDD
		$lIdAdherent = AdherentManager::insert( $pAdherent );
		
		if($lNvCompte) { // Création d'un compte
			$lCompte = $lCompteService->get($lCompte->getId());
			$lCompte->setIdAdherentPrincipal($lIdAdherent); // Positionnement de l'adhérent en adhérent principal du compte
			$lCompteService->set($lCompte);
		} else { // Liaison avec un autre compte
			// Les adhérents du compte
			$lListeAdherent = $this->selectActifByIdCompte($pAdherent->getIdCompte());
			// Le premier adhérent
			$lAdherent = $lListeAdherent[0];
			
			$lAdhesionService = new AdhesionService();
			// Les adhésions sur le premier adhérent
			$lAdhesions = $lAdhesionService->getAdhesionSurAdherent($lAdherent->getId());
			
			// Positionne les mêmes adhésions
			foreach($lAdhesions as $lAdhesion) {
				if(!is_null($lAdhesion->getAdadId())) {
					$lAdhesionAdherentDetail = $lAdhesionService->getAdhesionAdherent($lAdhesion->getAdadId());
					$lAdhesionAdherent = $lAdhesionAdherentDetail->getAdhesionAdherent();
					
					$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($lAdhesionAdherent->getIdTypeAdhesion());
					
					if($lTypeAdhesion->getIdPerimetre() == 2) { // Si type d'adhésion sur périmètre compte
						$lAdhesionAdherent->setId('');
						$lAdhesionAdherent->setIdAdherent($lIdAdherent);
						$lAdhesionService->setAdhesionAdherent($lAdhesionAdherent);
					}
				}
			}
		}
		
		$pAdherent->setId($lIdAdherent);
		$pAdherent->setNumero('Z' . $lIdAdherent); // Mise à jour du numéro dans l'objet
		AdherentManager::update($pAdherent); // Mise à jour de la base
		
		// Ajout des autorisations de l'adherent
		$lModuleService = new ModuleService();
		$lModulesDefaut = $lModuleService->selectAllDefautVisible();
		
		$lAutorisations = array();
		foreach( $lModulesDefaut as $lModule) {
			$lAutorisation = new AutorisationVO();
			$lAutorisation->setIdAdherent($lIdAdherent);
			$lAutorisation->setIdModule($lModule->getId());
			//AutorisationManager::insert($lAutorisation);
			array_push($lAutorisations,$lAutorisation);
		}
		if(!empty($lAutorisations)) {
			AutorisationManager::insertByArray($lAutorisations);
		}
		//$lAdherent = AdherentManager::select($lIdAdherent);
			
		// Insertion des informations de connexion
		$lMdp = MotDePasseUtils::generer();
		$lIdentification = new IdentificationVO();
		$lIdentification->setIdLogin($lIdAdherent);
		$lIdentification->setLogin($pAdherent->getNumero());
		$lIdentification->setPass( md5( $lMdp ) );
		$lIdentification->setType(1);
		$lIdentification->setAutorise(1);
		IdentificationManager::insert( $lIdentification );
			
		// Ajout à la mailing liste
		$lMailingListeService = new MailingListeService();
		if($pAdherent->getCourrielPrincipal() != "") {
			$lMailingListeService->insert($pAdherent->getCourrielPrincipal());
		}
		if($pAdherent->getCourrielSecondaire() != "") {
			$lMailingListeService->insert($pAdherent->getCourrielSecondaire());
		}
		
		// Envoi du mail de confirmation
		if($pAdherent->getCourrielPrincipal() != "") {
			$lTo = $pAdherent->getCourrielPrincipal();
		} else if($pAdherent->getCourrielSecondaire() != "") {
			$lTo = $pAdherent->getCourrielSecondaire();
		} else { // Pas de mail sur le compte : Envoi au gestionnaire
			$lTo = MAIL_SUPPORT;
		}
		$lFrom  = MAIL_SUPPORT;
		
		$jour  = date("d-m-Y");
		$heure = date("H:i");
		$lSujet = "Votre Compte zeybux";
		
		$lContenu = file_get_contents(CHEMIN_TEMPLATE . MOD_GESTION_ADHERENTS . "/" . "MailAjoutAdherent.html");
		$lContenu = str_replace(array("{LOGIN}", "{MOT_PASSE}"), array($pAdherent->getNumero(), $lMdp), $lContenu);
			
		$lHeaders = file_get_contents(CHEMIN_TEMPLATE . COMMUN_TEMPLATE . "/" . "EnteteMail.html");
		$lHeaders = str_replace("{FROM}", $lFrom, $lHeaders);
			
		$VerifEnvoiMail = TRUE;
		$VerifEnvoiMail = @mail ($lTo, $lSujet, $lContenu, $lHeaders);
		
		if ($VerifEnvoiMail === FALSE) {
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_118_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_118_MSG);
			$lVr->getLog()->addErreur($lErreur);
			$lLogger->log("Erreur d'envoi du mail de création de l'adhérent " . $pAdherent->getNumero() . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
			$lLogger->log($lVr->export(),PEAR_LOG_INFO);	// Maj des logs
					
		} else {
			$lLogger->log("Envoi du mail de création de l'adhérent " . $pAdherent->getNumero() . "par : " . $_SESSION[ID_CONNEXION] . ".",PEAR_LOG_INFO);	// Maj des logs
		}
		
		return $pAdherent;
	}
	
	/**
	 * @name update($pAdherent)
	 * @param AdherentVO
	 * @return AdherentVO
	 * @desc Modifie un adherent
	 */
	private function update($pAdherent) {
		$lAdherentActuel = AdherentManager::select($pAdherent->getId());
		
		// Si pas de liaison création d'un nouveau compte
		if($pAdherent->getIdCompte() == 0) {
			// Création d'un nouveau compte
			$lCompte = new CompteVO();
			$lCompteService = new CompteService();
			$lCompte = $lCompteService->set($lCompte);
			$pAdherent->setIdCompte($lCompte->getId()); // Laision avec l'adhérent
			$lCompte->setIdAdherentPrincipal($pAdherent->getId()); // Positionnement de l'adhérent en adhérent principal du compte
			$lCompteService->set($lCompte);
		} else if($pAdherent->getIdCompte() != $lAdherentActuel->getIdCompte()){ // Liaison avec un autre compte
			$lAdhesionService = new AdhesionService();
			// Suppression des adhésions actuelles
			$lAdhesionService->deleteAdhesionAdherentByIdAdherent($pAdherent->getId());

			// Les adhérents du compte
			$lListeAdherent = $this->selectActifByIdCompte($pAdherent->getIdCompte());
			// Le premier adhérent
			$lAdherent = $lListeAdherent[0];

			// Les adhésions sur le premier adhérent
			$lAdhesions = $lAdhesionService->getAdhesionSurAdherent($lAdherent->getId());
				
			// Positionne les mêmes adhésions si elles existent
			foreach($lAdhesions as $lAdhesion) {
				$lAdhesionAdherentDetail = $lAdhesionService->getAdhesionAdherent($lAdhesion->getAdadId());
				if($lAdhesionAdherentDetail) {
					$lAdhesionAdherent = $lAdhesionAdherentDetail->getAdhesionAdherent();
					
					$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($lAdhesionAdherent->getIdTypeAdhesion());
					
					if($lTypeAdhesion->getIdPerimetre() == 2) { // Si type d'adhésion sur périmètre compte
						$lAdhesionAdherent->setId('');
						$lAdhesionAdherent->setIdAdherent($pAdherent->getId());
						$lAdhesionService->setAdhesionAdherent($lAdhesionAdherent);
					}
				}
			}
		}
				
		// Insertion de la date de mise à jour
		$pAdherent->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
					
		// On reporte le numero dans la maj
		$pAdherent->setNumero($lAdherentActuel->getNumero());
		
		// L'adherent n'est pas supprimé
		$pAdherent->setEtat(1);
		
		// Mise en forme des données
		$pAdherent->setNom(StringUtils::formaterNom(trim($pAdherent->getNom())));
		$pAdherent->setPrenom(StringUtils::formaterPrenom(trim($pAdherent->getPrenom())));
		$pAdherent->setCourrielPrincipal(trim($pAdherent->getCourrielPrincipal()));
		$pAdherent->setCourrielSecondaire(trim($pAdherent->getCourrielSecondaire()));
		$pAdherent->setTelephonePrincipal(trim($pAdherent->getTelephonePrincipal()));
		$pAdherent->setTelephoneSecondaire(trim($pAdherent->getTelephoneSecondaire()));
		$pAdherent->setAdresse(trim($pAdherent->getAdresse()));
		$pAdherent->setCodePostal(trim($pAdherent->getCodePostal()));
		$pAdherent->setVille(StringUtils::formaterVille(trim($pAdherent->getVille())));
		$pAdherent->setCommentaire(trim($pAdherent->getCommentaire()));
		
		// Protection des dates vides
		if($pAdherent->getDateNaissance() == '') {
			$pAdherent->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pAdherent->getDateAdhesion() == '') {
			$pAdherent->setDateAdhesion(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pAdherent->getDateMaj() == '') {
			$pAdherent->setDateMaj(StringUtils::FORMAT_DATE_NULLE);
		}
		
		// Maj de l'adherent dans la BDD
		$lRetour = AdherentManager::update( $pAdherent );
			
		// Récupération des autorisations acutelles
		$lAutorisationsActuelles = AutorisationManager::selectByIdAdherent( $pAdherent->getId() );
		
		$lModuleService = new ModuleService();
		$lModulesDefaut = $lModuleService->selectAllDefautVisible();
		$lIdModuleDefaut = array();
		foreach($lModulesDefaut as $lModule) {
			array_push($lIdModuleDefaut, $lModule->getId());
		}
				
		// Suppression des autorisations
		$lIdSuppAutorisation = array();
		foreach($lAutorisationsActuelles as $lAutorisationActu) {
			// Suppression si ce n'est pas un module par defaut
			if(!in_array($lAutorisationActu->getIdModule(),$lIdModuleDefaut)) {
				$lSupp = true;
				foreach( $pAdherent->getListeModule() as $lIdModule) {
					if($lAutorisationActu->getIdModule() == $lIdModule)	{
						$lSupp = false;
					}
				}
				if($lSupp) {
					array_push($lIdSuppAutorisation,$lAutorisationActu->getId());
				}
			}
		}
		if(!empty($lIdSuppAutorisation)) {
			AutorisationManager::deleteByArray($lIdSuppAutorisation);
		}	
		
		// Ajout des nouvelles autorisations du compte
		$lAutorisations = array();
		foreach( $pAdherent->getListeModule() as $lIdModule) {
			$lAjout = true;
			foreach($lAutorisationsActuelles as $lAutorisationActu) {
				if($lAutorisationActu->getIdModule() == $lIdModule)	{
					$lAjout = false;
				}
			}
		
			if($lAjout) {
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($pAdherent->getId());
				$lAutorisation->setIdModule($lIdModule);
				
				array_push($lAutorisations,$lAutorisation);
			}
		}
		if(!empty($lAutorisations)) {
			AutorisationManager::insertByArray($lAutorisations);
		}
			
		//Mise à jour des inscriptions de mailing liste
		$lMailingListeService = new MailingListeService();
		
		// Suppression des anciens mails
		if($lAdherentActuel->getCourrielPrincipal() != "") {
			$lMailingListeService->delete($lAdherentActuel->getCourrielPrincipal());
		}
		if($lAdherentActuel->getCourrielSecondaire() != "") {
			$lMailingListeService->delete($lAdherentActuel->getCourrielSecondaire());
		}
		
		// Ajout des nouveaux mails
		if($pAdherent->getCourrielPrincipal() != "") {
			$lMailingListeService->insert($pAdherent->getCourrielPrincipal());
		}
		if($pAdherent->getCourrielSecondaire() != "") {
			$lMailingListeService->insert($pAdherent->getCourrielSecondaire());
		}
		return $lRetour;
	}
	
	/**
	 * @name delete($pIdAdherent)
	 * @param integer
	 * @return AdherentVO
	 * @desc Supprime un adherent
	 */
	public function delete($pIdAdherent) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if($lAdherentValid->delete($pIdAdherent)) {
			$lAdherent = AdherentManager::select( $pIdAdherent );
				
			$lCompteService = new CompteService();
			$lNbAdherentSurCompte = $lCompteService->getNombreAdherentSurCompte($lAdherent->getIdCompte());
			
			$lAdhesionService = new AdhesionService();
			// Suppression des adhésions
			$lAdhesionService->deleteAdhesionAdherentByIdAdherent($pIdAdherent);
			
			// Change l'état à supprimé
			$lAdherent->setEtat(2);
			AdherentManager::update( $lAdherent );
			
			// Désactive l'identification
			$lIdentification = IdentificationManager::selectByIdType($lAdherent->getId(),1);
			$lIdentification = $lIdentification[0];
			$lIdentification->setAutorise( 0 );
			IdentificationManager::update( $lIdentification );
						
			//Désinscription de la mailing liste
			$lMailingListeService = new MailingListeService();
			if($lAdherent->getCourrielPrincipal() != "") {
				$lMailingListeService->delete($lAdherent->getCourrielPrincipal());
			}
			if($lAdherent->getCourrielSecondaire() != "") {
				$lMailingListeService->delete($lAdherent->getCourrielSecondaire());
			}
			
			// Si c'est le dernier adhérent du compte : suppression des réservations et abonnements
			if( $lNbAdherentSurCompte < 2 ) {
				// Suppression des réservations en cours
				$lMarcheService = new MarcheService();
				$lReservations = $lMarcheService->getNonAchatParCompte($lAdherent->getIdCompte());
				
				if(!is_null($lReservations[0]->getId())) {
					$lReservationService = new ReservationService();
					foreach($lReservations as $lReservation) {
						$lIdReservation = new IdReservationVO();
						$lIdReservation->setIdCompte($lAdherent->getIdCompte());
						$lIdReservation->setIdCommande($lReservation->getId());
						$lReservationService->delete($lIdReservation);
					}
				}
				
				// Suppression des abonnements
				$lAbonnementService = new AbonnementService();
				$lProduits = $lAbonnementService->getProduitsAbonne($lAdherent->getIdCompte());
				foreach($lProduits as $lProduit) {
					$lAbonnementService->deleteAbonnement($lProduit->getCptAboId());
				}
			}
			
			return true;
		} else {
			return false;
		}
	}
	
	
	/**
	* @name get($pId)
	* @param integer
	* @return AdherentViewVO or array(AdherentViewVO)
	* @desc Retourne un adhérent ou une liste d'adhérent
	*/
	public function get($pId = null, $pIdCompte = null) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if(!is_null($pId)) {
			if($lAdherentValid->delete($pId)) {
				return $this->select($pId);
			} else if($pId == NULL) {
				return $this->selectAll();
			} 
		} else if(!is_null($pIdCompte)) {
			return $this->selectByIdCompte($pIdCompte);
		}
		return false;
		
	}
		
	/**
	 * @name select($pId)
	 * @param integer
	 * @return AdherentViewVO
	 * @desc Retourne un adhérent
	 */
	private function select($pId) {
		return AdherentViewManager::select( $pId );
	}
	
	/**
	 * @name selectAll()
	 * @return AdherentViewVO
	 * @desc Retourne un adhérent
	 */
	private function selectAll() {
		return AdherentViewManager::selectAll();
	}
	
	/**
	 * @name select($pIdCompte)
	 * @param integer
	 * @return AdherentViewVO
	 * @desc Retourne un adhérent
	 */
	public function selectByIdCompte($pIdCompte) {
		return AdherentViewManager::selectByIdCompte( $pIdCompte );
	}	

	/**
	 * @name getAutorisation($pId)
	 * @param integer
	 * @return array(AutorisationVO)
	 * @desc Retourne les autorisations d'un adhérent
	 */
	public function getAutorisation($pId) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if($lAdherentValid->delete($pId)) {
			return AutorisationManager::selectByIdAdherent( $pId );
		}
		return false;
	}
	
	/**
	 * @name getOperationAvenir($pId)
	 * @param integer
	 * @return array(OperationAvenirViewVO)
	 * @desc Retourne les opérations avenir pour un adhérent
	 */
	public function getOperationAvenir($pId) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if($lAdherentValid->delete($pId)) {
			$lAdherent = $this->select($pId);		
			
			$lOperationService = new OperationService();
			return $lOperationService->getOperationAvenir( $lAdherent->getAdhIdCompte() );
		}
		return false;		
	}
	
	/**
	 * @name getOperationPassee($pId)
	 * @param integer
	 * @return array(OperationPasseeViewVO)
	 * @desc Retourne les opérations passées pour un adhérent
	 */
	public function getOperationPassee($pId) {
		$lAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdherentValid();
		if($lAdherentValid->delete($pId)) {
			$lAdherent = $this->select($pId);
				
			$lOperationService = new OperationService();
			return $lOperationService->getOperationPassee( $lAdherent->getAdhIdCompte() );
		}
		return false;
	}
	
	/**
	* @name getAllResumeSolde()
	* @return array(ListeAdherentViewVO)
	* @desc Retourne la liste des adhérents
	*/
	public function getAllResumeSolde() {
		return ListeAdherentViewManager::selectAll();
	}
	
	/**
	 * @name getAllResumeSansSolde()
	 * @return array(ListeAdherentViewVO)
	 * @desc Retourne la liste des adhérents
	 */
	public function getAllResumeSansSolde() {
		return ListeAdherentViewManager::selectAll(true);
	}
	
	/**
	 * @name getAllActif()
	 * @return array(AdherentViewVO)
	 * @desc Retourne la liste des adhérents
	 */
	public function getAllActif() {
		return AdherentViewManager::selectAllActif();
	}
	
	/**
	 * @name estActif($pId)
	 * @return bool
	 * @desc Retourne si l'adherent est actif
	 */
	public function estActif($pId) {
		$lAdherent = $this->get($pId);
		if($lAdherent !== FALSE) {
			return $lAdherent->getAdhEtat() == 1;
		}
		return false;
	}
	
	/**
	 * @name selectActifByIdCompte($pIdCompte)
	 * @return array(AdherentVO)
	 * @desc Retourne la liste des adhérents par compte
	 */
	public function selectActifByIdCompte($pIdCompte) {
		return AdherentManager::selectActifByIdCompte($pIdCompte);
	}
}
?>