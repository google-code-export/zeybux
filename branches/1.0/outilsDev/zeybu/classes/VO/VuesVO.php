<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : VuesVO.php
//
// Description : Classe VuesVO
//
//****************************************************************

/**
 * @name VuesVO
 * @author Julien PIERRE
 * @since 10/06/2010
 * @desc Classe représentant une VuesVO
 */
class VuesVO
{
	/**
	* @var int(11)
	* @desc Id de la VuesVO
	*/
	private $mId;

	/**
	* @var int(11)
	* @desc IdModule de la VuesVO
	*/
	private $mIdModule;

	/**
	* @var varchar(50)
	* @desc Nom de la VuesVO
	*/
	private $mNom;

	/**
	* @var varchar(80)
	* @desc Label de la VuesVO
	*/
	private $mLabel;

	/**
	* @var int(11)
	* @desc Ordre de la VuesVO
	*/
	private $mOrdre;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la VuesVO
	*/
	public function getId(){
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
	public function getIdModule(){
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
	public function getNom(){
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
	public function getLabel(){
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
	public function getOrdre(){
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

}
?>