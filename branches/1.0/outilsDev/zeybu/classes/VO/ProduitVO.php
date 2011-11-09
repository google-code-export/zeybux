<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : ProduitVO.php
//
// Description : Classe ProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitVO
 * @author Julien PIERRE
 * @since 08/11/2011
 * @desc Classe représentant une ProduitVO
 */
class ProduitVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ProduitVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCommande de la ProduitVO
	*/
	protected $mIdCommande;

	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitVO
	*/
	protected $mIdNomProduit;

	/**
	* @var varchar(20)
	* @desc UniteMesure de la ProduitVO
	*/
	protected $mUniteMesure;

	/**
	* @var decimal(10,2)
	* @desc MaxProduitCommande de la ProduitVO
	*/
	protected $mMaxProduitCommande;

	/**
	* @var int(11)
	* @desc IdCompteFerme de la ProduitVO
	*/
	protected $mIdCompteFerme;

	/**
	* @var decimal(10,2)
	* @desc StockReservation de la ProduitVO
	*/
	protected $mStockReservation;

	/**
	* @var decimal(10,2)
	* @desc StockInitial de la ProduitVO
	*/
	protected $mStockInitial;

	/**
	* @var int(11)
	* @desc Etat de la ProduitVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ProduitVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ProduitVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la ProduitVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la ProduitVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre UniteMesure de la ProduitVO
	*/
	public function getUniteMesure() {
		return $this->mUniteMesure;
	}

	/**
	* @name setUniteMesure($pUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre UniteMesure de la ProduitVO par $pUniteMesure
	*/
	public function setUniteMesure($pUniteMesure) {
		$this->mUniteMesure = $pUniteMesure;
	}

	/**
	* @name getMaxProduitCommande()
	* @return decimal(10,2)
	* @desc Renvoie le membre MaxProduitCommande de la ProduitVO
	*/
	public function getMaxProduitCommande() {
		return $this->mMaxProduitCommande;
	}

	/**
	* @name setMaxProduitCommande($pMaxProduitCommande)
	* @param decimal(10,2)
	* @desc Remplace le membre MaxProduitCommande de la ProduitVO par $pMaxProduitCommande
	*/
	public function setMaxProduitCommande($pMaxProduitCommande) {
		$this->mMaxProduitCommande = $pMaxProduitCommande;
	}

	/**
	* @name getIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre IdCompteFerme de la ProduitVO
	*/
	public function getIdCompteFerme() {
		return $this->mIdCompteFerme;
	}

	/**
	* @name setIdCompteFerme($pIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre IdCompteFerme de la ProduitVO par $pIdCompteFerme
	*/
	public function setIdCompteFerme($pIdCompteFerme) {
		$this->mIdCompteFerme = $pIdCompteFerme;
	}

	/**
	* @name getStockReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre StockReservation de la ProduitVO
	*/
	public function getStockReservation() {
		return $this->mStockReservation;
	}

	/**
	* @name setStockReservation($pStockReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre StockReservation de la ProduitVO par $pStockReservation
	*/
	public function setStockReservation($pStockReservation) {
		$this->mStockReservation = $pStockReservation;
	}

	/**
	* @name getStockInitial()
	* @return decimal(10,2)
	* @desc Renvoie le membre StockInitial de la ProduitVO
	*/
	public function getStockInitial() {
		return $this->mStockInitial;
	}

	/**
	* @name setStockInitial($pStockInitial)
	* @param decimal(10,2)
	* @desc Remplace le membre StockInitial de la ProduitVO par $pStockInitial
	*/
	public function setStockInitial($pStockInitial) {
		$this->mStockInitial = $pStockInitial;
	}

	/**
	* @name getEtat()
	* @return int(11)
	* @desc Renvoie le membre Etat de la ProduitVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param int(11)
	* @desc Remplace le membre Etat de la ProduitVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>