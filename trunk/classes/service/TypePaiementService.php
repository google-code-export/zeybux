<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : TypePaiementService.php
//
// Description : Classe TypePaiementService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "TypePaiementValid.php");

/**
 * @name TypePaiementService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un TypePaiement
 */
class TypePaiementService
{		
	/**
	* @name set($pTypePaiement)
	* @param TypePaiementVO
	* @return integer
	* @desc Ajoute ou modifie un TypePaiement
	*/
	/*public function set($pTypePaiement) {
		$lOperationValid = new OperationValid();
		if($lOperationValid->insert($pOperation)) {			
			return $this->insert($pOperation);			
		} else if($lOperationValid->update($pOperation)) {
			return $this->update($pOperation);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Ajoute une opération
	*/
	/*private function insert($pOperation) {		
		$lId = OperationManager::insert($pOperation); // Ajout de l'opération
		$pOperation->setId($lId);
		$this->insertHistorique($pOperation); // Ajout historique
		return $lId;
	}
	
	/**
	* @name update($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Met à jour une opération
	*/
	/*private function update($pOperation) {
		$this->insertHistorique($pOperation); // Ajout historique
		return OperationManager::update($pOperation); // update de l'opération
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une opération
	*/
	/*public function delete($pId) {
		$lOperationValid = new OperationValid();
		if($lOperationValid->delete($pId)){
			$lOperation = $this->get($pId);
			$lOperation->setlibelle("Supression");
			$this->insertHistorique($lOperation); // Ajout historique
			return OperationManager::delete($pId); // delete de l'opération		
		} else {
			return false;
		}
	}

	/**
	* @name existe($pTypePaiement)
	* @param TypePaiementVO ou interger
	* @return bool
	* @desc Vérifie si le typePaiement existe
	*/
	public function existe($pTypePaiement) {
		$lTypePaiementValid = new TypePaiementValid();
		if(	is_object($pTypePaiement) && $lTypePaiementValid->estTypePaiement($pTypePaiement)) {
			$lTypePaiement = $this->get($pTypePaiement);
			if($lTypePaiement->getId() == $pTypePaiement->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_int((int)$pTypePaiement)){
			if($lTypePaiementValid->id($pTypePaiement)) {
				$lTypePaiement = $this->get($pTypePaiement);
				if($lTypePaiement->getId() == $pTypePaiement) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
			
	/**
	* @name get($pTypePaiement)
	* @param integer
	* @return array(TypePaiementVO) ou TypePaiementVO
	* @desc Retourne une liste de virement
	*/
	public function get($pTypePaiement = null) {
		if(!is_null($pTypePaiement)) {
			return $this->select($pTypePaiement);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pTypePaiement)
	* @param integer
	* @return TypePaiementVO
	* @desc Retourne une Operation
	*/
	private function select($pTypePaiement) {
		return TypePaiementManager::select($pTypePaiement);
	}
	
	/**
	* @name selectAll()
	* @return array(TypePaiementVO)
	* @desc Retourne une liste d'Operation
	*/
	private function selectAll() {
		return TypePaiementManager::selectAll();
	}
	
	/**
	* @name selectVisible($pTypePaiement)
	* @return array(TypePaiementDetailVO)
	* @desc Retourne une liste de type de Paiement
	*/
	public function selectVisible($pTypePaiement = null) {
		return TypePaiementManager::selectDetail($pTypePaiement, 1);
	}
	
	/**
	 * @name selectDetail($pTypePaiement)
	 * @return array(TypePaiementDetailVO)
	 * @desc Retourne une liste de type de Paiement
	 */
	public function selectDetail($pTypePaiement = null) {
		return TypePaiementManager::selectDetail($pTypePaiement);
	}
}
?>