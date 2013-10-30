<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : ChampComplementaireVO.php
//
// Description : Classe ChampComplementaireVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ChampComplementaireVO
 * @author Julien PIERRE
 * @since 15/06/2013
 * @desc Classe représentant une ChampComplementaireVO
 */
class ChampComplementaireVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ChampComplementaireVO
	*/
	protected $mId;

	/**
	* @var varchar(30)
	* @desc Label de la ChampComplementaireVO
	*/
	protected $mLabel;

	/**
	* @var tinyint(1)
	* @desc Obligatoire de la ChampComplementaireVO
	*/
	protected $mObligatoire;

	/**
	* @var tinyint(1)
	* @desc Etat de la ChampComplementaireVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ChampComplementaireVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ChampComplementaireVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(30)
	* @desc Renvoie le membre Label de la ChampComplementaireVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(30)
	* @desc Remplace le membre Label de la ChampComplementaireVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getObligatoire()
	* @return tinyint(1)
	* @desc Renvoie le membre Obligatoire de la ChampComplementaireVO
	*/
	public function getObligatoire() {
		return $this->mObligatoire;
	}

	/**
	* @name setObligatoire($pObligatoire)
	* @param tinyint(1)
	* @desc Remplace le membre Obligatoire de la ChampComplementaireVO par $pObligatoire
	*/
	public function setObligatoire($pObligatoire) {
		$this->mObligatoire = $pObligatoire;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la ChampComplementaireVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la ChampComplementaireVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>