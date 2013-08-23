<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/08/2010
// Fichier : TemplateVR.php
//
// Description : Classe TemplateVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TemplateVR
 * @author Julien PIERRE
 * @since 30/08/2010
 * @desc Classe représentant une TemplateVR
 */
class TemplateVR extends DataTemplate
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
	 * @desc Le Log de l'objet
	 */
	private $mData;

	/**
	* @name TemplateVR()
	* @return bool
	* @desc Constructeur
	*/
	function TemplateVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mData = array();
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
	* @name getData()
	* @return array()
	* @desc Renvoie le mData
	*/
	public function getData() {
		return $this->mData;
	}

	/**
	* @name setData($pData)
	* @param array()
	* @desc Remplace le mData par $pData
	*/
	public function setData($pData) {
		$this->mData = $pData;
	}

	/**
	* @name addData($pData)
	* @param array()
	* @desc ajoute $pData à mData 
	*/
	public function addData($pData) {
		array_push($this->mData, $pData);
	}
}
?>