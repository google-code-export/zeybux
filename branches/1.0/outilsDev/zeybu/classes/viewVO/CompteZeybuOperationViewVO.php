<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2011
// Fichier : CompteZeybuOperationViewVO.php
//
// Description : Classe CompteZeybuOperationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuOperationViewVO
 * @author Julien PIERRE
 * @since 11/08/2011
 * @desc Classe représentant une CompteZeybuOperationViewVO
 */
class CompteZeybuOperationViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeId de la CompteZeybuOperationViewVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la CompteZeybuOperationViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(30)
	* @desc CptLabel de la CompteZeybuOperationViewVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la CompteZeybuOperationViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la CompteZeybuOperationViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc TppType de la CompteZeybuOperationViewVO
	*/
	protected $mTppType;

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la CompteZeybuOperationViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la CompteZeybuOperationViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la CompteZeybuOperationViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la CompteZeybuOperationViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la CompteZeybuOperationViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la CompteZeybuOperationViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la CompteZeybuOperationViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la CompteZeybuOperationViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la CompteZeybuOperationViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la CompteZeybuOperationViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getTppType()
	* @return varchar(100)
	* @desc Renvoie le membre TppType de la CompteZeybuOperationViewVO
	*/
	public function getTppType() {
		return $this->mTppType;
	}

	/**
	* @name setTppType($pTppType)
	* @param varchar(100)
	* @desc Remplace le membre TppType de la CompteZeybuOperationViewVO par $pTppType
	*/
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}

}
?>