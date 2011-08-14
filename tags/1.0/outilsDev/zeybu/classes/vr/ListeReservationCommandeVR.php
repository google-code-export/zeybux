<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ListeReservationCommandeVR.php
//
// Description : Classe ListeReservationCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeReservationCommandeVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ListeReservationCommandeVR
 */
class ListeReservationCommandeVR extends DataTemplate
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
	 * @var array(VRelement)
	 * @desc Commandes de la ListeReservationCommandeVR
	 */
	private $mCommandes;

	/**
	* @name ListeReservationCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ListeReservationCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mCommandes = array();
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
	* @name getCommandes()
	* @return VRelement
	* @desc Renvoie le VRelement mCommandes
	*/
	public function getCommandes() {
		return $this->mCommandes;
	}

	/**
	* @name setCommandes($pCommandes)
	* @param VRelement
	* @desc Remplace le mCommandes par $pCommandes
	*/
	public function setCommandes($pCommandes) {
		$this->mCommandes = $pCommandes;
	}

	/**
	* @name addCommandes($pCommandes)
	* @param VRelement
	* @desc Ajoute le $pCommandes à mCommandes
	*/
	public function addCommandes($pCommandes) {
		array_push($this->mCommandes,$pCommandes);
	}

}
?>