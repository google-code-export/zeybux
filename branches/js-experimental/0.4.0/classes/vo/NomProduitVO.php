<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/05/2010
// Fichier : NomProduitVO.php
//
// Description : Classe NomProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitVO
 * @author Julien PIERRE
 * @since 06/05/2010
 * @desc Classe représentant une NomProduitVO
 */
class NomProduitVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la NomProduitVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc Nom de la NomProduitVO
	*/
	protected $mNom;

	/**
	* @var text
	* @desc Description de la NomProduitVO
	*/
	protected $mDescription;

	/**
	* @var int(11)
	* @desc IdCategorie de la NomProduitVO
	*/
	protected $mIdCategorie;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la NomProduitVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la NomProduitVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la NomProduitVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la NomProduitVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le membre Description de la NomProduitVO
	*/
	public function getDescription(){
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le membre Description de la NomProduitVO par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getIdCategorie()
	* @return int(11)
	* @desc Renvoie le membre IdCategorie de la NomProduitVO
	*/
	public function getIdCategorie(){
		return $this->mIdCategorie;
	}

	/**
	* @name setIdCategorie($pIdCategorie)
	* @param int(11)
	* @desc Remplace le membre IdCategorie de la NomProduitVO par $pIdCategorie
	*/
	public function setIdCategorie($pIdCategorie) {
		$this->mIdCategorie = $pIdCategorie;
	}

}
?>