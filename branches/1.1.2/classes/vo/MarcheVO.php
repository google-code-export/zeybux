<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : MarcheVO.php
//
// Description : Classe MarcheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "CommandeVO.php");
include_once(CHEMIN_CLASSES_VO . "ProduitMarcheVO.php");

/**
 * @name MarcheVO
 * @author Julien PIERRE
 * @since 13/07/2011
 * @desc Classe représentant une MarcheVO
 */
class MarcheVO extends CommandeVO
{
	/**
	* @var array(ProduitMarcheVO)
	* @desc Produits de la MarcheVO
	*/
	protected $mProduits;
	
	/**
	* @name MarcheVO()
	* @desc Le constructeur
	*/
	public function MarcheVO() {
		$this->mProduits = array();
	}
	
	/**
	* @name getProduits()
	* @return array(ProduitMarcheVO)
	* @desc Renvoie le membre Produits de la MarcheVO
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduit)
	* @param array(ProduitMarcheVO)
	* @desc Remplace le membre Produits de la MarcheVO par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduit)
	* @return ProduitMarcheVO
	* @desc Ajoute $pProduit à Produits
	*/
	public function addProduits($pProduit){
		array_push($this->mProduits,$pProduit);
	}
}
?>