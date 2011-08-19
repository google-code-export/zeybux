<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/09/2010
// Fichier : ReservationViewVO.php
//
// Description : Classe ReservationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationViewVO
 * @author Julien PIERRE
 * @since 19/09/2010
 * @desc Classe représentant une ReservationViewVO
 */
class ReservationViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la ReservationViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProId de la ReservationViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoId de la ReservationViewVO
	*/
	protected $mStoId;
	
	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la ReservationViewVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la ReservationViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var tinyint(1)
	* @desc StoType de la ReservationViewVO
	*/
	protected $mStoType;

	/**
	* @var int(11)
	* @desc StoIdCompte de la ReservationViewVO
	*/
	protected $mStoIdCompte;	
	
	/**
	* @var int(11)
	* @desc DcomId de la ReservationViewVO
	*/
	protected $mDcomId;	
	
	/**
	* @var int(11)
	* @desc AdhId de la ReservationViewVO
	*/
	protected $mAdhId;	
	
	/**
	* @var varchar(50)
	* @desc AdhNom de la ReservationViewVO
	*/
	protected $mAdhNom;	
	
	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ReservationViewVO
	*/
	protected $mAdhPrenom;	
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la ReservationViewVO
	*/
	protected $mCptLabel;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ReservationViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ReservationViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la ReservationViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la ReservationViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la ReservationViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la ReservationViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}
	
	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la ReservationViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la ReservationViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la ReservationViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la ReservationViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getStoType()
	* @return tinyint(1)
	* @desc Renvoie le membre StoType de la ReservationViewVO
	*/
	public function getStoType() {
		return $this->mStoType;
	}

	/**
	* @name setStoType($pStoType)
	* @param tinyint(1)
	* @desc Remplace le membre StoType de la ReservationViewVO par $pStoType
	*/
	public function setStoType($pStoType) {
		$this->mStoType = $pStoType;
	}

	/**
	* @name getStoIdCompte()
	* @return int(11)
	* @desc Renvoie le membre StoIdCompte de la ReservationViewVO
	*/
	public function getStoIdCompte() {
		return $this->mStoIdCompte;
	}

	/**
	* @name setStoIdCompte($pStoIdCompte)
	* @param int(11)
	* @desc Remplace le membre StoIdCompte de la ReservationViewVO par $pStoIdCompte
	*/
	public function setStoIdCompte($pStoIdCompte) {
		$this->mStoIdCompte = $pStoIdCompte;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la ReservationViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la ReservationViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}
	
	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ReservationViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ReservationViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ReservationViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ReservationViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}
	
	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ReservationViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ReservationViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
	
	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ReservationViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ReservationViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}
}
?>