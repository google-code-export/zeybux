<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueVR.php
//
// Description : Classe CaracteristiqueVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaracteristiqueVR
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une CaracteristiqueVR
 */
class CaracteristiqueVR extends DataTemplate
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
	 * @desc Nom de la CaracteristiqueVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Description de la CaracteristiqueVR
	 */
	protected $mDescription;

	/**
	* @name CaracteristiqueVR()
	* @return bool
	* @desc Constructeur
	*/
	function CaracteristiqueVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mNom = new VRelement();
		$this->mDescription = new VRelement();
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
	* @name getNom()
	* @return VRelement
	* @desc Renvoie le VRelement mNom
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param VRelement
	* @desc Remplace le mNom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return VRelement
	* @desc Renvoie le VRelement mDescription
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param VRelement
	* @desc Remplace le mDescription par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}
}
?>