<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/08/2013
// Fichier : RechercheListeFactureVR.php
//
// Description : Classe RechercheListeFactureVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name RechercheListeFactureVR
 * @author Julien PIERRE
 * @since 23/08/2013
 * @desc Classe représentant une RechercheListeFactureVR
 */
class RechercheListeFactureVR extends DataTemplate
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
	 * @desc L'IdMarche de l'objet
	 */
	protected $mIdMarche;

	/**
	 * @var VRelement
	 * @desc Date de debut de la RechercheListeFactureVR
	 */
	protected $mDateDebut;

	/**
	 * @var VRelement
	 * @desc Date de fin de la RechercheListeFactureVR
	 */
	protected $mDateFin;

	/**
	* @name RechercheListeFactureVR()
	* @return bool
	* @desc Constructeur
	*/
	function RechercheListeFactureVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mIdMarche = new VRelement();
		$this->mDateDebut = new VRelement();
		$this->mDateFin = new VRelement();
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
	* @name getIdMarche()
	* @return VRelement
	* @desc Renvoie le VRelement IdMarche
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param VRelement
	* @desc Remplace le VRelement IdMarche par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}

	/**
	* @name getDateDebut()
	* @return VRelement
	* @desc Renvoie le VRelement mDateDebut
	*/
	public function getDateDebut() {
		return $this->mDateDebut;
	}

	/**
	* @name setDateDebut($pDateDebut)
	* @param VRelement
	* @desc Remplace le mDateDebut par $pDateDebut
	*/
	public function setDateDebut($pDateDebut) {
		$this->mDateDebut = $pDateDebut;
	}

	/**
	* @name getDateFin()
	* @return VRelement
	* @desc Renvoie le VRelement mDateFin
	*/
	public function getDateFin() {
		return $this->mDateFin;
	}

	/**
	* @name setDateFin($pDateFin)
	* @param VRelement
	* @desc Remplace le mDateFin par $pDateFin
	*/
	public function setDateFin($pDateFin) {
		$this->mDateFin = $pDateFin;
	}
}
?>