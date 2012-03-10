<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ListeProduitFermeResponse.php
//
// Description : Classe ListeProduitFermeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitFermeResponse
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une ListeProduitFermeResponse
 */
class ListeProduitFermeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la ListeProduitFermeResponse
	*/
	protected $mListeProduit;
	
	/**
	* @name ListeProduitFermeResponse()
	* @desc Le constructeur
	*/
	public function ListeProduitFermeResponse() {
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
	* @desc Renvoie le membre ListeProduit de la ListeProduitFermeResponse
	*/
	public function getListeProduit(){
		return $this->mListeProduit;
	}

	/**
	* @name setListeProduit($pListeProduit)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre ListeProduit de la ListeProduitFermeResponse par $pListeProduit
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