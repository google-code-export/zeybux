<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/061/2011
// Fichier : RechargerCompteControleur.php
//
// Description : Classe RechargerCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "ListeAdherentRechargementResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "RechargerCompteValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "RechargementCompteValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "InfoRechargementResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

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
		$lResponse->setListeAdherent(ListeAdherentViewManager::selectAll());
		$lTypePaiement = TypePaiementVisibleViewManager::selectAll();
		$lResponse->setTypePaiement($lTypePaiement);
		
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
			
			$lAdherent = AdherentViewManager::select($pParam['id-adherent']);		
	
			$lResponse->setNumero($lAdherent->getAdhNumero());
			$lResponse->setIdCompte($lAdherent->getAdhIdCompte());
			$lResponse->setCompte($lAdherent->getCptLabel());
			$lResponse->setPrenom($lAdherent->getAdhPrenom());
			$lResponse->setNom($lAdherent->getAdhNom());
			$lResponse->setSolde($lAdherent->getOpeMontant());
			
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
			$lOperation = new OperationVO();
			$lOperation->setIdCompte($pParam['id']);
			$lOperation->setMontant($pParam['montant']);
			$lOperation->setLibelle("Rechargement");
			$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
			$lOperation->setTypePaiement($pParam['typePaiement']);		
			$lOperation->setTypePaiementChampComplementaire($pParam['champComplementaire']);
			$lOperation->setType(1);
			$lOperation->setIdCommande(0);
			OperationManager::insert($lOperation);
			
			$lVr = new TemplateVR();
			return $lVr;
		}				
		return $lVr;
	}
}
?>
