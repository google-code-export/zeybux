<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteViewVO.php
//
// Description : Classe OperationAttenteViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAttenteViewVO
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une OperationAttenteViewVO
 */
class OperationAttenteViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc AdhId de la OperationAttenteViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(20)
	* @desc AdhNumero de la OperationAttenteViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la OperationAttenteViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la OperationAttenteViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationAttenteViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc CptSolde de la OperationAttenteViewVO
	*/
	protected $mCptSolde;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAttenteViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la OperationAttenteViewVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @var varchar(50)
	* @desc OpeTypePaiementChampComplementaire de la OperationAttenteViewVO
	*/
	protected $mOpeTypePaiementChampComplementaire;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAttenteViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAttenteViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var int(11)
	* @desc OpeId de la OperationAttenteViewVO
	*/
	protected $mOpeId;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la OperationAttenteViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la OperationAttenteViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la OperationAttenteViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la OperationAttenteViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la OperationAttenteViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la OperationAttenteViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la OperationAttenteViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la OperationAttenteViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationAttenteViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationAttenteViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptSolde de la OperationAttenteViewVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre CptSolde de la OperationAttenteViewVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAttenteViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAttenteViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la OperationAttenteViewVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la OperationAttenteViewVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAttenteViewVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAttenteViewVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAttenteViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAttenteViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAttenteViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAttenteViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationAttenteViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationAttenteViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

}
?>