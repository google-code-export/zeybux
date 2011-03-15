<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationAvenirViewVO.php
//
// Description : Classe OperationAvenirViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAvenirViewVO
 * @author Julien PIERRE
 * @since 08/09/2010
 * @desc Classe représentant une OperationAvenirViewVO
 */
class OperationAvenirViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeIdCompte de la OperationAvenirViewVO
	*/
	protected $mOpeIdCompte;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAvenirViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAvenirViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAvenirViewVO
	*/
	protected $mOpeDate;
	
	/**
	* @var datetime
	* @desc ComDateMarche de la OperationAvenirViewVO
	*/
	protected $mComDateMarche;
	
	/**
	* @var varchar(100)
	* @desc TppType de la OperationAvenirViewVO
	*/
	protected $mTppType;

	/**
	* @var tinyint(4)
	* @desc TppChampComplementaire de la OperationAvenirViewVO
	*/
	protected $mTppChampComplementaire;

	/**
	* @var varchar(30)
	* @desc TppLabelChampComplementaire de la OperationAvenirViewVO
	*/
	protected $mTppLabelChampComplementaire;

	/**
	* @var varchar(50)
	* @desc OpeTypePaiementChampComplementaire de la OperationAvenirViewVO
	*/
	protected $mOpeTypePaiementChampComplementaire;

	/**
	* @name getOpeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre OpeIdCompte de la OperationAvenirViewVO
	*/
	public function getOpeIdCompte() {
		return $this->mOpeIdCompte;
	}

	/**
	* @name setOpeIdCompte($pOpeIdCompte)
	* @param int(11)
	* @desc Remplace le membre OpeIdCompte de la OperationAvenirViewVO par $pOpeIdCompte
	*/
	public function setOpeIdCompte($pOpeIdCompte) {
		$this->mOpeIdCompte = $pOpeIdCompte;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAvenirViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAvenirViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAvenirViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAvenirViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAvenirViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAvenirViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}
	
	/**
	* @name getComDateMarche()
	* @return datetime
	* @desc Renvoie le membre ComDateMarche de la OperationAvenirViewVO
	*/
	public function getComDateMarche() {
		return $this->mComDateMarche;
	}

	/**
	* @name setComDateMarche($pComDateMarche)
	* @param datetime
	* @desc Remplace le membre ComDateMarche de la OperationAvenirViewVO par $pComDateMarche
	*/
	public function setComDateMarche($pComDateMarche) {
		$this->mComDateMarche = $pComDateMarche;
	}

	/**
	* @name getTppType()
	* @return varchar(100)
	* @desc Renvoie le membre TppType de la OperationAvenirViewVO
	*/
	public function getTppType() {
		return $this->mTppType;
	}

	/**
	* @name setTppType($pTppType)
	* @param varchar(100)
	* @desc Remplace le membre TppType de la OperationAvenirViewVO par $pTppType
	*/
	public function setTppType($pTppType) {
		$this->mTppType = $pTppType;
	}

	/**
	* @name getTppChampComplementaire()
	* @return tinyint(4)
	* @desc Renvoie le membre TppChampComplementaire de la OperationAvenirViewVO
	*/
	public function getTppChampComplementaire() {
		return $this->mTppChampComplementaire;
	}

	/**
	* @name setTppChampComplementaire($pTppChampComplementaire)
	* @param tinyint(4)
	* @desc Remplace le membre TppChampComplementaire de la OperationAvenirViewVO par $pTppChampComplementaire
	*/
	public function setTppChampComplementaire($pTppChampComplementaire) {
		$this->mTppChampComplementaire = $pTppChampComplementaire;
	}

	/**
	* @name getTppLabelChampComplementaire()
	* @return varchar(30)
	* @desc Renvoie le membre TppLabelChampComplementaire de la OperationAvenirViewVO
	*/
	public function getTppLabelChampComplementaire() {
		return $this->mTppLabelChampComplementaire;
	}

	/**
	* @name setTppLabelChampComplementaire($pTppLabelChampComplementaire)
	* @param varchar(30)
	* @desc Remplace le membre TppLabelChampComplementaire de la OperationAvenirViewVO par $pTppLabelChampComplementaire
	*/
	public function setTppLabelChampComplementaire($pTppLabelChampComplementaire) {
		$this->mTppLabelChampComplementaire = $pTppLabelChampComplementaire;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAvenirViewVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAvenirViewVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}
}
?>