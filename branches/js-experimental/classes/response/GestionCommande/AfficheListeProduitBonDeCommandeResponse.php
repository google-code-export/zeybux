<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : AfficheListeProduitBonDeCommandeResponse.php
//
// Description : Classe AfficheListeProduitBonDeCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheListeProduitBonDeCommandeResponse
 * @author Julien PIERRE
 * @since 09/01/2011
 * @desc Classe représentant une AfficheListeProduitBonDeCommandeResponse
 */
class AfficheListeProduitBonDeCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	 * @var array(StockProduitReservationViewVO)
	 * @desc Les produits
	 */
	protected $mProduits;
	
	/**
	 * @var array(StockCommandeViewVO)
	 * @desc Les produits en commande
	 */
	protected $mProduitsCommande;
	
	/**
	* @name AfficheListeProduitBonDeCommandeResponse()
	* @desc Le constructeur
	*/
	public function AfficheListeProduitBonDeCommandeResponse() {
		$this->mValid = true;
		$this->mProduits = array();
		$this->mProduitsCommande = array();
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
	* @return array(StockProduitReservationViewVO)
	* @desc Renvoie les Produits
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(StockProduitReservationViewVO)
	* @desc Remplace le Produits par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduits)
	* @param StockProduitReservationViewVO
	* @desc Ajoute Produits à Produits
	*/
	public function addProduits($pProduits){
		array_push($this->mProduits,$pProduits);
	}
	
	/**
	* @name getProduitsCommande()
	* @return array(StockCommandeViewVO)
	* @desc Renvoie les ProduitsCommande
	*/
	public function getProduitsCommande() {
		return $this->mProduitsCommande;
	}

	/**
	* @name setProduitsCommande($pProduitsCommande)
	* @param array(StockCommandeViewVO)
	* @desc Remplace le ProduitsCommande par $pProduitsCommande
	*/
	public function setProduitsCommande($pProduitsCommande) {
		$this->mProduitsCommande = $pProduitsCommande;
	}
	
	/**
	* @name addProduitsCommande($pProduitsCommande)
	* @param StockCommandeViewVO
	* @desc Ajoute ProduitsCommande à ProduitsCommande
	*/
	public function addProduitsCommande($pProduitsCommande){
		array_push($this->mProduitsCommande,$pProduitsCommande);
	}
}
?>