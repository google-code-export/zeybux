<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/07/2011
// Fichier : IdReservationVO.php
//
// Description : Classe IdReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdReservationVO
 * @author Julien PIERRE
 * @since 14/07/2011
 * @desc Classe représentant une IdReservationVO
 */
class IdReservationVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdCompte de la IdReservationVO
	*/
	protected $mIdCompte;
	
	/**
	* @var int(11)
	* @desc IdCommande de la IdReservationVO
	*/
	protected $mIdCommande;

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la IdReservationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la IdReservationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}
	
	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la IdReservationVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la IdReservationVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}
}
?>