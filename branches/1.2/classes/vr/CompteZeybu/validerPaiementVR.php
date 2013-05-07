<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/05/2012
// Fichier : validerPaiementVR.php
//
// Description : Classe validerPaiementVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name validerPaiementVR
 * @author Julien PIERRE
 * @since 13/05/2012
 * @desc Classe représentant une validerPaiementVR
 */
class validerPaiementVR extends DataTemplate
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
	 * @desc Id de la validerPaiementVR
	 */
	protected $mId;
	
	/**
	* @name validerPaiementVR()
	* @return bool
	* @desc Constructeur
	*/
	function validerPaiementVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
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
	* @desc Renvoie le VRelement mId
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le mId par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
}
?>