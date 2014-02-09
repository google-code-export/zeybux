<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2013
// Fichier : AdhesionService.php
//
// Description : Classe AdhesionService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/AdhesionValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "/OperationService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/AdhesionManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/TypeAdhesionManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/PerimetreAdhesionManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/AdhesionAdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "/AdherentManager.php");

/**
 * @name AdhesionService
 * @author Julien PIERRE
 * @since 02/11/2013
 * @desc Classe Service d'Adhesion
 */
class AdhesionService
{	
	/**
	 * @name set($pAdhesion)
	 * @param AdhesionDetailVO
	 * @return integer
	 * @desc Ajoute ou modifie une adhésion
	 */
	public function set($pAdhesion) {
		$lAdhesionValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdhesionValid();
		if($lAdhesionValid->insert($pAdhesion)) {
			return $this->insert($pAdhesion);
		} else if($lAdhesionValid->update($pAdhesion)) {
			return $this->update($pAdhesion);
		} else {
			return false;
		}
	}
	
	/**
	 * @name insert($pAdhesion)
	 * @param AdhesionDetailVO
	 * @return integer
	 * @desc Ajoute une adhésion
	 */
	private function insert($pAdhesion) {
		$lIdAdhesion = AdhesionManager::insert($pAdhesion);
		$lListeTypes = array();
		foreach($pAdhesion->getTypes() as $lType) {
			$lType->setIdAdhesion($lIdAdhesion);
			array_push($lListeTypes, $lType);
		}
		TypeAdhesionManager::insert($lListeTypes);
		return $lIdAdhesion;
	}
	
	/**
	 * @name update($pAdhesion)
	 * @param AdhesionDetailVO
	 * @return integer
	 * @desc Met à jour une adhésion
	 */
	private function update($pAdhesion) {
		$lAdhesionActuelle = $this->select($pAdhesion->getId());
		foreach($lAdhesionActuelle->getTypes() as $lTypeActuel) {
			$lMaj = false;
			foreach($pAdhesion->getTypes() as $lType) { // Maj
				if($lType->getId() == $lTypeActuel->getId()) {
					$lTypeActuel->setLabel($lType->getLabel());
					TypeAdhesionManager::update($lTypeActuel);
					$lMaj = true;
				}
			}
			if(!$lMaj) { // Suppression
				$this->deleteTypeAdhesion($lTypeActuel->getId());
			}
		}
		foreach($pAdhesion->getTypes() as $lType) { // Maj
			$lAjout = true;
			foreach($lAdhesionActuelle->getTypes() as $lTypeActuel) {
				if($lType->getId() == $lTypeActuel->getId()) {
					$lAjout = false;
				}
			}
			if($lAjout) {
				$lType->setIdAdhesion($pAdhesion->getId());
				TypeAdhesionManager::insert($lType);
			}
		}
		return AdhesionManager::update($pAdhesion);
	}
	
	/**
	 * @name deleteTypeAdhesion($pIdTypeAdhesion)
	 * @param integer
	 * @desc Supprime un Type adhésion
	 */
	public function deleteTypeAdhesion($pIdTypeAdhesion) {
		$lAdhesionValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdhesionValid();
		if($lAdhesionValid->deleteTypeAdhesion($pIdTypeAdhesion)) {
			$lTypeAdhesion = TypeAdhesionManager::select($pIdTypeAdhesion);
			$lTypeAdhesion->setEtat(1);
			TypeAdhesionManager::update($lTypeAdhesion);

			// Supprime les adhésions adhérent
			AdhesionAdherentManager::deleteByIdTypeAdhesion($pIdTypeAdhesion);
			return true;
		}
		return false;
	}
	
	/**
	 * @name delete($pIdAdhesion)
	 * @param integer
	 * @desc Supprime une adhésion
	 */
	public function delete($pIdAdhesion) {
		$lAdhesionValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdhesionValid();
		if($lAdhesionValid->delete($pIdAdhesion)) {
			$lAdhesion = $this->select($pIdAdhesion);
			$lAdhesion->setEtat(1);
			AdhesionManager::update($lAdhesion);
			
			foreach($lAdhesion->getTypes() as $lType) {
				$this->deleteTypeAdhesion($lType->getId());
			}
			return true;
		}
		return false;
	}
	
	/**
	 * @name get($pId)
	 * @param integer
	 * @return array(AdhesionVO) ou AdhesionDetailVO
	 * @desc Retourne une liste d'adhésion
	 */
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	 * @name select($pIdAdhesion)
	 * @param integer
	 * @return AdhesionDetailVO
	 * @desc Retourne une adhésion
	 */
	private function select($pIdAdhesion) {
		return AdhesionManager::selectDetail($pIdAdhesion);
	}
	
	/**
	 * @name selectAll()
	 * @return array(AdhesionVO)
	 * @desc Retourne la liste des adhésions
	 */
	private function selectAll() {
		return AdhesionManager::recherche(
				array(AdhesionManager::CHAMP_ADHESION_ETAT),
				array('='),
				array(0),
				array(AdhesionManager::CHAMP_ADHESION_DATE_DEBUT),
				array('DESC'));
	}
	
	/**
	 * @name getPerimetre()
	 * @return array(PerimetreAdhesionVO)
	 * @desc Retourne la liste des Périmètres d'adhésion
	 */
	public function getPerimetre() {
		return PerimetreAdhesionManager::recherche(
				array(PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_ETAT),
				array('='),
				array(0),
				array(PerimetreAdhesionManager::CHAMP_PERIMETREADHESION_LABEL),
				array('ASC'));
	}
	
	/**
	 * @name getListeAdherentSurAdhesion($pIdTypeAdhesion)
	 * @return array(AdherentVO)
	 * @desc Retourne la liste des adhérents sur un type d'adhésion
	 */
	public function getListeAdherentSurAdhesion($pIdTypeAdhesion) {
		return AdhesionAdherentManager::selectAdherentSurTypeAdhesion($pIdTypeAdhesion);
	}
	
	/**
	 * @name existeAdherentSurTypeAdhesion($pIdTypeAdhesion)
	 * @return bool
	 * @desc Retourne si il existe des adhérents sur un type d'adhésion
	 */
	public function existeAdherentSurTypeAdhesion($pIdTypeAdhesion) {
		return AdhesionAdherentManager::existeAdherentSurTypeAdhesion($pIdTypeAdhesion);
	}	
	
	/**
	 * @name getTypeAdhesion($pId)
	 * @param integer
	 * @return array(TypeAdhesionAdhesionVO) ou TypeAdhesionAdhesionDetailVO
	 * @desc Retourne une liste de Type adhésion
	 */
	public function getTypeAdhesion($pId = null) {
		if($pId != null) {
			return $this->selectTypeAdhesion($pId);
		} else {
			return $this->selectTypeAdhesionAll();
		}
	}
	
	/**
	 * @name selectTypeAdhesion($pIdAdhesion)
	 * @param integer
	 * @return TypeAdhesionAdhesionDetailVO
	 * @desc Retourne un Type adhésion
	 */
	private function selectTypeAdhesion($pIdAdhesion) {
		return TypeAdhesionManager::select($pIdAdhesion);
	}
	
	/**
	 * @name selectTypeAdhesionAll()
	 * @return array(TypeAdhesionAdhesionVO)
	 * @desc Retourne la liste des Types adhésions
	 */
	private function selectTypeAdhesionAll() {
		return TypeAdhesionManager::recherche(
				array(TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT),
				array('='),
				array(0),
				array(TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL),
				array('ASC'));
	}
	
	
	/**
	 * @name selectNbAdherentHorsAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère le nombre des adhérents actifs qui ne sont pas sur l'adhesion $pIdAdhesion
	 */
	public function selectNbAdherentHorsAdhesion($pIdAdhesion) {
		return AdherentManager::selectNbAdherentHorsAdhesion($pIdAdhesion);
	}
	
	/**
	 * @name selectNbAdherentSurAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère le nombre des adhérents actifs sur l'adhesion $pIdAdhesion
	 */
	public function selectNbAdherentSurAdhesion($pIdAdhesion) {
		return AdherentManager::selectNbAdherentSurAdhesion($pIdAdhesion);
	}
	
	/**
	 * @name selectListeAdherentAdhesion($pIdAdhesion)
	 * @param integer
	 * @desc Récupère la liste des adhérents actifs et leur statut sur l'adhesion $pIdAdhesion
	 */
	public function selectListeAdherentAdhesion($pIdAdhesion) {
		return AdherentManager::selectListeAdherentAdhesion($pIdAdhesion);
	}
	
	/**
	 * @name setAdhesionAdherent($pAdhesionAdherent)
	 * @param AdhesionAdherentDetailVO
	 * @return integer
	 * @desc Ajoute ou modifie une adhésion d'adhérent
	 */
	public function setAdhesionAdherent($pAdhesionAdherent) {
		$lAdhesionAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdhesionAdherentValid();
		if($lAdhesionAdherentValid->insert($pAdhesionAdherent)) {
			return $this->insertAdhesionAdherent($pAdhesionAdherent);
		} else if($lAdhesionAdherentValid->update($pAdhesionAdherent)) {
			return $this->updateAdhesionAdherent($pAdhesionAdherent);
		} else {
			return false;
		}
	}

	/**
	 * @name insertAdhesionAdherent($pAdhesionAdherent)
	 * @param AdhesionAdherentDetailVO
	 * @return integer
	 * @desc Ajoute une adhésion d'adhérent
	 */
	private function insertAdhesionAdherent($pAdhesionAdherent) {		
		
		$lIdAdhesionAdherent = 0;
		$lTypeAdhesion = TypeAdhesionManager::select($pAdhesionAdherent->getAdhesionAdherent()->getIdTypeAdhesion());
		
		// Le Paiement
		$lOperationService = new OperationService();
		$pAdhesionAdherent->getOperation()->setLibelle('Adhésion');
		$pAdhesionAdherent->getOperation()->setIdCompte(-4);
		$pAdhesionAdherent->getOperation()->setMontant($lTypeAdhesion->getMontant());
		$lIdOperation = $lOperationService->set($pAdhesionAdherent->getOperation());
		
		// L'adhésion
		$pAdhesionAdherent->getAdhesionAdherent()->setIdOperation($lIdOperation);
		
		if($lTypeAdhesion->getIdPerimetre() == 1) { // Périmètre Adhérent	
			$lIdAdhesionAdherent = AdhesionAdherentManager::insert($pAdhesionAdherent->getAdhesionAdherent());
		} else if($lTypeAdhesion->getIdPerimetre() == 2) { // Périmètre Compte
			$lAdherentService = new AdherentService();
			// Récupérer les adhérents du compte
			$lAdherent = $lAdherentService->get($pAdhesionAdherent->getAdhesionAdherent()->getIdAdherent());
			$lListeAdherent = $lAdherentService->selectActifByIdCompte($lAdherent->getAdhIdCompte());
			// Positionnement des adhésions
			foreach($lListeAdherent as $lAdh) {
				$pAdhesionAdherent->getAdhesionAdherent()->setIdAdherent($lAdh->getId());
				$lIdAdhesionAdherent = AdhesionAdherentManager::insert($pAdhesionAdherent->getAdhesionAdherent());
			}
		}		

		return $lIdAdhesionAdherent;
	}

	/**
	 * @name updateAdhesionAdherent($pAdhesionAdherent)
	 * @param AdhesionAdherentDetailVO
	 * @return integer
	 * @desc Modifie une adhésion d'adhérent
	 */
	private function updateAdhesionAdherent($pAdhesionAdherent) {
		// L'adhésion
		$lAdhesionAdherent = AdhesionAdherentManager::select($pAdhesionAdherent->getAdhesionAdherent()->getId());
		$lAdhesionAdherent->setStatutFormulaire($pAdhesionAdherent->getAdhesionAdherent()->getStatutFormulaire());
		AdhesionAdherentManager::updateByIdOperation($lAdhesionAdherent);
		
		// Le Paiement
		$lOperationService = new OperationService();
		$lOperation = $lOperationService->getDetail($pAdhesionAdherent->getOperation()->getId());
		$lOperation->setTypePaiement($pAdhesionAdherent->getOperation()->getTypePaiement());
		$lOperation->setChampComplementaire($pAdhesionAdherent->getOperation()->getChampComplementaire());
		
		$lOperationService->set($lOperation);

		return $pAdhesionAdherent->getAdhesionAdherent()->getId();
	}
	
	/**
	 * @name deleteAdhesionAdherent($pIdAdhesionAdherent)
	 * @param integer
	 * @return integer
	 * @desc Supprime une adhésion d'adhérent
	 */
	public function deleteAdhesionAdherent($pIdAdhesionAdherent) {
		$lAdhesionAdherentValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\AdhesionAdherentValid();
		if($lAdhesionAdherentValid->delete($pIdAdhesionAdherent)) {
			$lAdhesionAdherent = AdhesionAdherentManager::select($pIdAdhesionAdherent);
			
			// L'adhésion
			$lOperationService = new OperationService();
			$lOperationService->delete($lAdhesionAdherent->getIdOperation());
		
			// L'adhésion
			AdhesionAdherentManager::deleteByIdOperation($lAdhesionAdherent->getIdOperation());
			
			return $pIdAdhesionAdherent;
		}
		return false;		
	}
	
	/**
	 * @name deleteAdhesionAdherentByIdAdherent($pIdAdherent)
	 * @param integer
	 * @return integer
	 * @desc Supprime les adhésions d'adhérent pour un adhérent
	 */
	private function deleteAdhesionAdherentByIdAdherent($pIdAdherent) {	
		return AdhesionAdherentManager::deleteByIdAdherent($pIdAdherent);
	}
		
	/**
	 * @name getAdhesionAdherent($pIdAdhesionAdherent)
	 * @param integer
	 * @return array(AdhesionAdherentVO) ou AdhesionAdherentDetailVO
	 * @desc Retourne une liste d'adhésion d'adhérent
	 */
	public function getAdhesionAdherent($pIdAdhesionAdherent = null) {
		if($pIdAdhesionAdherent != null) {
			return $this->selectAdhesionAdherent($pIdAdhesionAdherent);
		} else {
			return false;
		}
	}
	
	/**
	 * @name selectAdhesionAdherent($pIdAdhesionAdherent)
	 * @param integer
	 * @return AdhesionAdherentDetailVO
	 * @desc Retourne une adhésion d'adhérent
	 */
	private function selectAdhesionAdherent($pIdAdhesionAdherent) {
		$lAdhesionAdherent = AdhesionAdherentManager::select($pIdAdhesionAdherent);
		$lOperationService = new OperationService();
		$lOperation = $lOperationService->getDetail($lAdhesionAdherent->getIdOperation());
		
		$lTypeAdhesion = $this->getTypeAdhesion($lAdhesionAdherent->getIdTypeAdhesion());
		$lAdhesion = $this->select($lTypeAdhesion->getIdAdhesion());
		return new AdhesionAdherentDetailVO($lAdhesionAdherent, $lOperation, $lAdhesion);
	}
	
	/**
	 * @name getAdhesionSurAdherent($pIdAdherent)
	 * @param integer
	 * @return ListeAdhesionVO
	 * @desc Retourne les adhésion sur un adhérent
	 */
	public function getAdhesionSurAdherent($pIdAdherent) {
		return AdhesionAdherentManager::adhesionSurAdherent($pIdAdherent);
	}
	
	/**
	 * @name getNbAdhesionEnCoursSurAdherent($pIdAdherent)
	 * @param integer
	 * @return integer
	 * @desc Retourne le nombre d'adhésion en cours sur un adhérent
	 */
	public function getNbAdhesionEnCoursSurAdherent($pIdAdherent) {
		return AdhesionAdherentManager::nbAdhesionEnCoursSurAdherent($pIdAdherent);
	}
	
	/**
	 * @name typeAdhesionAdherentExiste($pIdAdherent, $pIdTypeAdhesion)
	 * @return bool
	 * @desc Retourne si il existe une adhésion de l'adhérent sur le type adhésion
	 */
	public function typeAdhesionAdherentExiste($pIdAdherent, $pIdTypeAdhesion) {
		 $lAdhesionAdherent = AdhesionAdherentManager::recherche(
				array(AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT,AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION,AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT),
				array('=','=','='),
				array($pIdAdherent, $pIdTypeAdhesion, 0),
				array(''),
				array(''));
		 return !is_null($lAdhesionAdherent[0]->getId());
	}
}
?>