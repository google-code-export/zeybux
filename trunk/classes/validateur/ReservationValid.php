<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : ReservationValid.php
//
// Description : Classe ReservationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdReservationValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "DetailReservationValid.php" );

/**
 * @name ReservationValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une ReservationValid
 */
class ReservationValid
{
	/**
	* @name estReservation($pReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estReservation($pReservation) {
		if(is_object($pReservation)) {
			return (get_class($pReservation) == "ReservationVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name detailReservation($pDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function detailReservation($pDetailReservation) {
		return is_array($pDetailReservation);
	}
		
	/**
	* @name insert($pReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pReservation) {
		if($this->estReservation($pReservation)) {
			$lIdReservationValid = new IdReservationValid();
			$lIdValid = $lIdReservationValid->estVide($pReservation->getId());
			if(!is_null($lIdValid) && !$lIdValid) {
				if($this->detailReservation($pReservation->getDetailReservation())) {
					$lDetailValid = true;
					$lDetailReservation = $pReservation->getDetailReservation();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = $lDetailReservationValid->insert($lDetailReservation[$i]);
						$i++;
					}
					return $lDetailValid;				
				}
			}
		}
		return false;
	}
	
	/**
	* @name update($pReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pReservation) {
		if($this->estReservation($pReservation)) {
			$lIdReservationValid = new IdReservationValid();
			$lIdValid = $lIdReservationValid->estVide($pReservation->getId());
			if(!is_null($lIdValid) && !$lIdValid) {
				if($this->detailReservation($pReservation->getDetailReservation())) {
					foreach($pReservation->getDetailReservation() as $lDetail) {
						$lDetailValid = true;
						$lDetailReservationValid = new DetailReservationValid();
						$lDetailValid &= $lDetailReservationValid->update($lDetail) || $lDetailReservationValid->insert($lDetail);
					}
					return $lDetailValid;				
				}
			}
		}
		return false;
	}
	
	/**
	* @name delete($pIdReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pIdReservation) {
		/*$lIdReservationValid = new IdReservationValid();
		$lIdValid = $lIdReservationValid->estValide($pIdReservation);
		if($lIdValid != NULL) {
			return $lIdValid;
		} else {
			return false;
		}*/
		return false;
	}
	
	/**
	* @name select($pIdReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function select($pIdReservation) {		
		$lIdReservationValid = new IdReservationValid();
		$lIdValid = $lIdReservationValid->estVide($pIdReservation);
		if(!is_null($lIdValid) && !$lIdValid) {
			return true;
		}
		return false;
	}
}
?>