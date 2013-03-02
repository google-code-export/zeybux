<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueVR.php
//
// Description : Classe BanqueVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name BanqueVR
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une BanqueVR
 */
class BanqueVR extends DataTemplate
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
	 * @desc Id de la BanqueVR
	 */
	protected $mId;

	/**
	 * @var VRelement
	 * @desc NomCourt de la BanqueVR
	 */
	protected $mNomCourt;

	/**
	 * @var VRelement
	 * @desc Nom de la BanqueVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Description de la BanqueVR
	 */
	protected $mDescription;

	/**
	 * @var VRelement
	 * @desc Etat de la BanqueVR
	 */
	protected $mEtat;

	/**
	* @name BanqueVR()
	* @return bool
	* @desc Constructeur
	*/
	function BanqueVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mId = new VRelement();
		$this->mNomCourt = new VRelement();
		$this->mNom = new VRelement();
		$this->mDescription = new VRelement();
		$this->mEtat = new VRelement();
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

	/**
	* @name getNomCourt()
	* @return VRelement
	* @desc Renvoie le VRelement mNomCourt
	*/
	public function getNomCourt() {
		return $this->mNomCourt;
	}

	/**
	* @name setNomCourt($pNomCourt)
	* @param VRelement
	* @desc Remplace le mNomCourt par $pNomCourt
	*/
	public function setNomCourt($pNomCourt) {
		$this->mNomCourt = $pNomCourt;
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

	/**
	* @name getEtat()
	* @return VRelement
	* @desc Renvoie le VRelement mEtat
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param VRelement
	* @desc Remplace le mEtat par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>