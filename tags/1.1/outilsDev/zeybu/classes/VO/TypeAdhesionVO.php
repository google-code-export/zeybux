<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : TypeAdhesionVO.php
//
// Description : Classe TypeAdhesionVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name TypeAdhesionVO
 * @author Julien PIERRE
 * @since 22/07/2012
 * @desc Classe représentant une TypeAdhesionVO
 */
class TypeAdhesionVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la TypeAdhesionVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdAdhesion de la TypeAdhesionVO
	*/
	protected $mIdAdhesion;

	/**
	* @var varchar(45)
	* @desc Label de la TypeAdhesionVO
	*/
	protected $mLabel;

	/**
	* @var tinyint(1)
	* @desc Perimetre de la TypeAdhesionVO
	*/
	protected $mPerimetre;

	/**
	* @var decimal(10,2)
	* @desc Montant de la TypeAdhesionVO
	*/
	protected $mMontant;

	/**
	* @var tinyint(1)
	* @desc Etat de la TypeAdhesionVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la TypeAdhesionVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la TypeAdhesionVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdAdhesion()
	* @return int(11)
	* @desc Renvoie le membre IdAdhesion de la TypeAdhesionVO
	*/
	public function getIdAdhesion() {
		return $this->mIdAdhesion;
	}

	/**
	* @name setIdAdhesion($pIdAdhesion)
	* @param int(11)
	* @desc Remplace le membre IdAdhesion de la TypeAdhesionVO par $pIdAdhesion
	*/
	public function setIdAdhesion($pIdAdhesion) {
		$this->mIdAdhesion = $pIdAdhesion;
	}

	/**
	* @name getLabel()
	* @return varchar(45)
	* @desc Renvoie le membre Label de la TypeAdhesionVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(45)
	* @desc Remplace le membre Label de la TypeAdhesionVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getPerimetre()
	* @return tinyint(1)
	* @desc Renvoie le membre Perimetre de la TypeAdhesionVO
	*/
	public function getPerimetre() {
		return $this->mPerimetre;
	}

	/**
	* @name setPerimetre($pPerimetre)
	* @param tinyint(1)
	* @desc Remplace le membre Perimetre de la TypeAdhesionVO par $pPerimetre
	*/
	public function setPerimetre($pPerimetre) {
		$this->mPerimetre = $pPerimetre;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la TypeAdhesionVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la TypeAdhesionVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la TypeAdhesionVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la TypeAdhesionVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>