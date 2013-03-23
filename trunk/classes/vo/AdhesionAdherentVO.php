<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : AdhesionAdherentVO.php
//
// Description : Classe AdhesionAdherentVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionAdherentVO
 * @author Julien PIERRE
 * @since 22/07/2012
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
	* @desc Etat de la AdhesionAdherentVO
	*/
	protected $mEtat;

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