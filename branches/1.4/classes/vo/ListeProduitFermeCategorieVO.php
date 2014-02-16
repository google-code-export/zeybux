<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/03/2012
// Fichier : ListeProduitFermeCategorieVO.php
//
// Description : Classe ListeProduitFermeCategorieVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitFermeCategorieVO
 * @author Julien PIERRE
 * @since 01/03/2012
 * @desc Classe représentant une ListeProduitFermeCategorieVO
 */
class ListeProduitFermeCategorieVO extends DataTemplate
{
	/**
	* @var string(50)
	* @desc Nom de la ListeProduitFermeCategorieVO
	*/
	protected $mNom;
	
	/**
	* @var array(ListeProduitFermeCategorieProduitVO)
	* @desc Produits de la ListeProduitFermeCategorieVO
	*/
	protected $mProduits;
	
	/**
	* @name ListeProduitFermeCategorieVO()
	* @desc Le constructeur
	*/
	public function ListeProduitFermeCategorieVO() {
		$this->mProduits = array();
	}
	
	/**
	* @name getNom()
	* @return string(50)
	* @desc Renvoie le membre Nom de la ListeProduitFermeCategorieVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param string(50)
	* @desc Remplace le membre Nom de la ListeProduitFermeCategorieVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getProduits()
	* @return array(ListeProduitFermeCategorieProduitVO)
	* @desc Renvoie le membre Produits de la ListeProduitFermeCategorieVO
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(ListeProduitFermeCategorieProduitVO)
	* @desc Remplace le membre Produits de la ListeProduitFermeCategorieVO par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduit)
	* @param ListeProduitFermeCategorieProduitVO
	* @desc Ajoute $pFerme à Produits
	*/
	public function addProduits($pProduit){
		array_push($this->mProduits,$pProduit);
	}
}
?>