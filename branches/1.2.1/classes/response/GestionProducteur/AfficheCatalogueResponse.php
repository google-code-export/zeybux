<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : AfficheCatalogueResponse.php
//
// Description : Classe AfficheCatalogueResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheCatalogueResponse
 * @author Julien PIERRE
 * @since 09/10/2011
 * @desc Classe représentant une AfficheCatalogueResponse
 */
class AfficheCatalogueResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(CategorieProduitActiveViewVO)
	* @desc Liste des catégories de la AfficheCatalogueResponse
	*/
	protected $mListeCategorie;
	
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la AfficheCatalogueResponse
	*/
	protected $mListeProduit;
	
	/**
	* @name AfficheCatalogueResponse()
	* @desc Le constructeur
	*/
	public function AfficheCatalogueResponse() {
		$this->mValid = true;
		$this->mListeCategorie = array();
		$this->mListeProduit = array();
	}
	
	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}
	
	/**
	* @name getListeCategorie()
	* @return array(CategorieProduitActiveViewVO)
	* @desc Renvoie le membre ListeCategorie de la AfficheCatalogueResponse
	*/
	public function getListeCategorie(){
		return $this->mListeCategorie;
	}

	/**
	* @name setListeCategorie($pListeCategorie)
	* @param array(CategorieProduitActiveViewVO)
	* @desc Remplace le membre ListeCategorie de la AfficheCatalogueResponse par $pListeCategorie
	*/
	public function setListeCategorie($pListeCategorie) {
		$this->mListeCategorie = $pListeCategorie;
	}
	
	/**
	* @name addListeCategorie($pListeCategorie)
	* @param CategorieProduitActiveViewVO
	* @desc Ajoute $pListeCategorie à ListeCategorie
	*/
	public function addListeCategorie($pListeCategorie){
		array_push($this->mListeCategorie,$pListeCategorie);
	}
	
	/**
	* @name getListeProduit()
	* @return array(NomProduitViewVO)
	* @desc Renvoie le membre ListeProduit de la AfficheCatalogueResponse
	*/
	public function getListeProduit(){
		return $this->mListeProduit;
	}

	/**
	* @name setListeProduit($pListeProduit)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre ListeProduit de la AfficheCatalogueResponse par $pListeProduit
	*/
	public function setListeProduit($pListeProduit) {
		$this->mListeProduit = $pListeProduit;
	}
	
	/**
	* @name addListeProduit($pListeProduit)
	* @param NomProduitViewVO
	* @desc Ajoute $pListeProduit à ListeProduit
	*/
	public function addListeProduit($pListeProduit){
		array_push($this->mListeProduit,$pListeProduit);
	}
}
?>