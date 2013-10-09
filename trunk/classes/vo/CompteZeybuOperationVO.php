<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2011
// Fichier : CompteZeybuOperationVO.php
//
// Description : Classe CompteZeybuOperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuOperationVO
 * @author Julien PIERRE
 * @since 11/08/2011
 * @desc Classe représentant une CompteZeybuOperationVO
 */
class CompteZeybuOperationVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeId de la CompteZeybuOperationVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la CompteZeybuOperationVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(30)
	* @desc CptLabel de la CompteZeybuOperationVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la CompteZeybuOperationVO
	*/
	protected $mOpeLibelle;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la CompteZeybuOperationVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc TppType de la CompteZeybuOperationVO
	*/
	protected $mTppType;

	/**
	* @var varchar(50)
	* @desc NumeroCheque de la CompteZeybuOperationVO
	*/
	protected $mNumeroCheque;

	/**
	 * @name CompteZeybuOperationVO()
	 * @desc Le constructeur
	 */
	function CompteZeybuOperationVO($pOpeId = null, $pOpeDate = null, $pCptLabel = null, $pOpeLibelle = null, $pOpeMontant = null, $pTppType = null, $pNumeroCheque = null) {
		if(!is_null($pOpeId)) {$this->mOpeId = $pOpeId; }
		if(!is_null($pOpeDate)) {$this->mOpeDate = $pOpeDate; }
		if(!is_null($pCptLabel)) {$this->mCptLabel = $pCptLabel; }
		if(!is_null($pOpeLibelle)) {$this->mOpeLibelle = $pOpeLibelle; }
		if(!is_null($pOpeMontant)) {$this->mOpeMontant = $pOpeMontant; }
		if(!is_null($pTppType)) {$this->mTppType = $pTppType; }
		if(!is_null($pNumeroCheque)) {$this->mNumeroCheque = $pNumeroCheque; }
	}
	
	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la CompteZeybuOperationVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la CompteZeybuOperationVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la CompteZeybuOperationVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la CompteZeybuOperationVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la CompteZeybuOperationVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la CompteZeybuOperationVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la CompteZeybuOperationVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la CompteZeybuOperationVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la CompteZeybuOperationVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la CompteZeybuOperationVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getTppType()
	* @return varchar(100)
	* @desc Renvoie le membre TppType de la CompteZeybuOperationVO
	*/
	public function getTppType() {
		return $this->mTppType;
	}

	/**
	* @name setTppType($pTppType)
	* @param varchar(100)
	* @desc Remplace le membre TppType de la CompteZeybuOperationVO par $pTppType
	*/
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}

	/**
	* @name getNumeroCheque()
	* @return varchar(50)
	* @desc Renvoie le membre NumeroCheque de la CompteZeybuOperationVO
	*/
	public function getNumeroCheque() {
		return $this->mNumeroCheque;
	}

	/**
	* @name setNumeroCheque($pNumeroCheque)
	* @param varchar(50)
	* @desc Remplace le membre NumeroCheque de la CompteZeybuOperationVO par $pNumeroCheque
	*/
	public function setNumeroCheque($pNumeroCheque) {
		$this->mNumeroCheque = $pNumeroCheque;
	}

}
?>