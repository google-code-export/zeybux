<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/03/2013
// Fichier : DetailProduitViewVO.php
//
// Description : Classe DetailProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProduitViewVO
 * @author Julien PIERRE
 * @since 24/03/2013
 * @desc Classe représentant une DetailProduitViewVO
 */
class DetailProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProId de la DetailProduitViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc ProIdCommande de la DetailProduitViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdNomProduit de la DetailProduitViewVO
	*/
	protected $mProIdNomProduit;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la DetailProduitViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var decimal(10,2) 	
	* @desc ProMaxProduitCommande de la DetailProduitViewVO
	*/
	protected $mProMaxProduitCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la DetailProduitViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var decimal(10,2)
	* @desc ProStockReservation de la DetailProduitViewVO
	*/
	protected $mProStockReservation;

	/**
	* @var decimal(10,2) 	
	* @desc ProStocktInitial de la DetailProduitViewVO
	*/
	protected $mProStocktInitial;

	/**
	* @var tinyint(4)
	* @desc ProType de la DetailProduitViewVO
	*/
	protected $mProType;

	/**
	* @var int(11)
	* @desc ProEtat de la DetailProduitViewVO
	*/
	protected $mProEtat;

	/**
	* @var int(11)
	* @desc NproId de la DetailProduitViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNumero de la DetailProduitViewVO
	*/
	protected $mNproNumero;

	/**
	* @var varchar(50)
	* @desc NproNom de la DetailProduitViewVO
	*/
	protected $mNproNom;

	/**
	* @var text
	* @desc NproDescription de la DetailProduitViewVO
	*/
	protected $mNproDescription;

	/**
	* @var int(11)
	* @desc NproIdCategorie de la DetailProduitViewVO
	*/
	protected $mNproIdCategorie;

	/**
	* @var int(11)
	* @desc NproIdFerme de la DetailProduitViewVO
	*/
	protected $mNproIdFerme;

	/**
	* @var int(11)
	* @desc NproEtat de la DetailProduitViewVO
	*/
	protected $mNproEtat;

	/**
	* @var int(11)
	* @desc CproId de la DetailProduitViewVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la DetailProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @var text
	* @desc CproDescription de la DetailProduitViewVO
	*/
	protected $mCproDescription;

	/**
	* @var tinyint(4)
	* @desc CproEtat de la DetailProduitViewVO
	*/
	protected $mCproEtat;

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la DetailProduitViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la DetailProduitViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la DetailProduitViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la DetailProduitViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProIdNomProduit de la DetailProduitViewVO
	*/
	public function getProIdNomProduit() {
		return $this->mProIdNomProduit;
	}

	/**
	* @name setProIdNomProduit($pProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProIdNomProduit de la DetailProduitViewVO par $pProIdNomProduit
	*/
	public function setProIdNomProduit($pProIdNomProduit) {
		$this->mProIdNomProduit = $pProIdNomProduit;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la DetailProduitViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la DetailProduitViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProMaxProduitCommande()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre ProMaxProduitCommande de la DetailProduitViewVO
	*/
	public function getProMaxProduitCommande() {
		return $this->mProMaxProduitCommande;
	}

	/**
	* @name setProMaxProduitCommande($pProMaxProduitCommande)
	* @param decimal(10,2) 	
	* @desc Remplace le membre ProMaxProduitCommande de la DetailProduitViewVO par $pProMaxProduitCommande
	*/
	public function setProMaxProduitCommande($pProMaxProduitCommande) {
		$this->mProMaxProduitCommande = $pProMaxProduitCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la DetailProduitViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la DetailProduitViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProStockReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProStockReservation de la DetailProduitViewVO
	*/
	public function getProStockReservation() {
		return $this->mProStockReservation;
	}

	/**
	* @name setProStockReservation($pProStockReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre ProStockReservation de la DetailProduitViewVO par $pProStockReservation
	*/
	public function setProStockReservation($pProStockReservation) {
		$this->mProStockReservation = $pProStockReservation;
	}

	/**
	* @name getProStocktInitial()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre ProStocktInitial de la DetailProduitViewVO
	*/
	public function getProStocktInitial() {
		return $this->mProStocktInitial;
	}

	/**
	* @name setProStocktInitial($pProStocktInitial)
	* @param decimal(10,2) 	
	* @desc Remplace le membre ProStocktInitial de la DetailProduitViewVO par $pProStocktInitial
	*/
	public function setProStocktInitial($pProStocktInitial) {
		$this->mProStocktInitial = $pProStocktInitial;
	}

	/**
	* @name getProType()
	* @return tinyint(4)
	* @desc Renvoie le membre ProType de la DetailProduitViewVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param tinyint(4)
	* @desc Remplace le membre ProType de la DetailProduitViewVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}

	/**
	* @name getProEtat()
	* @return int(11)
	* @desc Renvoie le membre ProEtat de la DetailProduitViewVO
	*/
	public function getProEtat() {
		return $this->mProEtat;
	}

	/**
	* @name setProEtat($pProEtat)
	* @param int(11)
	* @desc Remplace le membre ProEtat de la DetailProduitViewVO par $pProEtat
	*/
	public function setProEtat($pProEtat) {
		$this->mProEtat = $pProEtat;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la DetailProduitViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la DetailProduitViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la DetailProduitViewVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la DetailProduitViewVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la DetailProduitViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la DetailProduitViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getNproDescription()
	* @return text
	* @desc Renvoie le membre NproDescription de la DetailProduitViewVO
	*/
	public function getNproDescription() {
		return $this->mNproDescription;
	}

	/**
	* @name setNproDescription($pNproDescription)
	* @param text
	* @desc Remplace le membre NproDescription de la DetailProduitViewVO par $pNproDescription
	*/
	public function setNproDescription($pNproDescription) {
		$this->mNproDescription = $pNproDescription;
	}

	/**
	* @name getNproIdCategorie()
	* @return int(11)
	* @desc Renvoie le membre NproIdCategorie de la DetailProduitViewVO
	*/
	public function getNproIdCategorie() {
		return $this->mNproIdCategorie;
	}

	/**
	* @name setNproIdCategorie($pNproIdCategorie)
	* @param int(11)
	* @desc Remplace le membre NproIdCategorie de la DetailProduitViewVO par $pNproIdCategorie
	*/
	public function setNproIdCategorie($pNproIdCategorie) {
		$this->mNproIdCategorie = $pNproIdCategorie;
	}

	/**
	* @name getNproIdFerme()
	* @return int(11)
	* @desc Renvoie le membre NproIdFerme de la DetailProduitViewVO
	*/
	public function getNproIdFerme() {
		return $this->mNproIdFerme;
	}

	/**
	* @name setNproIdFerme($pNproIdFerme)
	* @param int(11)
	* @desc Remplace le membre NproIdFerme de la DetailProduitViewVO par $pNproIdFerme
	*/
	public function setNproIdFerme($pNproIdFerme) {
		$this->mNproIdFerme = $pNproIdFerme;
	}

	/**
	* @name getNproEtat()
	* @return int(11)
	* @desc Renvoie le membre NproEtat de la DetailProduitViewVO
	*/
	public function getNproEtat() {
		return $this->mNproEtat;
	}

	/**
	* @name setNproEtat($pNproEtat)
	* @param int(11)
	* @desc Remplace le membre NproEtat de la DetailProduitViewVO par $pNproEtat
	*/
	public function setNproEtat($pNproEtat) {
		$this->mNproEtat = $pNproEtat;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la DetailProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la DetailProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la DetailProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la DetailProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getCproDescription()
	* @return text
	* @desc Renvoie le membre CproDescription de la DetailProduitViewVO
	*/
	public function getCproDescription() {
		return $this->mCproDescription;
	}

	/**
	* @name setCproDescription($pCproDescription)
	* @param text
	* @desc Remplace le membre CproDescription de la DetailProduitViewVO par $pCproDescription
	*/
	public function setCproDescription($pCproDescription) {
		$this->mCproDescription = $pCproDescription;
	}

	/**
	* @name getCproEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre CproEtat de la DetailProduitViewVO
	*/
	public function getCproEtat() {
		return $this->mCproEtat;
	}

	/**
	* @name setCproEtat($pCproEtat)
	* @param tinyint(4)
	* @desc Remplace le membre CproEtat de la DetailProduitViewVO par $pCproEtat
	*/
	public function setCproEtat($pCproEtat) {
		$this->mCproEtat = $pCproEtat;
	}

}
?>