<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : TypeAdhesionVO.php
//
// Description : Classe TypeAdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TypeAdhesionVO
 * @author Julien PIERRE
 * @since 30/10/2013
 * @desc Classe représentant une TypeAdhesionVO
 */
class TypeAdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la TypeAdhesionVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdAdhesion de la TypeAdhesionVO
	*/
	protected $mIdAdhesion;

	/**
	* @var varchar(45)
	* @desc Label de la TypeAdhesionVO
	*/
	protected $mLabel;

	/**
	* @var int(11)
	* @desc IdPerimetre de la TypeAdhesionVO
	*/
	protected $mIdPerimetre;

	/**
	* @var decimal(10,2)
	* @desc Montant de la TypeAdhesionVO
	*/
	protected $mMontant;

	/**
	* @var datetime
	* @desc DateCreation de la TypeAdhesionVO
	*/
	private $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la TypeAdhesionVO
	*/
	private $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la TypeAdhesionVO
	*/
	private $mEtat;

	/**
	 * @name TypeAdhesionVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function TypeAdhesionVO($pId = null, $pIdAdhesion = null, $pLabel = null, $pIdPerimetre = null, $pMontant = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdAdhesion)) { $this->mIdAdhesion = $pIdAdhesion; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pIdPerimetre)) { $this->mIdPerimetre = $pIdPerimetre; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la TypeAdhesionVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la TypeAdhesionVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdhesion()
	* @return int(11)
	* @desc Renvoie le membre IdAdhesion de la TypeAdhesionVO
	*/
	public function getIdAdhesion() {
		return $this->mIdAdhesion;
	}

	/**
	* @name setIdAdhesion($pIdAdhesion)
	* @param int(11)
	* @desc Remplace le membre IdAdhesion de la TypeAdhesionVO par $pIdAdhesion
	*/
	public function setIdAdhesion($pIdAdhesion) {
		$this->mIdAdhesion = $pIdAdhesion;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la TypeAdhesionVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la TypeAdhesionVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getIdPerimetre()
	* @return int(11)
	* @desc Renvoie le membre IdPerimetre de la TypeAdhesionVO
	*/
	public function getIdPerimetre() {
		return $this->mIdPerimetre;
	}

	/**
	* @name setIdPerimetre($pIdPerimetre)
	* @param int(11)
	* @desc Remplace le membre IdPerimetre de la TypeAdhesionVO par $pIdPerimetre
	*/
	public function setIdPerimetre($pIdPerimetre) {
		$this->mIdPerimetre = $pIdPerimetre;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la TypeAdhesionVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la TypeAdhesionVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la TypeAdhesionVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la TypeAdhesionVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la TypeAdhesionVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la TypeAdhesionVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la TypeAdhesionVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la TypeAdhesionVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}
}
?>