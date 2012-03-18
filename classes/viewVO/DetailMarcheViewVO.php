<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : DetailMarcheViewVO.php
//
// Description : Classe DetailMarcheViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailMarcheViewVO
 * @author Julien PIERRE
 * @since 18/09/2010
 * @desc Classe représentant une DetailMarcheViewVO
 */
class DetailMarcheViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la DetailMarcheViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la DetailMarcheViewVO
	*/
	protected $mComNumero;

	/**
	* @var varchar(100)
	* @desc ComNom de la DetailMarcheViewVO
	*/
	protected $mComNom;

	/**
	* @var text
	* @desc ComDescription de la DetailMarcheViewVO
	*/
	protected $mComDescription;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la DetailMarcheViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la DetailMarcheViewVO
	*/
	protected $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateDebutReservation de la DetailMarcheViewVO
	*/
	protected $mComDateDebutReservation;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la DetailMarcheViewVO
	*/
	protected $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la DetailMarcheViewVO
	*/
	protected $mComArchive;

	/**
	* @var int(11)
	* @desc ProId de la DetailMarcheViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc ProIdCommande de la DetailMarcheViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdNomProduit de la DetailMarcheViewVO
	*/
	protected $mProIdNomProduit;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la DetailMarcheViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var decimal(10,2)
	* @desc ProMaxProduitCommande de la DetailMarcheViewVO
	*/
	protected $mProMaxProduitCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la DetailMarcheViewVO
	*/
	protected $mProIdCompteFerme;
	
	/**
	* @var decimal(10,2)
	* @desc ProStockReservation de la DetailMarcheViewVO
	*/
	protected $mProStockReservation;
	
	/**
	* @var decimal(10,2)
	* @desc ProStockInitial de la DetailMarcheViewVO
	*/
	protected $mProStockInitial;
	
	/**
	* @var integer
	* @desc ProType de la DetailMarcheViewVO
	*/
	protected $mProType;
	
	/**
	* @var int(11)
	* @desc NproId de la DetailMarcheViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la DetailMarcheViewVO
	*/
	protected $mNproNom;

	/**
	* @var text
	* @desc NproDescription de la DetailMarcheViewVO
	*/
	protected $mNproDescription;

	/**
	* @var int(11)
	* @desc NproIdCategorie de la DetailMarcheViewVO
	*/
	protected $mNproIdCategorie;

	/**
	* @var int(11)
	* @desc DcomId de la DetailMarcheViewVO
	*/
	protected $mDcomId;

	/**
	* @var int(11)
	* @desc DcomIdProduit de la DetailMarcheViewVO
	*/
	protected $mDcomIdProduit;

	/**
	* @var decimal(10,2)
	* @desc DcomTaille de la DetailMarcheViewVO
	*/
	protected $mDcomTaille;

	/**
	* @var decimal(10,2)
	* @desc DcomPrix de la DetailMarcheViewVO
	*/
	protected $mDcomPrix;
	
	/**
	* @var varchar(50)
	* @desc CproNom de la DetailMarcheViewVO
	*/
	protected $mCproNom;
	
	/**
	* @var int(11)
	* @desc FerId de la DetailMarcheViewVO
	*/
	protected $mFerId;
	
	/**
	* @var varchar(20)
	* @desc FerNom de la DetailMarcheViewVO
	*/
	protected $mFerNom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la DetailMarcheViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la DetailMarcheViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la DetailMarcheViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la DetailMarcheViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComNom()
	* @return varchar(100)
	* @desc Renvoie le membre ComNom de la DetailMarcheViewVO
	*/
	public function getComNom() {
		return $this->mComNom;
	}

	/**
	* @name setComNom($pComNom)
	* @param varchar(100)
	* @desc Remplace le membre ComNom de la DetailMarcheViewVO par $pComNom
	*/
	public function setComNom($pComNom) {
		$this->mComNom = $pComNom;
	}

	/**
	* @name getComDescription()
	* @return text
	* @desc Renvoie le membre ComDescription de la DetailMarcheViewVO
	*/
	public function getComDescription() {
		return $this->mComDescription;
	}

	/**
	* @name setComDescription($pComDescription)
	* @param text
	* @desc Remplace le membre ComDescription de la DetailMarcheViewVO par $pComDescription
	*/
	public function setComDescription($pComDescription) {
		$this->mComDescription = $pComDescription;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la DetailMarcheViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la DetailMarcheViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la DetailMarcheViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la DetailMarcheViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateDebutReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateDebutReservation de la DetailMarcheViewVO
	*/
	public function getComDateDebutReservation() {
		return $this->mComDateDebutReservation;
	}

	/**
	* @name setComDateDebutReservation($pComDateDebutReservation)
	* @param datetime
	* @desc Remplace le membre ComDateDebutReservation de la DetailMarcheViewVO par $pComDateDebutReservation
	*/
	public function setComDateDebutReservation($pComDateDebutReservation) {
		$this->mComDateDebutReservation = $pComDateDebutReservation;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la DetailMarcheViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la DetailMarcheViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la DetailMarcheViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la DetailMarcheViewVO par $pComArchive
	*/
	public function setComArchive($pComArchive) {
		$this->mComArchive = $pComArchive;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la DetailMarcheViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la DetailMarcheViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la DetailMarcheViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la DetailMarcheViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProIdNomProduit de la DetailMarcheViewVO
	*/
	public function getProIdNomProduit() {
		return $this->mProIdNomProduit;
	}

	/**
	* @name setProIdNomProduit($pProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProIdNomProduit de la DetailMarcheViewVO par $pProIdNomProduit
	*/
	public function setProIdNomProduit($pProIdNomProduit) {
		$this->mProIdNomProduit = $pProIdNomProduit;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la DetailMarcheViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la DetailMarcheViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProMaxProduitCommande()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProMaxProduitCommande de la DetailMarcheViewVO
	*/
	public function getProMaxProduitCommande() {
		return $this->mProMaxProduitCommande;
	}

	/**
	* @name setProMaxProduitCommande($pProMaxProduitCommande)
	* @param decimal(10,2)
	* @desc Remplace le membre ProMaxProduitCommande de la DetailMarcheViewVO par $pProMaxProduitCommande
	*/
	public function setProMaxProduitCommande($pProMaxProduitCommande) {
		$this->mProMaxProduitCommande = $pProMaxProduitCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la DetailMarcheViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la DetailMarcheViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}
	
	/**
	* @name getProStockReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProStockReservation de la DetailMarcheViewVO
	*/
	public function getProStockReservation() {
		return $this->mProStockReservation;
	}

	/**
	* @name setProStockReservation($pProStockReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre ProStockReservation de la DetailMarcheViewVO par $pProStockReservation
	*/
	public function setProStockReservation($pProStockReservation) {
		$this->mProStockReservation = $pProStockReservation;
	}
	
	/**
	* @name getProStockInitial()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProStockInitial de la DetailMarcheViewVO
	*/
	public function getProStockInitial() {
		return $this->mProStockInitial;
	}

	/**
	* @name setProStockInitial($pProStockInitial)
	* @param decimal(10,2)
	* @desc Remplace le membre ProStockInitial de la DetailMarcheViewVO par $pProStockInitial
	*/
	public function setProStockInitial($pProStockInitial) {
		$this->mProStockInitial = $pProStockInitial;
	}
	
	/**
	* @name getProType()
	* @return int(11)
	* @desc Renvoie le membre ProType de la DetailMarcheViewVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param int(11)
	* @desc Remplace le membre ProType de la DetailMarcheViewVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}
	
	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la DetailMarcheViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la DetailMarcheViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la DetailMarcheViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la DetailMarcheViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getNproDescription()
	* @return text
	* @desc Renvoie le membre NproDescription de la DetailMarcheViewVO
	*/
	public function getNproDescription() {
		return $this->mNproDescription;
	}

	/**
	* @name setNproDescription($pNproDescription)
	* @param text
	* @desc Remplace le membre NproDescription de la DetailMarcheViewVO par $pNproDescription
	*/
	public function setNproDescription($pNproDescription) {
		$this->mNproDescription = $pNproDescription;
	}

	/**
	* @name getNproIdCategorie()
	* @return int(11)
	* @desc Renvoie le membre NproIdCategorie de la DetailMarcheViewVO
	*/
	public function getNproIdCategorie() {
		return $this->mNproIdCategorie;
	}

	/**
	* @name setNproIdCategorie($pNproIdCategorie)
	* @param int(11)
	* @desc Remplace le membre NproIdCategorie de la DetailMarcheViewVO par $pNproIdCategorie
	*/
	public function setNproIdCategorie($pNproIdCategorie) {
		$this->mNproIdCategorie = $pNproIdCategorie;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la DetailMarcheViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la DetailMarcheViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getDcomIdProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdProduit de la DetailMarcheViewVO
	*/
	public function getDcomIdProduit() {
		return $this->mDcomIdProduit;
	}

	/**
	* @name setDcomIdProduit($pDcomIdProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdProduit de la DetailMarcheViewVO par $pDcomIdProduit
	*/
	public function setDcomIdProduit($pDcomIdProduit) {
		$this->mDcomIdProduit = $pDcomIdProduit;
	}

	/**
	* @name getDcomTaille()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomTaille de la DetailMarcheViewVO
	*/
	public function getDcomTaille() {
		return $this->mDcomTaille;
	}

	/**
	* @name setDcomTaille($pDcomTaille)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomTaille de la DetailMarcheViewVO par $pDcomTaille
	*/
	public function setDcomTaille($pDcomTaille) {
		$this->mDcomTaille = $pDcomTaille;
	}

	/**
	* @name getDcomPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomPrix de la DetailMarcheViewVO
	*/
	public function getDcomPrix() {
		return $this->mDcomPrix;
	}

	/**
	* @name setDcomPrix($pDcomPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomPrix de la DetailMarcheViewVO par $pDcomPrix
	*/
	public function setDcomPrix($pDcomPrix) {
		$this->mDcomPrix = $pDcomPrix;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la DetailMarcheViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)varchar(50)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la DetailMarcheViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la DetailMarcheViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)varchar(50)
	* @param int(11)
	* @desc Remplace le membre FerId de la DetailMarcheViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}
	
	/**
	* @name getFerNom()
	* @return varchar(20)
	* @desc Renvoie le membre FerNom de la DetailMarcheViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)varchar(50)
	* @param varchar(20)
	* @desc Remplace le membre FerNom de la DetailMarcheViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}
}
?>