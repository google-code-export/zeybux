<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2014
// Fichier : OperationRemiseChequeVO.php
//
// Description : Classe OperationRemiseChequeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationRemiseChequeVO
 * @author Julien PIERRE
 * @since 04/05/2014
 * @desc Classe représentant une OperationRemiseChequeVO
 */
class OperationRemiseChequeVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdRemiseCheque de la OperationRemiseChequeVO
	*/
	protected $mIdRemiseCheque;

	/**
	* @var int(11)
	* @desc IdOperation de la OperationRemiseChequeVO
	*/
	protected $mIdOperation;

	/**
	* @var datetime
	* @desc DateCreation de la OperationRemiseChequeVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la OperationRemiseChequeVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la OperationRemiseChequeVO
	*/
	protected $mEtat;

	/**
	 * @name OperationRemiseChequeVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationRemiseChequeVO($pIdRemiseCheque = null, $pIdOperation = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pIdRemiseCheque)) { $this->mIdRemiseCheque = $pIdRemiseCheque; }
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getIdRemiseCheque()
	* @return int(11)
	* @desc Renvoie le membre IdRemiseCheque de la OperationRemiseChequeVO
	*/
	public function getIdRemiseCheque() {
		return $this->mIdRemiseCheque;
	}

	/**
	* @name setIdRemiseCheque($pIdRemiseCheque)
	* @param int(11)
	* @desc Remplace le membre IdRemiseCheque de la OperationRemiseChequeVO par $pIdRemiseCheque
	*/
	public function setIdRemiseCheque($pIdRemiseCheque) {
		$this->mIdRemiseCheque = $pIdRemiseCheque;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la OperationRemiseChequeVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la OperationRemiseChequeVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la OperationRemiseChequeVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la OperationRemiseChequeVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la OperationRemiseChequeVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la OperationRemiseChequeVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la OperationRemiseChequeVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la OperationRemiseChequeVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>