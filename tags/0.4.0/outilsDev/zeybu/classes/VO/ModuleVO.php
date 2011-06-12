<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : ModuleVO.php
//
// Description : Classe ModuleVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModuleVO
 * @author Julien PIERRE
 * @since 22/12/2010
 * @desc Classe représentant une ModuleVO
 */
class ModuleVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ModuleVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc Nom de la ModuleVO
	*/
	protected $mNom;

	/**
	* @var varchar(80)
	* @desc Label de la ModuleVO
	*/
	protected $mLabel;

	/**
	* @var tinyint(1)
	* @desc Defaut de la ModuleVO
	*/
	protected $mDefaut;

	/**
	* @var int(11)
	* @desc Ordre de la ModuleVO
	*/
	protected $mOrdre;

	/**
	* @var tinyint(1)
	* @desc Admin de la ModuleVO
	*/
	protected $mAdmin;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ModuleVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ModuleVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la ModuleVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la ModuleVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getLabel()
	* @return varchar(80)
	* @desc Renvoie le membre Label de la ModuleVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(80)
	* @desc Remplace le membre Label de la ModuleVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getDefaut()
	* @return tinyint(1)
	* @desc Renvoie le membre Defaut de la ModuleVO
	*/
	public function getDefaut() {
		return $this->mDefaut;
	}

	/**
	* @name setDefaut($pDefaut)
	* @param tinyint(1)
	* @desc Remplace le membre Defaut de la ModuleVO par $pDefaut
	*/
	public function setDefaut($pDefaut) {
		$this->mDefaut = $pDefaut;
	}

	/**
	* @name getOrdre()
	* @return int(11)
	* @desc Renvoie le membre Ordre de la ModuleVO
	*/
	public function getOrdre() {
		return $this->mOrdre;
	}

	/**
	* @name setOrdre($pOrdre)
	* @param int(11)
	* @desc Remplace le membre Ordre de la ModuleVO par $pOrdre
	*/
	public function setOrdre($pOrdre) {
		$this->mOrdre = $pOrdre;
	}

	/**
	* @name getAdmin()
	* @return tinyint(1)
	* @desc Renvoie le membre Admin de la ModuleVO
	*/
	public function getAdmin() {
		return $this->mAdmin;
	}

	/**
	* @name setAdmin($pAdmin)
	* @param tinyint(1)
	* @desc Remplace le membre Admin de la ModuleVO par $pAdmin
	*/
	public function setAdmin($pAdmin) {
		$this->mAdmin = $pAdmin;
	}

}
?>