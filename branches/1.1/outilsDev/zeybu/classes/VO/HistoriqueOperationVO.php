<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : HistoriqueOperationVO.php
//
// Description : Classe HistoriqueOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name HistoriqueOperationVO
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une HistoriqueOperationVO
 */
class HistoriqueOperationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la HistoriqueOperationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdOperation de la HistoriqueOperationVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdCompte de la HistoriqueOperationVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la HistoriqueOperationVO
	*/
	protected $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la HistoriqueOperationVO
	*/
	protected $mLibelle;

	/**
	* @var datetime
	* @desc Date de la HistoriqueOperationVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la HistoriqueOperationVO
	*/
	protected $mTypePaiement;

	/**
	* @var varchar(50)
	* @desc TypePaiementChampComplementaire de la HistoriqueOperationVO
	*/
	protected $mTypePaiementChampComplementaire;

	/**
	* @var int(11)
	* @desc Type de la HistoriqueOperationVO
	*/
	protected $mType;

	/**
	* @var int(11)
	* @desc IdCommande de la HistoriqueOperationVO
	*/
	protected $mIdCommande;

	/**
	* @var int(11)
	* @desc IdConnexion de la HistoriqueOperationVO
	*/
	protected $mIdConnexion;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la HistoriqueOperationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la HistoriqueOperationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la HistoriqueOperationVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la HistoriqueOperationVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la HistoriqueOperationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la HistoriqueOperationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la HistoriqueOperationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la HistoriqueOperationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre Libelle de la HistoriqueOperationVO
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param varchar(100)
	* @desc Remplace le membre Libelle de la HistoriqueOperationVO par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la HistoriqueOperationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la HistoriqueOperationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre TypePaiement de la HistoriqueOperationVO
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param int(11)
	* @desc Remplace le membre TypePaiement de la HistoriqueOperationVO par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre TypePaiementChampComplementaire de la HistoriqueOperationVO
	*/
	public function getTypePaiementChampComplementaire() {
		return $this->mTypePaiementChampComplementaire;
	}

	/**
	* @name setTypePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre TypePaiementChampComplementaire de la HistoriqueOperationVO par $pTypePaiementChampComplementaire
	*/
	public function setTypePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		$this->mTypePaiementChampComplementaire = $pTypePaiementChampComplementaire;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la HistoriqueOperationVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la HistoriqueOperationVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la HistoriqueOperationVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la HistoriqueOperationVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdConnexion()
	* @return int(11)
	* @desc Renvoie le membre IdConnexion de la HistoriqueOperationVO
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param int(11)
	* @desc Remplace le membre IdConnexion de la HistoriqueOperationVO par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}

}
?>