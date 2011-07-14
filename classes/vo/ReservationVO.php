<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : ReservationVO.php
//
// Description : Classe ReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
include_once(CHEMIN_CLASSES_VO . "DetailReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");

/**
 * @name ReservationVO
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une ReservationVO
 */
class ReservationVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ReservationVO
	*/
	protected $mId;
	
	/**
	* @var array(DetailReservationVO)
	* @desc Produits de la ReservationVO
	*/
	protected $mDetailReservation;
		
	/**
	* @name ReservationVO()
	* @desc Le constructeur
	*/
	public function ReservationVO() {
		$this->mId = new IdReservationVO();
		$this->mDetailReservation = array();
	}
	
	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ReservationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ReservationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	* @name getDetailReservation()
	* @return array(DetailReservationVO)
	* @desc Renvoie le membre DetailReservation de la ReservationVO
	*/
	public function getDetailReservation(){
		return $this->mDetailReservation;
	}

	/**
	* @name setDetailReservation($pProduit)
	* @param array(DetailReservationVO)
	* @desc Remplace le membre DetailReservation de la ReservationVO par $pDetailReservation
	*/
	public function setDetailReservation($pDetailReservation) {
		$this->mDetailReservation = $pDetailReservation;
	}
	
	/**
	* @name addDetailReservation($pProduit)
	* @return DetailReservationVO
	* @desc Ajoute $pProduit à DetailReservation
	*/
	public function addDetailReservation($pProduit){
		array_push($this->mDetailReservation,$pProduit);
	}
}
?>