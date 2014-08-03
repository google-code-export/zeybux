<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : PerimetreAdhesionVO.php
//
// Description : Classe PerimetreAdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name PerimetreAdhesionVO
 * @author Julien PIERRE
 * @since 30/10/2013
 * @desc Classe représentant une PerimetreAdhesionVO
 */
class PerimetreAdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la PerimetreAdhesionVO
	*/
	protected $mId;

	/**
	* @var varchar(20)
	* @desc Label de la PerimetreAdhesionVO
	*/
	protected $mLabel;

	/**
	* @var datetime
	* @desc DateCreation de la PerimetreAdhesionVO
	*/
	private $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la PerimetreAdhesionVO
	*/
	private $mDateModification;

	/**
	* @var tinyint(4)
	* @desc Etat de la PerimetreAdhesionVO
	*/
	private $mEtat;

	/**
	 * @name PerimetreAdhesionVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function PerimetreAdhesionVO($pId = null, $pLabel = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la PerimetreAdhesionVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la PerimetreAdhesionVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(20)
	* @desc Renvoie le membre Label de la PerimetreAdhesionVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(20)
	* @desc Remplace le membre Label de la PerimetreAdhesionVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la PerimetreAdhesionVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la PerimetreAdhesionVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la PerimetreAdhesionVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la PerimetreAdhesionVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la PerimetreAdhesionVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la PerimetreAdhesionVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>