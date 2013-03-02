<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueVO.php
//
// Description : Classe BanqueVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name BanqueVO
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une BanqueVO
 */
class BanqueVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la BanqueVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc NomCourt de la BanqueVO
	*/
	protected $mNomCourt;

	/**
	* @var varchar(200)
	* @desc Nom de la BanqueVO
	*/
	protected $mNom;

	/**
	* @var text
	* @desc Description de la BanqueVO
	*/
	protected $mDescription;

	/**
	* @var tinyint(4)
	* @desc Etat de la BanqueVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la BanqueVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la BanqueVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNomCourt()
	* @return varchar(50)
	* @desc Renvoie le membre NomCourt de la BanqueVO
	*/
	public function getNomCourt() {
		return $this->mNomCourt;
	}

	/**
	* @name setNomCourt($pNomCourt)
	* @param varchar(50)
	* @desc Remplace le membre NomCourt de la BanqueVO par $pNomCourt
	*/
	public function setNomCourt($pNomCourt) {
		$this->mNomCourt = $pNomCourt;
	}

	/**
	* @name getNom()
	* @return varchar(200)
	* @desc Renvoie le membre Nom de la BanqueVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(200)
	* @desc Remplace le membre Nom de la BanqueVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le membre Description de la BanqueVO
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le membre Description de la BanqueVO par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la BanqueVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la BanqueVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>