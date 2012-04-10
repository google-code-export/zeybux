<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : StockProduitReservationViewVO.php
//
// Description : Classe StockProduitReservationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockProduitReservationViewVO
 * @author Julien PIERRE
 * @since 09/01/2011
 * @desc Classe représentant une StockProduitReservationViewVO
 */
class StockProduitReservationViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la StockProduitReservationViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la StockProduitReservationViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la StockProduitReservationViewVO
	*/
	protected $mProId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la StockProduitReservationViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var tinyint(4)
	* @desc ProType de la StockProduitReservationViewVO
	*/
	protected $mProType;

	/**
	* @var varchar(50)
	* @desc NproNumero de la StockProduitReservationViewVO
	*/
	protected $mNproNumero;

	/**
	* @var varchar(50)
	* @desc NproNom de la StockProduitReservationViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(33,2)
	* @desc StoQuantite de la StockProduitReservationViewVO
	*/
	protected $mStoQuantite;

	/**
	* @var decimal(32,2)
	* @desc DopeMontant de la DopeMontantViewVO
	*/
	protected $mDopeMontant;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la StockProduitReservationViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la StockProduitReservationViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la StockProduitReservationViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la StockProduitReservationViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockProduitReservationViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockProduitReservationViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la StockProduitReservationViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la StockProduitReservationViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProType()
	* @return tinyint(4)
	* @desc Renvoie le membre ProType de la StockProduitReservationViewVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param tinyint(4)
	* @desc Remplace le membre ProType de la StockProduitReservationViewVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}

	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la StockProduitReservationViewVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la StockProduitReservationViewVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la StockProduitReservationViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la StockProduitReservationViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(33,2)
	* @desc Renvoie le membre StoQuantite de la StockProduitReservationViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(33,2)
	* @desc Remplace le membre StoQuantite de la StockProduitReservationViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(33,2)
	* @desc Renvoie le membre DopeMontant de la StockProduitReservationViewVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(33,2)
	* @desc Remplace le membre DopeMontant de la StockProduitReservationViewVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

}
?>