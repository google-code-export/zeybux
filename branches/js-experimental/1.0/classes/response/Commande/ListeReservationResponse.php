<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationResponse.php
//
// Description : Classe ListeReservationResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeReservationResponse
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe représentant une ListeReservationResponse
 */
class ListeReservationResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var array(ListeReservationEnCoursViewVO)
	 * @desc Les reservations
	 */
	protected $mReservations;
	
	/**
	* @name ListeReservationResponse()
	* @desc Le constructeur
	*/
	public function ListeReservationResponse() {
		$this->mValid = true;
		$this->mReservations = array();
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
}
?>