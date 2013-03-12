<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ReservationCommandeVR.php
//
// Description : Classe ReservationCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationCommandeVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ReservationCommandeVR
 */
class ReservationCommandeVR extends DataTemplate
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
	private $mLog;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	private $mId;

	/**
	 * @var VRelement
	 * @desc StoQuantite de la ReservationCommandeVR
	 */
	private $mStoQuantite;

	/**
	 * @var VRelement
	 * @desc StoIdProduit de la ReservationCommandeVR
	 */
	private $mStoIdProduit;

	/**
	* @name ReservationCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ReservationCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mStoQuantite = new VRelement();
		$this->mStoIdProduit = new VRelement();
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
	* @name getStoQuantite()
	* @return VRelement
	* @desc Renvoie le VRelement mStoQuantite
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param VRelement
	* @desc Remplace le mStoQuantite par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getStoIdProduit()
	* @return VRelement
	* @desc Renvoie le VRelement mStoIdProduit
	*/
	public function getStoIdProduit() {
		return $this->mStoIdProduit;
	}

	/**
	* @name setStoIdProduit($pStoIdProduit)
	* @param VRelement
	* @desc Remplace le mStoIdProduit par $pStoIdProduit
	*/
	public function setStoIdProduit($pStoIdProduit) {
		$this->mStoIdProduit = $pStoIdProduit;
	}

}
?>