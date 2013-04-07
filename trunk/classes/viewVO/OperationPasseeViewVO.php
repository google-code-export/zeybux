<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationPasseeViewVO.php
//
// Description : Classe OperationPasseeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationPasseeViewVO
 * @author Julien PIERRE
 * @since 08/09/2010
 * @desc Classe représentant une OperationPasseeViewVO
 */
class OperationPasseeViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeIdCompte de la OperationPasseeViewVO
	*/
	protected $mOpeIdCompte;
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationPasseeViewVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationPasseeViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationPasseeViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var datetime
	* @desc OpeDate de la OperationPasseeViewVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc TppType de la OperationPasseeViewVO
	*/
	protected $mTppType;

	/**
	* @var tinyint(4)
	* @desc TppChampComplementaire de la OperationPasseeViewVO
	*/
	protected $mTppChampComplementaire;

	/**
	* @var varchar(30)
	* @desc TppLabelChampComplementaire de la OperationPasseeViewVO
	*/
	protected $mTppLabelChampComplementaire;

	/**
	* @var varchar(50)
	* @desc OpeTypePaiementChampComplementaire de la OperationPasseeViewVO
	*/
	protected $mOpeTypePaiementChampComplementaire;
	
	/**
	 * @var int(11)
	 * @desc TppId de la OperationPasseeViewVO
	 */
	protected $mTppId;

	/**
	* @name getOpeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre OpeIdCompte de la OperationPasseeViewVO
	*/
	public function getOpeIdCompte() {
		return $this->mOpeIdCompte;
	}

	/**
	* @name setOpeIdCompte($pOpeIdCompte)
	* @param int(11)
	* @desc Remplace le membre OpeIdCompte de la OperationPasseeViewVO par $pOpeIdCompte
	*/
	public function setOpeIdCompte($pOpeIdCompte) {
		$this->mOpeIdCompte = $pOpeIdCompte;
	}
	
	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationPasseeViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationPasseeViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationPasseeViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationPasseeViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationPasseeViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationPasseeViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationPasseeViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationPasseeViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getTppType()
	* @return varchar(100)
	* @desc Renvoie le membre TppType de la OperationPasseeViewVO
	*/
	public function getTppType() {
		return $this->mTppType;
	}

	/**
	* @name setTppType($pTppType)
	* @param varchar(100)
	* @desc Remplace le membre TppType de la OperationPasseeViewVO par $pTppType
	*/
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}

	/**
	* @name getTppChampComplementaire()
	* @return tinyint(4)
	* @desc Renvoie le membre TppChampComplementaire de la OperationPasseeViewVO
	*/
	public function getTppChampComplementaire() {
		return $this->mTppChampComplementaire;
	}

	/**
	* @name setTppChampComplementaire($pTppChampComplementaire)
	* @param tinyint(4)
	* @desc Remplace le membre TppChampComplementaire de la OperationPasseeViewVO par $pTppChampComplementaire
	*/
	public function setTppChampComplementaire($pTppChampComplementaire) {
		$this->mTppChampComplementaire = $pTppChampComplementaire;
	}

	/**
	* @name getTppLabelChampComplementaire()
	* @return varchar(30)
	* @desc Renvoie le membre TppLabelChampComplementaire de la OperationPasseeViewVO
	*/
	public function getTppLabelChampComplementaire() {
		return $this->mTppLabelChampComplementaire;
	}

	/**
	* @name setTppLabelChampComplementaire($pTppLabelChampComplementaire)
	* @param varchar(30)
	* @desc Remplace le membre TppLabelChampComplementaire de la OperationPasseeViewVO par $pTppLabelChampComplementaire
	*/
	public function setTppLabelChampComplementaire($pTppLabelChampComplementaire) {
		$this->mTppLabelChampComplementaire = $pTppLabelChampComplementaire;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationPasseeViewVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationPasseeViewVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}
	
	/**
	 * @name getTppId()
	 * @return int(11)
	 * @desc Renvoie le membre TppId de la OperationPasseeViewVO
	 */
	public function getTppId() {
		return $this->mTppId;
	}
	
	/**
	 * @name setTppId($pTppId)
	 * @param int(11)
	 * @desc Remplace le membre TppId de la OperationPasseeViewVO par $pTppId
	 */
	public function setTppId($pTppId) {
		$this->mTppId = $pTppId;
	}
}
?>