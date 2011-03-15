<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : StockCommandeViewVO.php
//
// Description : Classe StockCommandeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockCommandeViewVO
 * @author Julien PIERRE
 * @since 09/01/2011
 * @desc Classe représentant une StockCommandeViewVO
 */
class StockCommandeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc StoId de la StockCommandeViewVO
	*/
	protected $mStoId;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la StockCommandeViewVO
	*/
	protected $mProIdProducteur;

	/**
	* @var int(11)
	* @desc DcomId de la StockCommandeViewVO
	*/
	protected $mDcomId;

	/**
	* @var int(11)
	* @desc ProId de la StockCommandeViewVO
	*/
	protected $mProId;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la StockCommandeViewVO
	*/
	protected $mStoQuantite;

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la StockCommandeViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la StockCommandeViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la StockCommandeViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la StockCommandeViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la StockCommandeViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la StockCommandeViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockCommandeViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockCommandeViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la StockCommandeViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la StockCommandeViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

}
?>