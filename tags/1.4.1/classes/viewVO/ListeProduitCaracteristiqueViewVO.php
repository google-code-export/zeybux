<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeProduitCaracteristiqueViewVO.php
//
// Description : Classe ListeProduitCaracteristiqueViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitCaracteristiqueViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une ListeProduitCaracteristiqueViewVO
 */
class ListeProduitCaracteristiqueViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CarProIdCaracteristique de la ListeProduitCaracteristiqueViewVO
	*/
	protected $mCarProIdCaracteristique;

	/**
	* @var int(11)
	* @desc CarProId de la ListeProduitCaracteristiqueViewVO
	*/
	protected $mCarProId;

	/**
	* @var int(11)
	* @desc NproId de la ListeProduitCaracteristiqueViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la ListeProduitCaracteristiqueViewVO
	*/
	protected $mNproNom;

	/**
	* @name getCarProIdCaracteristique()
	* @return int(11)
	* @desc Renvoie le membre CarProIdCaracteristique de la ListeProduitCaracteristiqueViewVO
	*/
	public function getCarProIdCaracteristique() {
		return $this->mCarProIdCaracteristique;
	}

	/**
	* @name setCarProIdCaracteristique($pCarProIdCaracteristique)
	* @param int(11)
	* @desc Remplace le membre CarProIdCaracteristique de la ListeProduitCaracteristiqueViewVO par $pCarProIdCaracteristique
	*/
	public function setCarProIdCaracteristique($pCarProIdCaracteristique) {
		$this->mCarProIdCaracteristique = $pCarProIdCaracteristique;
	}

	/**
	* @name getCarProId()
	* @return int(11)
	* @desc Renvoie le membre CarProId de la ListeProduitCaracteristiqueViewVO
	*/
	public function getCarProId() {
		return $this->mCarProId;
	}

	/**
	* @name setCarProId($pCarProId)
	* @param int(11)
	* @desc Remplace le membre CarProId de la ListeProduitCaracteristiqueViewVO par $pCarProId
	*/
	public function setCarProId($pCarProId) {
		$this->mCarProId = $pCarProId;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la ListeProduitCaracteristiqueViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la ListeProduitCaracteristiqueViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ListeProduitCaracteristiqueViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ListeProduitCaracteristiqueViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

}
?>