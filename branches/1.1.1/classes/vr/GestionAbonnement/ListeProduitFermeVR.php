<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/03/2012
// Fichier : ListeProduitFermeVR.php
//
// Description : Classe ListeProduitFermeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitFermeVR
 * @author Julien PIERRE
 * @since 09/03/2012
 * @desc Classe représentant une ListeProduitFermeVR
 */
class ListeProduitFermeVR extends DataTemplate
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
	 * @desc IdFerme de la ListeProduitFermeVR
	 */
	protected $mIdFerme;

	/**
	* @name ListeProduitFermeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ListeProduitFermeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdFerme = new VRelement();
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
	* @name getIdFerme()
	* @return VRelement
	* @desc Renvoie le VRelement mIdFerme
	*/
	public function getIdFerme() {
		return $this->mIdFerme;
	}

	/**
	* @name setIdFerme($pIdFerme)
	* @param VRelement
	* @desc Remplace le mIdFerme par $pIdFerme
	*/
	public function setIdFerme($pIdFerme) {
		$this->mIdFerme = $pIdFerme;
	}
}
?>