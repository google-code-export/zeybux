<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : IdDetailReservationValid.php
//
// Description : Classe IdDetailReservationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "IdDetailReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php" );
//include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );

/**
 * @name IdDetailReservationValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une IdDetailReservationValid
 */
class IdDetailReservationValid extends IdValid 
{
	/**
	* @name estIdDetailReservation($pIdDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estIdDetailReservation($pIdDetailReservation) {
		if(is_object($pIdDetailReservation)) {
			return (get_class($pIdDetailReservation) == "IdDetailReservationVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name estVide($pIdDetailReservation)
	* @return bool
	* @desc Test si le paramètre est bien un IdDetailReservationVO et si il est vide
	*/
	public function estVide($pIdDetailReservation) {
		if($this->format($pIdDetailReservation)) {
			 return ($pIdDetailReservation->getIdStock() == '' || $pIdDetailReservation->getIdDetailOperation() == '');
		} else {
			return NULL;
		}
	}
	
	/**
	* @name format($pIdDetailReservation)
	* @return bool
	* @desc Test le format du paramètre
	*/
	public function format($pIdDetailReservation) {
		if($this->estIdDetailReservation($pIdDetailReservation)) {
			return ( $this->estId($pIdDetailReservation->getIdStock()) && $this->estId($pIdDetailReservation->getIdDetailOperation()) );
		} else {	
			return false;
		}
	}
	
	/**
	* @name estStock($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de débit
	*/
	/*public function estStock($pIdOperation) {
		if($this->estId($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			return ($lOperation->getTypePaiement() == 3 || $lOperation->getTypePaiement() == 9);
		} else {
			return false;
		}
	}
	
	/**
	* @name estDetailOperation($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de crédit
	*/
	/*public function estDetailOperation($pIdOperation) {
		if($this->estId($pIdOperation) && !empty($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			return ($lOperation->getTypePaiement() == 4 || $lOperation->getTypePaiement() == 10);
		} else {
			return false;
		}
	}
	
	/**
	* @name estValide($pIdDetailReservation)
	* @return bool
	* @desc Test si l'id est valide
	*/
	/*public function estValide($pIdDetailReservation) {
		if($this->format($pIdDetailReservation)) {
			return $this->estStock($pIdDetailReservation->getIdStock()) 
			&& $this->estDetailOperation($pIdDetailReservation->getIdDetailOperation());
		} else {
			return NULL;
		}
	}*/
}
?>