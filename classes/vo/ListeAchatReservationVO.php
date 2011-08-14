<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/08/2011
// Fichier : ListeAchatReservationVO.php
//
// Description : Classe ListeAchatReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAchatReservationVO
 * @author Julien PIERRE
 * @since 03/08/2011
 * @desc Classe représentant une ListeAchatReservationVO
 */
class ListeAchatReservationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeAchatReservationVO
	*/
	protected $mAdhId;

	/**
	* @var int(11)
	* @desc AdhNumero de la ListeAchatReservationVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la ListeAchatReservationVO
	*/
	protected $mAdhIdCompte;

	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeAchatReservationVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAchatReservationVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAchatReservationVO
	*/
	protected $mAdhPrenom;

	/**
	* @var decimal(10,2)
	* @desc Reservation de la ListeAchatReservationVO
	*/
	protected $mReservation;

	/**
	* @var decimal(10,2)
	* @desc Achat de la ListeAchatReservationVO
	*/
	protected $mAchat;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAchatReservationVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAchatReservationVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return int(11)
	* @desc Renvoie le membre AdhNumero de la ListeAchatReservationVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param int(11)
	* @desc Remplace le membre AdhNumero de la ListeAchatReservationVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la ListeAchatReservationVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la ListeAchatReservationVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeAchatReservationVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeAchatReservationVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAchatReservationVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAchatReservationVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAchatReservationVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAchatReservationVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre Reservation de la ListeAchatReservationVO
	*/
	public function getReservation() {
		return $this->mReservation;
	}

	/**
	* @name setReservation($pReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre Reservation de la ListeAchatReservationVO par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
	}

	/**
	* @name getAchat()
	* @return decimal(10,2)
	* @desc Renvoie le membre Achat de la ListeAchatReservationVO
	*/
	public function getAchat() {
		return $this->mAchat;
	}

	/**
	* @name setAchat($pAchat)
	* @param decimal(10,2)
	* @desc Remplace le membre Achat de la ListeAchatReservationVO par $pAchat
	*/
	public function setAchat($pAchat) {
		$this->mAchat = $pAchat;
	}
}
?>