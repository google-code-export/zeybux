<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : TypepaiementVO.php
//
// Description : Classe TypepaiementVO
//
//****************************************************************

/**
 * @name TypepaiementVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une TypepaiementVO
 */
class TypepaiementVO
{
	/**
	* @var int(11)
	* @desc Id de la TypepaiementVO
	*/
	private $mId;

	/**
	* @var varchar(100)
	* @desc Type de la TypepaiementVO
	*/
	private $mType;

	/**
	* @var tinyint(4)
	* @desc ChampComplementaire de la TypepaiementVO
	*/
	private $mChampComplementaire;

	/**
	* @var varchar(30)
	* @desc LabelChampComplementaire de la TypepaiementVO
	*/
	private $mLabelChampComplementaire;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la TypepaiementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la TypepaiementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getType()
	* @return varchar(100)
	* @desc Renvoie le membre Type de la TypepaiementVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param varchar(100)
	* @desc Remplace le membre Type de la TypepaiementVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getChampComplementaire()
	* @return tinyint(4)
	* @desc Renvoie le membre ChampComplementaire de la TypepaiementVO
	*/
	public function getChampComplementaire() {
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pChampComplementaire)
	* @param tinyint(4)
	* @desc Remplace le membre ChampComplementaire de la TypepaiementVO par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}

	/**
	* @name getLabelChampComplementaire()
	* @return varchar(30)
	* @desc Renvoie le membre LabelChampComplementaire de la TypepaiementVO
	*/
	public function getLabelChampComplementaire() {
		return $this->mLabelChampComplementaire;
	}

	/**
	* @name setLabelChampComplementaire($pLabelChampComplementaire)
	* @param varchar(30)
	* @desc Remplace le membre LabelChampComplementaire de la TypepaiementVO par $pLabelChampComplementaire
	*/
	public function setLabelChampComplementaire($pLabelChampComplementaire) {
		$this->mLabelChampComplementaire = $pLabelChampComplementaire;
	}

}
?>