<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : ReservationDetailViewVO.php
//
// Description : Classe ReservationDetailViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationDetailViewVO
 * @author Julien PIERRE
 * @since 23/07/2011
 * @desc Classe représentant une ReservationDetailViewVO
 */
class ReservationDetailViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc StoIdOperation de la ReservationDetailViewVO
	*/
	protected $mStoIdOperation;

	/**
	* @var int(11)
	* @desc StoId de la ReservationDetailViewVO
	*/
	protected $mStoId;

	/**
	* @var int(11)
	* @desc DopeId de la ReservationDetailViewVO
	*/
	protected $mDopeId;

	/**
	* @var int(11)
	* @desc StoIdDetailCommande de la ReservationDetailViewVO
	*/
	protected $mStoIdDetailCommande;

	/**
	* @var int(11)
	* @desc DopeIdCompte de la ReservationDetailViewVO
	*/
	protected $mDopeIdCompte;

	/**
	* @var decimal(10,2)
	* @desc DopeMontant de la ReservationDetailViewVO
	*/
	protected $mDopeMontant;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la ReservationDetailViewVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var int(11)
	* @desc DcomIdProduit de la ReservationDetailViewVO
	*/
	protected $mDcomIdProduit;	
	
	/**
	* @var int(11)
	* @desc DopeTypePaiement de la ReservationDetailViewVO
	*/
	protected $mDopeTypePaiement;
	
	/**
	* @var int(11)
	* @desc StoType de la ReservationDetailViewVO
	*/
	protected $mStoType;

	/**
	* @name getStoIdOperation()
	* @return int(11)
	* @desc Renvoie le membre StoIdOperation de la ReservationDetailViewVO
	*/
	public function getStoIdOperation() {
		return $this->mStoIdOperation;
	}

	/**
	* @name setStoIdOperation($pStoIdOperation)
	* @param int(11)
	* @desc Remplace le membre StoIdOperation de la ReservationDetailViewVO par $pStoIdOperation
	*/
	public function setStoIdOperation($pStoIdOperation) {
		$this->mStoIdOperation = $pStoIdOperation;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la ReservationDetailViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la ReservationDetailViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getDopeId()
	* @return int(11)
	* @desc Renvoie le membre DopeId de la ReservationDetailViewVO
	*/
	public function getDopeId() {
		return $this->mDopeId;
	}

	/**
	* @name setDopeId($pDopeId)
	* @param int(11)
	* @desc Remplace le membre DopeId de la ReservationDetailViewVO par $pDopeId
	*/
	public function setDopeId($pDopeId) {
		$this->mDopeId = $pDopeId;
	}

	/**
	* @name getStoIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre StoIdDetailCommande de la ReservationDetailViewVO
	*/
	public function getStoIdDetailCommande() {
		return $this->mStoIdDetailCommande;
	}

	/**
	* @name setStoIdDetailCommande($pStoIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre StoIdDetailCommande de la ReservationDetailViewVO par $pStoIdDetailCommande
	*/
	public function setStoIdDetailCommande($pStoIdDetailCommande) {
		$this->mStoIdDetailCommande = $pStoIdDetailCommande;
	}

	/**
	* @name getDopeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre DopeIdCompte de la ReservationDetailViewVO
	*/
	public function getDopeIdCompte() {
		return $this->mDopeIdCompte;
	}

	/**
	* @name setDopeIdCompte($pDopeIdCompte)
	* @param int(11)
	* @desc Remplace le membre DopeIdCompte de la ReservationDetailViewVO par $pDopeIdCompte
	*/
	public function setDopeIdCompte($pDopeIdCompte) {
		$this->mDopeIdCompte = $pDopeIdCompte;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre DopeMontant de la ReservationDetailViewVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre DopeMontant de la ReservationDetailViewVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la ReservationDetailViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la ReservationDetailViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getDcomIdProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdProduit de la ReservationDetailViewVO
	*/
	public function getDcomIdProduit() {
		return $this->mDcomIdProduit;
	}

	/**
	* @name setDcomIdProduit($pDcomIdProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdProduit de la ReservationDetailViewVO par $pDcomIdProduit
	*/
	public function setDcomIdProduit($pDcomIdProduit) {
		$this->mDcomIdProduit = $pDcomIdProduit;
	}
	
	/**
	* @name getDopeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre DopeTypePaiement de la ReservationDetailViewVO
	*/
	public function getDopeTypePaiement() {
		return $this->mDopeTypePaiement;
	}

	/**
	* @name setDopeTypePaiement($pDopeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre DopeTypePaiement de la ReservationDetailViewVO par $pDopeTypePaiement
	*/
	public function setDopeTypePaiement($pDopeTypePaiement) {
		$this->mDopeTypePaiement = $pDopeTypePaiement;
	}

	/**
	* @name getStoType()
	* @return int(11)
	* @desc Renvoie le membre StoType de la ReservationDetailViewVO
	*/
	public function getStoType() {
		return $this->mStoType;
	}

	/**
	* @name setStoType($pStoType)
	* @param int(11)
	* @desc Remplace le membre StoType de la ReservationDetailViewVO par $pStoType
	*/
	public function setStoType($pStoType) {
		$this->mStoType = $pStoType;
	}
}
?>