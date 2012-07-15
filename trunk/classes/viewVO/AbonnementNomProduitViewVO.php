<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/03/2011
// Fichier : AbonnementNomProduitViewVO.php
//
// Description : Classe AbonnementNomProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AbonnementNomProduitViewVO
 * @author Julien PIERRE
 * @since 03/03/2011
 * @desc Classe représentant une AbonnementNomProduitViewVO
 */
class AbonnementNomProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NproIdFerme de la AbonnementNomProduitViewVO
	*/
	protected $mNproIdFerme;

	/**
	* @var int(11)
	* @desc NproId de la AbonnementNomProduitViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la AbonnementNomProduitViewVO
	*/
	protected $mNproNom;

	/**
	* @var varchar(50)
	* @desc CproNom de la AbonnementNomProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @var int(11)
	* @desc CproId de la AbonnementNomProduitViewVO
	*/
	protected $mCproId;

	/**
	* @name getNproIdFerme()
	* @return int(11)
	* @desc Renvoie le membre NproIdFerme de la AbonnementNomProduitViewVO
	*/
	public function getNproIdFerme() {
		return $this->mNproIdFerme;
	}

	/**
	* @name setNproIdFerme($pNproIdFerme)
	* @param int(11)
	* @desc Remplace le membre NproIdFerme de la AbonnementNomProduitViewVO par $pNproIdFerme
	*/
	public function setNproIdFerme($pNproIdFerme) {
		$this->mNproIdFerme = $pNproIdFerme;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la AbonnementNomProduitViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la AbonnementNomProduitViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la AbonnementNomProduitViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la AbonnementNomProduitViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la AbonnementNomProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la AbonnementNomProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la AbonnementNomProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la AbonnementNomProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

}
?>