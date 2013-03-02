<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueProduitVO.php
//
// Description : Classe CaracteristiqueProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaracteristiqueProduitVO
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une CaracteristiqueProduitVO
 */
class CaracteristiqueProduitVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CaracteristiqueProduitVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la CaracteristiqueProduitVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdCaracteristique de la CaracteristiqueProduitVO
	*/
	protected $mIdCaracteristique;

	/**
	* @var tinyint(1)
	* @desc Etat de la CaracteristiqueProduitVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CaracteristiqueProduitVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CaracteristiqueProduitVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la CaracteristiqueProduitVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la CaracteristiqueProduitVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getIdCaracteristique()
	* @return int(11)
	* @desc Renvoie le membre IdCaracteristique de la CaracteristiqueProduitVO
	*/
	public function getIdCaracteristique() {
		return $this->mIdCaracteristique;
	}

	/**
	* @name setIdCaracteristique($pIdCaracteristique)
	* @param int(11)
	* @desc Remplace le membre IdCaracteristique de la CaracteristiqueProduitVO par $pIdCaracteristique
	*/
	public function setIdCaracteristique($pIdCaracteristique) {
		$this->mIdCaracteristique = $pIdCaracteristique;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la CaracteristiqueProduitVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la CaracteristiqueProduitVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>