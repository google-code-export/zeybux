<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/03/2012
// Fichier : ListeProduitFermeCategorieProduitVO.php
//
// Description : Classe ListeProduitFermeCategorieProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
include_once(CHEMIN_CLASSES_VO . "ListeProduitFermeCategorieProduitVO.php");

/**
 * @name ListeProduitFermeCategorieProduitVO
 * @author Julien PIERRE
 * @since 08/03/2012
 * @desc Classe représentant une ListeProduitFermeCategorieProduitVO
 */
class ListeProduitFermeCategorieProduitAbonnementVO extends ListeProduitFermeCategorieProduitVO
{
	/**
	* @var integer
	* @desc IdAbonnement de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mIdAbonnement;

	/**
	* @var dateTime
	* @desc DateDebutSuspension de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mDateDebutSuspension;

	/**
	* @var dateTime
	* @desc DateFinSuspension de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mDateFinSuspension;
	
	/**
	* @name getIdAbonnement()
	* @return integer
	* @desc Renvoie le membre IdAbonnement de la ListeProduitFermeCategorieProduitVO
	*/
	public function getIdAbonnement(){
		return $this->mIdAbonnement;
	}

	/**
	* @name setIdAbonnement($pIdAbonnement)
	* @param integer
	* @desc Remplace le membre IdAbonnement de la ListeProduitFermeCategorieProduitVO par $pIdAbonnement
	*/
	public function setIdAbonnement($pIdAbonnement) {
		$this->mIdAbonnement = $pIdAbonnement;
	}

	/**
	* @name getDateDebutSuspension()
	* @return dateTime
	* @desc Renvoie le membre DateDebutSuspension de la ListeProduitFermeCategorieProduitVO
	*/
	public function getDateDebutSuspension() {
		return $this->mDateDebutSuspension;
	}

	/**
	* @name setDateDebutSuspension($pDateDebutSuspension)
	* @param dateTime
	* @desc Remplace le membre DateDebutSuspension de la ListeProduitFermeCategorieProduitVO par $pDateDebutSuspension
	*/
	public function setDateDebutSuspension($pDateDebutSuspension) {
		$this->mDateDebutSuspension = $pDateDebutSuspension;
	}

	/**
	* @name getDateFinSuspension()
	* @return dateTime
	* @desc Renvoie le membre DateFinSuspension de la ListeProduitFermeCategorieProduitVO
	*/
	public function getDateFinSuspension() {
		return $this->mDateFinSuspension;
	}

	/**
	* @name setDateFinSuspension($pDateFinSuspension)
	* @param dateTime
	* @desc Remplace le membre DateFinSuspension de la ListeProduitFermeCategorieProduitVO par $pDateFinSuspension
	*/
	public function setDateFinSuspension($pDateFinSuspension) {
		$this->mDateFinSuspension = $pDateFinSuspension;
	}
}
?>