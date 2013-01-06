<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : AdhesionVO.php
//
// Description : Classe AdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdhesionVO
 * @author Julien PIERRE
 * @since 22/07/2012
 * @desc Classe représentant une AdhesionVO
 */
class AdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AdhesionVO
	*/
	protected $mId;

	/**
	* @var varchar(45)
	* @desc Label de la AdhesionVO
	*/
	protected $mLabel;

	/**
	* @var datetime
	* @desc DateDebut de la AdhesionVO
	*/
	protected $mDateDebut;

	/**
	* @var datetime
	* @desc DateFin de la AdhesionVO
	*/
	protected $mDateFin;

	/**
	* @var tinyint(1)
	* @desc Etat de la AdhesionVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdhesionVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdhesionVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la AdhesionVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la AdhesionVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getDateDebut()
	* @return datetime
	* @desc Renvoie le membre DateDebut de la AdhesionVO
	*/
	public function getDateDebut() {
		return $this->mDateDebut;
	}

	/**
	* @name setDateDebut($pDateDebut)
	* @param datetime
	* @desc Remplace le membre DateDebut de la AdhesionVO par $pDateDebut
	*/
	public function setDateDebut($pDateDebut) {
		$this->mDateDebut = $pDateDebut;
	}

	/**
	* @name getDateFin()
	* @return datetime
	* @desc Renvoie le membre DateFin de la AdhesionVO
	*/
	public function getDateFin() {
		return $this->mDateFin;
	}

	/**
	* @name setDateFin($pDateFin)
	* @param datetime
	* @desc Remplace le membre DateFin de la AdhesionVO par $pDateFin
	*/
	public function setDateFin($pDateFin) {
		$this->mDateFin = $pDateFin;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la AdhesionVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la AdhesionVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>