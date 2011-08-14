<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/09/2010
// Fichier : AfficheAjoutCommandeResponse.php
//
// Description : Classe AfficheAjoutCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheAjoutCommandeResponse
 * @author Julien PIERRE
 * @since 28/09/2010
 * @desc Classe représentant une AfficheAjoutCommandeResponse
 */
class AfficheAjoutCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var array(NomProduitVO)
	 * @desc Les produits
	 */
	protected $mProduits;
	
	/**
	 * @var array(ProducteursViewVO)
	 * @desc Les producteurs
	 */
	protected $mProducteurs;
	
	/**
	* @name AfficheAjoutCommandeResponse()
	* @desc Le constructeur
	*/
	public function AfficheAjoutCommandeResponse() {
		$this->mValid = true;
		$this->mProduits = array();
		$this->mProducteurs = array();
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
	* @name getProduits()
	* @return array(NomProduitVO)
	* @desc Renvoie les Produits
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(NomProduitVO)
	* @desc Remplace le Produits par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduits)
	* @param NomProduitVO
	* @desc Ajoute $pProduits à Produits
	*/
	public function addProduits($pProduits){
		array_push($this->mProduits,$pProduits);
	}
	
	/**
	* @name getProducteurs()
	* @return array(ProducteursViewVO)
	* @desc Renvoie les Producteurs
	*/
	public function getProducteurs() {
		return $this->mProducteurs;
	}

	/**
	* @name setProducteurs($pProducteurs)
	* @param array(ProducteursViewVO)
	* @desc Remplace le Producteurs par $pProducteurs
	*/
	public function setProducteurs($pProducteurs) {
		$this->mProducteurs = $pProducteurs;
	}
	
	/**
	* @name addProducteurs($pProducteurs)
	* @param ProducteursViewVO
	* @desc Ajoute $pProducteurs à Producteurs
	*/
	public function addProducteurs($pProducteurs){
		array_push($this->mProducteurs,$pProducteurs);
	}
}
?>