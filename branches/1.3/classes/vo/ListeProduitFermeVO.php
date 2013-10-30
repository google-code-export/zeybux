<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/03/2012
// Fichier : ListeProduitFermeVO.php
//
// Description : Classe ListeProduitFermeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitFermeVO
 * @author Julien PIERRE
 * @since 01/03/2012
 * @desc Classe représentant une ListeProduitFermeVO
 */
class ListeProduitFermeVO extends DataTemplate
{
	/**
	* @var text
	* @desc Nom de la ListeProduitFermeVO
	*/
	protected $mNom;
	
	/**
	* @var array(ListeProduitFermeCategorieVO)
	* @desc Categories de la ListeProduitFermeVO
	*/
	protected $mCategories;
	
	/**
	* @name ListeProduitFermeVO()
	* @desc Le constructeur
	*/
	public function ListeProduitFermeVO() {
		$this->mCategories = array();
	}
	
	/**
	* @name getNom()
	* @return text
	* @desc Renvoie le membre Nom de la ListeProduitFermeVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param text
	* @desc Remplace le membre Nom de la ListeProduitFermeVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getCategories()
	* @return array(ListeProduitFermeCategorieVO)
	* @desc Renvoie le membre Categories de la ListeProduitFermeVO
	*/
	public function getCategories(){
		return $this->mCategories;
	}

	/**
	* @name setCategories($pCategories)
	* @param array(ListeProduitFermeCategorieVO)
	* @desc Remplace le membre Categories de la ListeProduitFermeVO par $pCategories
	*/
	public function setCategories($pCategories) {
		$this->mCategories = $pCategories;
	}
	
	/**
	* @name addCategories($pCategorie)
	* @param ListeProduitFermeCategorieVO
	* @desc Ajoute $pFerme à Categories
	*/
	public function addCategories($pCategorie){
		array_push($this->mCategories,$pCategorie);
	}
}
?>