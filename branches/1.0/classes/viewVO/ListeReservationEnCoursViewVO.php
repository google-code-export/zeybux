<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/10/2010
// Fichier : ListeReservationEnCoursViewVO.php
//
// Description : Classe ListeReservationEnCoursViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeReservationEnCoursViewVO
 * @author Julien PIERRE
 * @since 04/10/2010
 * @desc Classe représentant une ListeReservationEnCoursViewVO
 */
class ListeReservationEnCoursViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeReservationEnCoursViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeReservationEnCoursViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la ListeReservationEnCoursViewVO
	*/
	protected $mAdhIdCompte;

	/**
	* @var int(11)
	* @desc ComId de la ListeReservationEnCoursViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la ListeReservationEnCoursViewVO
	*/
	protected $mComNumero;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la ListeReservationEnCoursViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la ListeReservationEnCoursViewVO
	*/
	protected $mComDateMarcheFin;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la ListeReservationEnCoursViewVO
	*/
	protected $mComDateFinReservation;

	/**
	* @var tinyint(1)
	* @desc ComArchive de la ListeReservationEnCoursViewVO
	*/
	protected $mComArchive;
	
	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeReservationEnCoursViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeReservationEnCoursViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeReservationEnCoursViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeReservationEnCoursViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la ListeReservationEnCoursViewVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la ListeReservationEnCoursViewVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeReservationEnCoursViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeReservationEnCoursViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeReservationEnCoursViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeReservationEnCoursViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la ListeReservationEnCoursViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la ListeReservationEnCoursViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la ListeReservationEnCoursViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la ListeReservationEnCoursViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la ListeReservationEnCoursViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la ListeReservationEnCoursViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComArchive()
	* @return tinyint(1)
	* @desc Renvoie le membre ComArchive de la ListeReservationEnCoursViewVO
	*/
	public function getComArchive() {
		return $this->mComArchive;
	}

	/**
	* @name setComArchive($pComArchive)
	* @param tinyint(1)
	* @desc Remplace le membre ComArchive de la ListeReservationEnCoursViewVO par $pComArchive
	*/
	public function setComArchive($pComArchive) {
		$this->mComArchive = $pComArchive;
	}
}
?>