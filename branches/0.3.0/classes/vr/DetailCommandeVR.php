<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : DetailCommandeVR.php
//
// Description : Classe DetailCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailCommandeVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une DetailCommandeVR
 */
class DetailCommandeVR extends DataTemplate
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
	 * @desc IdProduit de la DetailCommandeVR
	 */
	protected $mIdProduit;


	/**
	 * @var VRelement
	 * @desc Taille de la DetailCommandeVR
	 */
	protected $mTaille;


	/**
	 * @var VRelement
	 * @desc Prix de la DetailCommandeVR
	 */
	protected $mPrix;

	/**
	* @name DetailCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function DetailCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdProduit = new VRelement();
		$this->mTaille = new VRelement();
		$this->mPrix = new VRelement();
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
	* @name getIdProduit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdProduit
	*/
	public function getIdProduit() {
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param VRelement
	* @desc Remplace le mIdProduit par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

	/**
	* @name getTaille()
	* @return VRelement
	* @desc Renvoie le VRelement mTaille
	*/
	public function getTaille() {
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param VRelement
	* @desc Remplace le mTaille par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return VRelement
	* @desc Renvoie le VRelement mPrix
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param VRelement
	* @desc Remplace le mPrix par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}
}
?>