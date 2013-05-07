<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : IdVirementValid.php
//
// Description : Classe IdVirementValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "IdVirementVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );

/**
 * @name IdVirementValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une IdVirementValid
 */
class IdVirementValid extends IdValid 
{
	/**
	* @name estIdVirement($pIdVirement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estIdVirement($pIdVirement) {
		if(is_object($pIdVirement)) {
			return (get_class($pIdVirement) == "IdVirementVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name estVide($pIdVirement)
	* @return bool
	* @desc Test si le paramètre est bien un IdVirementVO et si il est vide
	*/
	public function estVide($pIdVirement) {
		if($this->format($pIdVirement)) {
			return ($pIdVirement->getIdDebit() == '' && $pIdVirement->getIdCredit() == '');
		} else {
			return NULL;
		}
	}
	
	/**
	* @name format($pIdVirement)
	* @return bool
	* @desc Test le format du paramètre
	*/
	public function format($pIdVirement) {
		if($this->estIdVirement($pIdVirement)) {
			return ( $this->estId($pIdVirement->getIdDebit()) && $this->estId($pIdVirement->getIdCredit()) );
		} else {	
			return false;
		}
	}
	
	/**
	* @name estDebit($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de débit
	*/
	public function estDebit($pIdOperation) {
		if($this->estId($pIdOperation) && !is_null($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			if(!is_null($lOperation)) {
				return ($lOperation->getTypePaiement() == 3 || $lOperation->getTypePaiement() == 9);
			}
		}
		return false;
	}
	
	/**
	* @name estCredit($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de crédit
	*/
	public function estCredit($pIdOperation) {
		if($this->estId($pIdOperation) && !is_null($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			if(!is_null($lOperation)) {
				return ($lOperation->getTypePaiement() == 4 || $lOperation->getTypePaiement() == 10);
			}
		}
		return false;
	}
	
	/**
	* @name estValide($pIdVirement)
	* @return bool
	* @desc Test si l'id est valide
	*/
	public function estValide($pIdVirement) {
		if($this->format($pIdVirement)) {
			return $this->estDebit($pIdVirement->getIdDebit()) && $this->estCredit($pIdVirement->getIdCredit());
		} else {
			return NULL;
		}
	}
}
?>