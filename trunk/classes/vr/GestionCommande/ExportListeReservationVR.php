<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : ExportListeReservationVR.php
//
// Description : Classe ExportListeReservationVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ExportListeReservationVR
 * @author Julien PIERRE
 * @since 02/01/2011
 * @desc Classe représentant une ExportListeReservationVR
 */
class ExportListeReservationVR extends DataTemplate
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
	 * @desc Id_commande de la ExportListeReservationVR
	 */
	protected $mId_commande;

	/**
	 * @var array(VRelement)
	 * @desc Id_produits de la ExportListeReservationVR
	 */
	protected $mId_produits;

	/**
	* @name ExportListeReservationVR()
	* @return bool
	* @desc Constructeur
	*/
	function ExportListeReservationVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mId_commande = new VRelement();
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