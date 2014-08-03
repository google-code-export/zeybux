<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : VirementVO.php
//
// Description : Classe VirementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name VirementVO
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une VirementVO
 */
class VirementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la VirementVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc CptDebit de la VirementVO
	*/
	protected $mCptDebit;

	/**
	* @var int(11)
	* @desc CptCredit de la VirementVO
	*/
	protected $mCptCredit;

	/**
	* @var float(10,2)
	* @desc Montant de la VirementVO
	*/
	protected $mMontant;

	/**
	* @var int(11)
	* @desc Type de la VirementVO
	*/
	protected $mType;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la VirementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la VirementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getCptDebit()
	* @return int(11)
	* @desc Renvoie le membre CptDebit de la VirementVO
	*/
	public function getCptDebit() {
		return $this->mCptDebit;
	}

	/**
	* @name setCptDebit($pCptDebit)
	* @param int(11)
	* @desc Remplace le membre CptDebit de la VirementVO par $pCptDebit
	*/
	public function setCptDebit($pCptDebit) {
		$this->mCptDebit = $pCptDebit;
	}

	/**
	* @name getCptCredit()
	* @return int(11)
	* @desc Renvoie le membre CptCredit de la VirementVO
	*/
	public function getCptCredit() {
		return $this->mCptCredit;
	}

	/**
	* @name setCptCredit($pCptCredit)
	* @param int(11)
	* @desc Remplace le membre CptCredit de la VirementVO par $pCptCredit
	*/
	public function setCptCredit($pCptCredit) {
		$this->mCptCredit = $pCptCredit;
	}

	/**
	* @name getMontant()
	* @return float(10,2)
	* @desc Renvoie le membre Montant de la VirementVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param float(10,2)
	* @desc Remplace le membre Montant de la VirementVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la VirementVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la VirementVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}
}
?>