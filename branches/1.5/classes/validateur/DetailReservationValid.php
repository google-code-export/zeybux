<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : DetailReservationValid.php
//
// Description : Classe DetailReservationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "DetailReservationVO.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdDetailReservationValid.php" );
//include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "MontantValid.php" );

/**
 * @name DetailReservationValid
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une DetailReservationValid
 */
class DetailReservationValid
{
	/**
	* @name estDetailReservation($pDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estDetailReservation($pDetailReservation) {
		if(is_object($pDetailReservation)) {
			return (get_class($pDetailReservation) == "DetailReservationVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name idDetailCommande($pIdDetailCommande)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function idDetailCommande($pIdDetailCommande) {
		$lIdValid = new IdValid();
		if(!empty($pIdDetailCommande)){
			return $lIdValid->estId($pIdDetailCommande);
		} else {
			return false;
		}
	}
	
	/**
	* @name montant($pMontant)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function montant($pMontant) {
		$lMontantValid = new MontantValid();
		return $lMontantValid->valeur($pMontant);
	}
	
	/**
	* @name quantite($pQuantite)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function quantite($pQuantite) {
		$lQuantiteValid = new MontantValid();
		return $lQuantiteValid->valeur($pQuantite);
	}
	
	/**
	* @name insert($pDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pDetailReservation) {
		if($this->estDetailReservation($pDetailReservation)) {
			$lIdDetailReservationValid = new IdDetailReservationValid();
			$lIdValid = $lIdDetailReservationValid->estVide($pDetailReservation->getId());
			if(!is_null($lIdValid) && $lIdValid) {
				$lIdDetailCommande = $pDetailReservation->getIdDetailCommande();
				return $this->idDetailCommande($lIdDetailCommande)
				&& !empty($lIdDetailCommande)
				&& $this->montant($pDetailReservation->getMontant())
				&& $this->quantite($pDetailReservation->getQuantite());
			}
		}
		return false;
	}
	
	/**
	* @name update($pDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pDetailReservation) {
		if($this->estDetailReservation($pDetailReservation)) {
			$lIdDetailReservationValid = new IdDetailReservationValid();
			$lIdValid = $lIdDetailReservationValid->estVide($pDetailReservation->getId());
			if(!is_null($lIdValid) && !$lIdValid) {
				$lIdDetailCommande = $pDetailReservation->getIdDetailCommande();
				return $this->idDetailCommande($lIdDetailCommande)
				&& $this->montant($pDetailReservation->getMontant())
				&& $this->quantite($pDetailReservation->getQuantite());
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name delete($pIdDetailReservation)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pIdDetailReservation) {
		/*$lIdDetailReservationValid = new IdDetailReservationValid();
		$lIdValid = $lIdDetailReservationValid->estValide($pIdDetailReservation);
		if($lIdValid != NULL) {
			return $lIdValid;
		} else {
			return false;
		}*/
		return false;
	}
}
?>