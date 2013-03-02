<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitProducteurViewVO.php
//
// Description : Classe NomProduitProducteurViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitProducteurViewVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitProducteurViewVO
 */
class NomProduitProducteurViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc NPrdtIdNomProduit de la NomProduitProducteurViewVO
	*/
	protected $mNPrdtIdNomProduit;

	/**
	* @var int(11)
	* @desc PrdtId de la NomProduitProducteurViewVO
	*/
	protected $mPrdtId;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la NomProduitProducteurViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la NomProduitProducteurViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @var text
	* @desc PrdtCommentaire de la NomProduitProducteurViewVO
	*/
	protected $mPrdtCommentaire;
	
	/**
	* @var int(11)
	* @desc NPrdtId de la NomProduitProducteurViewVO
	*/
	protected $mNPrdtId;

	/**
	* @name getNPrdtIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre NPrdtIdNomProduit de la NomProduitProducteurViewVO
	*/
	public function getNPrdtIdNomProduit() {
		return $this->mNPrdtIdNomProduit;
	}

	/**
	* @name setNPrdtIdNomProduit($pNPrdtIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre NPrdtIdNomProduit de la NomProduitProducteurViewVO par $pNPrdtIdNomProduit
	*/
	public function setNPrdtIdNomProduit($pNPrdtIdNomProduit) {
		$this->mNPrdtIdNomProduit = $pNPrdtIdNomProduit;
	}

	/**
	* @name getPrdtId()
	* @return int(11)
	* @desc Renvoie le membre PrdtId de la NomProduitProducteurViewVO
	*/
	public function getPrdtId() {
		return $this->mPrdtId;
	}

	/**
	* @name setPrdtId($pPrdtId)
	* @param int(11)
	* @desc Remplace le membre PrdtId de la NomProduitProducteurViewVO par $pPrdtId
	*/
	public function setPrdtId($pPrdtId) {
		$this->mPrdtId = $pPrdtId;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la NomProduitProducteurViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la NomProduitProducteurViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la NomProduitProducteurViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la NomProduitProducteurViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

	/**
	* @name getPrdtCommentaire()
	* @return text
	* @desc Renvoie le membre PrdtCommentaire de la NomProduitProducteurViewVO
	*/
	public function getPrdtCommentaire() {
		return $this->mPrdtCommentaire;
	}

	/**
	* @name setPrdtCommentaire($pPrdtCommentaire)
	* @param text
	* @desc Remplace le membre PrdtCommentaire de la NomProduitProducteurViewVO par $pPrdtCommentaire
	*/
	public function setPrdtCommentaire($pPrdtCommentaire) {
		$this->mPrdtCommentaire = $pPrdtCommentaire;
	}

	/**
	* @name getNPrdtId()
	* @return int(11)
	* @desc Renvoie le membre NPrdtId de la NomProduitProducteurViewVO
	*/
	public function getNPrdtId() {
		return $this->mNPrdtId;
	}

	/**
	* @name setNPrdtId($pNPrdtId)
	* @param int(11)
	* @desc Remplace le membre NPrdtId de la NomProduitProducteurViewVO par $pNPrdtId
	*/
	public function setNPrdtId($pNPrdtId) {
		$this->mNPrdtId = $pNPrdtId;
	}
}
?>