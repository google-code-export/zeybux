<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/05/2014
// Fichier : RemiseChequeVO.php
//
// Description : Classe RemiseChequeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name RemiseChequeVO
 * @author Julien PIERRE
 * @since 11/05/2014
 * @desc Classe représentant une RemiseChequeVO
 */
class RemiseChequeVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la RemiseChequeVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc Numero de la RemiseChequeVO
	*/
	protected $mNumero;

	/**
	* @var int(11)
	* @desc IdCompte de la RemiseChequeVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,0)
	* @desc Montant de la RemiseChequeVO
	*/
	protected $mMontant;

	/**
	* @var datetime
	* @desc DateCreation de la RemiseChequeVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la RemiseChequeVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la RemiseChequeVO
	*/
	protected $mEtat;

	/**
	 * @name RemiseChequeVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function RemiseChequeVO($pId = null, $pNumero = null, $pIdCompte = null, $pMontant = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pNumero)) { $this->mNumero = $pNumero; }
		if(!is_null($pIdCompte)) { $this->mIdCompte = $pIdCompte; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la RemiseChequeVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la RemiseChequeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return int(11)
	* @desc Renvoie le membre Numero de la RemiseChequeVO
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param int(11)
	* @desc Remplace le membre Numero de la RemiseChequeVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la RemiseChequeVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la RemiseChequeVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,0)
	* @desc Renvoie le membre Montant de la RemiseChequeVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,0)
	* @desc Remplace le membre Montant de la RemiseChequeVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la RemiseChequeVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la RemiseChequeVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la RemiseChequeVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la RemiseChequeVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la RemiseChequeVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la RemiseChequeVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>