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
	* @var int(11)
	* @desc Etat de la ReservationVO
	*/
	protected $mEtat;
	
	/**
	* @var decimal(10,2)
	* @desc Total de la ReservationVO
	*/
	protected $mTotal;
		
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
	* @name getEtat()
	* @return int(11)
	* @desc Renvoie le membre Etat de la ReservationVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param int(11)
	* @desc Remplace le membre Etat de la ReservationVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}
	
	/**
	* @name getTotal()
	* @return decimal(10,2)
	* @desc Renvoie le membre Total de la ReservationVO
	*/
	public function getTotal() {
		return $this->mTotal;
	}

	/**
	* @name setTotal($pTotal)
	* @param decimal(10,2)
	* @desc Remplace le membre Total de la ReservationVO par $pTotal
	*/
	public function setTotal($pTotal) {
		$this->mTotal = $pTotal;
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