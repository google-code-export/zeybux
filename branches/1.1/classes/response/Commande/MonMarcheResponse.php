<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MonMarcheResponse.php
//
// Description : Classe MonMarcheResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MonMarcheResponse
 * @author Julien PIERRE
 * @since 03/10/2011
 * @desc Classe représentant une MonMarcheResponse
 */
class MonMarcheResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeReservationEnCoursViewVO)
	* @desc Liste des réservations de la MonMarcheResponse
	*/
	protected $mReservations;
	
	/**
	* @var array(ListeCommandeViewVO)
	* @desc Liste des marchés de la MonMarcheResponse
	*/
	protected $mMarches;
	
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
	* @name MonMarcheResponse()
	* @desc Le constructeur
	*/
	public function MonMarcheResponse() {
		$this->mValid = true;
		$this->mReservations = array();
		$this->mMarches = array();
	}
	
	/**
	* @name getReservations()
	* @return array(ListeReservationEnCoursViewVO)
	* @desc Renvoie les Reservations
	*/
	public function getReservations() {
		return $this->mReservations;
	}

	/**
	* @name setReservations($pReservations)
	* @param array(ListeReservationEnCoursViewVO)
	* @desc Remplace le Reservations par $pReservations
	*/
	public function setReservations($pReservations) {
		$this->mReservations = $pReservations;
	}
	
	/**
	* @name addProduits($pReservations)
	* @param ListeReservationEnCoursViewVO
	* @desc Ajoute $pReservations à Reservations
	*/
	public function addReservations($pReservations){
		array_push($this->mReservations,$pReservations);
	}
	
	/**
	* @name getMarches()
	* @return array(ListeCommandeViewVO)
	* @desc Renvoie le membre Marches de la MonMarcheResponse
	*/
	public function getMarches(){
		return $this->mMarches;
	}

	/**
	* @name setMarches($pMarches)
	* @param array(ListeCommandeViewVO)
	* @desc Remplace le membre Marches de la MonMarcheResponse par $pMarches
	*/
	public function setMarches($pMarches) {
		$this->mMarches = $pMarches;
	}
	
	/**
	* @name addMarches($pMarches)
	* @param ListeCommandeViewVO
	* @desc Ajoute $pMarches à Marches
	*/
	public function addMarches($pMarches){
		array_push($this->mMarches,$pMarches);
	}
}
?>