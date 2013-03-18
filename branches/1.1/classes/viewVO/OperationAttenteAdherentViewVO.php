<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteAdherentViewVO.php
//
// Description : Classe OperationAttenteAdherentViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAttenteAdherentViewVO
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une OperationAttenteAdherentViewVO
 */
class OperationAttenteAdherentViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc AdhId de la OperationAttenteAdherentViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(20)
	* @desc AdhNumero de la OperationAttenteAdherentViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la OperationAttenteAdherentViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la OperationAttenteAdherentViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationAttenteAdherentViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc CptSolde de la OperationAttenteAdherentViewVO
	*/
	protected $mCptSolde;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @var varchar(50)
	* @desc OpeTypePaiementChampComplementaire de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeTypePaiementChampComplementaire;

	/**
	 * @var int(11)
	 * @desc Banque de la OperationAttenteFermeViewVO
	 */
	protected $mOpeIdBanque;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var int(11)
	* @desc OpeId de la OperationAttenteAdherentViewVO
	*/
	protected $mOpeId;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la OperationAttenteAdherentViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la OperationAttenteAdherentViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la OperationAttenteAdherentViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la OperationAttenteAdherentViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la OperationAttenteAdherentViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la OperationAttenteAdherentViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la OperationAttenteAdherentViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la OperationAttenteAdherentViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationAttenteAdherentViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationAttenteAdherentViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptSolde de la OperationAttenteAdherentViewVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre CptSolde de la OperationAttenteAdherentViewVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAttenteAdherentViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAttenteAdherentViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la OperationAttenteAdherentViewVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la OperationAttenteAdherentViewVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAttenteAdherentViewVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAttenteAdherentViewVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}

	/**
	 * @name getOpeIdBanque()
	 * @return int(11)
	 * @desc Renvoie le membre OpeIdBanque de la OperationAttenteFermeViewVO
	 */
	public function getOpeIdBanque() {
		return $this->mOpeIdBanque;
	}
	
	/**
	 * @name setOpeIdBanque($pOpeIdBanque)
	 * @param int(11)
	 * @desc Remplace le membre OpeIdBanque de la OperationAttenteFermeViewVO par $pOpeIdBanque
	 */
	public function setOpeIdBanque($pOpeIdBanque) {
		$this->mOpeIdBanque = $pOpeIdBanque;
	}
	
	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAttenteAdherentViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAttenteAdherentViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAttenteAdherentViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAttenteAdherentViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationAttenteAdherentViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationAttenteAdherentViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

}
?>