<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/01/2014
// Fichier : AdhesionAdherentVO.php
//
// Description : Classe AdhesionAdherentVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionAdherentVO
 * @author Julien PIERRE
 * @since 31/01/2014
 * @desc Classe représentant une AdhesionAdherentVO
 */
class AdhesionAdherentVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AdhesionAdherentVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdAdherent de la AdhesionAdherentVO
	*/
	protected $mIdAdherent;

	/**
	* @var int(11)
	* @desc IdTypeAdhesion de la AdhesionAdherentVO
	*/
	protected $mIdTypeAdhesion;

	/**
	* @var int(11)
	* @desc IdOperation de la AdhesionAdherentVO
	*/
	protected $mIdOperation;

	/**
	* @var tinyint(1)
	* @desc StatutFormulaire de la AdhesionAdherentVO
	*/
	protected $mStatutFormulaire;

	/**
	* @var datetime
	* @desc DateCreation de la AdhesionAdherentVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la AdhesionAdherentVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la AdhesionAdherentVO
	*/
	protected $mEtat;

	/**
	 * @name AdhesionAdherentVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionAdherentVO($pId = null, $pIdAdherent = null, $pIdTypeAdhesion = null, $pIdOperation = null, $pStatutFormulaire = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdAdherent)) { $this->mIdAdherent = $pIdAdherent; }
		if(!is_null($pIdTypeAdhesion)) { $this->mIdTypeAdhesion = $pIdTypeAdhesion; }
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; }
		if(!is_null($pStatutFormulaire)) { $this->mStatutFormulaire = $pStatutFormulaire; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdhesionAdherentVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdhesionAdherentVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return int(11)
	* @desc Renvoie le membre IdAdherent de la AdhesionAdherentVO
	*/
	public function getIdAdherent() {
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param int(11)
	* @desc Remplace le membre IdAdherent de la AdhesionAdherentVO par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
	}

	/**
	* @name getIdTypeAdhesion()
	* @return int(11)
	* @desc Renvoie le membre IdTypeAdhesion de la AdhesionAdherentVO
	*/
	public function getIdTypeAdhesion() {
		return $this->mIdTypeAdhesion;
	}

	/**
	* @name setIdTypeAdhesion($pIdTypeAdhesion)
	* @param int(11)
	* @desc Remplace le membre IdTypeAdhesion de la AdhesionAdherentVO par $pIdTypeAdhesion
	*/
	public function setIdTypeAdhesion($pIdTypeAdhesion) {
		$this->mIdTypeAdhesion = $pIdTypeAdhesion;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la AdhesionAdherentVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la AdhesionAdherentVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getStatutFormulaire()
	* @return tinyint(1)
	* @desc Renvoie le membre StatutFormulaire de la AdhesionAdherentVO
	*/
	public function getStatutFormulaire() {
		return $this->mStatutFormulaire;
	}

	/**
	* @name setStatutFormulaire($pStatutFormulaire)
	* @param tinyint(1)
	* @desc Remplace le membre StatutFormulaire de la AdhesionAdherentVO par $pStatutFormulaire
	*/
	public function setStatutFormulaire($pStatutFormulaire) {
		$this->mStatutFormulaire = $pStatutFormulaire;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la AdhesionAdherentVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la AdhesionAdherentVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la AdhesionAdherentVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la AdhesionAdherentVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la AdhesionAdherentVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la AdhesionAdherentVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>