<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : OperationService.php
//
// Description : Classe OperationService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueOperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "OperationValid.php");

/**
 * @name OperationService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un Operation
 */
class OperationService
{		
	/**
	* @name set($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Ajoute ou modifie une opération
	*/
	public function set($pOperation) {
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
	private function insert($pOperation) {		
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
	private function update($pOperation) {
		$this->insertHistorique($pOperation); // Ajout historique
		return OperationManager::update($pOperation); // update de l'opération
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une opération
	*/
	public function delete($pId) {
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
	* @name insertHistorique($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la OperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	private function insertHistorique($pOperation) {
		$lHistoriqueOperation = new HistoriqueOperationVO();
		$lHistoriqueOperation->setIdOperation($pOperation->getId());
		$lHistoriqueOperation->setIdCompte($pOperation->getIdCompte());
		$lHistoriqueOperation->setMontant($pOperation->getMontant());
		$lHistoriqueOperation->setLibelle($pOperation->getLibelle());
		$lHistoriqueOperation->setDate($pOperation->getDate());
		$lHistoriqueOperation->setTypePaiement($pOperation->getTypePaiement()	);
		$lHistoriqueOperation->setTypePaiementChampComplementaire($pOperation->getTypePaiementChampComplementaire());
		$lHistoriqueOperation->setType($pOperation->getType());
		$lHistoriqueOperation->setIdCommande($pOperation->getIdCommande());
		$lHistoriqueOperation->setIdConnexion($_SESSION[ID_CONNEXION]);
		return HistoriqueOperationManager::insert($lHistoriqueOperation);
	}
		
	/**
	* @name get($pId)
	* @param integer
	* @return array(OperationVO) ou OperationVO
	* @desc Retourne une liste de virement
	*/
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return OperationVO
	* @desc Retourne une Operation
	*/
	public function select($pId) {
		return OperationManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(OperationVO)
	* @desc Retourne une liste d'Operation
	*/
	public function selectAll() {
		return OperationManager::selectAll();
	}
}
?>