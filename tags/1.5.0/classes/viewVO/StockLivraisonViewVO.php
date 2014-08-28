<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : StockLivraisonViewVO.php
//
// Description : Classe StockLivraisonViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockLivraisonViewVO
 * @author Julien PIERRE
 * @since 25/01/2011
 * @desc Classe représentant une StockLivraisonViewVO
 */
class StockLivraisonViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la StockLivraisonViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la StockLivraisonViewVO
	*/
	protected $mProIdProducteur;

	/**
	* @var int(11)
	* @desc ProId de la StockLivraisonViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoId de la StockLivraisonViewVO
	*/
	protected $mStoId;

	/**
	* @var int(11)
	* @desc DcomId de la StockLivraisonViewVO
	*/
	protected $mDcomId;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la StockLivraisonViewVO
	*/
	protected $mStoQuantite;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la StockLivraisonViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la StockLivraisonViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la StockLivraisonViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la StockLivraisonViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockLivraisonViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockLivraisonViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la StockLivraisonViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la StockLivraisonViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la StockLivraisonViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la StockLivraisonViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la StockLivraisonViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la StockLivraisonViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

}
?>