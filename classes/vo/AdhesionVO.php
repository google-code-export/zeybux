<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : AdhesionVO.php
//
// Description : Classe AdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionVO
 * @author Julien PIERRE
 * @since 30/10/2013
 * @desc Classe représentant une AdhesionVO
 */
class AdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AdhesionVO
	*/
	protected $mId;

	/**
	* @var varchar(45)
	* @desc Label de la AdhesionVO
	*/
	protected $mLabel;

	/**
	* @var datetime
	* @desc DateDebut de la AdhesionVO
	*/
	protected $mDateDebut;

	/**
	* @var datetime
	* @desc DateFin de la AdhesionVO
	*/
	protected $mDateFin;

	/**
	* @var datetime
	* @desc DateCreation de la AdhesionVO
	*/
	private $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la AdhesionVO
	*/
	private $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la AdhesionVO
	*/
	private $mEtat;

	/**
	 * @name AdhesionVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionVO($pId = null, $pLabel = null, $pDateDebut = null, $pDateFin = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pDateDebut)) { $this->mDateDebut = $pDateDebut; }
		if(!is_null($pDateFin)) { $this->mDateFin = $pDateFin; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdhesionVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdhesionVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la AdhesionVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la AdhesionVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getDateDebut()
	* @return datetime
	* @desc Renvoie le membre DateDebut de la AdhesionVO
	*/
	public function getDateDebut() {
		return $this->mDateDebut;
	}

	/**
	* @name setDateDebut($pDateDebut)
	* @param datetime
	* @desc Remplace le membre DateDebut de la AdhesionVO par $pDateDebut
	*/
	public function setDateDebut($pDateDebut) {
		$this->mDateDebut = $pDateDebut;
	}

	/**
	* @name getDateFin()
	* @return datetime
	* @desc Renvoie le membre DateFin de la AdhesionVO
	*/
	public function getDateFin() {
		return $this->mDateFin;
	}

	/**
	* @name setDateFin($pDateFin)
	* @param datetime
	* @desc Remplace le membre DateFin de la AdhesionVO par $pDateFin
	*/
	public function setDateFin($pDateFin) {
		$this->mDateFin = $pDateFin;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la AdhesionVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la AdhesionVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la AdhesionVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la AdhesionVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la AdhesionVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la AdhesionVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>