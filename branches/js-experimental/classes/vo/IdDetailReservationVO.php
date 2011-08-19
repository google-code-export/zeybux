<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : IdDetailReservationVO.php
//
// Description : Classe IdDetailReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdDetailReservationVO
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une IdDetailReservationVO
 */
class IdDetailReservationVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdStock de la IdDetailReservationVO
	*/
	protected $mIdStock;
	
	/**
	* @var int(11)
	* @desc IdDetailOperation de la IdDetailReservationVO
	*/
	protected $mIdDetailOperation;

	/**
	* @name getIdStock()
	* @return int(11)
	* @desc Renvoie le membre IdStock de la IdDetailReservationVO
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param int(11)
	* @desc Remplace le membre IdStock de la IdDetailReservationVO par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}
	
	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la IdDetailReservationVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la IdDetailReservationVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}
}
?>