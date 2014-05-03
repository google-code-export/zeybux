<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/05/2014
// Fichier : ExportListeAchatEtReservationVR.php
//
// Description : Classe ExportListeAchatEtReservationVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ExportListeAchatEtReservationVR
 * @author Julien PIERRE
 * @since 02/05/2014
 * @desc Classe représentant une ExportListeAchatEtReservationVR
 */
class ExportListeAchatEtReservationVR extends DataTemplate
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
	 * @var array(VRelement)
	 * @desc Id_produits de la ExportListeAchatEtReservationVR
	 */
	protected $mId_produits;

	/**
	* @name ExportListeAchatEtReservationVR()
	* @return bool
	* @desc Constructeur
	*/
	function ExportListeAchatEtReservationVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mId_produits = array();
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
	* @name getId_produits()
	* @return VRelement
	* @desc Renvoie le VRelement mId_produits
	*/
	public function getId_produits() {
		return $this->mId_produits;
	}

	/**
	* @name setId_produits($pId_produits)
	* @param VRelement
	* @desc Remplace le mId_produits par $pId_produits
	*/
	public function setId_produits($pId_produits) {
		$this->mId_produits = $pId_produits;
	}

	/**
	* @name addId_produits($pId_produits)
	* @param VRelement
	* @desc Ajoute le $pId_produits à mId_produits
	*/
	public function addId_produits($pId_produits) {
		array_push($this->mId_produits,$pId_produits);
	}

}
?>