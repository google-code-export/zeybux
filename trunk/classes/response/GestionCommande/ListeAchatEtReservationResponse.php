<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeAchatEtReservationResponse.php
//
// Description : Classe ListeAchatEtReservationResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAchatEtReservationResponse
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeAchatEtReservationResponse
 */
class ListeAchatEtReservationResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	* @var array(ListeAchatEtReservationVO)
	* @desc ListeAchatEtReservation de la ListeAchatEtReservationResponse
	*/
	protected $mListeAchatEtReservation;
	
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
	* @name ListeAchatEtReservationResponse()
	* @desc Le constructeur
	*/
	public function ListeAchatEtReservationResponse() {
		$this->mValid = true;
		$this->mListeAchatEtReservation = array();
	}
	
	/**
	* @name getListeAchatEtReservation()
	* @return array(ListeAchatEtReservationVO)
	* @desc Renvoie le membre ListeAchatEtReservation de la ListeAchatEtReservationResponse
	*/
	public function getListeAchatEtReservation(){
		return $this->mListeAchatEtReservation;
	}

	/**
	* @name setListeAchatEtReservation($pListeAchatEtReservation)
	* @param array(ListeAchatEtReservationVO)
	* @desc Remplace le membre ListeAchatEtReservation de la ListeAchatEtReservationResponse par $pListeAchatEtReservation
	*/
	public function setListeAchatEtReservation($pListeAchatEtReservation) {
		$this->mListeAchatEtReservation = $pListeAchatEtReservation;
	}
	
	/**
	* @name addListeAchatEtReservation($pListeAchatEtReservation)
	* @param ListeAchatEtReservationVO
	* @desc Ajoute $pListeAchatEtReservation à ListeAchatEtReservation
	*/
	public function addListeAchatEtReservation($pListeAchatEtReservation){
		array_push($this->mListeAchatEtReservation,$pListeAchatEtReservation);
	}
}