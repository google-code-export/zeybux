<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : AchatValid.php
//
// Description : Classe AchatValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdAchatValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "DetailReservationValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name AchatValid
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une AchatValid
 */
class AchatValid
{
	/**
	* @name estAchat($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estAchat($pAchat) {
		if(is_object($pAchat)) {
			return (get_class($pAchat) == "AchatVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name detailAchat($pDetailAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function detailAchat($pDetailAchat) {
		return is_array($pDetailAchat);
	}
	
	/**
	* @name detailAchatSolidaire($pDetailAchatSolidaire)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function detailAchatSolidaire($pDetailAchatSolidaire) {
		return is_array($pDetailAchatSolidaire);
	}
		
	/**
	* @name insert($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estAjout($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = $lDetailReservationValid->insert($lDetailReservation[$i]);
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
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
	* @name updateReservation($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function updateReservation($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estReservation($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}					
					return $lDetailValid;				
				}
			}
		}
		return false;
	}
	
	/**
	* @name updateReservation($pAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function updateAchat($pAchat) {
		if($this->estAchat($pAchat)) {
			$lIdAchatValid = new IdAchatValid();
			$lIdValid = $lIdAchatValid->estAchat($pAchat->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				if($this->detailAchat($pAchat->getDetailAchat())
					&& $this->detailAchatSolidaire($pAchat->getDetailAchatSolidaire())) {
					$lDetailValid = true;
					$lDetailReservation = $pAchat->getDetailAchat();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
					}
					
					$lDetailReservation = $pAchat->getDetailAchatSolidaire();
					$i = 0;
					$lDetailReservationValid = new DetailReservationValid();
					while($lDetailValid && isset($lDetailReservation[$i])) {
						$lDetailValid = ( $lDetailReservationValid->update($lDetailReservation[$i]) || $lDetailReservationValid->insert($lDetailReservation[$i]) );
						$i++;
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
	* @name select($pIdAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function select($pIdAchat) {	
		$lIdValid = new IdValid();
		if(!empty($pIdAchat)){
			$lIdAchatValid = new IdAchatValid();
			return $lIdAchatValid->estSelect($pIdAchat);
		}
		return false;
	}
	
	/**
	* @name selectAll($pIdAchat)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function selectAll($pIdAchat) {
		if(!empty($pIdAchat)){
			$lIdAchatValid = new IdAchatValid();
			return $lIdAchatValid->estAjout($pIdAchat);
		}
		return false;
	}
	
}
?>