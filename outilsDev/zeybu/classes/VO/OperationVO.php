<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/07/2012
// Fichier : OperationVO.php
//
// Description : Classe OperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationVO
 * @author Julien PIERRE
 * @since 15/07/2012
 * @desc Classe représentant une OperationVO
 */
class OperationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la OperationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la OperationVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la OperationVO
	*/
	protected $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la OperationVO
	*/
	protected $mLibelle;

	/**
	* @var datetime
	* @desc Date de la OperationVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la OperationVO
	*/
	protected $mTypePaiement;

	/**
	* @var varchar(50)
	* @desc TypePaiementChampComplementaire de la OperationVO
	*/
	protected $mTypePaiementChampComplementaire;

	/**
	* @var int(11)
	* @desc Type de la OperationVO
	*/
	protected $mType;

	/**
	* @var int(11)
	* @desc IdCommande de la OperationVO
	*/
	protected $mIdCommande;

	/**
	* @var int(11)
	* @desc IdBanque de la OperationVO
	*/
	protected $mIdBanque;

	/**
	* @var datetime
	* @desc DateMaj de la OperationVO
	*/
	protected $mDateMaj;

	/**
	* @var int(11)
	* @desc IdLogin de la OperationVO
	*/
	protected $mIdLogin;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la OperationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la OperationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la OperationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la OperationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la OperationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la OperationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre Libelle de la OperationVO
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param varchar(100)
	* @desc Remplace le membre Libelle de la OperationVO par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la OperationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la OperationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre TypePaiement de la OperationVO
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param int(11)
	* @desc Remplace le membre TypePaiement de la OperationVO par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre TypePaiementChampComplementaire de la OperationVO
	*/
	public function getTypePaiementChampComplementaire() {
		return $this->mTypePaiementChampComplementaire;
	}

	/**
	* @name setTypePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre TypePaiementChampComplementaire de la OperationVO par $pTypePaiementChampComplementaire
	*/
	public function setTypePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		$this->mTypePaiementChampComplementaire = $pTypePaiementChampComplementaire;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la OperationVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la OperationVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la OperationVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la OperationVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdBanque()
	* @return int(11)
	* @desc Renvoie le membre IdBanque de la OperationVO
	*/
	public function getIdBanque() {
		return $this->mIdBanque;
	}

	/**
	* @name setIdBanque($pIdBanque)
	* @param int(11)
	* @desc Remplace le membre IdBanque de la OperationVO par $pIdBanque
	*/
	public function setIdBanque($pIdBanque) {
		$this->mIdBanque = $pIdBanque;
	}

	/**
	* @name getDateMaj()
	* @return datetime
	* @desc Renvoie le membre DateMaj de la OperationVO
	*/
	public function getDateMaj() {
		return $this->mDateMaj;
	}

	/**
	* @name setDateMaj($pDateMaj)
	* @param datetime
	* @desc Remplace le membre DateMaj de la OperationVO par $pDateMaj
	*/
	public function setDateMaj($pDateMaj) {
		$this->mDateMaj = $pDateMaj;
	}

	/**
	* @name getIdLogin()
	* @return int(11)
	* @desc Renvoie le membre IdLogin de la OperationVO
	*/
	public function getIdLogin() {
		return $this->mIdLogin;
	}

	/**
	* @name setIdLogin($pIdLogin)
	* @param int(11)
	* @desc Remplace le membre IdLogin de la OperationVO par $pIdLogin
	*/
	public function setIdLogin($pIdLogin) {
		$this->mIdLogin = $pIdLogin;
	}

}
?>