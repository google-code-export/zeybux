<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/08/2013
// Fichier : AccesVO.php
//
// Description : Classe AccesVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AccesVO
 * @author Julien PIERRE
 * @since 03/08/2013
 * @desc Classe représentant une AccesVO
 */
class AccesVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AccesVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdLogin de la AccesVO
	*/
	protected $mIdLogin;

	/**
	* @var int(11)
	* @desc TypeLogin de la AccesVO
	*/
	protected $mTypeLogin;

	/**
	* @var varchar(40)
	* @desc Ip de la AccesVO
	*/
	protected $mIp;

	/**
	* @var varchar(100)
	* @desc Nav de la AccesVO
	*/
	protected $mNav;

	/**
	* @var datetime
	* @desc DateCreation de la AccesVO
	*/
	protected $mDateCreation;

	/**
	* @var timestamp
	* @desc DateModification de la AccesVO
	*/
	protected $mDateModification;

	/**
	* @var int(11)
	* @desc Autorise de la AccesVO
	*/
	protected $mAutorise;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AccesVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AccesVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdLogin()
	* @return int(11)
	* @desc Renvoie le membre IdLogin de la AccesVO
	*/
	public function getIdLogin() {
		return $this->mIdLogin;
	}

	/**
	* @name setIdLogin($pIdLogin)
	* @param int(11)
	* @desc Remplace le membre IdLogin de la AccesVO par $pIdLogin
	*/
	public function setIdLogin($pIdLogin) {
		$this->mIdLogin = $pIdLogin;
	}

	/**
	* @name getTypeLogin()
	* @return int(11)
	* @desc Renvoie le membre TypeLogin de la AccesVO
	*/
	public function getTypeLogin() {
		return $this->mTypeLogin;
	}

	/**
	* @name setTypeLogin($pTypeLogin)
	* @param int(11)
	* @desc Remplace le membre TypeLogin de la AccesVO par $pTypeLogin
	*/
	public function setTypeLogin($pTypeLogin) {
		$this->mTypeLogin = $pTypeLogin;
	}

	/**
	* @name getIp()
	* @return varchar(40)
	* @desc Renvoie le membre Ip de la AccesVO
	*/
	public function getIp() {
		return $this->mIp;
	}

	/**
	* @name setIp($pIp)
	* @param varchar(40)
	* @desc Remplace le membre Ip de la AccesVO par $pIp
	*/
	public function setIp($pIp) {
		$this->mIp = $pIp;
	}

	/**
	* @name getNav()
	* @return varchar(100)
	* @desc Renvoie le membre Nav de la AccesVO
	*/
	public function getNav() {
		return $this->mNav;
	}

	/**
	* @name setNav($pNav)
	* @param varchar(100)
	* @desc Remplace le membre Nav de la AccesVO par $pNav
	*/
	public function setNav($pNav) {
		$this->mNav = $pNav;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la AccesVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la AccesVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return timestamp
	* @desc Renvoie le membre DateModification de la AccesVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param timestamp
	* @desc Remplace le membre DateModification de la AccesVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getAutorise()
	* @return int(11)
	* @desc Renvoie le membre Autorise de la AccesVO
	*/
	public function getAutorise() {
		return $this->mAutorise;
	}

	/**
	* @name setAutorise($pAutorise)
	* @param int(11)
	* @desc Remplace le membre Autorise de la AccesVO par $pAutorise
	*/
	public function setAutorise($pAutorise) {
		$this->mAutorise = $pAutorise;
	}

}
?>