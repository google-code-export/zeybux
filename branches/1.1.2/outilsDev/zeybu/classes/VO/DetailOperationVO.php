<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/07/2011
// Fichier : DetailOperationVO.php
//
// Description : Classe DetailOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailOperationVO
 * @author Julien PIERRE
 * @since 10/07/2011
 * @desc Classe représentant une DetailOperationVO
 */
class DetailOperationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la DetailOperationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdOperation de la DetailOperationVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdCompte de la DetailOperationVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la DetailOperationVO
	*/
	protected $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la DetailOperationVO
	*/
	protected $mLibelle;

	/**
	* @var datetime
	* @desc Date de la DetailOperationVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la DetailOperationVO
	*/
	protected $mTypePaiement;

	/**
	* @var varchar(50)
	* @desc TypePaiementChampComplementaire de la DetailOperationVO
	*/
	protected $mTypePaiementChampComplementaire;

	/**
	* @var int(11)
	* @desc IdDetailCommande de la DetailOperationVO
	*/
	protected $mIdDetailCommande;

	/**
	* @var int(11)
	* @desc IdConnexion de la DetailOperationVO
	*/
	protected $mIdConnexion;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la DetailOperationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la DetailOperationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la DetailOperationVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la DetailOperationVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la DetailOperationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la DetailOperationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la DetailOperationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la DetailOperationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre Libelle de la DetailOperationVO
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param varchar(100)
	* @desc Remplace le membre Libelle de la DetailOperationVO par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la DetailOperationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la DetailOperationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre TypePaiement de la DetailOperationVO
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param int(11)
	* @desc Remplace le membre TypePaiement de la DetailOperationVO par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre TypePaiementChampComplementaire de la DetailOperationVO
	*/
	public function getTypePaiementChampComplementaire() {
		return $this->mTypePaiementChampComplementaire;
	}

	/**
	* @name setTypePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre TypePaiementChampComplementaire de la DetailOperationVO par $pTypePaiementChampComplementaire
	*/
	public function setTypePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		$this->mTypePaiementChampComplementaire = $pTypePaiementChampComplementaire;
	}

	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la DetailOperationVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la DetailOperationVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

	/**
	* @name getIdConnexion()
	* @return int(11)
	* @desc Renvoie le membre IdConnexion de la DetailOperationVO
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param int(11)
	* @desc Remplace le membre IdConnexion de la DetailOperationVO par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}

}
?>