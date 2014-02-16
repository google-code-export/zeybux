<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/05/2013
// Fichier : StockProduitDisponibleViewVO.php
//
// Description : Classe StockProduitDisponibleViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitDisponibleViewVO
 * @author Julien PIERRE
 * @since 18/05/2013
 * @desc Classe représentant une StockProduitDisponibleViewVO
 */
class StockProduitDisponibleViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NproId de la StockProduitDisponibleViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNumero de la StockProduitDisponibleViewVO
	*/
	protected $mNproNumero;

	/**
	* @var varchar(50)
	* @desc NproNom de la StockProduitDisponibleViewVO
	*/
	protected $mNproNom;

	/**
	* @var int(11)
	* @desc CproId de la StockProduitDisponibleViewVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la StockProduitDisponibleViewVO
	*/
	protected $mCproNom;

	/**
	* @var int(11)
	* @desc FerId de la StockProduitDisponibleViewVO
	*/
	protected $mFerId;

	/**
	* @var varchar(20)
	* @desc FerNumero de la StockProduitDisponibleViewVO
	*/
	protected $mFerNumero;

	/**
	* @var text
	* @desc FerNom de la StockProduitDisponibleViewVO
	*/
	protected $mFerNom;

	/**
	* @var int(11)
	* @desc FerIdCompte de la StockProduitDisponibleViewVO
	*/
	protected $mFerIdCompte;

	/**
	* @var int(11)
	* @desc StoQteId de la StockProduitDisponibleViewVO
	*/
	protected $mStoQteId;

	/**
	* @var decimal(10,2) 	
	* @desc StoQteQuantite de la StockProduitDisponibleViewVO
	*/
	protected $mStoQteQuantite;

	/**
	* @var decimal(10,2) 	
	* @desc StoQteQuantiteSolidaire de la StockProduitDisponibleViewVO
	*/
	protected $mStoQteQuantiteSolidaire;

	/**
	* @var varchar(20)
	* @desc StoQteUnite de la StockProduitDisponibleViewVO
	*/
	protected $mStoQteUnite;

	/**
	* @var int(11)
	* @desc MLotId de la StockProduitDisponibleViewVO
	*/
	protected $mMLotId;

	/**
	* @var decimal(10,2)
	* @desc MLotQuantite de la StockProduitDisponibleViewVO
	*/
	protected $mMLotQuantite;

	/**
	* @var varchar(20)
	* @desc MLotUnite de la StockProduitDisponibleViewVO
	*/
	protected $mMLotUnite;

	/**
	* @var decimal(10,2)
	* @desc MLotPrix de la StockProduitDisponibleViewVO
	*/
	protected $mMLotPrix;

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la StockProduitDisponibleViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la StockProduitDisponibleViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la StockProduitDisponibleViewVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la StockProduitDisponibleViewVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la StockProduitDisponibleViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la StockProduitDisponibleViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la StockProduitDisponibleViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la StockProduitDisponibleViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la StockProduitDisponibleViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la StockProduitDisponibleViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la StockProduitDisponibleViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la StockProduitDisponibleViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return varchar(20)
	* @desc Renvoie le membre FerNumero de la StockProduitDisponibleViewVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param varchar(20)
	* @desc Remplace le membre FerNumero de la StockProduitDisponibleViewVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la StockProduitDisponibleViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la StockProduitDisponibleViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getFerIdCompte()
	* @return int(11)
	* @desc Renvoie le membre FerIdCompte de la StockProduitDisponibleViewVO
	*/
	public function getFerIdCompte() {
		return $this->mFerIdCompte;
	}

	/**
	* @name setFerIdCompte($pFerIdCompte)
	* @param int(11)
	* @desc Remplace le membre FerIdCompte de la StockProduitDisponibleViewVO par $pFerIdCompte
	*/
	public function setFerIdCompte($pFerIdCompte) {
		$this->mFerIdCompte = $pFerIdCompte;
	}

	/**
	* @name getStoQteId()
	* @return int(11)
	* @desc Renvoie le membre StoQteId de la StockProduitDisponibleViewVO
	*/
	public function getStoQteId() {
		return $this->mStoQteId;
	}

	/**
	* @name setStoQteId($pStoQteId)
	* @param int(11)
	* @desc Remplace le membre StoQteId de la StockProduitDisponibleViewVO par $pStoQteId
	*/
	public function setStoQteId($pStoQteId) {
		$this->mStoQteId = $pStoQteId;
	}

	/**
	* @name getStoQteQuantite()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre StoQteQuantite de la StockProduitDisponibleViewVO
	*/
	public function getStoQteQuantite() {
		return $this->mStoQteQuantite;
	}

	/**
	* @name setStoQteQuantite($pStoQteQuantite)
	* @param decimal(10,2) 	
	* @desc Remplace le membre StoQteQuantite de la StockProduitDisponibleViewVO par $pStoQteQuantite
	*/
	public function setStoQteQuantite($pStoQteQuantite) {
		$this->mStoQteQuantite = $pStoQteQuantite;
	}

	/**
	* @name getStoQteQuantiteSolidaire()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre StoQteQuantiteSolidaire de la StockProduitDisponibleViewVO
	*/
	public function getStoQteQuantiteSolidaire() {
		return $this->mStoQteQuantiteSolidaire;
	}

	/**
	* @name setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire)
	* @param decimal(10,2) 	
	* @desc Remplace le membre StoQteQuantiteSolidaire de la StockProduitDisponibleViewVO par $pStoQteQuantiteSolidaire
	*/
	public function setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire) {
		$this->mStoQteQuantiteSolidaire = $pStoQteQuantiteSolidaire;
	}

	/**
	* @name getStoQteUnite()
	* @return varchar(20)
	* @desc Renvoie le membre StoQteUnite de la StockProduitDisponibleViewVO
	*/
	public function getStoQteUnite() {
		return $this->mStoQteUnite;
	}

	/**
	* @name setStoQteUnite($pStoQteUnite)
	* @param varchar(20)
	* @desc Remplace le membre StoQteUnite de la StockProduitDisponibleViewVO par $pStoQteUnite
	*/
	public function setStoQteUnite($pStoQteUnite) {
		$this->mStoQteUnite = $pStoQteUnite;
	}

	/**
	* @name getMLotId()
	* @return int(11)
	* @desc Renvoie le membre MLotId de la StockProduitDisponibleViewVO
	*/
	public function getMLotId() {
		return $this->mMLotId;
	}

	/**
	* @name setMLotId($pMLotId)
	* @param int(11)
	* @desc Remplace le membre MLotId de la StockProduitDisponibleViewVO par $pMLotId
	*/
	public function setMLotId($pMLotId) {
		$this->mMLotId = $pMLotId;
	}

	/**
	* @name getMLotQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre MLotQuantite de la StockProduitDisponibleViewVO
	*/
	public function getMLotQuantite() {
		return $this->mMLotQuantite;
	}

	/**
	* @name setMLotQuantite($pMLotQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre MLotQuantite de la StockProduitDisponibleViewVO par $pMLotQuantite
	*/
	public function setMLotQuantite($pMLotQuantite) {
		$this->mMLotQuantite = $pMLotQuantite;
	}

	/**
	* @name getMLotUnite()
	* @return varchar(20)
	* @desc Renvoie le membre MLotUnite de la StockProduitDisponibleViewVO
	*/
	public function getMLotUnite() {
		return $this->mMLotUnite;
	}

	/**
	* @name setMLotUnite($pMLotUnite)
	* @param varchar(20)
	* @desc Remplace le membre MLotUnite de la StockProduitDisponibleViewVO par $pMLotUnite
	*/
	public function setMLotUnite($pMLotUnite) {
		$this->mMLotUnite = $pMLotUnite;
	}

	/**
	* @name getMLotPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre MLotPrix de la StockProduitDisponibleViewVO
	*/
	public function getMLotPrix() {
		return $this->mMLotPrix;
	}

	/**
	* @name setMLotPrix($pMLotPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre MLotPrix de la StockProduitDisponibleViewVO par $pMLotPrix
	*/
	public function setMLotPrix($pMLotPrix) {
		$this->mMLotPrix = $pMLotPrix;
	}

}
?>