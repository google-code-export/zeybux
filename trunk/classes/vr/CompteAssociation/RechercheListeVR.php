<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/02/2014
// Fichier : RechercheListeVR.php
//
// Description : Classe RechercheListeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name RechercheListeVR
 * @author Julien PIERRE
 * @since 09/02/2014
 * @desc Classe représentant une RechercheListeVR
 */
class RechercheListeVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Date de debut de la RechercheListeVR
	 */
	protected $mDateDebut;

	/**
	 * @var VRelement
	 * @desc Date de fin de la RechercheListeVR
	 */
	protected $mDateFin;

	/**
	* @name RechercheListeVR()
	* @return bool
	* @desc Constructeur
	*/
	function RechercheListeVR() {
		parent::__construct();		
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mDateDebut = new VRelement();
		$this->mDateFin = new VRelement();
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