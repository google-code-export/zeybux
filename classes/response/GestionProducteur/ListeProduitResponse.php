<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : ListeProduitResponse.php
//
// Description : Classe ListeProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitResponse
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une ListeProduitResponse
 */
class ListeProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la ListeProduitResponse
	*/
	protected $mListeProduit;
	
	/**
	* @name ListeProduitResponse()
	* @desc Le constructeur
	*/
	public function ListeProduitResponse() {
		$this->mValid = true;
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
	* @name getListeProduit()
	* @return array(NomProduitViewVO)
	* @desc Renvoie le membre ListeProduit de la ListeProduitResponse
	*/
	public function getListeProduit(){
		return $this->mListeProduit;
	}

	/**
	* @name setListeProduit($pListeProduit)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre ListeProduit de la ListeProduitResponse par $pListeProduit
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