<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/11/2010
// Fichier : GestionCommandeListeReservationViewVO.php
//
// Description : Classe GestionCommandeListeReservationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name GestionCommandeListeReservationViewVO
 * @author Julien PIERRE
 * @since 17/11/2010
 * @desc Classe représentant une GestionCommandeListeReservationViewVO
 */
class GestionCommandeListeReservationViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la GestionCommandeListeReservationViewVO
	*/
	protected $mComId;
	
	/**
	* @var int(11)
	* @desc ComNumero de la GestionCommandeListeReservationViewVO
	*/
	protected $mComNumero;

	/**
	* @var int(11)
	* @desc AdhId de la GestionCommandeListeReservationViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la GestionCommandeListeReservationViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhLabelCompte de la GestionCommandeListeReservationViewVO
	*/
	protected $mAdhLabelCompte;

	/**
	* @var varchar(50)
	* @desc AdhNom de la GestionCommandeListeReservationViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la GestionCommandeListeReservationViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la GestionCommandeListeReservationViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la GestionCommandeListeReservationViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}
	
	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la GestionCommandeListeReservationViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la GestionCommandeListeReservationViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la GestionCommandeListeReservationViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la GestionCommandeListeReservationViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la GestionCommandeListeReservationViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la GestionCommandeListeReservationViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhLabelCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhLabelCompte de la GestionCommandeListeReservationViewVO
	*/
	public function getAdhLabelCompte() {
		return $this->mAdhLabelCompte;
	}

	/**
	* @name setAdhLabelCompte($pAdhLabelCompte)
	* @param int(11)
	* @desc Remplace le membre AdhLabelCompte de la GestionCommandeListeReservationViewVO par $pAdhLabelCompte
	*/
	public function setAdhLabelCompte($pAdhLabelCompte) {
		$this->mAdhLabelCompte = $pAdhLabelCompte;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la GestionCommandeListeReservationViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la GestionCommandeListeReservationViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la GestionCommandeListeReservationViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la GestionCommandeListeReservationViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
}
?>