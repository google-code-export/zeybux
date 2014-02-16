<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2014
// Fichier : ParametreVO.php
//
// Description : Classe ParametreVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ParametreVO
 * @author Julien PIERRE
 * @since 15/02/2014
 * @desc Classe représentant une ParametreVO
 */
class ParametreVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ParametreVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc Label de la ParametreVO
	*/
	protected $mLabel;

	/**
	* @var varchar(50)
	* @desc IntLabel de la ParametreVO
	*/
	protected $mIntLabel;

	/**
	* @var int(11)
	* @desc IntValeur de la ParametreVO
	*/
	protected $mIntValeur;

	/**
	* @var varchar(50)
	* @desc DecimalLabel de la ParametreVO
	*/
	protected $mDecimalLabel;

	/**
	* @var decimal(10,2)
	* @desc DecimalValeur de la ParametreVO
	*/
	protected $mDecimalValeur;

	/**
	* @var varchar(50)
	* @desc VarcharLabel de la ParametreVO
	*/
	protected $mVarcharLabel;

	/**
	* @var varchar(50)
	* @desc VarcharValeur de la ParametreVO
	*/
	protected $mVarcharValeur;

	/**
	* @var varchar(50)
	* @desc DateLabel de la ParametreVO
	*/
	protected $mDateLabel;

	/**
	* @var datetime
	* @desc DateValeur de la ParametreVO
	*/
	protected $mDateValeur;

	/**
	* @var varchar(50)
	* @desc TextLabel de la ParametreVO
	*/
	protected $mTextLabel;

	/**
	* @var text
	* @desc TextValeur de la ParametreVO
	*/
	protected $mTextValeur;

	/**
	* @var datetime
	* @desc DateCreation de la ParametreVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la ParametreVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la ParametreVO
	*/
	protected $mEtat;

	/**
	 * @name ParametreVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ParametreVO($pId = null, $pLabel = null, $pIntLabel = null, $pIntValeur = null, $pDecimalLabel = null, $pDecimalValeur = null, $pVarcharLabel = null, $pVarcharValeur = null, $pDateLabel = null, $pDateValeur = null, $pTextLabel = null, $pTextValeur = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pIntLabel)) { $this->mIntLabel = $pIntLabel; }
		if(!is_null($pIntValeur)) { $this->mIntValeur = $pIntValeur; }
		if(!is_null($pDecimalLabel)) { $this->mDecimalLabel = $pDecimalLabel; }
		if(!is_null($pDecimalValeur)) { $this->mDecimalValeur = $pDecimalValeur; }
		if(!is_null($pVarcharLabel)) { $this->mVarcharLabel = $pVarcharLabel; }
		if(!is_null($pVarcharValeur)) { $this->mVarcharValeur = $pVarcharValeur; }
		if(!is_null($pDateLabel)) { $this->mDateLabel = $pDateLabel; }
		if(!is_null($pDateValeur)) { $this->mDateValeur = $pDateValeur; }
		if(!is_null($pTextLabel)) { $this->mTextLabel = $pTextLabel; }
		if(!is_null($pTextValeur)) { $this->mTextValeur = $pTextValeur; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ParametreVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ParametreVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(50)
	* @desc Renvoie le membre Label de la ParametreVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(50)
	* @desc Remplace le membre Label de la ParametreVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getIntLabel()
	* @return varchar(50)
	* @desc Renvoie le membre IntLabel de la ParametreVO
	*/
	public function getIntLabel() {
		return $this->mIntLabel;
	}

	/**
	* @name setIntLabel($pIntLabel)
	* @param varchar(50)
	* @desc Remplace le membre IntLabel de la ParametreVO par $pIntLabel
	*/
	public function setIntLabel($pIntLabel) {
		$this->mIntLabel = $pIntLabel;
	}

	/**
	* @name getIntValeur()
	* @return int(11)
	* @desc Renvoie le membre IntValeur de la ParametreVO
	*/
	public function getIntValeur() {
		return $this->mIntValeur;
	}

	/**
	* @name setIntValeur($pIntValeur)
	* @param int(11)
	* @desc Remplace le membre IntValeur de la ParametreVO par $pIntValeur
	*/
	public function setIntValeur($pIntValeur) {
		$this->mIntValeur = $pIntValeur;
	}

	/**
	* @name getDecimalLabel()
	* @return varchar(50)
	* @desc Renvoie le membre DecimalLabel de la ParametreVO
	*/
	public function getDecimalLabel() {
		return $this->mDecimalLabel;
	}

	/**
	* @name setDecimalLabel($pDecimalLabel)
	* @param varchar(50)
	* @desc Remplace le membre DecimalLabel de la ParametreVO par $pDecimalLabel
	*/
	public function setDecimalLabel($pDecimalLabel) {
		$this->mDecimalLabel = $pDecimalLabel;
	}

	/**
	* @name getDecimalValeur()
	* @return decimal(10,2)
	* @desc Renvoie le membre DecimalValeur de la ParametreVO
	*/
	public function getDecimalValeur() {
		return $this->mDecimalValeur;
	}

	/**
	* @name setDecimalValeur($pDecimalValeur)
	* @param decimal(10,2)
	* @desc Remplace le membre DecimalValeur de la ParametreVO par $pDecimalValeur
	*/
	public function setDecimalValeur($pDecimalValeur) {
		$this->mDecimalValeur = $pDecimalValeur;
	}

	/**
	* @name getVarcharLabel()
	* @return varchar(50)
	* @desc Renvoie le membre VarcharLabel de la ParametreVO
	*/
	public function getVarcharLabel() {
		return $this->mVarcharLabel;
	}

	/**
	* @name setVarcharLabel($pVarcharLabel)
	* @param varchar(50)
	* @desc Remplace le membre VarcharLabel de la ParametreVO par $pVarcharLabel
	*/
	public function setVarcharLabel($pVarcharLabel) {
		$this->mVarcharLabel = $pVarcharLabel;
	}

	/**
	* @name getVarcharValeur()
	* @return varchar(50)
	* @desc Renvoie le membre VarcharValeur de la ParametreVO
	*/
	public function getVarcharValeur() {
		return $this->mVarcharValeur;
	}

	/**
	* @name setVarcharValeur($pVarcharValeur)
	* @param varchar(50)
	* @desc Remplace le membre VarcharValeur de la ParametreVO par $pVarcharValeur
	*/
	public function setVarcharValeur($pVarcharValeur) {
		$this->mVarcharValeur = $pVarcharValeur;
	}

	/**
	* @name getDateLabel()
	* @return varchar(50)
	* @desc Renvoie le membre DateLabel de la ParametreVO
	*/
	public function getDateLabel() {
		return $this->mDateLabel;
	}

	/**
	* @name setDateLabel($pDateLabel)
	* @param varchar(50)
	* @desc Remplace le membre DateLabel de la ParametreVO par $pDateLabel
	*/
	public function setDateLabel($pDateLabel) {
		$this->mDateLabel = $pDateLabel;
	}

	/**
	* @name getDateValeur()
	* @return datetime
	* @desc Renvoie le membre DateValeur de la ParametreVO
	*/
	public function getDateValeur() {
		return $this->mDateValeur;
	}

	/**
	* @name setDateValeur($pDateValeur)
	* @param datetime
	* @desc Remplace le membre DateValeur de la ParametreVO par $pDateValeur
	*/
	public function setDateValeur($pDateValeur) {
		$this->mDateValeur = $pDateValeur;
	}

	/**
	* @name getTextLabel()
	* @return varchar(50)
	* @desc Renvoie le membre TextLabel de la ParametreVO
	*/
	public function getTextLabel() {
		return $this->mTextLabel;
	}

	/**
	* @name setTextLabel($pTextLabel)
	* @param varchar(50)
	* @desc Remplace le membre TextLabel de la ParametreVO par $pTextLabel
	*/
	public function setTextLabel($pTextLabel) {
		$this->mTextLabel = $pTextLabel;
	}

	/**
	* @name getTextValeur()
	* @return text
	* @desc Renvoie le membre TextValeur de la ParametreVO
	*/
	public function getTextValeur() {
		return $this->mTextValeur;
	}

	/**
	* @name setTextValeur($pTextValeur)
	* @param text
	* @desc Remplace le membre TextValeur de la ParametreVO par $pTextValeur
	*/
	public function setTextValeur($pTextValeur) {
		$this->mTextValeur = $pTextValeur;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la ParametreVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la ParametreVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la ParametreVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la ParametreVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la ParametreVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la ParametreVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>