<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : TypePaiementVO.php
//
// Description : Classe TypePaiementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TypePaiementVO
 * @author Julien PIERRE
 * @since 15/06/2013
 * @desc Classe représentant une TypePaiementVO
 */
class TypePaiementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la TypePaiementVO
	*/
	protected $mId;

	/**
	* @var varchar(100)
	* @desc Type de la TypePaiementVO
	*/
	protected $mType;

	/**
	* @var tinyint(4)
	* @desc ChampComplementaire de la TypePaiementVO
	*/
	protected $mChampComplementaire;

	/**
	* @var tinyint(1)
	* @desc Visible de la TypePaiementVO
	*/
	protected $mVisible;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la TypePaiementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la TypePaiementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getType()
	* @return varchar(100)
	* @desc Renvoie le membre Type de la TypePaiementVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param varchar(100)
	* @desc Remplace le membre Type de la TypePaiementVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getChampComplementaire()
	* @return tinyint(4)
	* @desc Renvoie le membre ChampComplementaire de la TypePaiementVO
	*/
	public function getChampComplementaire() {
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pChampComplementaire)
	* @param tinyint(4)
	* @desc Remplace le membre ChampComplementaire de la TypePaiementVO par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}

	/**
	* @name getVisible()
	* @return tinyint(1)
	* @desc Renvoie le membre Visible de la TypePaiementVO
	*/
	public function getVisible() {
		return $this->mVisible;
	}

	/**
	* @name setVisible($pVisible)
	* @param tinyint(1)
	* @desc Remplace le membre Visible de la TypePaiementVO par $pVisible
	*/
	public function setVisible($pVisible) {
		$this->mVisible = $pVisible;
	}

}
?>