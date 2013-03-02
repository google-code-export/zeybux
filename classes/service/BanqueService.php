<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueService.php
//
// Description : Classe BanqueService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "BanqueManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/BanqueValid.php" );
/*include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );*/

/**
 * @name BanqueService
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe Service d'une Banque
 */
class BanqueService
{	
	/**
	* @name set($pBanque)
	* @param BanqueVO
	* @return integer
	* @desc Ajoute ou modifie un Banque
	*/
	public function set($pBanque) {
		$lBanqueValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\BanqueValid();
		if($lBanqueValid->insert($pBanque)) {
			return $this->insert($pBanque);			
		} else if($lBanqueValid->update($pBanque)) {
			return $this->update($pBanque);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pBanque)
	* @param BanqueVO
	* @return BanqueVO
	* @desc Ajoute une Banque
	*/
	private function insert($pBanque) {
		$pBanque->setEtat(0);
		return BanqueManager::insert($pBanque);
	}
	
	/**
	* @name update($pBanque)
	* @param BanqueVO
	* @return integer
	* @desc Met à jour une Banque
	*/
	private function update($pBanque) {		
		return BanqueManager::update($pBanque);
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime une Banque
	*/
	public function delete($pId) {
		$lBanqueValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\BanqueValid();
		if($lBanqueValid->delete($pId)) {
			$lBanque = $this->get($pId);
			$lBanque->setEtat(1);
			return $this->set($lBanque); // delete la Banque	
		} else {
			return false;
		}
	}
	
	/**
	* @name existe($pBanque)
	* @param BanqueVO ou String
	* @return bool
	* @desc Vérifie si la Banque existe
	*/
	public function existe($pBanque) {
		$lBanqueValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\BanqueValid();
		if(	is_object($pBanque) && BanqueValid::estBanque($pBanque)) {
			$lBanque = $this->get($pBanque);
			if($lBanque->getId() == $pBanque->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_int((int)$pBanque)) {
			$lBanque = $this->get((int)$pBanque);
			if($lBanque->getId() == $pBanque) {
				return true;
			} else {
				return false;
			}
		} /*else if(is_string($pBanque)){
			$lBanque = $this->get($pBanque);
			if($lBanque->getNom() == $pBanque) {
				return true;
			} else {
				return false;
			}
		} */else {
			return false;
		}
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(BanqueVO) ou BanqueVO
	* @desc Retourne une liste de Banque
	*/
	public function get($pId = null) {		
		$lBanqueValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\BanqueValid();
		if($lBanqueValid->delete($pId)) {
			return $this->select($pId);
		} else if($pId == NULL) {
			return $this->selectAll();
		} else {
			return false;
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return BanqueVO
	* @desc Retourne une Banque
	*/
	private function select($pId) {
		return BanqueManager::select($pId);
	}
		
	/**
	* @name selectAll()
	* @return array(BanqueVO)
	* @desc Retourne une liste de Banque
	*/
	private function selectAll() {
		return BanqueManager::selectAll();
	}
	
	/**
	 * @name getAllActif()
	 * @param string
	 * @return BanqueVO
	 * @desc Retourne un liste de Banque active
	 */
	public function getAllActif() {
		return BanqueManager::recherche(
			array(BanqueManager::CHAMP_BANQUE_ETAT),
			array('='),
			array(0),
			array(BanqueManager::CHAMP_BANQUE_NOM),
			array('ASC'));
	}
}
?>