<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeCommandeArchiveViewVO.php
//
// Description : Classe ListeCommandeArchiveViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCommandeArchiveViewVO
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeCommandeArchiveViewVO
 */
class ListeCommandeArchiveViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la ListeCommandeArchiveViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la ListeCommandeArchiveViewVO
	*/
	protected $mComNumero;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la ListeCommandeArchiveViewVO
	*/
	protected $mComDateFinReservation;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la ListeCommandeArchiveViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la ListeCommandeArchiveViewVO
	*/
	protected $mComDateMarcheFin;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeCommandeArchiveViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeCommandeArchiveViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeCommandeArchiveViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeCommandeArchiveViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la ListeCommandeArchiveViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la ListeCommandeArchiveViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la ListeCommandeArchiveViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la ListeCommandeArchiveViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la ListeCommandeArchiveViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la ListeCommandeArchiveViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}
}
?>