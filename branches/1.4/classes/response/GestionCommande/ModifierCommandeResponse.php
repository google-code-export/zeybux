<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/11/2010
// Fichier : ModifierCommandeResponse.php
//
// Description : Classe ModifierCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModifierCommandeResponse
 * @author Julien PIERRE
 * @since 04/11/2010
 * @desc Classe représentant une ModifierCommandeResponse
 */
class ModifierCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var MarcheVO
	 * @desc La commande
	 */
	protected $mMarche;
	
	/**
	 * @var array(ProduitsViewVO)
	 * @desc La Liste des Produits
	 */
	protected $mProduits;
	
	/**
	 * @var array(ProducteursViewVO)
	 * @desc Les producteurs
	 */
	protected $mProducteurs;
	
	/**
	* @name ModifierCommandeResponse()
	* @desc Le constructeur
	*/
	public function ModifierCommandeResponse() {
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
	* @name getMarche()
	* @return MarcheVO
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param MarcheVO
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}

	/**
	* @name getProduits()
	* @return array(ProduitsVO)
	* @desc Renvoie le membre Produits de la EditerCommandeResponse
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(ProduitsVO)
	* @desc Remplace le membre Produits de la EditerCommandeResponse par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduits)
	* @param ProduitsVO
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