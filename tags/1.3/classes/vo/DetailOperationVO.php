<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/07/2013
// Fichier : DetailOperationVO.php
//
// Description : Classe DetailOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailOperationVO
 * @author Julien PIERRE
 * @since 25/07/2013
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
	* @var int(11)
	* @desc IdDetailCommande de la DetailOperationVO
	*/
	protected $mIdDetailCommande;

	/**
	* @var int(11)
	* @desc IdModeleLot de la DetailOperationVO
	*/
	protected $mIdModeleLot;

	/**
	* @var int(11)
	* @desc IdNomProduit de la DetailOperationVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdConnexion de la DetailOperationVO
	*/
	protected $mIdConnexion;
	
	/**
	 * @name DetailOperationVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function DetailOperationVO($pId = null, $pIdOperation = null, $pIdCompte = null, $pMontant = null, $pLibelle = null, $pDate = null, $pTypePaiement = null, $pIdDetailCommande = null, $pIdModeleLot = null, $pIdNomProduit = null, $pIdConnexion = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdOperation)) {$this->mIdOperation = $pIdOperation; }
		if(!is_null($pIdCompte)) {$this->mIdCompte = $pIdCompte; }
		if(!is_null($pMontant)) {$this->mMontant = $pMontant; }
		if(!is_null($pLibelle)) {$this->mLibelle = $pLibelle; }
		if(!is_null($pDate)) {$this->mDate = $pDate; }
		if(!is_null($pTypePaiement)) {$this->mTypePaiement = $pTypePaiement; }
		if(!is_null($pIdDetailCommande)) {$this->mIdDetailCommande = $pIdDetailCommande; }
		if(!is_null($pIdModeleLot)) {$this->mIdModeleLot = $pIdModeleLot; }
		if(!is_null($pIdNomProduit)) {$this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdConnexion)) {$this->mIdConnexion = $pIdConnexion; }
	}

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
	* @name getIdModeleLot()
	* @return int(11)
	* @desc Renvoie le membre IdModeleLot de la DetailOperationVO
	*/
	public function getIdModeleLot() {
		return $this->mIdModeleLot;
	}

	/**
	* @name setIdModeleLot($pIdModeleLot)
	* @param int(11)
	* @desc Remplace le membre IdModeleLot de la DetailOperationVO par $pIdModeleLot
	*/
	public function setIdModeleLot($pIdModeleLot) {
		$this->mIdModeleLot = $pIdModeleLot;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la DetailOperationVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la DetailOperationVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
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