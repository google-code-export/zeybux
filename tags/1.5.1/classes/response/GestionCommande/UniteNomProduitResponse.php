<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/08/2013
// Fichier : UniteNomProduitResponse.php
//
// Description : Classe UniteNomProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name UniteNomProduitResponse
 * @author Julien PIERRE
 * @since 14/08/2013
 * @desc Classe représentant une UniteNomProduitResponse
 */
class UniteNomProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var UniteNomProduitVO
	* @desc Liste des produits de la UniteNomProduitResponse
	*/
	protected $mUniteNomProduit;
	
	/**
	* @name UniteNomProduitResponse()
	* @desc Le constructeur
	*/
	public function UniteNomProduitResponse($pUniteNomProduit = null) {
		$this->mValid = true;
		if(!is_null($pUniteNomProduit)) {$this->mUniteNomProduit = $pUniteNomProduit; }
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
	* @name getUniteNomProduit()
	* @return UniteNomProduitVO
	* @desc Renvoie le membre UniteNomProduit de la UniteNomProduitResponse
	*/
	public function getUniteNomProduit(){
		return $this->mUniteNomProduit;
	}

	/**
	* @name setUniteNomProduit($pUniteNomProduit)
	* @param UniteNomProduitVO
	* @desc Remplace le membre UniteNomProduit de la UniteNomProduitResponse par $pUniteNomProduit
	*/
	public function setUniteNomProduit($pUniteNomProduit) {
		$this->mUniteNomProduit = $pUniteNomProduit;
	}
}
?>