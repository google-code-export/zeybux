<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueVO.php
//
// Description : Classe CaracteristiqueVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaracteristiqueVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une CaracteristiqueVO
 */
class CaracteristiqueVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CaracteristiqueVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc Nom de la CaracteristiqueVO
	*/
	protected $mNom;

	/**
	* @var text
	* @desc Description de la CaracteristiqueVO
	*/
	protected $mDescription;

	/**
	* @var tinyint(1)
	* @desc Etat de la CaracteristiqueVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CaracteristiqueVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CaracteristiqueVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la CaracteristiqueVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la CaracteristiqueVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le membre Description de la CaracteristiqueVO
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le membre Description de la CaracteristiqueVO par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la CaracteristiqueVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la CaracteristiqueVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>