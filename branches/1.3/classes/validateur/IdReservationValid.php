<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : IdReservationValid.php
//
// Description : Classe IdReservationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php" );
//include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );

/**
 * @name IdReservationValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une IdReservationValid
 */
class IdReservationValid extends IdValid 
{
	/**
	* @name estIdReservation($pIdReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estIdReservation($pIdReservation) {
		if(is_object($pIdReservation)) {
			return (get_class($pIdReservation) == "IdReservationVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name estVide($pIdReservation)
	* @return bool
	* @desc Test si le paramètre est bien un IdReservationVO et si il est vide
	*/
	public function estVide($pIdReservation) {
		if($this->format($pIdReservation)) {
			 return ($pIdReservation->getIdCompte() == '' || $pIdReservation->getIdCommande() == '');
		} else {
			return NULL;
		}
	}
	
	/**
	* @name format($pIdReservation)
	* @return bool
	* @desc Test le format du paramètre
	*/
	public function format($pIdReservation) {
		if($this->estIdReservation($pIdReservation)) {
			return ( $this->estId($pIdReservation->getIdCompte()) && $this->estId($pIdReservation->getIdCommande()) );
		} else {	
			return false;
		}
	}
	
	/**
	* @name estCompte($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de débit
	*/
	/*public function estCompte($pIdOperation) {
		if($this->estId($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			return ($lOperation->getTypePaiement() == 3 || $lOperation->getTypePaiement() == 9);
		} else {
			return false;
		}
	}
	
	/**
	* @name estCommande($pIdOperation)
	* @return bool
	* @desc Test si le paramètre est un id d'une opération de crédit
	*/
	/*public function estCommande($pIdOperation) {
		if($this->estId($pIdOperation) && !empty($pIdOperation)) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pIdOperation);
			return ($lOperation->getTypePaiement() == 4 || $lOperation->getTypePaiement() == 10);
		} else {
			return false;
		}
	}
	
	/**
	* @name estValide($pIdReservation)
	* @return bool
	* @desc Test si l'id est valide
	*/
	/*public function estValide($pIdReservation) {
		if($this->format($pIdReservation)) {
			return $this->estCompte($pIdReservation->getIdCompte()) 
			&& $this->estCommande($pIdReservation->getIdCommande());
		} else {
			return NULL;
		}
	}*/
}
?>