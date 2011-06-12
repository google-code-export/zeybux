<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : StockVO.php
//
// Description : Classe StockVO
//
//****************************************************************

/**
 * @name StockVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une StockVO
 */
class StockVO
{
	/**
	* @var int(11)
	* @desc Id de la StockVO
	*/
	private $mId;

	/**
	* @var datetime
	* @desc Date de la StockVO
	*/
	private $mDate;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la StockVO
	*/
	private $mQuantite;

	/**
	* @var tinyint(1)
	* @desc Type de la StockVO
	*/
	private $mType;

	/**
	* @var int(11)
	* @desc IdCompte de la StockVO
	*/
	private $mIdCompte;

	/**
	* @var int(11)
	* @desc IdProduit de la StockVO
	*/
	private $mIdProduit;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la StockVO
	*/
	public function getId(){
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
	public function getDate(){
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
	public function getQuantite(){
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
	public function getType(){
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
	public function getIdCompte(){
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
	* @name getIdProduit()
	* @return int(11)
	* @desc Renvoie le membre IdProduit de la StockVO
	*/
	public function getIdProduit(){
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param int(11)
	* @desc Remplace le membre IdProduit de la StockVO par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

}
?>