<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/09/2010
// Fichier : ListeReservationVO.php
//
// Description : Classe ListeReservationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeReservationVO
 * @author Julien PIERRE
 * @since 19/09/2010
 * @desc Classe représentant une ListeReservationVO
 */
class ListeReservationVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la ListeReservationVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProId de la ListeReservationVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoId de la ListeReservationVO
	*/
	protected $mStoId;
	
	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la ListeReservationVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la ListeReservationVO
	*/
	protected $mProUniteMesure;

	/**
	* @var tinyint(1)
	* @desc StoType de la ListeReservationVO
	*/
	protected $mStoType;

	/**
	* @var int(11)
	* @desc StoIdCompte de la ListeReservationVO
	*/
	protected $mStoIdCompte;	
	
	/**
	* @var int(11)
	* @desc DcomId de la ListeReservationVO
	*/
	protected $mDcomId;	
	
	/**
	* @var int(11)
	* @desc AdhId de la ListeReservationVO
	*/
	protected $mAdhId;	
	
	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeReservationVO
	*/
	protected $mAdhNom;	
	
	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeReservationVO
	*/
	protected $mAdhPrenom;	
		
	/**
	* @var varchar(20)
	* @desc AdhTelephonePrincipal de la ListeReservationVO
	*/
	protected $mAdhTelephonePrincipal;	
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeReservationVO
	*/
	protected $mCptLabel;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeReservationVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeReservationVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la ListeReservationVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la ListeReservationVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la ListeReservationVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la ListeReservationVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}
	
	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la ListeReservationVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la ListeReservationVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la ListeReservationVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la ListeReservationVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getStoType()
	* @return tinyint(1)
	* @desc Renvoie le membre StoType de la ListeReservationVO
	*/
	public function getStoType() {
		return $this->mStoType;
	}

	/**
	* @name setStoType($pStoType)
	* @param tinyint(1)
	* @desc Remplace le membre StoType de la ListeReservationVO par $pStoType
	*/
	public function setStoType($pStoType) {
		$this->mStoType = $pStoType;
	}

	/**
	* @name getStoIdCompte()
	* @return int(11)
	* @desc Renvoie le membre StoIdCompte de la ListeReservationVO
	*/
	public function getStoIdCompte() {
		return $this->mStoIdCompte;
	}

	/**
	* @name setStoIdCompte($pStoIdCompte)
	* @param int(11)
	* @desc Remplace le membre StoIdCompte de la ListeReservationVO par $pStoIdCompte
	*/
	public function setStoIdCompte($pStoIdCompte) {
		$this->mStoIdCompte = $pStoIdCompte;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la ListeReservationVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la ListeReservationVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}
	
	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeReservationVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeReservationVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeReservationVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeReservationVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}
	
	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeReservationVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeReservationVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
	
	/**
	* @name getAdhTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre AdhTelephonePrincipal de la ListeReservationVO
	*/
	public function getAdhTelephonePrincipal() {
		return $this->mAdhTelephonePrincipal;
	}

	/**
	* @name setAdhTelephonePrincipal($pAdhTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre AdhTelephonePrincipal de la ListeReservationVO par $pAdhTelephonePrincipal
	*/
	public function setAdhTelephonePrincipal($pAdhTelephonePrincipal) {
		$this->mAdhTelephonePrincipal = $pAdhTelephonePrincipal;
	}
	
	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeReservationVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeReservationVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}
}
?>