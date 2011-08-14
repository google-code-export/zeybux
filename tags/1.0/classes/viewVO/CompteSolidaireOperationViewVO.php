<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireOperationViewVO.php
//
// Description : Classe CompteSolidaireOperationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteSolidaireOperationViewVO
 * @author Julien PIERRE
 * @since 02/07/2011
 * @desc Classe représentant une CompteSolidaireOperationViewVO
 */
class CompteSolidaireOperationViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeId de la CompteSolidaireOperationViewVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la CompteSolidaireOperationViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(30)
	* @desc CptLabel de la CompteSolidaireOperationViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la CompteSolidaireOperationViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la CompteSolidaireOperationViewVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la CompteSolidaireOperationViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la CompteSolidaireOperationViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la CompteSolidaireOperationViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la CompteSolidaireOperationViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la CompteSolidaireOperationViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la CompteSolidaireOperationViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la CompteSolidaireOperationViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la CompteSolidaireOperationViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la CompteSolidaireOperationViewVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la CompteSolidaireOperationViewVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

}
?>