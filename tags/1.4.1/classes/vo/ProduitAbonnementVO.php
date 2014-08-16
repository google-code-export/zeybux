<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ProduitAbonnementVO.php
//
// Description : Classe ProduitAbonnementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitAbonnementVO
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une ProduitAbonnementVO
 */
class ProduitAbonnementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ProduitAbonnementVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitAbonnementVO
	*/
	protected $mIdNomProduit;

	/**
	* @var varchar(20)
	* @desc Unite de la ProduitAbonnementVO
	*/
	protected $mUnite;

	/**
	* @var decimal(10,2)
	* @desc StockInitial de la ProduitAbonnementVO
	*/
	protected $mStockInitial;

	/**
	* @var decimal(10,2)
	* @desc Max de la ProduitAbonnementVO
	*/
	protected $mMax;

	/**
	* @var varchar(200)
	* @desc Frequence de la ProduitAbonnementVO
	*/
	protected $mFrequence;

	/**
	* @var tinyint(4)
	* @desc Etat de la ProduitAbonnementVO
	*/
	protected $mEtat;
	
	/**
	* @var array(LotAbonnementVo);
	* @desc Lots de la ProduitAbonnementVO
	*/
	protected $mLots;
	
	/**
	* @name ProduitAbonnementVO()
	* @desc Constructeur
	*/
	function ProduitAbonnementVO() {
		$this->mLots = array();
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ProduitAbonnementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ProduitAbonnementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitAbonnementVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitAbonnementVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la ProduitAbonnementVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la ProduitAbonnementVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	* @name getStockInitial()
	* @return decimal(10,2)
	* @desc Renvoie le membre StockInitial de la ProduitAbonnementVO
	*/
	public function getStockInitial() {
		return $this->mStockInitial;
	}

	/**
	* @name setStockInitial($pStockInitial)
	* @param decimal(10,2)
	* @desc Remplace le membre StockInitial de la ProduitAbonnementVO par $pStockInitial
	*/
	public function setStockInitial($pStockInitial) {
		$this->mStockInitial = $pStockInitial;
	}

	/**
	* @name getMax()
	* @return decimal(10,2)
	* @desc Renvoie le membre Max de la ProduitAbonnementVO
	*/
	public function getMax() {
		return $this->mMax;
	}

	/**
	* @name setMax($pMax)
	* @param decimal(10,2)
	* @desc Remplace le membre Max de la ProduitAbonnementVO par $pMax
	*/
	public function setMax($pMax) {
		$this->mMax = $pMax;
	}

	/**
	* @name getFrequence()
	* @return varchar(200)
	* @desc Renvoie le membre Frequence de la ProduitAbonnementVO
	*/
	public function getFrequence() {
		return $this->mFrequence;
	}

	/**
	* @name setFrequence($pFrequence)
	* @param varchar(200)
	* @desc Remplace le membre Frequence de la ProduitAbonnementVO par $pFrequence
	*/
	public function setFrequence($pFrequence) {
		$this->mFrequence = $pFrequence;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la ProduitAbonnementVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la ProduitAbonnementVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

	/**
	* @name getLots()
	* @return array(LotAbonnementVO)
	* @desc Renvoie le membre mLots de la ProduitAbonnementVO
	*/
	public function getLots() {
		return $this->mLots;
	}

	/**
	* @name setLots($pLots)
	* @param array(LotAbonnementVO)
	* @desc Remplace le membre mLots de la ProduitAbonnementVO par $pLots
	*/
	public function setLots($pLots) {
		$this->mLots = $pLots;
	}

	/**
	* @name addLots($pLots)
	* @param LotAbonnementVO
	* @desc Ajout $pLots au membre mLots de la ProduitAbonnementVO par $pLots
	*/
	public function addLots($pLots) {
		array_push($this->mLots,$pLots);
	}

}
?>