<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : CompteSpecialVR.php
//
// Description : Classe CompteSpecialVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteSpecialVR
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe représentant une CompteSpecialVR
 */
class CompteSpecialVR extends DataTemplate
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
	 * @desc Numero de la CompteSpecialVR
	 */
	protected $mLogin;

	/**
	 * @var VRelement
	 * @desc MotPasse de la CompteSpecialVR
	 */
	protected $mMotPasse;
	
	/**
	 * @var VRelement
	 * @desc Type de la CompteSpecialVR
	 */
	protected $mType;

	/**
	* @name CompteSpecialVR()
	* @return bool
	* @desc Constructeur
	*/
	function CompteSpecialVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mLogin = new VRelement();
		$this->mMotPasse = new VRelement();
		$this->mType = new VRelement();
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
	* @name getMotPasse()
	* @return VRelement
	* @desc Renvoie le VRelement mMotPasse
	*/
	public function getMotPasse() {
		return $this->mMotPasse;
	}

	/**
	* @name setMotPasse($pMotPasse)
	* @param VRelement
	* @desc Remplace le mMotPasse par $pMotPasse
	*/
	public function setMotPasse($pMotPasse) {
		$this->mMotPasse = $pMotPasse;
	}
	
	/**
	* @name getType()
	* @return VRelement
	* @desc Renvoie le VRelement mType
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param VRelement
	* @desc Remplace le mType par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}
}
?>