<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : DetailOperationService.php
//
// Description : Classe DetailOperationService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueDetailOperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "DetailOperationValid.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

/**
 * @name DetailOperationService
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe Service d'un DetailOperation
 */
class DetailOperationService
{		
	/**
	* @name set($pDetailOperation)
	* @param DetailOperationVO
	* @return integer
	* @desc Ajoute ou modifie une opération
	*/
	public function set($pDetailOperation) {
		$lDetailOperationValid = new DetailOperationValid();
		if($lDetailOperationValid->insert($pDetailOperation)) {
			return $this->insert($pDetailOperation);			
		} else if($lDetailOperationValid->update($pDetailOperation)) {
			return $this->update($pDetailOperation);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pDetailOperation)
	* @param DetailOperationVO
	* @return integer
	* @desc Ajoute une opération
	*/
	private function insert($pDetailOperation) {
		$pDetailOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
		$pDetailOperation->setIdConnexion($_SESSION[ID_CONNEXION]);
		
		$lId = DetailOperationManager::insert($pDetailOperation); // Ajout de l'opération
		$pDetailOperation->setId($lId);
		$this->insertHistorique($pDetailOperation); // Ajout historique
		
		return $lId;
	}
	
	/**
	* @name update($pDetailOperation)
	* @param DetailOperationVO
	* @return integer
	* @desc Met à jour une opération
	*/
	private function update($pDetailOperation) {
		$pDetailOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
		$pDetailOperation->setIdConnexion($_SESSION[ID_CONNEXION]);
		$this->insertHistorique($pDetailOperation); // Ajout historique		
		return DetailOperationManager::update($pDetailOperation); // update de l'opération
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une opération
	*/
	public function delete($pId) {
		$lDetailOperationValid = new DetailOperationValid();
		if($lDetailOperationValid->delete($pId)){			
			$pDetailOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
			$pDetailOperation->setIdConnexion($_SESSION[ID_CONNEXION]);
		
			$lDetailOperation = $this->get($pId);
			$lDetailOperation->setlibelle("Supression");
			$this->insertHistorique($lDetailOperation); // Ajout historique
			
			return DetailOperationManager::delete($pId); // delete de l'opération		
		} else {
			return false;
		}
	}
	
	/**
	* @name insertHistorique($pDetailOperation)
	* @param DetailOperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la DetailOperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	private function insertHistorique($pDetailOperation) {
		$lHistoriqueDetailOperation = new HistoriqueDetailOperationVO();
		$lHistoriqueDetailOperation->setIdDetailOperation($pDetailOperation->getId());
		$lHistoriqueDetailOperation->setIdOperation($pDetailOperation->getIdOperation());
		$lHistoriqueDetailOperation->setIdCompte($pDetailOperation->getIdCompte());
		$lHistoriqueDetailOperation->setMontant($pDetailOperation->getMontant());
		$lHistoriqueDetailOperation->setLibelle($pDetailOperation->getLibelle());
		$lHistoriqueDetailOperation->setDate($pDetailOperation->getDate());
		$lHistoriqueDetailOperation->setTypePaiement($pDetailOperation->getTypePaiement()	);
		$lHistoriqueDetailOperation->setTypePaiementChampComplementaire($pDetailOperation->getTypePaiementChampComplementaire());
		$lHistoriqueDetailOperation->setIdDetailCommande($pDetailOperation->getIdDetailCommande());
		$lHistoriqueDetailOperation->setIdConnexion($pDetailOperation->getIdConnexion());
		return HistoriqueDetailOperationManager::insert($lHistoriqueDetailOperation);
	}
		
	/**
	* @name get($pId)
	* @param integer
	* @return array(DetailOperationVO) ou DetailOperationVO
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
	* @return DetailOperationVO
	* @desc Retourne une DetailOperation
	*/
	public function select($pId) {
		return DetailOperationManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(DetailOperationVO)
	* @desc Retourne une liste d'DetailOperation
	*/
	public function selectAll() {
		return DetailOperationManager::selectAll();
	}
}
?>