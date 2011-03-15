<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : StockProduitViewVO.php
//
// Description : Classe StockProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitViewVO
 * @author Julien PIERRE
 * @since 18/09/2010
 * @desc Classe représentant une StockProduitViewVO
 */
class StockProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProId de la StockProduitViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc ProIdCommande de la StockProduitViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdNomProduit de la StockProduitViewVO
	*/
	protected $mProIdNomProduit;

	/**
	* @var decimal(32,2)
	* @desc StoQuantite de la StockProduitViewVO
	*/
	protected $mStoQuantite;

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockProduitViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockProduitViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la StockProduitViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la StockProduitViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProIdNomProduit de la StockProduitViewVO
	*/
	public function getProIdNomProduit() {
		return $this->mProIdNomProduit;
	}

	/**
	* @name setProIdNomProduit($pProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProIdNomProduit de la StockProduitViewVO par $pProIdNomProduit
	*/
	public function setProIdNomProduit($pProIdNomProduit) {
		$this->mProIdNomProduit = $pProIdNomProduit;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(32,2)
	* @desc Renvoie le membre StoQuantite de la StockProduitViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(32,2)
	* @desc Remplace le membre StoQuantite de la StockProduitViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
}
?>