<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/07/2011
// Fichier : AchatDetailSolidaireViewVO.php
//
// Description : Classe AchatDetailSolidaireViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AchatDetailSolidaireViewVO
 * @author Julien PIERRE
 * @since 23/07/2011
 * @desc Classe représentant une AchatDetailSolidaireViewVO
 */
class AchatDetailSolidaireViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc StoIdOperation de la AchatDetailSolidaireViewVO
	*/
	protected $mStoIdOperation;

	/**
	* @var int(11)
	* @desc StoId de la AchatDetailSolidaireViewVO
	*/
	protected $mStoId;

	/**
	* @var int(11)
	* @desc DopeId de la AchatDetailSolidaireViewVO
	*/
	protected $mDopeId;

	/**
	* @var int(11)
	* @desc StoIdDetailCommande de la AchatDetailSolidaireViewVO
	*/
	protected $mStoIdDetailCommande;

	/**
	* @var int(11)
	* @desc DopeIdModeleLot de la AchatDetailSolidaireViewVO
	*/
	protected $mDopeIdModeleLot;

	/**
	* @var decimal(10,2)
	* @desc DopeMontant de la AchatDetailSolidaireViewVO
	*/
	protected $mDopeMontant;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la AchatDetailSolidaireViewVO
	*/
	protected $mStoQuantite;

	/**
	* @var int(11)
	* @desc DcomIdProduit de la AchatDetailViewVO
	*/
	protected $mDcomIdProduit;

	/**
	* @var int(11)
	* @desc DcomIdNomProduit de la AchatDetailViewVO
	*/
	protected $mDcomIdNomProduit;
	
	/**
	* @name getStoIdOperation()
	* @return int(11)
	* @desc Renvoie le membre StoIdOperation de la AchatDetailSolidaireViewVO
	*/
	public function getStoIdOperation() {
		return $this->mStoIdOperation;
	}

	/**
	* @name setStoIdOperation($pStoIdOperation)
	* @param int(11)
	* @desc Remplace le membre StoIdOperation de la AchatDetailSolidaireViewVO par $pStoIdOperation
	*/
	public function setStoIdOperation($pStoIdOperation) {
		$this->mStoIdOperation = $pStoIdOperation;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la AchatDetailSolidaireViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la AchatDetailSolidaireViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getDopeId()
	* @return int(11)
	* @desc Renvoie le membre DopeId de la AchatDetailSolidaireViewVO
	*/
	public function getDopeId() {
		return $this->mDopeId;
	}

	/**
	* @name setDopeId($pDopeId)
	* @param int(11)
	* @desc Remplace le membre DopeId de la AchatDetailSolidaireViewVO par $pDopeId
	*/
	public function setDopeId($pDopeId) {
		$this->mDopeId = $pDopeId;
	}

	/**
	* @name getStoIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre StoIdDetailCommande de la AchatDetailSolidaireViewVO
	*/
	public function getStoIdDetailCommande() {
		return $this->mStoIdDetailCommande;
	}

	/**
	* @name setStoIdDetailCommande($pStoIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre StoIdDetailCommande de la AchatDetailSolidaireViewVO par $pStoIdDetailCommande
	*/
	public function setStoIdDetailCommande($pStoIdDetailCommande) {
		$this->mStoIdDetailCommande = $pStoIdDetailCommande;
	}

	/**
	 * @name getDopeIdModeleLot()
	 * @return int(11)
	 * @desc Renvoie le membre DopeIdModeleLot de la AchatDetailSolidaireViewVO
	 */
	public function getDopeIdModeleLot() {
		return $this->mDopeIdModeleLot;
	}
	
	/**
	 * @name setDopeIdModeleLot($pDopeIdModeleLot)
	 * @param int(11)
	 * @desc Remplace le membre DopeIdModeleLot de la AchatDetailSolidaireViewVO par $pDopeIdModeleLot
	 */
	public function setDopeIdModeleLot($pDopeIdModeleLot) {
		$this->mDopeIdModeleLot = $pDopeIdModeleLot;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre DopeMontant de la AchatDetailSolidaireViewVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre DopeMontant de la AchatDetailSolidaireViewVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la AchatDetailSolidaireViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la AchatDetailSolidaireViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getDcomIdProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdProduit de la AchatDetailSolidaireViewVO
	*/
	public function getDcomIdProduit() {
		return $this->mDcomIdProduit;
	}

	/**
	* @name setDcomIdProduit($pDcomIdProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdProduit de la AchatDetailSolidaireViewVO par $pDcomIdProduit
	*/
	public function setDcomIdProduit($pDcomIdProduit) {
		$this->mDcomIdProduit = $pDcomIdProduit;
	}
	
	/**
	* @name getDcomIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre DcomIdNomProduit de la AchatDetailSolidaireViewVO
	*/
	public function getDcomIdNomProduit() {
		return $this->mDcomIdNomProduit;
	}

	/**
	* @name setDcomIdNomProduit($pDcomIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre DcomIdNomProduit de la AchatDetailSolidaireViewVO par $pDcomIdNomProduit
	*/
	public function setDcomIdNomProduit($pDcomIdNomProduit) {
		$this->mDcomIdNomProduit = $pDcomIdNomProduit;
	}

}
?>