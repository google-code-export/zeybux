<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/09/2010
// Fichier : CommandeCompleteArchiveViewVO.php
//
// Description : Classe CommandeCompleteArchiveViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CommandeCompleteArchiveViewVO
 * @author Julien PIERRE
 * @since 18/09/2010
 * @desc Classe représentant une CommandeCompleteArchiveViewVO
 */
class CommandeCompleteArchiveViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la CommandeCompleteArchiveViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la CommandeCompleteArchiveViewVO
	*/
	protected $mComNumero;

	/**
	* @var varchar(100)
	* @desc ComNom de la CommandeCompleteArchiveViewVO
	*/
	protected $mComNom;

	/**
	* @var text
	* @desc ComDescription de la CommandeCompleteArchiveViewVO
	*/
	protected $mComDescription;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la CommandeCompleteArchiveViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la CommandeCompleteArchiveViewVO
	*/
	protected $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la CommandeCompleteArchiveViewVO
	*/
	protected $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la CommandeCompleteArchiveViewVO
	*/
	protected $mComArchive;

	/**
	* @var int(11)
	* @desc ProId de la CommandeCompleteArchiveViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc ProIdCommande de la CommandeCompleteArchiveViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdNomProduit de la CommandeCompleteArchiveViewVO
	*/
	protected $mProIdNomProduit;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la CommandeCompleteArchiveViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var decimal(10,2)
	* @desc ProMaxProduitCommande de la CommandeCompleteArchiveViewVO
	*/
	protected $mProMaxProduitCommande;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la CommandeCompleteArchiveViewVO
	*/
	protected $mProIdProducteur;
	
	/**
	* @var int(11)
	* @desc NproId de la CommandeCompleteArchiveViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la CommandeCompleteArchiveViewVO
	*/
	protected $mNproNom;

	/**
	* @var text
	* @desc NproDescription de la CommandeCompleteArchiveViewVO
	*/
	protected $mNproDescription;

	/**
	* @var int(11)
	* @desc NproIdCategorie de la CommandeCompleteArchiveViewVO
	*/
	protected $mNproIdCategorie;

	/**
	* @var int(11)
	* @desc DcomId de la CommandeCompleteArchiveViewVO
	*/
	protected $mDcomId;

	/**
	* @var int(11)
	* @desc DcomIdProduit de la CommandeCompleteArchiveViewVO
	*/
	protected $mDcomIdProduit;

	/**
	* @var decimal(10,2)
	* @desc DcomTaille de la CommandeCompleteArchiveViewVO
	*/
	protected $mDcomTaille;

	/**
	* @var decimal(10,2)
	* @desc DcomPrix de la CommandeCompleteArchiveViewVO
	*/
	protected $mDcomPrix;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la CommandeCompleteArchiveViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la CommandeCompleteArchiveViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la CommandeCompleteArchiveViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la CommandeCompleteArchiveViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComNom()
	* @return varchar(100)
	* @desc Renvoie le membre ComNom de la CommandeCompleteArchiveViewVO
	*/
	public function getComNom() {
		return $this->mComNom;
	}

	/**
	* @name setComNom($pComNom)
	* @param varchar(100)
	* @desc Remplace le membre ComNom de la CommandeCompleteArchiveViewVO par $pComNom
	*/
	public function setComNom($pComNom) {
		$this->mComNom = $pComNom;
	}

	/**
	* @name getComDescription()
	* @return text
	* @desc Renvoie le membre ComDescription de la CommandeCompleteArchiveViewVO
	*/
	public function getComDescription() {
		return $this->mComDescription;
	}

	/**
	* @name setComDescription($pComDescription)
	* @param text
	* @desc Remplace le membre ComDescription de la CommandeCompleteArchiveViewVO par $pComDescription
	*/
	public function setComDescription($pComDescription) {
		$this->mComDescription = $pComDescription;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la CommandeCompleteArchiveViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la CommandeCompleteArchiveViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la CommandeCompleteArchiveViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la CommandeCompleteArchiveViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la CommandeCompleteArchiveViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la CommandeCompleteArchiveViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la CommandeCompleteArchiveViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la CommandeCompleteArchiveViewVO par $pComArchive
	*/
	public function setComArchive($pComArchive) {
		$this->mComArchive = $pComArchive;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la CommandeCompleteArchiveViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la CommandeCompleteArchiveViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la CommandeCompleteArchiveViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la CommandeCompleteArchiveViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProIdNomProduit de la CommandeCompleteArchiveViewVO
	*/
	public function getProIdNomProduit() {
		return $this->mProIdNomProduit;
	}

	/**
	* @name setProIdNomProduit($pProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProIdNomProduit de la CommandeCompleteArchiveViewVO par $pProIdNomProduit
	*/
	public function setProIdNomProduit($pProIdNomProduit) {
		$this->mProIdNomProduit = $pProIdNomProduit;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la CommandeCompleteArchiveViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la CommandeCompleteArchiveViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getProMaxProduitCommande()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProMaxProduitCommande de la CommandeCompleteArchiveViewVO
	*/
	public function getProMaxProduitCommande() {
		return $this->mProMaxProduitCommande;
	}

	/**
	* @name setProMaxProduitCommande($pProMaxProduitCommande)
	* @param decimal(10,2)
	* @desc Remplace le membre ProMaxProduitCommande de la CommandeCompleteArchiveViewVO par $pProMaxProduitCommande
	*/
	public function setProMaxProduitCommande($pProMaxProduitCommande) {
		$this->mProMaxProduitCommande = $pProMaxProduitCommande;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la CommandeCompleteArchiveViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la CommandeCompleteArchiveViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
	}
	
	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la CommandeCompleteArchiveViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la CommandeCompleteArchiveViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la CommandeCompleteArchiveViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la CommandeCompleteArchiveViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getNproDescription()
	* @return text
	* @desc Renvoie le membre NproDescription de la CommandeCompleteArchiveViewVO
	*/
	public function getNproDescription() {
		return $this->mNproDescription;
	}

	/**
	* @name setNproDescription($pNproDescription)
	* @param text
	* @desc Remplace le membre NproDescription de la CommandeCompleteArchiveViewVO par $pNproDescription
	*/
	public function setNproDescription($pNproDescription) {
		$this->mNproDescription = $pNproDescription;
	}

	/**
	* @name getNproIdCategorie()
	* @return int(11)
	* @desc Renvoie le membre NproIdCategorie de la CommandeCompleteArchiveViewVO
	*/
	public function getNproIdCategorie() {
		return $this->mNproIdCategorie;
	}

	/**
	* @name setNproIdCategorie($pNproIdCategorie)
	* @param int(11)
	* @desc Remplace le membre NproIdCategorie de la CommandeCompleteArchiveViewVO par $pNproIdCategorie
	*/
	public function setNproIdCategorie($pNproIdCategorie) {
		$this->mNproIdCategorie = $pNproIdCategorie;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la CommandeCompleteArchiveViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la CommandeCompleteArchiveViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getDcomIdProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdProduit de la CommandeCompleteArchiveViewVO
	*/
	public function getDcomIdProduit() {
		return $this->mDcomIdProduit;
	}

	/**
	* @name setDcomIdProduit($pDcomIdProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdProduit de la CommandeCompleteArchiveViewVO par $pDcomIdProduit
	*/
	public function setDcomIdProduit($pDcomIdProduit) {
		$this->mDcomIdProduit = $pDcomIdProduit;
	}

	/**
	* @name getDcomTaille()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomTaille de la CommandeCompleteArchiveViewVO
	*/
	public function getDcomTaille() {
		return $this->mDcomTaille;
	}

	/**
	* @name setDcomTaille($pDcomTaille)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomTaille de la CommandeCompleteArchiveViewVO par $pDcomTaille
	*/
	public function setDcomTaille($pDcomTaille) {
		$this->mDcomTaille = $pDcomTaille;
	}

	/**
	* @name getDcomPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre DcomPrix de la CommandeCompleteArchiveViewVO
	*/
	public function getDcomPrix() {
		return $this->mDcomPrix;
	}

	/**
	* @name setDcomPrix($pDcomPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre DcomPrix de la CommandeCompleteArchiveViewVO par $pDcomPrix
	*/
	public function setDcomPrix($pDcomPrix) {
		$this->mDcomPrix = $pDcomPrix;
	}
}
?>