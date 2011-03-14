<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/05/2010
// Fichier : ReservationCommandeVO.php
//
// Description : Classe ReservationCommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationCommandeVO
 * @author Julien PIERRE
 * @since 20/05/2010
 * @desc Classe représentant une ReservationCommandeVO
 */
class ReservationCommandeVO extends DataTemplate
{
	/**
	* @var integer
	* @desc Id de la commande de la ReservationCommandeVO
	*/
	protected $mIdCommande;
	
	/**
	* @var array(ProduitReservationCommandeVO)
	* @desc Produit de la ReservationCommandeVO
	*/
	protected $mProduit;
	
	/**
	* @name getIdCommande()
	* @return integer
	* @desc Renvoie le IdCommande Produit de la ReservationCommandeVO
	*/
	public function getIdCommande(){
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param integer
	* @desc Remplace le membre IdCommande de la ReservationCommandeVO
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}
	
	/**
	* @name getProduits()
	* @return array(ProduitReservationCommandeVO)
	* @desc Renvoie le membre Produit de la ReservationCommandeVO
	*/
	public function getProduits(){
		return $this->mProduit;
	}

	/**
	* @name setProduits($pProduit)
	* @param array(ProduitReservationCommandeVO)
	* @desc Remplace le membre Produit de la ReservationCommandeVO
	*/
	public function setProduits($pProduit) {
		$this->mProduit = $pProduit;
	}
}
?>