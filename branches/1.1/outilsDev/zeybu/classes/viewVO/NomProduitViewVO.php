<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitViewVO.php
//
// Description : Classe NomProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitViewVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitViewVO
 */
class NomProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NProId de la NomProduitViewVO
	*/
	protected $mNProId;

	/**
	* @var int(11)
	* @desc NProIdFerme de la NomProduitViewVO
	*/
	protected $mNProIdFerme;

	/**
	* @var varchar(50)
	* @desc CproNom de la NomProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @var varchar(50)
	* @desc NproNom de la NomProduitViewVO
	*/
	protected $mNproNom;

	/**
	* @var text
	* @desc NProDescription de la NomProduitViewVO
	*/
	protected $mNProDescription;

	/**
	* @var int(11)
	* @desc CproId de la NomProduitViewVO
	*/
	protected $mCproId;

	/**
	* @name getNProId()
	* @return int(11)
	* @desc Renvoie le membre NProId de la NomProduitViewVO
	*/
	public function getNProId() {
		return $this->mNProId;
	}

	/**
	* @name setNProId($pNProId)
	* @param int(11)
	* @desc Remplace le membre NProId de la NomProduitViewVO par $pNProId
	*/
	public function setNProId($pNProId) {
		$this->mNProId = $pNProId;
	}

	/**
	* @name getNProIdFerme()
	* @return int(11)
	* @desc Renvoie le membre NProIdFerme de la NomProduitViewVO
	*/
	public function getNProIdFerme() {
		return $this->mNProIdFerme;
	}

	/**
	* @name setNProIdFerme($pNProIdFerme)
	* @param int(11)
	* @desc Remplace le membre NProIdFerme de la NomProduitViewVO par $pNProIdFerme
	*/
	public function setNProIdFerme($pNProIdFerme) {
		$this->mNProIdFerme = $pNProIdFerme;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la NomProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la NomProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la NomProduitViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la NomProduitViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getNProDescription()
	* @return text
	* @desc Renvoie le membre NProDescription de la NomProduitViewVO
	*/
	public function getNProDescription() {
		return $this->mNProDescription;
	}

	/**
	* @name setNProDescription($pNProDescription)
	* @param text
	* @desc Remplace le membre NProDescription de la NomProduitViewVO par $pNProDescription
	*/
	public function setNProDescription($pNProDescription) {
		$this->mNProDescription = $pNProDescription;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la NomProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la NomProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

}
?>