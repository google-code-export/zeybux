<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/07/2011
// Fichier : StockVO.php
//
// Description : Classe StockVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockVO
 * @author Julien PIERRE
 * @since 12/07/2011
 * @desc Classe représentant une StockVO
 */
class StockVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la StockVO
	*/
	protected $mId;

	/**
	* @var datetime
	* @desc Date de la StockVO
	*/
	protected $mDate;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la StockVO
	*/
	protected $mQuantite;

	/**
	* @var tinyint(1)
	* @desc Type de la StockVO
	*/
	protected $mType;

	/**
	* @var int(11)
	* @desc IdCompte de la StockVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc IdDetailCommande de la StockVO
	*/
	protected $mIdDetailCommande;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la StockVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la StockVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la StockVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la StockVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la StockVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la StockVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getType()
	* @return tinyint(1)
	* @desc Renvoie le membre Type de la StockVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param tinyint(1)
	* @desc Remplace le membre Type de la StockVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la StockVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la StockVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la StockVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la StockVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

}
?>