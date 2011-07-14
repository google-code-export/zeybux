<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : CommandeReservationVR.php
//
// Description : Classe CommandeReservationVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CommandeReservationVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une CommandeReservationVR
 */
class CommandeReservationVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var array(VRelement)
	 * @desc Commandes de la CommandeReservationVR
	 */
	protected $mCommandes;

	/**
	* @name CommandeReservationVR()
	* @return bool
	* @desc Constructeur
	*/
	function CommandeReservationVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
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