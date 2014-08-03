<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2013
// Fichier : TypeAdhesionDetailVO.php
//
// Description : Classe TypeAdhesionDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "TypeAdhesionVO.php");

/**
 * @name TypeAdhesionDetailVO
 * @author Julien PIERRE
 * @since 02/11/2013
 * @desc Classe représentant une TypeAdhesionDetailVO
 */
class TypeAdhesionDetailVO  extends TypeAdhesionVO
{
	/**
	* @var int(11)
	* @desc Id de la TypeAdhesionDetailVO
	*/
	protected $mPerId;

	/**
	* @var varchar(20)
	* @desc Label de la TypeAdhesionDetailVO
	*/
	protected $mPerLabel;

	/**
	* @var datetime
	* @desc DateCreation de la TypeAdhesionDetailVO
	*/
	private $mPerDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la TypeAdhesionDetailVO
	*/
	private $mPerDateModification;

	/**
	* @var tinyint(4)
	* @desc Etat de la TypeAdhesionDetailVO
	*/
	private $mPerEtat;

	/**
	 * @name TypeAdhesionDetailVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function TypeAdhesionDetailVO($pId = null, $pIdAdhesion = null, $pLabel = null, $pIdPerimetre = null, $pMontant = null, $pDateCreation = null, $pDateModification = null, $pEtat = null,
			$pPerId = null, $pPerLabel = null, $pPerDateCreation = null, $pPerDateModification = null, $pPerEtat = null) {
		parent::__construct($pId, $pIdAdhesion, $pLabel, $pIdPerimetre, $pMontant, $pDateCreation, $pDateModification, $pEtat);
		
		if(!is_null($pPerId)) { $this->mPerId = $pPerId; }
		if(!is_null($pPerLabel)) { $this->mPerLabel = $pPerLabel; }
		if(!is_null($pPerDateCreation)) { $this->mPerDateCreation = $pPerDateCreation; }
		if(!is_null($pPerDateModification)) { $this->mPerDateModification = $pPerDateModification; }
		if(!is_null($pPerEtat)) { $this->mPerEtat = $pPerEtat; }
	}

	/**
	* @name getPerId()
	* @return int(11)
	* @desc Renvoie le membre PerId de la PerimetreAdhesionVO
	*/
	public function getPerId() {
		return $this->mPerId;
	}

	/**
	* @name setPerId($pPerId)
	* @param int(11)
	* @desc Remplace le membre PerId de la PerimetreAdhesionVO par $pPerId
	*/
	public function setPerId($pPerId) {
		$this->mPerId = $pPerId;
	}

	/**
	* @name getPerLabel()
	* @return varchar(20)
	* @desc Renvoie le membre PerLabel de la PerimetreAdhesionVO
	*/
	public function getPerLabel() {
		return $this->mPerLabel;
	}

	/**
	* @name setPerLabel($pPerLabel)
	* @param varchar(20)
	* @desc Remplace le membre PerLabel de la PerimetreAdhesionVO par $pPerLabel
	*/
	public function setPerLabel($pPerLabel) {
		$this->mPerLabel = $pPerLabel;
	}

	/**
	* @name getPerDateCreation()
	* @return datetime
	* @desc Renvoie le membre PerDateCreation de la PerimetreAdhesionVO
	*/
	public function getPerDateCreation() {
		return $this->mPerDateCreation;
	}

	/**
	* @name setPerDateCreation($pPerDateCreation)
	* @param datetime
	* @desc Remplace le membre PerDateCreation de la PerimetreAdhesionVO par $pPerDateCreation
	*/
	public function setPerDateCreation($pPerDateCreation) {
		$this->mPerDateCreation = $pPerDateCreation;
	}

	/**
	* @name getPerDateModification()
	* @return datetime
	* @desc Renvoie le membre PerDateModification de la PerimetreAdhesionVO
	*/
	public function getPerDateModification() {
		return $this->mPerDateModification;
	}

	/**
	* @name setPerDateModification($pPerDateModification)
	* @param datetime
	* @desc Remplace le membre PerDateModification de la PerimetreAdhesionVO par $pPerDateModification
	*/
	public function setPerDateModification($pPerDateModification) {
		$this->mPerDateModification = $pPerDateModification;
	}

	/**
	* @name getPerEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre PerEtat de la PerimetreAdhesionVO
	*/
	public function getPerEtat() {
		return $this->mPerEtat;
	}

	/**
	* @name setPerEtat($pPerEtat)
	* @param tinyint(4)
	* @desc Remplace le membre PerEtat de la PerimetreAdhesionVO par $pPerEtat
	*/
	public function setPerEtat($pPerEtat) {
		$this->mPerEtat = $pPerEtat;
	}
}
?>