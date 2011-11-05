<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : CaracteristiqueProduitViewVO.php
//
// Description : Classe CaracteristiqueProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaracteristiqueProduitViewVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une CaracteristiqueProduitViewVO
 */
class CaracteristiqueProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CarProIdNomProduit de la CaracteristiqueProduitViewVO
	*/
	protected $mCarProIdNomProduit;

	/**
	* @var int(11)
	* @desc CarId de la CaracteristiqueProduitViewVO
	*/
	protected $mCarId;

	/**
	* @var varchar(50)
	* @desc CarNom de la CaracteristiqueProduitViewVO
	*/
	protected $mCarNom;

	/**
	* @var text
	* @desc CarDescription de la CaracteristiqueProduitViewVO
	*/
	protected $mCarDescription;
	
	/**
	* @var int(11)
	* @desc CarProId de la CaracteristiqueProduitViewVO
	*/
	protected $mCarProId;

	/**
	* @name getCarProIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre CarProIdNomProduit de la CaracteristiqueProduitViewVO
	*/
	public function getCarProIdNomProduit() {
		return $this->mCarProIdNomProduit;
	}

	/**
	* @name setCarProIdNomProduit($pCarProIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre CarProIdNomProduit de la CaracteristiqueProduitViewVO par $pCarProIdNomProduit
	*/
	public function setCarProIdNomProduit($pCarProIdNomProduit) {
		$this->mCarProIdNomProduit = $pCarProIdNomProduit;
	}

	/**
	* @name getCarId()
	* @return int(11)
	* @desc Renvoie le membre CarId de la CaracteristiqueProduitViewVO
	*/
	public function getCarId() {
		return $this->mCarId;
	}

	/**
	* @name setCarId($pCarId)
	* @param int(11)
	* @desc Remplace le membre CarId de la CaracteristiqueProduitViewVO par $pCarId
	*/
	public function setCarId($pCarId) {
		$this->mCarId = $pCarId;
	}

	/**
	* @name getCarNom()
	* @return varchar(50)
	* @desc Renvoie le membre CarNom de la CaracteristiqueProduitViewVO
	*/
	public function getCarNom() {
		return $this->mCarNom;
	}

	/**
	* @name setCarNom($pCarNom)
	* @param varchar(50)
	* @desc Remplace le membre CarNom de la CaracteristiqueProduitViewVO par $pCarNom
	*/
	public function setCarNom($pCarNom) {
		$this->mCarNom = $pCarNom;
	}

	/**
	* @name getCarDescription()
	* @return text
	* @desc Renvoie le membre CarDescription de la CaracteristiqueProduitViewVO
	*/
	public function getCarDescription() {
		return $this->mCarDescription;
	}

	/**
	* @name setCarDescription($pCarDescription)
	* @param text
	* @desc Remplace le membre CarDescription de la CaracteristiqueProduitViewVO par $pCarDescription
	*/
	public function setCarDescription($pCarDescription) {
		$this->mCarDescription = $pCarDescription;
	}
	
	/**
	* @name getCarProId()
	* @return int(11)
	* @desc Renvoie le membre CarProId de la CaracteristiqueProduitViewVO
	*/
	public function getCarProId() {
		return $this->mCarProId;
	}

	/**
	* @name setCarProId($pCarProId)
	* @param int(11)
	* @desc Remplace le membre CarProId de la CaracteristiqueProduitViewVO par $pCarProId
	*/
	public function setCarProId($pCarProId) {
		$this->mCarProId = $pCarProId;
	}

}
?>