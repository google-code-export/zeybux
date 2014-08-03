<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ListeProduitAbonnementResponse.php
//
// Description : Classe ListeProduitAbonnementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitAbonnementResponse
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une ListeProduitAbonnementResponse
 */
class ListeProduitAbonnementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ProduitsViewVO)
	* @desc Produits de la ListeProduitAbonnementResponse
	*/
	protected $mProduits;
	
	/**
	* @name ListeProduitAbonnementResponse()
	* @desc Le constructeur de ListeProduitAbonnementResponse
	*/	
	public function ListeProduitAbonnementResponse() {
		$this->mValid = true;
		$this->mProduits = array();
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
	* @return array(ProduitsViewVO)
	* @desc Renvoie le membre Produits de la ListeProduitAbonnementResponse
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(ProduitsViewVO)
	* @desc Remplace le membre Produits de la ListeProduitAbonnementResponse par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduits)
	* @param ProduitsViewVO
	* @desc Ajoute $pProduits à Produits
	*/
	public function addProduits($pProduits){
		array_push($this->mProduits,$pProduits);
	}
}
?>