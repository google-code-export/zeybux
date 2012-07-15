<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteFermeViewVO.php
//
// Description : Classe OperationAttenteFermeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAttenteFermeViewVO
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une OperationAttenteFermeViewVO
 */
class OperationAttenteFermeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc FerId de la OperationAttenteFermeViewVO
	*/
	protected $mFerId;

	/**
	* @var varchar(20)
	* @desc FerNumero de la OperationAttenteFermeViewVO
	*/
	protected $mFerNumero;

	/**
	* @var varchar(50)
	* @desc FerNom de la OperationAttenteFermeViewVO
	*/
	protected $mFerNom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationAttenteFermeViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc CptSolde de la OperationAttenteFermeViewVO
	*/
	protected $mCptSolde;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAttenteFermeViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la OperationAttenteFermeViewVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @var varchar(50)
	* @desc OpeTypePaiementChampComplementaire de la OperationAttenteFermeViewVO
	*/
	protected $mOpeTypePaiementChampComplementaire;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAttenteFermeViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAttenteFermeViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var int(11)
	* @desc OpeId de la OperationAttenteFermeViewVO
	*/
	protected $mOpeId;

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la OperationAttenteFermeViewVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la OperationAttenteFermeViewVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return varchar(20)
	* @desc Renvoie le membre FerNumero de la OperationAttenteFermeViewVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param varchar(20)
	* @desc Remplace le membre FerNumero de la OperationAttenteFermeViewVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getFerNom()
	* @return varchar(50)
	* @desc Renvoie le membre FerNom de la OperationAttenteFermeViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param varchar(50)
	* @desc Remplace le membre FerNom de la OperationAttenteFermeViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationAttenteFermeViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationAttenteFermeViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptSolde de la OperationAttenteFermeViewVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre CptSolde de la OperationAttenteFermeViewVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAttenteFermeViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAttenteFermeViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la OperationAttenteFermeViewVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la OperationAttenteFermeViewVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAttenteFermeViewVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAttenteFermeViewVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAttenteFermeViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAttenteFermeViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAttenteFermeViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAttenteFermeViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationAttenteFermeViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationAttenteFermeViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

}
?>