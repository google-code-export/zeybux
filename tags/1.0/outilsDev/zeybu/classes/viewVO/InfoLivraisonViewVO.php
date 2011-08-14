<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoLivraisonViewVO.php
//
// Description : Classe InfoLivraisonViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoLivraisonViewVO
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoLivraisonViewVO
 */
class InfoLivraisonViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc comId de la InfoLivraisonViewVO
	*/
	protected $mcomId;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la InfoLivraisonViewVO
	*/
	protected $mProIdProducteur;

	/**
	* @var int(11)
	* @desc ProId de la InfoLivraisonViewVO
	*/
	protected $mProId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la InfoLivraisonViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la InfoLivraisonViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la InfoLivraisonViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la InfoLivraisonViewVO
	*/
	protected $mStoQuantite;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la InfoLivraisonViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la InfoLivraisonViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantLivraison de la InfoLivraisonViewVO
	*/
	protected $mOpeMontantLivraison;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteLivraison de la InfoLivraisonViewVO
	*/
	protected $mStoQuantiteLivraison;

	/**
	* @name getcomId()
	* @return int(11)
	* @desc Renvoie le membre comId de la InfoLivraisonViewVO
	*/
	public function getcomId() {
		return $this->mcomId;
	}

	/**
	* @name setcomId($pcomId)
	* @param int(11)
	* @desc Remplace le membre comId de la InfoLivraisonViewVO par $pcomId
	*/
	public function setcomId($pcomId) {
		$this->mcomId = $pcomId;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la InfoLivraisonViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la InfoLivraisonViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la InfoLivraisonViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la InfoLivraisonViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la InfoLivraisonViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la InfoLivraisonViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la InfoLivraisonViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la InfoLivraisonViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la InfoLivraisonViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la InfoLivraisonViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la InfoLivraisonViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la InfoLivraisonViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la InfoLivraisonViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la InfoLivraisonViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la InfoLivraisonViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la InfoLivraisonViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

	/**
	* @name getOpeMontantLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantLivraison de la InfoLivraisonViewVO
	*/
	public function getOpeMontantLivraison() {
		return $this->mOpeMontantLivraison;
	}

	/**
	* @name setOpeMontantLivraison($pOpeMontantLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantLivraison de la InfoLivraisonViewVO par $pOpeMontantLivraison
	*/
	public function setOpeMontantLivraison($pOpeMontantLivraison) {
		$this->mOpeMontantLivraison = $pOpeMontantLivraison;
	}

	/**
	* @name getStoQuantiteLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteLivraison de la InfoLivraisonViewVO
	*/
	public function getStoQuantiteLivraison() {
		return $this->mStoQuantiteLivraison;
	}

	/**
	* @name setStoQuantiteLivraison($pStoQuantiteLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteLivraison de la InfoLivraisonViewVO par $pStoQuantiteLivraison
	*/
	public function setStoQuantiteLivraison($pStoQuantiteLivraison) {
		$this->mStoQuantiteLivraison = $pStoQuantiteLivraison;
	}

}
?>