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
	 * @var array(CommandeCompleteViewVO)
	 * @desc La commande
	 */
	protected $mCommande;
	
	/**
	 * @var array(StockVO)
	 * @desc Les Stocks Initiaux
	 */
	protected $mStockInitiaux;
	
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
		$this->mCommande = array();
		$this->mStockInitiaux = array();
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
	* @name getCommande()
	* @return array(CommandeCompleteViewVO)
	* @desc Renvoie le Commande
	*/
	public function getCommande() {
		return $this->mCommande;
	}

	/**
	* @name setCommande($pCommande)
	* @param array(CommandeCompleteViewVO)
	* @desc Remplace le Commande par $pCommande
	*/
	public function setCommande($pCommande) {
		$this->mCommande = $pCommande;
	}
	
	/**
	* @name addCommande($pCommande)
	* @param CommandeCompleteViewVO
	* @desc Ajoute le $pCommande à Commande
	*/
	public function addCommande($pCommande) {
		array_push($this->mCommande, $pCommande);
	}
		
	/**
	* @name addStock($pStock)
	* @param StockProduitViewVO
	* @desc Ajoute Stock à $pStock
	*/
	public function addStock($pStock) {
		array_push($this->mStock, $pStock);
	}
	
	/**
	* @name getStockInitiaux()
	* @return array(StockVO)
	* @desc Renvoie le Stock Initiaux
	*/
	public function getStockInitiaux() {
		return $this->mStockInitiaux;
	}

	/**
	* @name setStockInitiaux($pStockInitiaux)
	* @param array(StockVO)
	* @desc Remplace le Stock par $pStock
	*/
	public function setStockInitiaux($pStockInitiaux) {
		$this->mStockInitiaux = $pStockInitiaux;
	}
	
	/**
	* @name addStockInitiaux($pStockInitiaux)
	* @param StockVO
	* @desc Ajoute StockInitiaux à $pStockInitiaux
	*/
	public function addStockInitiaux($pStockInitiaux) {
		array_push($this->mStockInitiaux, $pStockInitiaux);
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