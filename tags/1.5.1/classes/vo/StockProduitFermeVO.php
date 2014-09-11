<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/04/2013
// Fichier : StockProduitFermeVO.php
//
// Description : Classe StockProduitFermeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitFermeVO
 * @author Julien PIERRE
 * @since 28/04/2013
 * @desc Classe représentant une StockProduitFermeVO
 */
class StockProduitFermeVO  extends DataTemplate
{
	/**
	 * @var int(11)
	 * @desc NproId de la StockProduitFermeVO
	 */
	protected $mNproId;
	
	/**
	 * @var varchar(50)
	 * @desc NproNumero de la StockProduitFermeVO
	 */
	protected $mNproNumero;
	
	/**
	 * @var varchar(50)
	 * @desc NproNom de la StockProduitFermeVO
	 */
	protected $mNproNom;
	
	/**
	 * @var int(11)
	 * @desc CproId de la StockProduitFermeVO
	 */
	protected $mCproId;
	
	/**
	 * @var varchar(50)
	 * @desc CproNom de la StockProduitFermeVO
	 */
	protected $mCproNom;
	
	/**
	 * @var int(11)
	 * @desc FerId de la StockProduitFermeVO
	 */
	protected $mFerId;
	
	/**
	 * @var int(11)
	 * @desc FerNumero de la StockProduitFermeVO
	 */
	protected $mFerNumero;
	
	/**
	 * @var text
	 * @desc FerNom de la StockProduitFermeVO
	 */
	protected $mFerNom;
	
	/**
	 * @var int(11)
	 * @desc FerIdCompte de la StockProduitFermeVO
	 */
	protected $mFerIdCompte;
	
	/**
	* @var int(11)
	* @desc StoQteId de la StockProduitFermeVO
	*/
	protected $mStoQteId;

	/**
	* @var decimal(10,2)
	* @desc StoQteQuantite de la StockProduitFermeVO
	*/
	protected $mStoQteQuantite;

	/**
	* @var decimal(10,2)
	* @desc StoQteQuantiteSolidaire de la StockProduitFermeVO
	*/
	protected $mStoQteQuantiteSolidaire;

	/**
	* @var varchar(20)
	* @desc StoQteUnite de la StockProduitFermeVO
	*/
	protected $mStoQteUnite;
	
	/**
	 * @name getNproId()
	 * @return int(11)
	 * @desc Renvoie le membre NproId de la StockProduitFermeVO
	 */
	public function getNproId() {
		return $this->mNproId;
	}
	
	/**
	 * @name setNproId($pNproId)
	 * @param int(11)
	 * @desc Remplace le membre NproId de la StockProduitFermeVO par $pNproId
	 */
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}
	
	/**
	 * @name getNproNumero()
	 * @return varchar(50)
	 * @desc Renvoie le membre NproNumero de la StockProduitFermeVO
	 */
	public function getNproNumero() {
		return $this->mNproNumero;
	}
	
	/**
	 * @name setNproNumero($pNproNumero)
	 * @param varchar(50)
	 * @desc Remplace le membre NproNumero de la StockProduitFermeVO par $pNproNumero
	 */
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}
	
	/**
	 * @name getNproNom()
	 * @return varchar(50)
	 * @desc Renvoie le membre NproNom de la StockProduitFermeVO
	 */
	public function getNproNom() {
		return $this->mNproNom;
	}
	
	/**
	 * @name setNproNom($pNproNom)
	 * @param varchar(50)
	 * @desc Remplace le membre NproNom de la StockProduitFermeVO par $pNproNom
	 */
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}
	

	/**
	 * @name getCproId()
	 * @return int(11)
	 * @desc Renvoie le membre CproId de la StockProduitFermeVO
	 */
	public function getCproId() {
		return $this->mCproId;
	}
	
	/**
	 * @name setCproId($pCproId)
	 * @param int(11)
	 * @desc Remplace le membre CproId de la StockProduitFermeVO par $pCproId
	 */
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}
	
	/**
	 * @name getCproNom()
	 * @return varchar(50)
	 * @desc Renvoie le membre CproNom de la StockProduitFermeVO
	 */
	public function getCproNom() {
		return $this->mCproNom;
	}
	
	/**
	 * @name setCproNom($pCproNom)
	 * @param varchar(50)
	 * @desc Remplace le membre CproNom de la StockProduitFermeVO par $pCproNom
	 */
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	 * @name getFerId()
	 * @return int(11)
	 * @desc Renvoie le membre FerId de la StockProduitFermeVO
	 */
	public function getFerId() {
		return $this->mFerId;
	}
	
	/**
	 * @name setFerId($pFerId)
	 * @param int(11)
	 * @desc Remplace le membre FerId de la StockProduitFermeVO par $pFerId
	 */
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}
	
	/**
	 * @name getFerNumero()
	 * @return int(11)
	 * @desc Renvoie le membre FerNumero de la StockProduitFermeVO
	 */
	public function getFerNumero() {
		return $this->mFerNumero;
	}
	
	/**
	 * @name setFerNumero($pFerNumero)
	 * @param int(11)
	 * @desc Remplace le membre FerNumero de la StockProduitFermeVO par $pFerNumero
	 */
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}
	
	/**
	 * @name getFerNom()
	 * @return text
	 * @desc Renvoie le membre FerNom de la StockProduitFermeVO
	 */
	public function getFerNom() {
		return $this->mFerNom;
	}
	
	/**
	 * @name setFerNom($pFerNom)
	 * @param text
	 * @desc Remplace le membre FerNom de la StockProduitFermeVO par $pFerNom
	 */
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}
	
	/**
	 * @name getFerIdCompte()
	 * @return int(11)
	 * @desc Renvoie le membre FerIdCompte de la StockProduitFermeVO
	 */
	public function getFerIdCompte() {
		return $this->mFerIdCompte;
	}
	
	/**
	 * @name setFerIdCompte($pFerIdCompte)
	 * @param int(11)
	 * @desc Remplace le membre FerIdCompte de la StockProduitFermeVO par $pFerIdCompte
	 */
	public function setFerIdCompte($pFerIdCompte) {
		$this->mFerIdCompte = $pFerIdCompte;
	}

	/**
	* @name getStoQteId()
	* @return int(11)
	* @desc Renvoie le membre StoQteId de la StockProduitFermeVO
	*/
	public function getStoQteId() {
		return $this->mStoQteId;
	}

	/**
	* @name setStoQteId($pStoQteId)
	* @param int(11)
	* @desc Remplace le membre StoQteId de la StockProduitFermeVO par $pStoQteId
	*/
	public function setStoQteId($pStoQteId) {
		$this->mStoQteId = $pStoQteId;
	}

	/**
	* @name getStoQteQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQteQuantite de la StockProduitFermeVO
	*/
	public function getStoQteQuantite() {
		return $this->mStoQteQuantite;
	}

	/**
	* @name setStoQteQuantite($pStoQteQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQteQuantite de la StockProduitFermeVO par $pStoQteQuantite
	*/
	public function setStoQteQuantite($pStoQteQuantite) {
		$this->mStoQteQuantite = $pStoQteQuantite;
	}

	/**
	* @name getStoQteQuantiteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQteQuantiteSolidaire de la StockProduitFermeVO
	*/
	public function getStoQteQuantiteSolidaire() {
		return $this->mStoQteQuantiteSolidaire;
	}

	/**
	* @name setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQteQuantiteSolidaire de la StockProduitFermeVO par $pStoQteQuantiteSolidaire
	*/
	public function setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire) {
		$this->mStoQteQuantiteSolidaire = $pStoQteQuantiteSolidaire;
	}

	/**
	* @name getStoQteUnite()
	* @return varchar(20)
	* @desc Renvoie le membre StoQteUnite de la StockProduitFermeVO
	*/
	public function getStoQteUnite() {
		return $this->mStoQteUnite;
	}

	/**
	* @name setStoQteUnite($pStoQteUnite)
	* @param varchar(20)
	* @desc Remplace le membre StoQteUnite de la StockProduitFermeVO par $pStoQteUnite
	*/
	public function setStoQteUnite($pStoQteUnite) {
		$this->mStoQteUnite = $pStoQteUnite;
	}
}
?>