<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/08/2013
// Fichier : StockVO.php
//
// Description : Classe StockVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockVO
 * @author Julien PIERRE
 * @since 09/08/2013
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
	* @var int(11)
	* @desc IdModeleLot de la StockVO
	*/
	protected $mIdModeleLot;

	/**
	* @var int(11)
	* @desc IdOperation de la StockVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdNomProduit de la StockVO
	*/
	protected $mIdNomProduit;

	/**
	* @var varchar(20)
	* @desc Unite de la StockVO
	*/
	protected $mUnite;
	
	/**
	 * @name StockVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function StockVO($pId = null, $pDate = null, $pQuantite = null, $pType = null, $pIdCompte = null, $pIdDetailCommande = null, $pIdModeleLot = null, $pIdOperation = null, $pIdNomProduit = null, $pUnite = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pDate)) {$this->mDate = $pDate; }
		if(!is_null($pQuantite)) {$this->mQuantite = $pQuantite; }
		if(!is_null($pType)) {$this->mType = $pType; }
		if(!is_null($pIdCompte)) {$this->mIdCompte = $pIdCompte; }
		if(!is_null($pIdDetailCommande)) {$this->mIdDetailCommande = $pIdDetailCommande; }
		if(!is_null($pIdModeleLot)) {$this->mIdModeleLot = $pIdModeleLot; }
		if(!is_null($pIdOperation)) {$this->mIdOperation = $pIdOperation; }
		if(!is_null($pIdNomProduit)) {$this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pUnite)) {$this->mUnite = $pUnite; }
	}

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

	/**
	* @name getIdModeleLot()
	* @return int(11)
	* @desc Renvoie le membre IdModeleLot de la StockVO
	*/
	public function getIdModeleLot() {
		return $this->mIdModeleLot;
	}

	/**
	* @name setIdModeleLot($pIdModeleLot)
	* @param int(11)
	* @desc Remplace le membre IdModeleLot de la StockVO par $pIdModeleLot
	*/
	public function setIdModeleLot($pIdModeleLot) {
		$this->mIdModeleLot = $pIdModeleLot;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la StockVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la StockVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la StockVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la StockVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la StockVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la StockVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

}
?>