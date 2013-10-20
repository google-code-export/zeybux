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
/*include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
//include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AfficheModificationAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/ModifierAdherentResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");*/



include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/CompteValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ModuleService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/InfoCompteAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/CompteResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );


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
		$lVr = AdherentValid::validAffiche($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam['id'];
			$lAdherentService = new AdherentService();
			
			$lResponse = new InfoCompteAdherentResponse();	
			$lAdherent = $lAdherentService->get($lIdAdherent);
			$lResponse->setAdherent($lAdherent);
			$lResponse->setAutorisations( $lAdherentService->getAutorisation($lIdAdherent) );
			
			$lModuleService = new ModuleService();
			$lResponse->setModules( $lModuleService->selectAllNonDefautVisible());

			$lCompteService = new CompteService();
			$lResponse->setAdherentCompte($lCompteService->getAdherentCompte($lAdherent->getAdhIdCompte()));
	
			return $lResponse;
		}
		return $lVr;
	}

	/**
	* @name modifierAdherent($pParam)
	* @desc Met à jour les informations de l'adherent ainsi que ses autorisations
	*/
	public function modifierAdherent($pParam) {		
		$lVr = AdherentValid::validUpdate($pParam);
		if($lVr->getValid()) {		
			// Conversion en objet
			$lAdherent = AdherentToVO::convertFromArray($pParam);
			
			// Maj de l'adhérent
			$lAdherentService = new AdherentService();
			$lAdherentService->set($lAdherent);
			
			$lIdNouveauCompte = $lAdherent->getIdcompte();
			$lIdAncienCompte = $lVr->getData()['adherent']->getAdhIdCompte();
			
			// Gestion du compte
			$lCompteService = new CompteService();
			if($lIdAncienCompte != $lIdNouveauCompte) { // Liaison avec un autre compte gestion du précédent compte
				$lAdherentAncienCompte = $lCompteService->getAdherentCompte($lIdAncienCompte);
				
				// RAZ de l'adhérent principal
				$lIdAdherentPrincipalAncienCompte = 0;
				// Ou positionnement du nouvel
				if(!is_null($lAdherentAncienCompte[0]->getId()) && $pParam['idAncienAdherentPrincipal'] != -1) {
					$lIdAdherentPrincipalAncienCompte = $pParam['idAncienAdherentPrincipal'];
				}
				// Maj de l'ancien compte
				$lAncienCompte = $lCompteService->get($lIdAncienCompte);
				$lAncienCompte->setIdAdherentPrincipal($lIdAdherentPrincipalAncienCompte);
				
				$lCompteService->set($lAncienCompte);
			}
			
			// Mise à jour du compte
			$lNouveauCompte = $lCompteService->get($lIdNouveauCompte);
			$lNouveauCompte->setIdAdherentPrincipal($pParam['idAdherentPrincipal']);
			$lCompteService->set($lNouveauCompte);
			
			
			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lAdherent->getId());
			return $lResponse;
		}	
		return $lVr;										
	}
	
	/**
	 * @name getDetailCompte($pParam)
	 * @desc Retourne les informations sur un compte
	 */
	public function getDetailCompte($pParam) {
		$lVr = NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_GESTION_ADHERENTS\CompteValid::validExiste($pParam);
		if($lVr->getValid()) {
			$lResponse = new CompteResponse();
			$lCompteService = new CompteService();
			$lResponse->setCompte($lCompteService->get($pParam['id']));
			$lResponse->setAdherentCompte($lCompteService->getAdherentCompte($pParam['id']));
			return $lResponse;
		}	
		return $lVr;	
	}
}
?>
