<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2010
// Fichier : CommandeCompleteVO.php
//
// Description : Classe CommandeCompleteVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "CommandeVO.php");

/**
 * @name CommandeCompleteVO
 * @author Julien PIERRE
 * @since 04/05/2010
 * @desc Classe représentant une CommandeCompleteVO
 */
class CommandeCompleteVO extends CommandeVO
{
	/**
	* @var array(ProduitCommandeVO)
	* @desc Produits de la CommandeVO
	*/
	protected $mProduits;
	
	/**
	* @name CommandeCompleteVO()
	* @desc Le constructeur
	*/
	public function CommandeCompleteVO() {
		$this->mProduits = array();
	}
	
	/**
	* @name getProduits()
	* @return array(ProduitCommandeVO)
	* @desc Renvoie le membre Produits de la CommandeCompleteVO
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduit)
	* @param array(ProduitCommandeVO)
	* @desc Remplace le membre Produits de la CommandeCompleteVO par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduit)
	* @return ProduitCommandeVO
	* @desc Ajoute $pProduit à Produits
	*/
	public function addProduits($pProduit){
		array_push($this->mProduits,$pProduit);
	}
}
?>