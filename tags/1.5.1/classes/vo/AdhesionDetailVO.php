<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2013
// Fichier : AdhesionDetailVO.php
//
// Description : Classe AdhesionDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "AdhesionVO.php");

/**
 * @name AdhesionDetailVO
 * @author Julien PIERRE
 * @since 02/11/2013
 * @desc Classe représentant une AdhesionDetailVO
 */
class AdhesionDetailVO extends AdhesionVO
{
	/**
	 * @var array(TypeAdhesionVO)
	 * @desc Types d'adhésion de la AdhesionDetailVO
	 */
	protected $mTypes;
	
	/**
	* @name AdhesionDetailVO()
	* @desc Le constructeur
	*/
	public function AdhesionDetailVO($pId = null, $pLabel = null, $pDateDebut = null, $pDateFin = null, $pDateCreation = null, $pDateModification = null, $pEtat = null, $pTypes = null) {
		parent::__construct($pId, $pLabel, $pDateDebut, $pDateFin, $pDateCreation, $pDateModification, $pEtat);
		if(!is_null($pTypes)) { $this->mTypes = $pTypes; } else { $this->mTypes = array(); }
	}
		
	/**
	* @name getTypes()
	* @return array(TypeAdhesionVO)
	* @desc Renvoie le membre Types de la AdhesionDetailVO
	*/
	public function getTypes(){
		return $this->mTypes;
	}

	/**
	* @name setTypes($pProduit)
	* @param array(TypeAdhesionVO)
	* @desc Remplace le membre Types de la AdhesionDetailVO par $pTypes
	*/
	public function setTypes($pTypes) {
		$this->mTypes = $pTypes;
	}
	
	/**
	* @name addTypes($pTypes)
	* @param TypeAdhesionVO
	* @desc Ajoute $pProduit à Types
	*/
	public function addTypes($pTypes){
		array_push($this->mTypes,$pTypes);
	}
}
?>