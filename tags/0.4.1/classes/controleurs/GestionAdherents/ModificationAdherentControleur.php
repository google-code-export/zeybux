<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/02/2010
// Fichier : ModificationAdherentControleur.php
//
// Description : Classe ModificationAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
//include_once(CHEMIN_CLASSES_PO . MOD_GESTION_ADHERENTS . "/ModificationAdherentPO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AfficheModificationAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "ModifierAdherentResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "AdherentValid.php" );

/**
 * @name ModificationAdherentControleur
 * @author Julien PIERRE
 * @since 02/02/2010
 * @desc Classe controleur d'une modification d'adherent
 */
class ModificationAdherentControleur
{	
	/**
	* @name getAdherent($pParam)
	* return AfficheModificationAdherentResponse
	* @desc Retourne les informations pour l'adhérent.
	*/
	public function getAdherent($pParam) {
		
		$lIdAdherent = $pParam['id_adherent'];
		
		// Recherche et met à jour les information de l'adherent
		$lAdherent = AdherentViewManager::select( $lIdAdherent );
				
		$lAdh = AdherentManager::select( $lIdAdherent );
		// Réalise le chargement si ce n'est pas un super zeybu 
		if($lAdh->getSuperZeybu() == 0) {
			$lResponse = new AfficheModificationAdherentResponse();
			
			$lResponse->setId($lAdherent->getAdhId());
			$lResponse->setNumero($lAdherent->getAdhNumero());
			$lResponse->setCompte($lAdherent->getCptLabel());
			$lResponse->setNom($lAdherent->getAdhNom());
			$lResponse->setPrenom($lAdherent->getAdhPrenom());
			$lResponse->setCourrielPrincipal($lAdherent->getAdhCourrielPrincipal());
			$lResponse->setCourrielSecondaire($lAdherent->getAdhCourrielSecondaire());
			$lResponse->setTelephonePrincipal($lAdherent->getAdhTelephonePrincipal());
			$lResponse->setTelephoneSecondaire($lAdherent->getAdhTelephoneSecondaire());
			$lResponse->setAdresse($lAdherent->getAdhAdresse());
			$lResponse->setCodePostal($lAdherent->getAdhCodePostal());
			$lResponse->setVille($lAdherent->getAdhVille());
			$lResponse->setDateNaissance($lAdherent->getAdhDateNaissance());
			$lResponse->setDateAdhesion($lAdherent->getAdhDateAdhesion());
			$lResponse->setCommentaire($lAdherent->getAdhCommentaire());
			
			$lResponse->setAutorisations(AutorisationManager::selectByIdAdherent( $lIdAdherent ));
			$lResponse->setModules(ModuleManager::selectAll());
			return $lResponse;
		}
		
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_231_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_231_MSG);
		$lVr->getLog()->addErreur($lErreur);
		$lVr->setValid(false);
		return $lVr;
	}

	/**
	* @name modifierAdherent($pParam)
	* @desc Met à jour les informations de l'adherent ainsi que ses autorisations
	*/
	public function modifierAdherent($pParam) {
		
		$lVr = AdherentValid::validUpdate($pParam);
		if($lVr->getValid()) {		
			$lAdherent = AdherentToVO::convertFromArray($pParam);
			
			// Chargement de l'adherent
			$lAdherentActuel = AdherentManager::select( $lAdherent->getId() );
			if($lAdherentActuel->getSuperZeybu() == 0) {
				$lAdherentCompte = $pParam['compte'];
				$lCompte = CompteManager::selectByLabel($lAdherentCompte);
				
				if(is_null($lCompte[0]->getId())) {
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
					$lOperation->setType(1);
					$lOperation->setIdCommande(0);
					$lOperation->setTypePaiement(-1);				
					OperationManager::insert($lOperation);
					
					$lAdherent->setIdCompte($lIdCompte);
				} else {									
					$lAdherent->setIdCompte($lCompte[0]->getId());
				}
							
				// Insertion de la première mise à jour
				$lAdherent->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
				
				// Crypte le mot de passe si il y a un nouveau
				if($lAdherent->getPass() != '') {
					$lAdherent->setPass( md5( $lAdherent->getPass() ) );
				} else {
					$lAdherent->setPass( $lAdherentActuel->getPass() );
				}			
				
				// On reporte le numero dans la maj
				$lAdherent->setNumero($lAdherentActuel->getNumero());
							
				// L'adherent n'est pas supprimé
				$lAdherent->setEtat(1);
				
				// Ne donne pas les droits de super zeybu
				$lAdherent->setSuperZeybu(0);
				
				// Maj de l'adherent dans la BDD
				AdherentManager::update( $lAdherent );
				
				// Récupération des autorisations acutelles
				$lAutorisationsActuelles = AutorisationManager::selectByIdAdherent( $lAdherent->getId() );
				
				// Suppression des autorisations
				foreach($lAutorisationsActuelles as $lAutorisationActu) {
					$lSupp = true;
					foreach( $lAdherent->getListeModule() as $lIdModule) {
						if($lAutorisationActu->getIdModule() == $lIdModule)	{				
							$lSupp = false;
						}
					}
					if($lSupp) {	
						AutorisationManager::delete($lAutorisationActu->getId());
					}
				}
				
				// Ajout des nouvelles autorisations du compte
				foreach( $lAdherent->getListeModule() as $lIdModule) {
					$lAjout = true;
					foreach($lAutorisationsActuelles as $lAutorisationActu) {
						if($lAutorisationActu->getIdModule() == $lIdModule)	{				
							$lAjout = false;
						}
					}
					
					if($lAjout) {
						$lAutorisation = new AutorisationVO();
						$lAutorisation->setIdAdherent($lAdherent->getId());
						$lAutorisation->setIdModule($lIdModule);
			
						AutorisationManager::insert($lAutorisation);
					}
				}
				
				$lResponse = new ModifierAdherentResponse();
				$lResponse->setNumero($lAdherent->getNumero());
				
				return $lResponse;
			}
				
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_231_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_231_MSG);
			$lVr->getLog()->addErreur($lErreur);
			$lVr->setValid(false);
			return $lVr;		
		}	
		return $lVr;										
	}
}
?>