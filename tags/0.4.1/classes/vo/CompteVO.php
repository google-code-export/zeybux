<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : CompteVO.php
//
// Description : Classe CompteVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une CompteVO
 */
class CompteVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CompteVO
	*/
	protected $mId;

	/**
	* @var varchar(30)
	* @desc Label de la CompteVO
	*/
	protected $mLabel;


	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CompteVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CompteVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(30)
	* @desc Renvoie le membre Label de la CompteVO
	*/
	public function getLabel(){
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(30)
	* @desc Remplace le membre Label de la CompteVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}
}
?>