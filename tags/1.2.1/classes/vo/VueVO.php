<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/06/2011
// Fichier : VueVO.php
//
// Description : Classe VueVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name VueVO
 * @author Julien PIERRE
 * @since 25/06/2011
 * @desc Classe représentant une VueVO
 */
class VueVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la VueVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdModule de la VueVO
	*/
	protected $mIdModule;

	/**
	* @var varchar(50)
	* @desc Nom de la VueVO
	*/
	protected $mNom;

	/**
	* @var varchar(80)
	* @desc Label de la VueVO
	*/
	protected $mLabel;

	/**
	* @var int(11)
	* @desc Ordre de la VueVO
	*/
	protected $mOrdre;

	/**
	* @var tinyint(1)
	* @desc Visible de la VueVO
	*/
	protected $mVisible;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la VueVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la VueVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdModule()
	* @return int(11)
	* @desc Renvoie le membre IdModule de la VueVO
	*/
	public function getIdModule() {
		return $this->mIdModule;
	}

	/**
	* @name setIdModule($pIdModule)
	* @param int(11)
	* @desc Remplace le membre IdModule de la VueVO par $pIdModule
	*/
	public function setIdModule($pIdModule) {
		$this->mIdModule = $pIdModule;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la VueVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la VueVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getLabel()
	* @return varchar(80)
	* @desc Renvoie le membre Label de la VueVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(80)
	* @desc Remplace le membre Label de la VueVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getOrdre()
	* @return int(11)
	* @desc Renvoie le membre Ordre de la VueVO
	*/
	public function getOrdre() {
		return $this->mOrdre;
	}

	/**
	* @name setOrdre($pOrdre)
	* @param int(11)
	* @desc Remplace le membre Ordre de la VueVO par $pOrdre
	*/
	public function setOrdre($pOrdre) {
		$this->mOrdre = $pOrdre;
	}

	/**
	* @name getVisible()
	* @return tinyint(1)
	* @desc Renvoie le membre Visible de la VueVO
	*/
	public function getVisible() {
		return $this->mVisible;
	}

	/**
	* @name setVisible($pVisible)
	* @param tinyint(1)
	* @desc Remplace le membre Visible de la VueVO par $pVisible
	*/
	public function setVisible($pVisible) {
		$this->mVisible = $pVisible;
	}

}
?>