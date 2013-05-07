<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 16/04/2012
// Fichier : LotAbonnementMarcheVO.php
//
// Description : Classe LotAbonnementMarcheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "LotAbonnementVO.php");

/**
 * @name LotAbonnementMarcheVO
 * @author Julien PIERRE
 * @since 16/04/2012
 * @desc Classe représentant une LotAbonnementMarcheVO
 */
class LotAbonnementMarcheVO extends LotAbonnementVO
{
	/**
	* @var bool
	* @desc Produits de la CommandeVO
	*/
	protected $mReservation = false;
	
	/**
	* @name LotAbonnementMarcheVO()
	* @desc Le constructeur
	*/
	public function LotAbonnementMarcheVO() {
		$this->mReservation = false;
	}
	
	/**
	* @name getReservation()
	* @return bool
	* @desc Renvoie le membre Reservation de la LotAbonnementMarcheVO
	*/
	public function getReservation(){
		return $this->mReservation;
	}

	/**
	* @name setReservation($pProduit)
	* @param bool
	* @desc Remplace le membre Reservation de la LotAbonnementMarcheVO par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
	}
}
?>