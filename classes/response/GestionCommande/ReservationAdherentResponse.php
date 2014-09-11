<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : ReservationAdherentResponse.php
//
// Description : Classe ReservationAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationAdherentResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une ReservationAdherentResponse
 */
class ReservationAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var AdherentViewVO
	 * @desc L'adhérent
	 */
	protected $mAdherent;
	
	/**
	 * @var MarcheVO
	 * @desc Le Marché
	 */
	protected $mMarche;
	
	/**
	 * @var ReservationVO
	 * @desc Les reservations
	 */
	protected $mReservation;
	
	/**
	 * @var int
	 * @desc L'état de la réservation
	 */
	protected $mEtat;
	
	/**
	* @name ReservationAdherentResponse()
	* @desc Le constructeur de ReservationAdherentResponse
	*/	
	public function ReservationAdherentResponse() {
		$this->mValid = true;
		$this->mMarche = array();
		$this->mReservation = array();
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
	* @name getAdherent()
	* @return AdherentViewVO
	* @desc Renvoie mAdherent
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace mAdherent de l'élément par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}

	/**
	* @name getMarche()
	* @return MarcheVO
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param MarcheVO
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}
	
	/**
	* @name getReservation()
	* @return ReservationVO
	* @desc Renvoie le Reservation
	*/
	public function getReservation() {
		return $this->mReservation;
	}

	/**
	* @name setReservation($pReservation)
	* @param ReservationVO
	* @desc Remplace le Reservation par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
	}
	
	/**
	* @name getEtat()
	* @return int
	* @desc Renvoie le Etat
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param int
	* @desc Remplace le Etat par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}
}
?>