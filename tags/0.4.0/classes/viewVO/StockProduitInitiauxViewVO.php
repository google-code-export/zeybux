<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/11/2010
// Fichier : StockProduitInitiauxViewVO.php
//
// Description : Classe StockProduitInitiauxViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitInitiauxViewVO
 * @author Julien PIERRE
 * @since 26/11/2010
 * @desc Classe représentant une StockProduitInitiauxViewVO
 */
class StockProduitInitiauxViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc Id de la StockProduitInitiauxViewVO
	*/
	protected $mId;

	/**
	* @var datetime
	* @desc Date de la StockProduitInitiauxViewVO
	*/
	protected $mDate;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la StockProduitInitiauxViewVO
	*/
	protected $mQuantite;

	/**
	* @var tinyint(1)
	* @desc Type de la StockProduitInitiauxViewVO
	*/
	protected $mType;

	/**
	* @var int(11)
	* @desc IdCommande de la StockProduitInitiauxViewVO
	*/
	protected $mIdCommande;

	/**
	* @var int(11)
	* @desc IdProduit de la StockProduitInitiauxViewVO
	*/
	protected $mIdProduit;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la StockProduitInitiauxViewVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la StockProduitInitiauxViewVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la StockProduitInitiauxViewVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la StockProduitInitiauxViewVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la StockProduitInitiauxViewVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la StockProduitInitiauxViewVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getType()
	* @return tinyint(1)
	* @desc Renvoie le membre Type de la StockProduitInitiauxViewVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param tinyint(1)
	* @desc Remplace le membre Type de la StockProduitInitiauxViewVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la StockProduitInitiauxViewVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la StockProduitInitiauxViewVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdProduit()
	* @return int(11)
	* @desc Renvoie le membre IdProduit de la StockProduitInitiauxViewVO
	*/
	public function getIdProduit() {
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param int(11)
	* @desc Remplace le membre IdProduit de la StockProduitInitiauxViewVO par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

}
?>