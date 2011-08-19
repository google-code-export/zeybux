<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : TypePaiementVisibleViewVO.php
//
// Description : Classe TypePaiementVisibleViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TypePaiementVisibleViewVO
 * @author Julien PIERRE
 * @since 25/01/2011
 * @desc Classe représentant une TypePaiementVisibleViewVO
 */
class TypePaiementVisibleViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc TppId de la TypePaiementVisibleViewVO
	*/
	protected $mTppId;

	/**
	* @var varchar(100)
	* @desc TppType de la TypePaiementVisibleViewVO
	*/
	protected $mTppType;

	/**
	* @var tinyint(4)
	* @desc TppChampComplementaire de la TypePaiementVisibleViewVO
	*/
	protected $mTppChampComplementaire;

	/**
	* @var varchar(30)
	* @desc TppLabelChampComplementaire de la TypePaiementVisibleViewVO
	*/
	protected $mTppLabelChampComplementaire;

	/**
	* @var tinyint(1)
	* @desc TppVisible de la TypePaiementVisibleViewVO
	*/
	protected $mTppVisible;

	/**
	* @name getTppId()
	* @return int(11)
	* @desc Renvoie le membre TppId de la TypePaiementVisibleViewVO
	*/
	public function getTppId() {
		return $this->mTppId;
	}

	/**
	* @name setTppId($pTppId)
	* @param int(11)
	* @desc Remplace le membre TppId de la TypePaiementVisibleViewVO par $pTppId
	*/
	public function setTppId($pTppId) {
		$this->mTppId = $pTppId;
	}

	/**
	* @name getTppType()
	* @return varchar(100)
	* @desc Renvoie le membre TppType de la TypePaiementVisibleViewVO
	*/
	public function getTppType() {
		return $this->mTppType;
	}

	/**
	* @name setTppType($pTppType)
	* @param varchar(100)
	* @desc Remplace le membre TppType de la TypePaiementVisibleViewVO par $pTppType
	*/
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}

	/**
	* @name getTppChampComplementaire()
	* @return tinyint(4)
	* @desc Renvoie le membre TppChampComplementaire de la TypePaiementVisibleViewVO
	*/
	public function getTppChampComplementaire() {
		return $this->mTppChampComplementaire;
	}

	/**
	* @name setTppChampComplementaire($pTppChampComplementaire)
	* @param tinyint(4)
	* @desc Remplace le membre TppChampComplementaire de la TypePaiementVisibleViewVO par $pTppChampComplementaire
	*/
	public function setTppChampComplementaire($pTppChampComplementaire) {
		$this->mTppChampComplementaire = $pTppChampComplementaire;
	}

	/**
	* @name getTppLabelChampComplementaire()
	* @return varchar(30)
	* @desc Renvoie le membre TppLabelChampComplementaire de la TypePaiementVisibleViewVO
	*/
	public function getTppLabelChampComplementaire() {
		return $this->mTppLabelChampComplementaire;
	}

	/**
	* @name setTppLabelChampComplementaire($pTppLabelChampComplementaire)
	* @param varchar(30)
	* @desc Remplace le membre TppLabelChampComplementaire de la TypePaiementVisibleViewVO par $pTppLabelChampComplementaire
	*/
	public function setTppLabelChampComplementaire($pTppLabelChampComplementaire) {
		$this->mTppLabelChampComplementaire = $pTppLabelChampComplementaire;
	}

	/**
	* @name getTppVisible()
	* @return tinyint(1)
	* @desc Renvoie le membre TppVisible de la TypePaiementVisibleViewVO
	*/
	public function getTppVisible() {
		return $this->mTppVisible;
	}

	/**
	* @name setTppVisible($pTppVisible)
	* @param tinyint(1)
	* @desc Remplace le membre TppVisible de la TypePaiementVisibleViewVO par $pTppVisible
	*/
	public function setTppVisible($pTppVisible) {
		$this->mTppVisible = $pTppVisible;
	}

}
?>