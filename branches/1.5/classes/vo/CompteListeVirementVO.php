<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/07/2013
// Fichier : CompteListeVirementVO.php
//
// Description : Classe CompteListeVirementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteListeVirementVO
 * @author Julien PIERRE
 * @since 27/07/2013
 * @desc Classe représentant une CompteListeVirementVO
 */
class CompteListeVirementVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeId de la CompteListeVirementVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la CompteListeVirementVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(30)
	* @desc CptLabel de la CompteListeVirementVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la CompteListeVirementVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la CompteListeVirementVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la CompteListeVirementVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la CompteListeVirementVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la CompteListeVirementVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la CompteListeVirementVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la CompteListeVirementVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la CompteListeVirementVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la CompteListeVirementVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la CompteListeVirementVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la CompteListeVirementVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la CompteListeVirementVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

}
?>