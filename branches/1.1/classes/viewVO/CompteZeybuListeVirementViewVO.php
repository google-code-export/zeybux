<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2011
// Fichier : CompteZeybuListeVirementViewVO.php
//
// Description : Classe CompteZeybuListeVirementViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteZeybuListeVirementViewVO
 * @author Julien PIERRE
 * @since 02/07/2011
 * @desc Classe représentant une CompteZeybuListeVirementViewVO
 */
class CompteZeybuListeVirementViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeId de la CompteZeybuListeVirementViewVO
	*/
	protected $mOpeId;

	/**
	* @var datetime
	* @desc OpeDate de la CompteZeybuListeVirementViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(30)
	* @desc CptLabel de la CompteZeybuListeVirementViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la CompteZeybuListeVirementViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la CompteZeybuListeVirementViewVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la CompteZeybuListeVirementViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la CompteZeybuListeVirementViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la CompteZeybuListeVirementViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la CompteZeybuListeVirementViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la CompteZeybuListeVirementViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la CompteZeybuListeVirementViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la CompteZeybuListeVirementViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la CompteZeybuListeVirementViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la CompteZeybuListeVirementViewVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la CompteZeybuListeVirementViewVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

}
?>