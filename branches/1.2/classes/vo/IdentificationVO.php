<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/06/2011
// Fichier : IdentificationVO.php
//
// Description : Classe IdentificationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdentificationVO
 * @author Julien PIERRE
 * @since 19/06/2011
 * @desc Classe représentant une IdentificationVO
 */
class IdentificationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la IdentificationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdLogin de la IdentificationVO
	*/
	protected $mIdLogin;

	/**
	* @var varchar(20)
	* @desc Login de la IdentificationVO
	*/
	protected $mLogin;

	/**
	* @var varchar(100)
	* @desc Pass de la IdentificationVO
	*/
	protected $mPass;

	/**
	* @var int(11)
	* @desc Type de la IdentificationVO
	*/
	protected $mType;

	/**
	* @var tinyint(1)
	* @desc Autorise de la IdentificationVO
	*/
	protected $mAutorise;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la IdentificationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la IdentificationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdLogin()
	* @return int(11)
	* @desc Renvoie le membre IdLogin de la IdentificationVO
	*/
	public function getIdLogin() {
		return $this->mIdLogin;
	}

	/**
	* @name setIdLogin($pIdLogin)
	* @param int(11)
	* @desc Remplace le membre IdLogin de la IdentificationVO par $pIdLogin
	*/
	public function setIdLogin($pIdLogin) {
		$this->mIdLogin = $pIdLogin;
	}

	/**
	* @name getLogin()
	* @return varchar(20)
	* @desc Renvoie le membre Login de la IdentificationVO
	*/
	public function getLogin() {
		return $this->mLogin;
	}

	/**
	* @name setLogin($pLogin)
	* @param varchar(20)
	* @desc Remplace le membre Login de la IdentificationVO par $pLogin
	*/
	public function setLogin($pLogin) {
		$this->mLogin = $pLogin;
	}

	/**
	* @name getPass()
	* @return varchar(100)
	* @desc Renvoie le membre Pass de la IdentificationVO
	*/
	public function getPass() {
		return $this->mPass;
	}

	/**
	* @name setPass($pPass)
	* @param varchar(100)
	* @desc Remplace le membre Pass de la IdentificationVO par $pPass
	*/
	public function setPass($pPass) {
		$this->mPass = $pPass;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la IdentificationVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la IdentificationVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getAutorise()
	* @return tinyint(1)
	* @desc Renvoie le membre Autorise de la IdentificationVO
	*/
	public function getAutorise() {
		return $this->mAutorise;
	}

	/**
	* @name setAutorise($pAutorise)
	* @param tinyint(1)
	* @desc Remplace le membre Autorise de la IdentificationVO par $pAutorise
	*/
	public function setAutorise($pAutorise) {
		$this->mAutorise = $pAutorise;
	}

}
?>