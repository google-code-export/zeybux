<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/06/2011
// Fichier : VuesVO.php
//
// Description : Classe VuesVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name VuesVO
 * @author Julien PIERRE
 * @since 25/06/2011
 * @desc Classe représentant une VuesVO
 */
class VuesVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la VuesVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdModule de la VuesVO
	*/
	protected $mIdModule;

	/**
	* @var varchar(50)
	* @desc Nom de la VuesVO
	*/
	protected $mNom;

	/**
	* @var varchar(80)
	* @desc Label de la VuesVO
	*/
	protected $mLabel;

	/**
	* @var int(11)
	* @desc Ordre de la VuesVO
	*/
	protected $mOrdre;

	/**
	* @var tinyint(1)
	* @desc Visible de la VuesVO
	*/
	protected $mVisible;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la VuesVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la VuesVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdModule()
	* @return int(11)
	* @desc Renvoie le membre IdModule de la VuesVO
	*/
	public function getIdModule() {
		return $this->mIdModule;
	}

	/**
	* @name setIdModule($pIdModule)
	* @param int(11)
	* @desc Remplace le membre IdModule de la VuesVO par $pIdModule
	*/
	public function setIdModule($pIdModule) {
		$this->mIdModule = $pIdModule;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la VuesVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la VuesVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getLabel()
	* @return varchar(80)
	* @desc Renvoie le membre Label de la VuesVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(80)
	* @desc Remplace le membre Label de la VuesVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getOrdre()
	* @return int(11)
	* @desc Renvoie le membre Ordre de la VuesVO
	*/
	public function getOrdre() {
		return $this->mOrdre;
	}

	/**
	* @name setOrdre($pOrdre)
	* @param int(11)
	* @desc Remplace le membre Ordre de la VuesVO par $pOrdre
	*/
	public function setOrdre($pOrdre) {
		$this->mOrdre = $pOrdre;
	}

	/**
	* @name getVisible()
	* @return tinyint(1)
	* @desc Renvoie le membre Visible de la VuesVO
	*/
	public function getVisible() {
		return $this->mVisible;
	}

	/**
	* @name setVisible($pVisible)
	* @param tinyint(1)
	* @desc Remplace le membre Visible de la VuesVO par $pVisible
	*/
	public function setVisible($pVisible) {
		$this->mVisible = $pVisible;
	}

}
?>