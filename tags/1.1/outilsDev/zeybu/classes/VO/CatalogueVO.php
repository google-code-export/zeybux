<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/10/2011
// Fichier : CatalogueVO.php
//
// Description : Classe CatalogueVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CatalogueVO
 * @author Julien PIERRE
 * @since 22/10/2011
 * @desc Classe représentant une CatalogueVO
 */
class CatalogueVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CatalogueVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la CatalogueVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdFerme de la CatalogueVO
	*/
	protected $mIdFerme;

	/**
	* @var tinyint(1)
	* @desc Etat de la CatalogueVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CatalogueVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CatalogueVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la CatalogueVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la CatalogueVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getIdFerme()
	* @return int(11)
	* @desc Renvoie le membre IdFerme de la CatalogueVO
	*/
	public function getIdFerme() {
		return $this->mIdFerme;
	}

	/**
	* @name setIdFerme($pIdFerme)
	* @param int(11)
	* @desc Remplace le membre IdFerme de la CatalogueVO par $pIdFerme
	*/
	public function setIdFerme($pIdFerme) {
		$this->mIdFerme = $pIdFerme;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la CatalogueVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la CatalogueVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>