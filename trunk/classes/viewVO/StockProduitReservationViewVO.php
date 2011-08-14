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
	* @desc ProIdCompteProducteur de la StockProduitReservationViewVO
	*/
	protected $mProIdCompteProducteur;

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
	* @name getProIdCompteProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteProducteur de la StockProduitReservationViewVO
	*/
	public function getProIdCompteProducteur() {
		return $this->mProIdCompteProducteur;
	}

	/**
	* @name setProIdCompteProducteur($pProIdCompteProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteProducteur de la StockProduitReservationViewVO par $pProIdCompteProducteur
	*/
	public function setProIdCompteProducteur($pProIdCompteProducteur) {
		$this->mProIdCompteProducteur = $pProIdCompteProducteur;
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

}
?>