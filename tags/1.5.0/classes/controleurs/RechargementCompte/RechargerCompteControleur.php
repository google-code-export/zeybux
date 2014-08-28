<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/06/2011
// Fichier : RechargerCompteControleur.php
//
// Description : Classe RechargerCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_RECHARGEMENT_COMPTE . "/ListeAdherentRechargementResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_RECHARGEMENT_COMPTE . "/InfoRechargementResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_RECHARGEMENT_COMPTE . "/RechargerCompteValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_RECHARGEMENT_COMPTE . "/RechargementCompteValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationDetailToVO.php" );

/**
 * @name RechargerCompteControleur
 * @author Julien PIERRE
 * @since 12/06/2011
 * @desc Classe controleur du rechargement de compte adhérent
 */
class RechargerCompteControleur
{	
	/**
	* @name getListeAdherent()
	* @return ListeAdherentResponse
	* @desc Recherche la liste des adherents
	*/
	public function getListeAdherent() {		
		// Lancement de la recherche
		$lResponse = new ListeAdherentRechargementResponse();
		$lAdherentService = new AdherentService();
		$lResponse->setListeAdherent($lAdherentService->getAllResumeSolde());
		$lTypePaiementService = new TypePaiementService();
		$lResponse->setTypePaiement($lTypePaiementService->selectVisible());
		
		return $lResponse;
	}
	
	/**
	* @name getInfoRechargement($pParam)
	* @return InfoRechargementResponse
	* @desc Retourne les infos pour le rechargement d'un compte
	*/
	public function getInfoRechargement($pParam) {
		$lVr = RechargerCompteValid::validInfo($pParam);
		if($lVr->getValid()) {
			$lResponse = new InfoRechargementResponse();
			
			$lAdherentService = new AdherentService();
			$lAdherent = $lAdherentService->get($pParam['id']);
	
			$lResponse->setNumero($lAdherent->getAdhNumero());
			$lResponse->setIdCompte($lAdherent->getAdhIdCompte());
			$lResponse->setCompte($lAdherent->getCptLabel());
			$lResponse->setPrenom($lAdherent->getAdhPrenom());
			$lResponse->setNom($lAdherent->getAdhNom());
			$lResponse->setSolde($lAdherent->getCptSolde());
			
			$lBanqueService = new BanqueService();
			$lResponse->setBanques($lBanqueService->getAllActif());
			
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name rechargerCompte($pParam)
	* @return VR
	* @desc Recharge le compte d'un adhérent
	*/
	public function rechargerCompte($pParam) {
		$lVr = RechargementCompteValid::validAjout($pParam);
		if($lVr->getValid()) {			
			$lOperationService = new OperationService();
			$lOperationService->set(OperationDetailToVO::convertFromArray($pParam));
		}				
		return $lVr;
	}
}
?>