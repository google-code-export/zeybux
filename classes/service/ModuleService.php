<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/01/2013
// Fichier : ModuleService.php
//
// Description : Classe ModuleService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");

/**
 * @name ModuleService
 * @author Julien PIERRE
 * @since 05/01/2013
 * @desc Classe Service d'un Module
 */
class ModuleService
{	
	/**
	* @name set($pCompte)
	* @param CompteVO
	* @return integer
	* @desc Ajoute ou modifie un compte
	*/
/*	public function set($pCompte) {
		$lCompteValid = new CompteValid();
		if($lCompteValid->insert($pCompte)) {
			return $this->insert($pCompte);			
		} else if($lCompteValid->update($pCompte)) {
			return $this->update($pCompte);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pCompte)
	* @param CompteVO
	* @return CompteVO
	* @desc Ajoute un compte
	*/
/*	private function insert($pCompte) {		
		$lId = CompteManager::insert($pCompte);
		// Le label est l'id du compte par défaut
		$pCompte->setId($lId);
		$pCompte->setLabel('C' . $lId);
		$this->update($pCompte);
		
		// Initialisation du compte
		$lOperation = new OperationVO();
		$lOperation->setIdCompte($lId);
		$lOperation->setMontant(0);
		$lOperation->setLibelle("Création du compte");
		$lOperation->setDate(StringUtils::dateAujourdhuiDb());
		$lOperation->setIdCommande(0);
		$lOperation->setTypePaiement(-1);
		
		$lOperationService = new OperationService();
		$lTest = $lOperationService->set($lOperation);
		
		return $pCompte;
	}
	
	/**
	* @name update($pCompte)
	* @param CompteVO
	* @return integer
	* @desc Met à jour un compte
	*/
/*	private function update($pCompte) {		
		return CompteManager::update($pCompte);
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime un compte
	*/
/*	public function delete($pId) {
		$lOperationValid = new OperationValid();
		if($lOperationValid->delete($pId)){			
			return CompteManager::delete($pId); // delete le compte	
		} else {
			return false;
		}
	}
	
	/**
	* @name existe($pCompte)
	* @param CompteVO ou String
	* @return bool
	* @desc Vérifie si le compte existe
	*/
/*	public function existe($pCompte) {
		if(	is_object($pCompte) && CompteValid::estCompte($pCompte)) {
			$lCompte = $this->get($pCompte);
			if($lCompte->getId() == $pCompte->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_int((int)$pCompte)) {
			$lCompte = $this->get((int)$pCompte);
			if($lCompte->getId() == $pCompte) {
				return true;
			} else {
				return false;
			}
		} else if(is_string($pCompte)){
			$lCompte = $this->get($pCompte);
			if($lCompte->getLabel() == $pCompte) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(ModuleVO) ou ModuleVO
	* @desc Retourne une liste de Module
	*/
	public function get($pId = null) {
		if($pId != null) {
			if(is_int((int)$pId)) {
				return $this->select($pId);
			} 
				return false;
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return ModuleVO
	* @desc Retourne un module
	*/
	private function select($pId) {
		return ModuleManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(ModuleVO)
	* @desc Retourne une liste de module
	*/
	private function selectAll() {
		return ModuleManager::selectAll();
	}
	
	/**
	 * @name selectAllVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules visible
	 */
	public function selectAllVisible() {
		return ModuleManager::selectAllVisible();
	}
	
	/**
	 * @name selectAllDefautVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules par defaut et visible
	 */
	public function selectAllDefautVisible() {
		return ModuleManager::selectAllDefautVisible();
	}
	
	/**
	 * @name selectAllNonDefautVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules par defaut et visible
	 */
	public function selectAllNonDefautVisible() {
		return ModuleManager::selectAllNonDefautVisible();
	}
}
?>