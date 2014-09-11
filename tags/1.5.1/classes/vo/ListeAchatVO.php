<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : ListeAchatVO.php
//
// Description : Classe ListeAchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAchatVO
 * @author Julien PIERRE
 * @since 08/09/2013
 * @desc Classe représentant une ListeAchatVO
 */
class ListeAchatVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeId de la ListeAchatVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la ListeAchatVO
	*/
	protected $mOpeDate;

	/**
	* @var int(11)
	* @desc ComNumero de la ListeAchatVO
	*/
	protected $mComNumero;

	/**
	* @var int(11)
	* @desc AdhId de la ListeAchatVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAchatVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAchatVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(20)
	* @desc AdhNumero de la ListeAchatVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeAchatVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la ListeAchatVO
	*/
	protected $mOpeMontant;

	/**
	 * @name ListeAchatVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeAchatVO($pOpeId = null, $pOpeDate = null, $pComNumero = null, $pAdhId = null, $pAdhNom = null, $pAdhPrenom = null, $pAdhNumero = null, $pCptLabel = null, $pOpeMontant = null) {
		if(!is_null($pOpeId)) { $this->mOpeId = $pOpeId; }
		if(!is_null($pOpeDate)) { $this->mOpeDate = $pOpeDate; }
		if(!is_null($pComNumero)) { $this->mComNumero = $pComNumero; }
		if(!is_null($pAdhId)) { $this->mAdhId = $pAdhId; }
		if(!is_null($pAdhNom)) { $this->mAdhNom = $pAdhNom; }
		if(!is_null($pAdhPrenom)) { $this->mAdhPrenom = $pAdhPrenom; }
		if(!is_null($pAdhNumero)) { $this->mAdhNumero = $pAdhNumero; }
		if(!is_null($pCptLabel)) { $this->mCptLabel = $pCptLabel; }
		if(!is_null($pOpeMontant)) { $this->mOpeMontant = $pOpeMontant; }
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la ListeAchatVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la ListeAchatVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return OpeDatetime
	* @desc Renvoie le membre OpeDate de la ListeAchatVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param OpeDatetime
	* @desc Remplace le membre OpeDate de la ListeAchatVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeAchatVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeAchatVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAchatVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAchatVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAchatVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAchatVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAchatVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAchatVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la ListeAchatVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la ListeAchatVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeAchatVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeAchatVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la ListeAchatVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la ListeAchatVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

}
?>