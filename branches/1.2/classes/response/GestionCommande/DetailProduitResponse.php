<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/11/2011
// Fichier : DetailProduitResponse.php
//
// Description : Classe DetailProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProduitResponse
 * @author Julien PIERRE
 * @since 05/11/2011
 * @desc Classe représentant une DetailProduitResponse
 */
class DetailProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var ModeleLotViewVO
	* @desc ModelesLot de la DetailProduitResponse
	*/
	protected $mModelesLot;
	
	/**
	* @var ProduitVO
	* @desc Produit de la DetailProduitResponse
	*/
	protected $mProduit;
	
	/**
	* @name DetailProduitResponse()
	* @desc Le constructeur
	*/
	public function DetailProduitResponse() {
		$this->mValid = true;
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
	* @name getModelesLot()
	* @return ModeleLotViewVO
	* @desc Renvoie le membre ModelesLot de la DetailProduitResponse
	*/
	public function getModelesLot(){
		return $this->mModelesLot;
	}

	/**
	* @name setModelesLot($pModelesLot)
	* @param ModeleLotViewVO
	* @desc Remplace le membre ModelesLot de la DetailProduitResponse par $pModelesLot
	*/
	public function setModelesLot($pModelesLot) {
		$this->mModelesLot = $pModelesLot;
	}
	
	/**
	* @name getProduit()
	* @return ProduitVO
	* @desc Renvoie le membre Produit de la DetailProduitResponse
	*/
	public function getProduit(){
		return $this->mProduit;
	}

	/**
	* @name setProduit($pProduit)
	* @param ProduitVO
	* @desc Remplace le membre Produit de la DetailProduitResponse par $pProduit
	*/
	public function setProduit($pProduit) {
		$this->mProduit = $pProduit;
	}
}
?>