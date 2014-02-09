<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/10/2013
// Fichier : TypeAdhesionVR.php
//
// Description : Classe TypeAdhesionVR
//
//****************************************************************
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name TypeAdhesionVR
 * @author Julien PIERRE
 * @since 30/10/2013
 * @desc Classe représentant une TypeAdhesionVR
 */
class TypeAdhesionVR  extends TemplateVR
{
	/**
	* @var int(11)
	* @desc Id de la TypeAdhesionVR
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdAdhesion de la TypeAdhesionVR
	*/
	protected $mIdAdhesion;

	/**
	* @var varchar(45)
	* @desc Label de la TypeAdhesionVR
	*/
	protected $mLabel;

	/**
	* @var int(11)
	* @desc IdPerimetre de la TypeAdhesionVR
	*/
	protected $mIdPerimetre;

	/**
	* @var decimal(10,2)
	* @desc Montant de la TypeAdhesionVR
	*/
	protected $mMontant;

	/**
	* @var datetime
	* @desc DateCreation de la TypeAdhesionVR
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la TypeAdhesionVR
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la TypeAdhesionVR
	*/
	protected $mEtat;

	/**
	 * @name TypeAdhesionVR()
	 * @return bool
	 * @desc Constructeur
	 */
	function TypeAdhesionVR($pId = null, $pIdAdhesion = null, $pLabel = null, $pIdPerimetre = null, $pMontant = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		parent::__construct();
		if(!is_null($pId)) { $this->mId = $pId; } else { $this->mId = new VRelement();}
		if(!is_null($pIdAdhesion)) { $this->mIdAdhesion = $pIdAdhesion; } else { $this->mIdAdhesion = new VRelement();}
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; } else { $this->mIdAdhesion = new VRelement();}
		if(!is_null($pIdPerimetre)) { $this->mIdPerimetre = $pIdPerimetre; } else { $this->mIdPerimetre = new VRelement();}
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; } else { $this->mMontant = new VRelement();}
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; } else { $this->mDateCreation = new VRelement();}
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; } else { $this->mDateModification = new VRelement();}
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; } else { $this->mEtat = new VRelement();}
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la TypeAdhesionVR
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la TypeAdhesionVR par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdhesion()
	* @return int(11)
	* @desc Renvoie le membre IdAdhesion de la TypeAdhesionVR
	*/
	public function getIdAdhesion() {
		return $this->mIdAdhesion;
	}

	/**
	* @name setIdAdhesion($pIdAdhesion)
	* @param int(11)
	* @desc Remplace le membre IdAdhesion de la TypeAdhesionVR par $pIdAdhesion
	*/
	public function setIdAdhesion($pIdAdhesion) {
		$this->mIdAdhesion = $pIdAdhesion;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la TypeAdhesionVR
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la TypeAdhesionVR par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getIdPerimetre()
	* @return int(11)
	* @desc Renvoie le membre IdPerimetre de la TypeAdhesionVR
	*/
	public function getIdPerimetre() {
		return $this->mIdPerimetre;
	}

	/**
	* @name setIdPerimetre($pIdPerimetre)
	* @param int(11)
	* @desc Remplace le membre IdPerimetre de la TypeAdhesionVR par $pIdPerimetre
	*/
	public function setIdPerimetre($pIdPerimetre) {
		$this->mIdPerimetre = $pIdPerimetre;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la TypeAdhesionVR
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la TypeAdhesionVR par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la TypeAdhesionVR
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la TypeAdhesionVR par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la TypeAdhesionVR
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la TypeAdhesionVR par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la TypeAdhesionVR
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la TypeAdhesionVR par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}
}
?>