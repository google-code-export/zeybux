<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2010
// Fichier : IdentificationVR.php
//
// Description : Classe IdentificationVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdentificationVR
 * @author Julien PIERRE
 * @since 01/11/2010
 * @desc Classe représentant une IdentificationVR
 */
class IdentificationVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc Login de la IdentificationVR
	 */
	protected $mLogin;

	/**
	 * @var VRelement
	 * @desc Pass de la IdentificationVR
	 */
	protected $mPass;

	/**
	* @name IdentificationVR()
	* @return bool
	* @desc Constructeur
	*/
	function IdentificationVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mLogin = new VRelement();
		$this->mPass = new VRelement();
	}

	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}

	/**
	* @name getLog()
	* @return VRelement
	* @desc Renvoie le VRelement Log
	*/
	public function getLog() {
		return $this->mLog;
	}

	/**
	* @name setLog($pLog)
	* @param VRelement
	* @desc Remplace le VRelement Log par $pLog
	*/
	public function setLog($pLog) {
		$this->mLog = $pLog;
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLogin()
	* @return VRelement
	* @desc Renvoie le VRelement mLogin
	*/
	public function getLogin() {
		return $this->mLogin;
	}

	/**
	* @name setLogin($pLogin)
	* @param VRelement
	* @desc Remplace le mLogin par $pLogin
	*/
	public function setLogin($pLogin) {
		$this->mLogin = $pLogin;
	}

	/**
	* @name getPass()
	* @return VRelement
	* @desc Renvoie le VRelement mPass
	*/
	public function getPass() {
		return $this->mPass;
	}

	/**
	* @name setPass($pPass)
	* @param VRelement
	* @desc Remplace le mPass par $pPass
	*/
	public function setPass($pPass) {
		$this->mPass = $pPass;
	}

}
?>