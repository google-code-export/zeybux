<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/05/2014
// Fichier : ListeAchatEtReservationExportVO.php
//
// Description : Classe ListeAchatEtReservationExportVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAchatEtReservationExportVO
 * @author Julien PIERRE
 * @since 02/05/2014
 * @desc Classe représentant une ListeAchatEtReservationExportVO
 */
class ListeAchatEtReservationExportVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ProId de la ListeAchatEtReservationExportVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoIdReservation de la ListeAchatEtReservationExportVO
	*/
	protected $mStoIdReservation;
	
	/**
	* @var decimal(10,2)
	* @desc StoQuantiteReservation de la ListeAchatEtReservationExportVO
	*/
	protected $mStoQuantiteReservation;

	/**
	* @var int(11)
	* @desc StoIdAchat de la ListeAchatEtReservationExportVO
	*/
	protected $mStoIdAchat;
	
	/**
	* @var decimal(10,2)
	* @desc StoQuantiteAchat de la ListeAchatEtReservationExportVO
	*/
	protected $mStoQuantiteAchat;

	/**
	* @var int(11)
	* @desc DopeIdAchat de la ListeAchatEtReservationExportVO
	*/
	protected $mDopeIdAchat;
	
	/**
	* @var decimal(10,2)
	* @desc DopeMontantAchat de la ListeAchatEtReservationExportVO
	*/
	protected $mDopeMontantAchat;

	/**
	* @var int(11)
	* @desc StoIdSolidaire de la ListeAchatEtReservationExportVO
	*/
	protected $mStoIdSolidaire;
	
	/**
	* @var decimal(10,2)
	* @desc StoQuantiteSolidaire de la ListeAchatEtReservationExportVO
	*/
	protected $mStoQuantiteSolidaire;

	/**
	* @var int(11)
	* @desc DopeIdSolidaire de la ListeAchatEtReservationExportVO
	*/
	protected $mDopeIdSolidaire;
	
	/**
	* @var decimal(10,2)
	* @desc DopeMontantSolidaire de la ListeAchatEtReservationExportVO
	*/
	protected $mDopeMontantSolidaire;
	
	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la ListeAchatEtReservationExportVO
	*/
	protected $mProUniteMesure;

	/**
	* @var int(11)
	* @desc CptId de la ListeAchatEtReservationExportVO
	*/
	protected $mCptId;	
	
	/**
	* @var int(11)
	* @desc DcomId de la ListeAchatEtReservationExportVO
	*/
	protected $mDcomId;	
	
	/**
	* @var int(11)
	* @desc AdhId de la ListeAchatEtReservationExportVO
	*/
	protected $mAdhId;	
	
	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAchatEtReservationExportVO
	*/
	protected $mAdhNom;	
	
	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAchatEtReservationExportVO
	*/
	protected $mAdhPrenom;	
		
	/**
	* @var varchar(20)
	* @desc AdhTelephonePrincipal de la ListeAchatEtReservationExportVO
	*/
	protected $mAdhTelephonePrincipal;	
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeAchatEtReservationExportVO
	*/
	protected $mCptLabel;

	/**
	 * @name ListeAchatEtReservationExportVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeAchatEtReservationExportVO($pProId = null, $pStoIdReservation = null, $pStoQuantiteReservation = null, $pStoIdAchat = null, $pStoQuantiteAchat = null, $pDopeIdAchat = null, $pDopeMontantAchat = null,
			$pStoIdSolidaire = null, $pStoQuantiteSolidaire = null, $pDopeIdSolidaire = null, $pDopeMontantSolidaire = null, $pProUniteMesure = null, $pCptId = null, $pDcomId = null, $pAdhId = null, 
			$pAdhNom = null, $pAdhPrenom = null, $pAdhTelephonePrincipal = null, $pCptLabel = null) {
		
		if(!is_null($pProId)) { $this->mProId = $pProId; }
		if(!is_null($pStoIdReservation)) { $this->mStoIdReservation = $pStoIdReservation; }
		if(!is_null($pStoQuantiteReservation)) { $this->mStoQuantiteReservation = $pStoQuantiteReservation; }
		if(!is_null($pStoIdAchat)) { $this->mStoIdAchat = $pStoIdAchat; }
		if(!is_null($pStoQuantiteAchat)) { $this->mStoQuantiteAchat = $pStoQuantiteAchat; }
		if(!is_null($pDopeIdAchat)) { $this->mDopeIdAchat = $pDopeIdAchat; }
		if(!is_null($pDopeMontantAchat)) { $this->mDopeMontantAchat = $pDopeMontantAchat; }
		if(!is_null($pStoIdSolidaire)) { $this->mStoIdSolidaire = $pStoIdSolidaire; }
		if(!is_null($pStoQuantiteSolidaire)) { $this->mStoQuantiteSolidaire = $pStoQuantiteSolidaire; }
		if(!is_null($pDopeIdSolidaire)) { $this->mDopeIdSolidaire = $pDopeIdSolidaire; }
		if(!is_null($pDopeMontantSolidaire)) { $this->mDopeMontantSolidaire = $pDopeMontantSolidaire; }
		if(!is_null($pProUniteMesure)) { $this->mProUniteMesure = $pProUniteMesure; }
		if(!is_null($pCptId)) { $this->mCptId = $pCptId; }
		if(!is_null($pDcomId)) { $this->mDcomId = $pDcomId; }
		if(!is_null($pAdhId)) { $this->mAdhId = $pAdhId; }
		if(!is_null($pAdhNom)) { $this->mAdhNom = $pAdhNom; }
		if(!is_null($pAdhPrenom)) { $this->mAdhPrenom = $pAdhPrenom; }
		if(!is_null($pAdhTelephonePrincipal)) { $this->mAdhTelephonePrincipal = $pAdhTelephonePrincipal; }
		if(!is_null($pCptLabel)) { $this->mCptLabel = $pCptLabel; }
	}
	
	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la ListeAchatEtReservationExportVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la ListeAchatEtReservationExportVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoIdReservation()
	* @return int(11)
	* @desc Renvoie le membre StoIdReservation de la ListeAchatEtReservationExportVO
	*/
	public function getStoIdReservation() {
		return $this->mStoIdReservation;
	}

	/**
	* @name setStoIdReservation($pStoIdReservation)
	* @param int(11)
	* @desc Remplace le membre StoIdReservation de la ListeAchatEtReservationExportVO par $pStoIdReservation
	*/
	public function setStoIdReservation($pStoIdReservation) {
		$this->mStoIdReservation = $pStoIdReservation;
	}
	
	/**
	* @name getStoQuantiteReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteReservation de la ListeAchatEtReservationExportVO
	*/
	public function getStoQuantiteReservation() {
		return $this->mStoQuantiteReservation;
	}

	/**
	* @name setStoQuantiteReservation($pStoQuantiteReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteReservation de la ListeAchatEtReservationExportVO par $pStoQuantiteReservation
	*/
	public function setStoQuantiteReservation($pStoQuantiteReservation) {
		$this->mStoQuantiteReservation = $pStoQuantiteReservation;
	}
	
	/**
	 * @name getStoIdAchat()
	 * @return int(11)
	 * @desc Renvoie le membre StoIdAchat de la ListeAchatEtReservationExportVO
	 */
	public function getStoIdAchat() {
		return $this->mStoIdAchat;
	}
	
	/**
	 * @name setStoIdAchat($pStoIdAchat)
	 * @param int(11)
	 * @desc Remplace le membre StoIdAchat de la ListeAchatEtReservationExportVO par $pStoIdAchat
	 */
	public function setStoIdAchat($pStoIdAchat) {
		$this->mStoIdAchat = $pStoIdAchat;
	}
	
	/**
	 * @name getStoQuantiteAchat()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre StoQuantiteAchat de la ListeAchatEtReservationExportVO
	 */
	public function getStoQuantiteAchat() {
		return $this->mStoQuantiteAchat;
	}
	
	/**
	 * @name setStoQuantiteAchat($pStoQuantiteAchat)
	 * @param decimal(10,2)
	 * @desc Remplace le membre StoQuantiteAchat de la ListeAchatEtReservationExportVO par $pStoQuantiteAchat
	 */
	public function setStoQuantiteAchat($pStoQuantiteAchat) {
		$this->mStoQuantiteAchat = $pStoQuantiteAchat;
	}
	
	/**
	 * @name getDopeIdAchat()
	 * @return int(11)
	 * @desc Renvoie le membre DopeIdAchat de la ListeAchatEtReservationExportVO
	 */
	public function getDopeIdAchat() {
		return $this->mDopeIdAchat;
	}
	
	/**
	 * @name setDopeIdAchat($pDopeIdAchat)
	 * @param int(11)
	 * @desc Remplace le membre DopeIdAchat de la ListeAchatEtReservationExportVO par $pDopeIdAchat
	 */
	public function setDopeIdAchat($pDopeIdAchat) {
		$this->mDopeIdAchat = $pDopeIdAchat;
	}
	
	/**
	 * @name getDopeMontantAchat()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre DopeMontantAchat de la ListeAchatEtReservationExportVO
	 */
	public function getDopeMontantAchat() {
		return $this->mDopeMontantAchat;
	}
	
	/**
	 * @name setDopeMontantAchat($pDopeMontantAchat)
	 * @param decimal(10,2)
	 * @desc Remplace le membre DopeMontantAchat de la ListeAchatEtReservationExportVO par $pDopeMontantAchat
	 */
	public function setDopeMontantAchat($pDopeMontantAchat) {
		$this->mDopeMontantAchat = $pDopeMontantAchat;
	}
	
	/**
	 * @name getStoIdSolidaire()
	 * @return int(11)
	 * @desc Renvoie le membre StoIdSolidaire de la ListeAchatEtReservationExportVO
	 */
	public function getStoIdSolidaire() {
		return $this->mStoIdSolidaire;
	}
	
	/**
	 * @name setStoIdSolidaire($pStoIdSolidaire)
	 * @param int(11)
	 * @desc Remplace le membre StoIdSolidaire de la ListeAchatEtReservationExportVO par $pStoIdSolidaire
	 */
	public function setStoIdSolidaire($pStoIdSolidaire) {
		$this->mStoIdSolidaire = $pStoIdSolidaire;
	}
	
	/**
	 * @name getStoQuantiteSolidaire()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre StoQuantiteSolidaire de la ListeAchatEtReservationExportVO
	 */
	public function getStoQuantiteSolidaire() {
		return $this->mStoQuantiteSolidaire;
	}
	
	/**
	 * @name setStoQuantiteSolidaire($pStoQuantiteSolidaire)
	 * @param decimal(10,2)
	 * @desc Remplace le membre StoQuantiteSolidaire de la ListeAchatEtReservationExportVO par $pStoQuantiteSolidaire
	 */
	public function setStoQuantiteSolidaire($pStoQuantiteSolidaire) {
		$this->mStoQuantiteSolidaire = $pStoQuantiteSolidaire;
	}
	
	/**
	 * @name getDopeIdSolidaire()
	 * @return int(11)
	 * @desc Renvoie le membre DopeIdSolidaire de la ListeAchatEtReservationExportVO
	 */
	public function getDopeIdSolidaire() {
		return $this->mDopeIdSolidaire;
	}
	
	/**
	 * @name setDopeIdSolidaire($pDopeIdSolidaire)
	 * @param int(11)
	 * @desc Remplace le membre DopeIdSolidaire de la ListeAchatEtReservationExportVO par $pDopeIdSolidaire
	 */
	public function setDopeIdSolidaire($pDopeIdSolidaire) {
		$this->mDopeIdSolidaire = $pDopeIdSolidaire;
	}
	
	/**
	 * @name getDopeMontantSolidaire()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre DopeMontantSolidaire de la ListeAchatEtReservationExportVO
	 */
	public function getDopeMontantSolidaire() {
		return $this->mDopeMontantSolidaire;
	}
	
	/**
	 * @name setDopeMontantSolidaire($pDopeMontantSolidaire)
	 * @param decimal(10,2)
	 * @desc Remplace le membre DopeMontantSolidaire de la ListeAchatEtReservationExportVO par $pDopeMontantSolidaire
	 */
	public function setDopeMontantSolidaire($pDopeMontantSolidaire) {
		$this->mDopeMontantSolidaire = $pDopeMontantSolidaire;
	}
	
	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la ListeAchatEtReservationExportVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la ListeAchatEtReservationExportVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getCptId()
	* @return int(11)
	* @desc Renvoie le membre CptId de la ListeAchatEtReservationExportVO
	*/
	public function getCptId() {
		return $this->mCptId;
	}

	/**
	* @name setCptId($pCptId)
	* @param int(11)
	* @desc Remplace le membre CptId de la ListeAchatEtReservationExportVO par $pCptId
	*/
	public function setCptId($pCptId) {
		$this->mCptId = $pCptId;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la ListeAchatEtReservationExportVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la ListeAchatEtReservationExportVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}
	
	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAchatEtReservationExportVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAchatEtReservationExportVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAchatEtReservationExportVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAchatEtReservationExportVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}
	
	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAchatEtReservationExportVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAchatEtReservationExportVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
	
	/**
	* @name getAdhTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre AdhTelephonePrincipal de la ListeAchatEtReservationExportVO
	*/
	public function getAdhTelephonePrincipal() {
		return $this->mAdhTelephonePrincipal;
	}

	/**
	* @name setAdhTelephonePrincipal($pAdhTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre AdhTelephonePrincipal de la ListeAchatEtReservationExportVO par $pAdhTelephonePrincipal
	*/
	public function setAdhTelephonePrincipal($pAdhTelephonePrincipal) {
		$this->mAdhTelephonePrincipal = $pAdhTelephonePrincipal;
	}
	
	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeAchatEtReservationExportVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeAchatEtReservationExportVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}
}
?>