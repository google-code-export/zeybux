<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueControleur.php
//
// Description : Classe BanqueControleur
//
//****************************************************************
// Inclusion des classes
/*include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_RECHARGEMENT_COMPTE . "/ListeAdherentRechargementResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_RECHARGEMENT_COMPTE . "/InfoRechargementResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_RECHARGEMENT_COMPTE . "/BanqueValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_RECHARGEMENT_COMPTE . "/RechargementCompteValid.php" );*/
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_PARAMETRAGE . "/BanqueValid.php" );
include_once(CHEMIN_CLASSES_VO . "BanqueVO.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_PARAMETRAGE . "/ListeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_PARAMETRAGE . "/DetailResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_PARAMETRAGE . "/AjoutResponse.php" );

/**
 * @name BanqueControleur
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe controleur de la gestion du paramétrage des banque
 */
class BanqueControleur
{	
	/**
	* @name getListeBanque()
	* @return ListeResponse
	* @desc Recherche la liste des banques actives
	*/
	public function getListeBanque() {
		$lBanqueService = new BanqueService();
		$lResponse = new ListeResponse();
		$lResponse->setListe($lBanqueService->getAllActif());
		return $lResponse;
	}
	
	/**
	 * @name getDetailBanque()
	 * @return DetailResponse
	 * @desc Retourne le détail d'un banque
	 */
	public function getDetailBanque($pBanque) {
		$lVr = BanqueValid::validDelete($pBanque);
		if($lVr->getValid()) {	
			$lBanqueService = new BanqueService();
			$lResponse = new DetailResponse();
			$lResponse->setDetail($lBanqueService->get($pBanque['id']));
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name ajoutBanque($pBanque)
	 * @return AjoutResponse
	 * @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	 */
	public function ajoutBanque($pBanque) {
		$lVr = BanqueValid::validAjout($pBanque);
		if($lVr->getValid()) {
			$lBanque = new BanqueVO();
			$lBanque->setNomCourt($pBanque['nomCourt']);
			$lBanque->setNom($pBanque['nom']);
			$lBanque->setDescription($pBanque['description']);
			
			$lBanqueService = new BanqueService();
			$lId = $lBanqueService->set($lBanque);
			
			$lResponse = new AjoutResponse();
			$lResponse->setId($lId);
			return $lResponse;
		}
		return $lVr;		
	}
	
	/**
	 * @name modifierBanque($pBanque)
	 * @return AjoutResponse
	 * @desc Met à jour une banque
	 */
	public function modifierBanque($pBanque) {
		$lVr = BanqueValid::validUpdate($pBanque);
		if($lVr->getValid()) {
			$lBanque = new BanqueVO();
			$lBanque->setId($pBanque['id']);
			$lBanque->setNomCourt($pBanque['nomCourt']);
			$lBanque->setNom($pBanque['nom']);
			$lBanque->setDescription($pBanque['description']);
				
			$lBanqueService = new BanqueService();
			$lId = $lBanqueService->set($lBanque);
				
			$lResponse = new AjoutResponse();
			$lResponse->setId($lId);
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name supprimerBanque($pBanque)
	 * @return VR
	 * @desc Supprime une banque
	 */
	public function supprimerBanque($pBanque) {
		$lVr = BanqueValid::validDelete($pBanque);
		if($lVr->getValid()) {	
			$lBanqueService = new BanqueService();
			$lBanque = $lBanqueService->delete($pBanque['id']);
		}
		return $lVr;
	}
}
?>