<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/11/2013
// Fichier : AdhesionAdherentVR.php
//
// Description : Classe AdhesionAdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name AdhesionAdherentVR
 * @author Julien PIERRE
 * @since 12/11/2013
 * @desc Classe représentant une AdhesionAdherentVR
 */
class AdhesionAdherentVR  extends TemplateVR
{
	/**
	* @var int(11)
	* @desc Id de la AdhesionAdherentVR
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdAdherent de la AdhesionAdherentVR
	*/
	protected $mIdAdherent;

	/**
	* @var int(11)
	* @desc IdTypeAdhesion de la AdhesionAdherentVR
	*/
	protected $mIdTypeAdhesion;

	/**
	* @var int(11)
	* @desc IdOperation de la AdhesionAdherentVR
	*/
	protected $mIdOperation;

	/**
	* @var int(1)
	* @desc StatutFormulaire de la AdhesionAdherentVR
	*/
	protected $mStatutFormulaire;

	/**
	 * @name AdhesionAdherentVR()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionAdherentVR($pId = null, $pIdAdherent = null, $pIdTypeAdhesion = null, $pIdOperation = null, $pStatutFormulaire = null) {
		parent::__construct();
		if(!is_null($pId)) { $this->mId = $pId; } else { $this->mId = new VRelement();}
		if(!is_null($pIdAdherent)) { $this->mIdAdherent = $pIdAdherent; } else { $this->mIdAdherent = new VRelement();}
		if(!is_null($pIdTypeAdhesion)) { $this->mIdTypeAdhesion = $pIdTypeAdhesion; } else { $this->mIdTypeAdhesion = new VRelement();}
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; } else { $this->mIdOperation = new VRelement();}
		if(!is_null($pStatutFormulaire)) { $this->mStatutFormulaire = $pStatutFormulaire; } else { $this->mStatutFormulaire = new VRelement();}
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdhesionAdherentVR
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdhesionAdherentVR par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdherent()
	* @return int(11)
	* @desc Renvoie le membre IdAdherent de la AdhesionAdherentVR
	*/
	public function getIdAdherent() {
		return $this->mIdAdherent;
	}

	/**
	* @name setIdAdherent($pIdAdherent)
	* @param int(11)
	* @desc Remplace le membre IdAdherent de la AdhesionAdherentVR par $pIdAdherent
	*/
	public function setIdAdherent($pIdAdherent) {
		$this->mIdAdherent = $pIdAdherent;
	}

	/**
	* @name getIdTypeAdhesion()
	* @return int(11)
	* @desc Renvoie le membre IdTypeAdhesion de la AdhesionAdherentVR
	*/
	public function getIdTypeAdhesion() {
		return $this->mIdTypeAdhesion;
	}

	/**
	* @name setIdTypeAdhesion($pIdTypeAdhesion)
	* @param int(11)
	* @desc Remplace le membre IdTypeAdhesion de la AdhesionAdherentVR par $pIdTypeAdhesion
	*/
	public function setIdTypeAdhesion($pIdTypeAdhesion) {
		$this->mIdTypeAdhesion = $pIdTypeAdhesion;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la AdhesionAdherentVR
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la AdhesionAdherentVR par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}
	
	/**
	 * @name getStatutFormulaire()
	 * @return int(1)
	 * @desc Renvoie le membre StatutFormulaire de la AdhesionAdherentVR
	 */
	public function getStatutFormulaire() {
		return $this->mStatutFormulaire;
	}
	
	/**
	 * @name setStatutFormulaire($pStatutFormulaire)
	 * @param int(1)
	 * @desc Remplace le membre StatutFormulaire de la AdhesionAdherentVR par $pStatutFormulaire
	 */
	public function setStatutFormulaire($pStatutFormulaire) {
		$this->mStatutFormulaire = $pStatutFormulaire;
	}
}
?>