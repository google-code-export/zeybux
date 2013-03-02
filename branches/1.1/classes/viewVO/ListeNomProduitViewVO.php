<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeNomProduitViewVO.php
//
// Description : Classe ListeNomProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeNomProduitViewVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une ListeNomProduitViewVO
 */
class ListeNomProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NproIdFerme de la ListeNomProduitViewVO
	*/
	protected $mNproIdFerme;

	/**
	* @var int(11)
	* @desc NproId de la ListeNomProduitViewVO
	*/
	protected $mNproId;

	/**
	* @var varchar(50)
	* @desc NproNom de la ListeNomProduitViewVO
	*/
	protected $mNproNom;

	/**
	* @var varchar(50)
	* @desc CproNom de la ListeNomProduitViewVO
	*/
	protected $mCproNom;

	/**
	* @var int(11)
	* @desc CproId de la ListeNomProduitViewVO
	*/
	protected $mCproId;

	/**
	* @name getNproIdFerme()
	* @return int(11)
	* @desc Renvoie le membre NproIdFerme de la ListeNomProduitViewVO
	*/
	public function getNproIdFerme() {
		return $this->mNproIdFerme;
	}

	/**
	* @name setNproIdFerme($pNproIdFerme)
	* @param int(11)
	* @desc Remplace le membre NproIdFerme de la ListeNomProduitViewVO par $pNproIdFerme
	*/
	public function setNproIdFerme($pNproIdFerme) {
		$this->mNproIdFerme = $pNproIdFerme;
	}

	/**
	* @name getNproId()
	* @return int(11)
	* @desc Renvoie le membre NproId de la ListeNomProduitViewVO
	*/
	public function getNproId() {
		return $this->mNproId;
	}

	/**
	* @name setNproId($pNproId)
	* @param int(11)
	* @desc Remplace le membre NproId de la ListeNomProduitViewVO par $pNproId
	*/
	public function setNproId($pNproId) {
		$this->mNproId = $pNproId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ListeNomProduitViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ListeNomProduitViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ListeNomProduitViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ListeNomProduitViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la ListeNomProduitViewVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la ListeNomProduitViewVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}

}
?>