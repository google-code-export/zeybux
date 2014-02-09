<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2014
// Fichier : AdhesionAdherentDetailVR.php
//
// Description : Classe AdhesionAdherentDetailVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name AdhesionAdherentDetailVR
 * @author Julien PIERRE
 * @since 06/02/2014
 * @desc Classe représentant une AdhesionAdherentDetailVR
 */
class AdhesionAdherentDetailVR  extends TemplateVR
{
	/**
	* @var AdhesionAdherentVR
	* @desc AdhesionAdherent de la AdhesionAdherentDetailVR
	*/
	protected $mAdhesionAdherent;

	/**
	* @var OperationDetailVR
	* @desc Operation de la AdhesionAdherentDetailVR
	*/
	protected $mOperation;

	/**
	 * @name AdhesionAdherentDetailVR()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionAdherentDetailVR($pAdhesionAdherent = null, $pOperation = null) {
		parent::__construct();
		if(!is_null($pAdhesionAdherent)) { $this->mAdhesionAdherent = $pAdhesionAdherent; } else { $this->mAdhesionAdherent = new VRelement();}
		if(!is_null($pOperation)) { $this->mOperation = $pOperation; } else { $this->mOperation = new VRelement();}
	}

	/**
	* @name getAdhesionAdherent()
	* @return int(11)
	* @desc Renvoie le membre AdhesionAdherent de la AdhesionAdherentDetailVR
	*/
	public function getAdhesionAdherent() {
		return $this->mAdhesionAdherent;
	}

	/**
	* @name setAdhesionAdherent($pAdhesionAdherent)
	* @param int(11)
	* @desc Remplace le membre AdhesionAdherent de la AdhesionAdherentDetailVR par $pAdhesionAdherent
	*/
	public function setAdhesionAdherent($pAdhesionAdherent) {
		$this->mAdhesionAdherent = $pAdhesionAdherent;
	}

	/**
	* @name getOperation()
	* @return int(11)
	* @desc Renvoie le membre Operation de la AdhesionAdherentDetailVR
	*/
	public function getOperation() {
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param int(11)
	* @desc Remplace le membre Operation de la AdhesionAdherentDetailVR par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}
}
?>