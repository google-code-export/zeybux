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
	protected $mId_adherent;

	/**
	 * @var VRelement
	 * @desc MotPasse de la InfoAdherentVR
	 */
	protected $mMotPasse;

	/**
	 * @var VRelement
	 * @desc MotPasseNouveau de la InfoAdherentVR
	 */
	protected $mMotPasseNouveau;

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
		$this->mId_adherent = new VRelement();
		$this->mMotPasse = new VRelement();
		$this->mMotPasseNouveau = new VRelement();
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
	* @name getId_adherent()
	* @return VRelement
	* @desc Renvoie le VRelement Id_adherent
	*/
	public function getId_adherent() {
		return $this->mId_adherent;
	}

	/**
	* @name setId_adherent($pId_adherent)
	* @param VRelement
	* @desc Remplace le VRelement Id_adherent par $pId_adherent
	*/
	public function setId_adherent($pId_adherent) {
		$this->mId_adherent = $pId_adherent;
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
	* @name getMotPasseNouveau()
	* @return VRelement
	* @desc Renvoie le VRelement mMotPasseNouveau
	*/
	public function getMotPasseNouveau() {
		return $this->mMotPasseNouveau;
	}

	/**
	* @name setMotPasseNouveau($pMotPasseNouveau)
	* @param VRelement
	* @desc Remplace le mMotPasseNouveau par $pMotPasseNouveau
	*/
	public function setMotPasseNouveau($pMotPasseNouveau) {
		$this->mMotPasseNouveau = $pMotPasseNouveau;
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