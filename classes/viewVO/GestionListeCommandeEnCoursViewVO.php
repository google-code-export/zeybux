<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/10/2010
// Fichier : GestionListeCommandeEnCoursViewVO.php
//
// Description : Classe GestionListeCommandeEnCoursViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
/**
 * @name GestionListeCommandeEnCoursViewVO
 * @author Julien PIERRE
 * @since 17/10/2010
 * @desc Classe représentant une GestionListeCommandeEnCoursViewVO
 */
class GestionListeCommandeEnCoursViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComId;
	
	/**
	* @var varchar(100)
	* @desc ComNom de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComNom;

	/**
	* @var int(11)
	* @desc ComNumero de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComNumero;

	/**
	* @var datetime
	* @desc ComDateFinReservation de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComDateFinReservation;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @var datetime
	* @desc ComDateMarcheFin de la GestionListeCommandeEnCoursViewVO
	*/
	protected $mComDateMarcheFin;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la GestionListeCommandeEnCoursViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNom()
	* @return varchar(100)
	* @desc Renvoie le membre ComNom de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComNom() {
		return $this->mComNom;
	}

	/**
	* @name setComNom($pComNom)
	* @param varchar(100)
	* @desc Remplace le membre ComNom de la GestionListeCommandeEnCoursViewVO par $pComNom
	*/
	public function setComNom($pComNom) {
		$this->mComNom = $pComNom;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la GestionListeCommandeEnCoursViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateFinReservation()
	* @return datetime
	* @desc Renvoie le membre ComDateFinReservation de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComDateFinReservation() {
		return $this->mComDateFinReservation;
	}

	/**
	* @name setComDateFinReservation($pComDateFinReservation)
	* @param datetime
	* @desc Remplace le membre ComDateFinReservation de la GestionListeCommandeEnCoursViewVO par $pComDateFinReservation
	*/
	public function setComDateFinReservation($pComDateFinReservation) {
		$this->mComDateFinReservation = $pComDateFinReservation;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la GestionListeCommandeEnCoursViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

	/**
	* @name getComDateMarcheFin()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheFin de la GestionListeCommandeEnCoursViewVO
	*/
	public function getComDateMarcheFin() {
		return $this->mComDateMarcheFin;
	}

	/**
	* @name setComDateMarcheFin($pComDateMarcheFin)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheFin de la GestionListeCommandeEnCoursViewVO par $pComDateMarcheFin
	*/
	public function setComDateMarcheFin($pComDateMarcheFin) {
		$this->mComDateMarcheFin = $pComDateMarcheFin;
	}
}
?>