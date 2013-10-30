<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/08/2013
// Fichier : CompteurVO.php
//
// Description : Classe CompteurVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteurVO
 * @author Julien PIERRE
 * @since 09/08/2013
 * @desc Classe représentant une CompteurVO
 */
class CompteurVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CompteurVO
	*/
	protected $mId;

	/**
	* @var varchar(20)
	* @desc Label de la CompteurVO
	*/
	protected $mLabel;

	/**
	* @var int(11)
	* @desc Valeur de la CompteurVO
	*/
	protected $mValeur;

	/**
	* @var datetime
	* @desc DateCreation de la CompteurVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la CompteurVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la CompteurVO
	*/
	protected $mEtat;

	/**
	 * @name CompteurVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function CompteurVO($pId = null, $pLabel = null, $pValeur = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pValeur)) { $this->mValeur = $pValeur; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CompteurVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CompteurVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(20)
	* @desc Renvoie le membre Label de la CompteurVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(20)
	* @desc Remplace le membre Label de la CompteurVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getValeur()
	* @return int(11)
	* @desc Renvoie le membre Valeur de la CompteurVO
	*/
	public function getValeur() {
		return $this->mValeur;
	}

	/**
	* @name setValeur($pValeur)
	* @param int(11)
	* @desc Remplace le membre Valeur de la CompteurVO par $pValeur
	*/
	public function setValeur($pValeur) {
		$this->mValeur = $pValeur;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la CompteurVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la CompteurVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la CompteurVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la CompteurVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la CompteurVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la CompteurVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>