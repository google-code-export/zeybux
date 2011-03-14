<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/05/2010
// Fichier : ProduitReservationCommandeVO.php
//
// Description : Classe ProduitReservationCommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitReservationCommandeVO
 * @author Julien PIERRE
 * @since 20/05/2010
 * @desc Classe représentant une ProduitReservationCommandeVO
 */
class ProduitReservationCommandeVO extends DataTemplate
{
	/**
	* @var integer
	* @desc IdProduit de la commande de la ProduitReservationCommandeVO
	*/
	protected $mIdProduit;
	
	/**
	* @var integer
	* @desc IdLot de la ProduitReservationCommandeVO
	*/
	protected $mIdLot;
	
	/**
	* @var integer
	* @desc Quantite de la ProduitReservationCommandeVO
	*/
	protected $mQte;
	
	/**
	* @name getIdProduit()
	* @return integer
	* @desc Renvoie le IdProduit de la ProduitReservationCommandeVO
	*/
	public function getIdProduit(){
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param integer
	* @desc Remplace le membre IdProduit de la ProduitReservationCommandeVO
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}
	
	/**
	* @name getIdLot()
	* @return integer
	* @desc Renvoie le membre IdLot de la ProduitReservationCommandeVO
	*/
	public function getIdLot(){
		return $this->mIdLot;
	}

	/**
	* @name setIdLot($pIdLot)
	* @param integer
	* @desc Remplace le membre IdLot de la ProduitReservationCommandeVO
	*/
	public function setIdLot($pIdLot) {
		$this->mIdLot = $pIdLot;
	}
	
	/**
	* @name getQte()
	* @return integer
	* @desc Renvoie le membre Qte de la ProduitReservationCommandeVO
	*/
	public function getQte(){
		return $this->mQte;
	}

	/**
	* @name setQte($pQte)
	* @param integer
	* @desc Remplace le membre Qte de la ProduitReservationCommandeVO
	*/
	public function setQte($pQte) {
		$this->mQte = $pQte;
	}
}
?>