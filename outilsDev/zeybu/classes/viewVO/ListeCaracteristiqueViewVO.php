<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeCaracteristiqueViewVO.php
//
// Description : Classe ListeCaracteristiqueViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCaracteristiqueViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une ListeCaracteristiqueViewVO
 */
class ListeCaracteristiqueViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CarId de la ListeCaracteristiqueViewVO
	*/
	protected $mCarId;

	/**
	* @var varchar(50)
	* @desc CarNom de la ListeCaracteristiqueViewVO
	*/
	protected $mCarNom;

	/**
	* @name getCarId()
	* @return int(11)
	* @desc Renvoie le membre CarId de la ListeCaracteristiqueViewVO
	*/
	public function getCarId() {
		return $this->mCarId;
	}

	/**
	* @name setCarId($pCarId)
	* @param int(11)
	* @desc Remplace le membre CarId de la ListeCaracteristiqueViewVO par $pCarId
	*/
	public function setCarId($pCarId) {
		$this->mCarId = $pCarId;
	}

	/**
	* @name getCarNom()
	* @return varchar(50)
	* @desc Renvoie le membre CarNom de la ListeCaracteristiqueViewVO
	*/
	public function getCarNom() {
		return $this->mCarNom;
	}

	/**
	* @name setCarNom($pCarNom)
	* @param varchar(50)
	* @desc Remplace le membre CarNom de la ListeCaracteristiqueViewVO par $pCarNom
	*/
	public function setCarNom($pCarNom) {
		$this->mCarNom = $pCarNom;
	}

}
?>