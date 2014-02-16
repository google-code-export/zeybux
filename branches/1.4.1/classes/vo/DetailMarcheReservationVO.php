<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/04/2012
// Fichier : DetailMarcheReservationVO.php
//
// Description : Classe DetailMarcheReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "DetailMarcheVO.php");

/**
 * @name DetailMarcheReservationVO
 * @author Julien PIERRE
 * @since 17/04/2012
 * @desc Classe représentant une DetailMarcheReservationVO
 */
class DetailMarcheReservationVO extends DetailMarcheVO
{
	/**
	* @var bool
	* @desc Reservation de la DetailMarcheReservationVO
	*/
	protected $mReservation = false;
	
	/**
	* @name DetailMarcheReservationVO()
	* @desc Le constructeur
	*/
	public function DetailMarcheReservationVO() {
		$this->mReservation = false;
	}
	
	/**
	* @name getReservation()
	* @return bool
	* @desc Renvoie le membre Reservation de la DetailMarcheReservationVO
	*/
	public function getReservation(){
		return $this->mReservation;
	}

	/**
	* @name setReservation($pProduit)
	* @param bool
	* @desc Remplace le membre Reservation de la DetailMarcheReservationVO par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
	}
}
?>