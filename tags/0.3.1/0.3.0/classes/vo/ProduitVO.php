<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : ProduitVO.php
//
// Description : Classe ProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitVO
 * @author Julien PIERRE
 * @since 10/06/2010
 * @desc Classe représentant une ProduitVO
 */
class ProduitVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ProduitVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCommande de la ProduitVO
	*/
	protected $mIdCommande;

	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitVO
	*/
	protected $mIdNomProduit;

	/**
	* @var varchar(20)
	* @desc UniteMesure de la ProduitVO
	*/
	protected $mUniteMesure;

	/**
	* @var int(11)
	* @desc MaxProduitCommande de la ProduitVO
	*/
	protected $mMaxProduitCommande;
	
	/**
	 * @var int(11)
	 * @desc ID du Producteur
	 */
	protected $mIdProducteur;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ProduitVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ProduitVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la ProduitVO
	*/
	public function getIdCommande(){
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la ProduitVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitVO
	*/
	public function getIdNomProduit(){
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre UniteMesure de la ProduitVO
	*/
	public function getUniteMesure(){
		return $this->mUniteMesure;
	}

	/**
	* @name setUniteMesure($pUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre UniteMesure de la ProduitVO par $pUniteMesure
	*/
	public function setUniteMesure($pUniteMesure) {
		$this->mUniteMesure = $pUniteMesure;
	}

	/**
	* @name getMaxProduitCommande()
	* @return int(11)
	* @desc Renvoie le membre MaxProduitCommande de la ProduitVO
	*/
	public function getMaxProduitCommande(){
		return $this->mMaxProduitCommande;
	}

	/**
	* @name setMaxProduitCommande($pMaxProduitCommande)
	* @param int(11)
	* @desc Remplace le membre MaxProduitCommande de la ProduitVO par $pMaxProduitCommande
	*/
	public function setMaxProduitCommande($pMaxProduitCommande) {
		$this->mMaxProduitCommande = $pMaxProduitCommande;
	}
	
	/**
	* @name getIdProducteur()
	* @return int(11)
	* @desc Renvoie l'IdProducteur du Produit
	*/
	public function getIdProducteur() {
		return $this->mIdProducteur;
	}

	/**
	* @name setIdProducteur($pIdProducteur)
	* @param int(11)
	* @desc Remplace l'IdProducteur par $pIdProducteur
	*/
	public function setIdProducteur($pIdProducteur) {
		$this->mIdProducteur = $pIdProducteur;
	}
}
?>