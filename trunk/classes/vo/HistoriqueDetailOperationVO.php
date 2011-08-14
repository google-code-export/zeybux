<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/07/2011
// Fichier : HistoriqueDetailOperationVO.php
//
// Description : Classe HistoriqueDetailOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name HistoriqueDetailOperationVO
 * @author Julien PIERRE
 * @since 12/07/2011
 * @desc Classe représentant une HistoriqueDetailOperationVO
 */
class HistoriqueDetailOperationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la HistoriqueDetailOperationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdDetailOperation de la HistoriqueDetailOperationVO
	*/
	protected $mIdDetailOperation;

	/**
	* @var int(11)
	* @desc IdOperation de la HistoriqueDetailOperationVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdCompte de la HistoriqueDetailOperationVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la HistoriqueDetailOperationVO
	*/
	protected $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la HistoriqueDetailOperationVO
	*/
	protected $mLibelle;

	/**
	* @var datetime
	* @desc Date de la HistoriqueDetailOperationVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la HistoriqueDetailOperationVO
	*/
	protected $mTypePaiement;

	/**
	* @var varchar(50)
	* @desc TypePaiementChampComplementaire de la HistoriqueDetailOperationVO
	*/
	protected $mTypePaiementChampComplementaire;

	/**
	* @var int(11)
	* @desc IdDetailCommande de la HistoriqueDetailOperationVO
	*/
	protected $mIdDetailCommande;

	/**
	* @var int(11)
	* @desc IdConnexion de la HistoriqueDetailOperationVO
	*/
	protected $mIdConnexion;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la HistoriqueDetailOperationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la HistoriqueDetailOperationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la HistoriqueDetailOperationVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la HistoriqueDetailOperationVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la HistoriqueDetailOperationVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la HistoriqueDetailOperationVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la HistoriqueDetailOperationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la HistoriqueDetailOperationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la HistoriqueDetailOperationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la HistoriqueDetailOperationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre Libelle de la HistoriqueDetailOperationVO
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param varchar(100)
	* @desc Remplace le membre Libelle de la HistoriqueDetailOperationVO par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la HistoriqueDetailOperationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la HistoriqueDetailOperationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre TypePaiement de la HistoriqueDetailOperationVO
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param int(11)
	* @desc Remplace le membre TypePaiement de la HistoriqueDetailOperationVO par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre TypePaiementChampComplementaire de la HistoriqueDetailOperationVO
	*/
	public function getTypePaiementChampComplementaire() {
		return $this->mTypePaiementChampComplementaire;
	}

	/**
	* @name setTypePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre TypePaiementChampComplementaire de la HistoriqueDetailOperationVO par $pTypePaiementChampComplementaire
	*/
	public function setTypePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		$this->mTypePaiementChampComplementaire = $pTypePaiementChampComplementaire;
	}

	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la HistoriqueDetailOperationVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la HistoriqueDetailOperationVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

	/**
	* @name getIdConnexion()
	* @return int(11)
	* @desc Renvoie le membre IdConnexion de la HistoriqueDetailOperationVO
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param int(11)
	* @desc Remplace le membre IdConnexion de la HistoriqueDetailOperationVO par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}

}
?>