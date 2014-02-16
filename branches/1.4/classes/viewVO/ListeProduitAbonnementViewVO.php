<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : ListeProduitAbonnementViewVO.php
//
// Description : Classe ListeProduitAbonnementViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitAbonnementViewVO
 * @author Julien PIERRE
 * @since 11/02/2012
 * @desc Classe représentant une ListeProduitAbonnementViewVO
 */
class ListeProduitAbonnementViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProAboId de la ListeProduitAbonnementViewVO
	*/
	protected $mProAboId;

	/**
	* @var text
	* @desc FerNom de la ListeProduitAbonnementViewVO
	*/
	protected $mFerNom;

	/**
	* @var varchar(50)
	* @desc CproNom de la ListeProduitAbonnementViewVO
	*/
	protected $mCproNom;

	/**
	* @var varchar(50)
	* @desc NproNom de la ListeProduitAbonnementViewVO
	*/
	protected $mNproNom;

	/**
	* @name getProAboId()
	* @return int(11)
	* @desc Renvoie le membre ProAboId de la ListeProduitAbonnementViewVO
	*/
	public function getProAboId() {
		return $this->mProAboId;
	}

	/**
	* @name setProAboId($pProAboId)
	* @param int(11)
	* @desc Remplace le membre ProAboId de la ListeProduitAbonnementViewVO par $pProAboId
	*/
	public function setProAboId($pProAboId) {
		$this->mProAboId = $pProAboId;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeProduitAbonnementViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeProduitAbonnementViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ListeProduitAbonnementViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ListeProduitAbonnementViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ListeProduitAbonnementViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ListeProduitAbonnementViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

}
?>