<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AdhesionVR.php
//
// Description : Classe AdhesionVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name AdhesionVR
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AdhesionVR
 */
class AdhesionVR  extends TemplateVR
{
	/**
	* @var int(11)
	* @desc Id de la AdhesionVR
	*/
	protected $mId;

	/**
	* @var varchar(45)
	* @desc Label de la AdhesionVR
	*/
	protected $mLabel;

	/**
	* @var datetime
	* @desc DateDebut de la AdhesionVR
	*/
	protected $mDateDebut;

	/**
	* @var datetime
	* @desc DateFin de la AdhesionVR
	*/
	protected $mDateFin;

	/**
	* @var datetime
	* @desc DateCreation de la AdhesionVR
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la AdhesionVR
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la AdhesionVR
	*/
	protected $mEtat;
	
	/**
	 * @var array(TypeAdhesionVR)
	 * @desc Types d'adhésion de la AdhesionDetailVR
	 */
	protected $mTypes;

	/**
	 * @name AdhesionVR()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionVR($pId = null, $pLabel = null, $pDateDebut = null, $pDateFin = null, $pDateCreation = null, $pDateModification = null, $pEtat = null, $pTypes = null) {
		parent::__construct();
		if(!is_null($pId)) { $this->mId = $pId; } else { $this->mId = new VRelement();}
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; } else { $this->mLabel = new VRelement();}
		if(!is_null($pDateDebut)) { $this->mDateDebut = $pDateDebut; } else { $this->mDateDebut = new VRelement();}
		if(!is_null($pDateFin)) { $this->mDateFin = $pDateFin; } else { $this->mDateFin = new VRelement();}
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; } else { $this->mDateCreation = new VRelement();}
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; } else { $this->mDateModification = new VRelement();}
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; } else {  $this->mEtat = new VRelement();}
		if(!is_null($pTypes)) { $this->mTypes = $pTypes; } else { $this->mTypes = array(); }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdhesionVR
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdhesionVR par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la AdhesionVR
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la AdhesionVR par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getDateDebut()
	* @return datetime
	* @desc Renvoie le membre DateDebut de la AdhesionVR
	*/
	public function getDateDebut() {
		return $this->mDateDebut;
	}

	/**
	* @name setDateDebut($pDateDebut)
	* @param datetime
	* @desc Remplace le membre DateDebut de la AdhesionVR par $pDateDebut
	*/
	public function setDateDebut($pDateDebut) {
		$this->mDateDebut = $pDateDebut;
	}

	/**
	* @name getDateFin()
	* @return datetime
	* @desc Renvoie le membre DateFin de la AdhesionVR
	*/
	public function getDateFin() {
		return $this->mDateFin;
	}

	/**
	* @name setDateFin($pDateFin)
	* @param datetime
	* @desc Remplace le membre DateFin de la AdhesionVR par $pDateFin
	*/
	public function setDateFin($pDateFin) {
		$this->mDateFin = $pDateFin;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la AdhesionVR
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la AdhesionVR par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la AdhesionVR
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la AdhesionVR par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la AdhesionVR
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la AdhesionVR par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

	/**
	 * @name getTypes()
	 * @return array(TypeAdhesionVR)
	 * @desc Renvoie le membre Types de la AdhesionDetailVR
	 */
	public function getTypes(){
		return $this->mTypes;
	}
	
	/**
	 * @name setTypes($pProduit)
	 * @param array(TypeAdhesionVR)
	 * @desc Remplace le membre Types de la AdhesionDetailVR par $pTypes
	 */
	public function setTypes($pTypes) {
		$this->mTypes = $pTypes;
	}
	
	/**
	 * @name addTypes($pTypes)
	 * @param TypeAdhesionVR
	 * @desc Ajoute $pProduit à Types
	 */
	public function addTypes($pTypes){
		array_push($this->mTypes,$pTypes);
	}
}
?>