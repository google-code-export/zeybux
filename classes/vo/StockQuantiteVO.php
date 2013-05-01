<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/04/2013
// Fichier : StockQuantiteVO.php
//
// Description : Classe StockQuantiteVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockQuantiteVO
 * @author Julien PIERRE
 * @since 28/04/2013
 * @desc Classe représentant une StockQuantiteVO
 */
class StockQuantiteVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la StockQuantiteVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la StockQuantiteVO
	*/
	protected $mIdNomProduit;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la StockQuantiteVO
	*/
	protected $mQuantite;

	/**
	* @var decimal(10,2)
	* @desc QuantiteSolidaire de la StockQuantiteVO
	*/
	protected $mQuantiteSolidaire;

	/**
	* @var varchar(20)
	* @desc Unite de la StockQuantiteVO
	*/
	protected $mUnite;

	/**
	* @var datetime
	* @desc DateCreation de la StockQuantiteVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la StockQuantiteVO
	*/
	protected $mDateModification;

	/**
	* @var int(11)
	* @desc IdLogin de la StockQuantiteVO
	*/
	protected $mIdLogin;

	/**
	* @var tinyint(1)
	* @desc Etat de la StockQuantiteVO
	*/
	protected $mEtat;
		
	/**
	 * @name StockQuantiteVO()
	 * @desc Constructeur
	 */
	function StockQuantiteVO() {
		$this->mQuantite = 0;
		$this->mQuantiteSolidaire = 0;
	}
	
	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la StockQuantiteVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la StockQuantiteVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la StockQuantiteVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la StockQuantiteVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la StockQuantiteVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la StockQuantiteVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getQuantiteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre QuantiteSolidaire de la StockQuantiteVO
	*/
	public function getQuantiteSolidaire() {
		return $this->mQuantiteSolidaire;
	}

	/**
	* @name setQuantiteSolidaire($pQuantiteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre QuantiteSolidaire de la StockQuantiteVO par $pQuantiteSolidaire
	*/
	public function setQuantiteSolidaire($pQuantiteSolidaire) {
		$this->mQuantiteSolidaire = $pQuantiteSolidaire;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la StockQuantiteVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la StockQuantiteVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la StockQuantiteVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la StockQuantiteVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la StockQuantiteVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la StockQuantiteVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getIdLogin()
	* @return int(11)
	* @desc Renvoie le membre IdLogin de la StockQuantiteVO
	*/
	public function getIdLogin() {
		return $this->mIdLogin;
	}

	/**
	* @name setIdLogin($pIdLogin)
	* @param int(11)
	* @desc Remplace le membre IdLogin de la StockQuantiteVO par $pIdLogin
	*/
	public function setIdLogin($pIdLogin) {
		$this->mIdLogin = $pIdLogin;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la StockQuantiteVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la StockQuantiteVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>