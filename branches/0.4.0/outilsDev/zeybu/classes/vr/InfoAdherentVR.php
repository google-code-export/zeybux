<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoAdherentVR.php
//
// Description : Classe InfoAdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoAdherentVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoAdherentVR
 */
class InfoAdherentVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	private $mValid;

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
	 * @desc MotPass de la InfoAdherentVR
	 */
	protected $mMotPass;

	/**
	 * @var VRelement
	 * @desc MotPassNouveau de la InfoAdherentVR
	 */
	protected $mMotPassNouveau;

	/**
	 * @var VRelement
	 * @desc MotPasseConfirm de la InfoAdherentVR
	 */
	protected $mMotPasseConfirm;

	/**
	* @name InfoAdherentVR()
	* @return bool
	* @desc Constructeur
	*/
	function InfoAdherentVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mMotPass = new VRelement();
		$this->mMotPassNouveau = new VRelement();
		$this->mMotPasseConfirm = new VRelement();
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
	* @name getMotPass()
	* @return VRelement
	* @desc Renvoie le VRelement mMotPass
	*/
	public function getMotPass() {
		return $this->mMotPass;
	}

	/**
	* @name setMotPass($pMotPass)
	* @param VRelement
	* @desc Remplace le mMotPass par $pMotPass
	*/
	public function setMotPass($pMotPass) {
		$this->mMotPass = $pMotPass;
	}

	/**
	* @name getMotPassNouveau()
	* @return VRelement
	* @desc Renvoie le VRelement mMotPassNouveau
	*/
	public function getMotPassNouveau() {
		return $this->mMotPassNouveau;
	}

	/**
	* @name setMotPassNouveau($pMotPassNouveau)
	* @param VRelement
	* @desc Remplace le mMotPassNouveau par $pMotPassNouveau
	*/
	public function setMotPassNouveau($pMotPassNouveau) {
		$this->mMotPassNouveau = $pMotPassNouveau;
	}

	/**
	* @name getMotPasseConfirm()
	* @return VRelement
	* @desc Renvoie le VRelement mMotPasseConfirm
	*/
	public function getMotPasseConfirm() {
		return $this->mMotPasseConfirm;
	}

	/**
	* @name setMotPasseConfirm($pMotPasseConfirm)
	* @param VRelement
	* @desc Remplace le mMotPasseConfirm par $pMotPasseConfirm
	*/
	public function setMotPasseConfirm($pMotPasseConfirm) {
		$this->mMotPasseConfirm = $pMotPasseConfirm;
	}

}
?>