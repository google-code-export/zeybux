<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2011
// Fichier : AfficheReservationAdherentVR.php
//
// Description : Classe AfficheReservationAdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheReservationAdherentVR
 * @author Julien PIERRE
 * @since 06/02/2011
 * @desc Classe représentant une AfficheReservationAdherentVR
 */
class AfficheReservationAdherentVR extends DataTemplate
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
	 * @desc Id_adherent de la AfficheReservationAdherentVR
	 */
	protected $mId_adherent;

	/**
	 * @var VRelement
	 * @desc Id_commande de la AfficheReservationAdherentVR
	 */
	protected $mId_commande;

	/**
	* @name AfficheReservationAdherentVR()
	* @return bool
	* @desc Constructeur
	*/
	function AfficheReservationAdherentVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mId_adherent = new VRelement();
		$this->mId_commande = new VRelement();
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
	* @name getId_adherent()
	* @return VRelement
	* @desc Renvoie le VRelement mId_adherent
	*/
	public function getId_adherent() {
		return $this->mId_adherent;
	}

	/**
	* @name setId_adherent($pId_adherent)
	* @param VRelement
	* @desc Remplace le mId_adherent par $pId_adherent
	*/
	public function setId_adherent($pId_adherent) {
		$this->mId_adherent = $pId_adherent;
	}

	/**
	* @name getId_commande()
	* @return VRelement
	* @desc Renvoie le VRelement mId_commande
	*/
	public function getId_commande() {
		return $this->mId_commande;
	}

	/**
	* @name setId_commande($pId_commande)
	* @param VRelement
	* @desc Remplace le mId_commande par $pId_commande
	*/
	public function setId_commande($pId_commande) {
		$this->mId_commande = $pId_commande;
	}

}
?>