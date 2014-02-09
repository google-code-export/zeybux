<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : AdhesionAdherentDetailVO.php
//
// Description : Classe AdhesionAdherentDetailVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionAdherentDetailVO
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une AdhesionAdherentDetailVO
 */
class AdhesionAdherentDetailVO  extends DataTemplate
{
	/**
	* @var AdhesionAdherentVO
	* @desc AdhesionAdherent de la AdhesionAdherentDetailVO
	*/
	protected $mAdhesionAdherent;

	/**
	* @var OperationVO
	* @desc Operation de la AdhesionAdherentDetailVO
	*/
	protected $mOperation;

	/**
	* @var AdhesionDetailVO
	* @desc AdhesionDetail de la AdhesionAdherentDetailVO
	*/
	protected $mAdhesionDetail;

	/**
	 * @name AdhesionAdherentDetailVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdhesionAdherentDetailVO($pAdhesionAdherent = null, $pOperation = null, $pAdhesionDetail = null) {
		if(!is_null($pAdhesionAdherent)) { $this->mAdhesionAdherent = $pAdhesionAdherent; }
		if(!is_null($pOperation)) { $this->mOperation = $pOperation; }
		if(!is_null($pAdhesionDetail)) { $this->mAdhesionDetail = $pAdhesionDetail; }
	}

	/**
	* @name getAdhesionAdherent()
	* @return AdhesionAdherentVO
	* @desc Renvoie le membre AdhesionAdherent de la AdhesionAdherentDetailVO
	*/
	public function getAdhesionAdherent() {
		return $this->mAdhesionAdherent;
	}

	/**
	* @name setAdhesionAdherent($pAdhesionAdherent)
	* @param AdhesionAdherentVO
	* @desc Remplace le membre AdhesionAdherent de la AdhesionAdherentDetailVO par $pAdhesionAdherent
	*/
	public function setAdhesionAdherent($pAdhesionAdherent) {
		$this->mAdhesionAdherent = $pAdhesionAdherent;
	}

	/**
	* @name getOperation()
	* @return OperationVO
	* @desc Renvoie le membre Operation de la AdhesionAdherentDetailVO
	*/
	public function getOperation() {
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param OperationVO
	* @desc Remplace le membre Operation de la AdhesionAdherentDetailVO par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}

	/**
	* @name getAdhesionDetail()
	* @return AdhesionDetailVO
	* @desc Renvoie le membre AdhesionDetail de la AdhesionAdherentDetailVO
	*/
	public function getAdhesionDetail() {
		return $this->mAdhesionDetail;
	}

	/**
	* @name setAdhesionDetail($pAdhesionDetail)
	* @param AdhesionDetailVO
	* @desc Remplace le membre AdhesionDetail de la AdhesionAdherentDetailVO par $pAdhesionDetail
	*/
	public function setAdhesionDetail($pAdhesionDetail) {
		$this->mAdhesionDetail = $pAdhesionDetail;
	}
}
?>