<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueViewVO.php
//
// Description : Classe CaracteristiqueViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaracteristiqueViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une CaracteristiqueViewVO
 */
class CaracteristiqueViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CarId de la CaracteristiqueViewVO
	*/
	protected $mCarId;

	/**
	* @var varchar(50)
	* @desc CarNom de la CaracteristiqueViewVO
	*/
	protected $mCarNom;

	/**
	* @var text
	* @desc CarDescription de la CaracteristiqueViewVO
	*/
	protected $mCarDescription;

	/**
	* @name getCarId()
	* @return int(11)
	* @desc Renvoie le membre CarId de la CaracteristiqueViewVO
	*/
	public function getCarId() {
		return $this->mCarId;
	}

	/**
	* @name setCarId($pCarId)
	* @param int(11)
	* @desc Remplace le membre CarId de la CaracteristiqueViewVO par $pCarId
	*/
	public function setCarId($pCarId) {
		$this->mCarId = $pCarId;
	}

	/**
	* @name getCarNom()
	* @return varchar(50)
	* @desc Renvoie le membre CarNom de la CaracteristiqueViewVO
	*/
	public function getCarNom() {
		return $this->mCarNom;
	}

	/**
	* @name setCarNom($pCarNom)
	* @param varchar(50)
	* @desc Remplace le membre CarNom de la CaracteristiqueViewVO par $pCarNom
	*/
	public function setCarNom($pCarNom) {
		$this->mCarNom = $pCarNom;
	}

	/**
	* @name getCarDescription()
	* @return text
	* @desc Renvoie le membre CarDescription de la CaracteristiqueViewVO
	*/
	public function getCarDescription() {
		return $this->mCarDescription;
	}

	/**
	* @name setCarDescription($pCarDescription)
	* @param text
	* @desc Remplace le membre CarDescription de la CaracteristiqueViewVO par $pCarDescription
	*/
	public function setCarDescription($pCarDescription) {
		$this->mCarDescription = $pCarDescription;
	}

}
?>