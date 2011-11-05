<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitProducteurVO.php
//
// Description : Classe NomProduitProducteurVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitProducteurVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitProducteurVO
 */
class NomProduitProducteurVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la NomProduitProducteurVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la NomProduitProducteurVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdProducteur de la NomProduitProducteurVO
	*/
	protected $mIdProducteur;

	/**
	* @var tinyint(4)
	* @desc Etat de la NomProduitProducteurVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la NomProduitProducteurVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la NomProduitProducteurVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la NomProduitProducteurVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la NomProduitProducteurVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre IdProducteur de la NomProduitProducteurVO
	*/
	public function getIdProducteur() {
		return $this->mIdProducteur;
	}

	/**
	* @name setIdProducteur($pIdProducteur)
	* @param int(11)
	* @desc Remplace le membre IdProducteur de la NomProduitProducteurVO par $pIdProducteur
	*/
	public function setIdProducteur($pIdProducteur) {
		$this->mIdProducteur = $pIdProducteur;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la NomProduitProducteurVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la NomProduitProducteurVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>