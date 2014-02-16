<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : StockProduitReservationVO.php
//
// Description : Classe StockProduitReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitReservationVO
 * @author Julien PIERRE
 * @since 09/01/2011
 * @desc Classe représentant une StockProduitReservationVO
 */
class StockProduitReservationVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la StockProduitReservationVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la StockProduitReservationVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la StockProduitReservationVO
	*/
	protected $mProId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la StockProduitReservationVO
	*/
	protected $mProUniteMesure;

	/**
	* @var tinyint(4)
	* @desc ProType de la StockProduitReservationVO
	*/
	protected $mProType;

	/**
	* @var varchar(50)
	* @desc NproNumero de la StockProduitReservationVO
	*/
	protected $mNproNumero;

	/**
	* @var varchar(50)
	* @desc NproNom de la StockProduitReservationVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(33,2)
	* @desc StoQuantite de la StockProduitReservationVO
	*/
	protected $mStoQuantite;

	/**
	* @var decimal(32,2)
	* @desc DopeMontant de la DopeMontantVO
	*/
	protected $mDopeMontant;
	/**
	* @var int(11)
	* @desc DcomId de la StockProduitReservationVO
	*/
	protected $mDcomId;
	
	/**
	* @var decimal(10,2)
	* @desc DcomTaille de la DopeMontantVO
	*/
	protected $mDcomTaille;
	
	/**
	* @var decimal(10,2)
	* @desc DcomPrix de la DopeMontantVO
	*/
	protected $mDcomPrix;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la StockProduitReservationVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la StockProduitReservationVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la StockProduitReservationVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la StockProduitReservationVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockProduitReservationVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockProduitReservationVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la StockProduitReservationVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la StockProduitReservationVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProType()
	* @return tinyint(4)
	* @desc Renvoie le membre ProType de la StockProduitReservationVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param tinyint(4)
	* @desc Remplace le membre ProType de la StockProduitReservationVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}

	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la StockProduitReservationVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la StockProduitReservationVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la StockProduitReservationVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la StockProduitReservationVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(33,2)
	* @desc Renvoie le membre StoQuantite de la StockProduitReservationVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(33,2)
	* @desc Remplace le membre StoQuantite de la StockProduitReservationVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(33,2)
	* @desc Renvoie le membre DopeMontant de la StockProduitReservationVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(33,2)
	* @desc Remplace le membre DopeMontant de la StockProduitReservationVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la StockProduitReservationVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la StockProduitReservationVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getDcomTaille()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomTaille de la StockProduitReservationVO
	*/
	public function getDcomTaille() {
		return $this->mDcomTaille;
	}

	/**
	* @name setDcomTaille($pDcomTaille)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomTaille de la StockProduitReservationVO par $pDcomTaille
	*/
	public function setDcomTaille($pDcomTaille) {
		$this->mDcomTaille = $pDcomTaille;
	}

	/**
	* @name getDcomPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomPrix de la StockProduitReservationVO
	*/
	public function getDcomPrix() {
		return $this->mDcomPrix;
	}

	/**
	* @name setDcomPrix($pDcomPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomPrix de la StockProduitReservationVO par $pDcomPrix
	*/
	public function setDcomPrix($pDcomPrix) {
		$this->mDcomPrix = $pDcomPrix;
	}

}
?>