<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeViewVO.php
//
// Description : Classe InfoCommandeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCommandeViewVO
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe représentant une InfoCommandeViewVO
 */
class InfoCommandeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ComId de la InfoCommandeViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la InfoCommandeViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la InfoCommandeViewVO
	*/
	protected $mProId;

	/**
	* @var tinyint(4)
	* @desc ProType de la InfoCommandeViewVO
	*/
	protected $mProType;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la InfoCommandeViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la InfoCommandeViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la InfoCommandeViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la InfoCommandeViewVO
	*/
	protected $mStoQuantite;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantLivraison de la InfoCommandeViewVO
	*/
	protected $mOpeMontantLivraison;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteLivraison de la InfoCommandeViewVO
	*/
	protected $mStoQuantiteLivraison;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteSolidaire de la InfoCommandeViewVO
	*/
	protected $mStoQuantiteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteVente de la InfoCommandeViewVO
	*/
	protected $mStoQuantiteVente;

	/**
	* @var decimal(10,2)
	* @desc StoQuantiteVenteSolidaire de la InfoCommandeViewVO
	*/
	protected $mStoQuantiteVenteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantVente de la InfoCommandeViewVO
	*/
	protected $mOpeMontantVente;

	/**
	* @var decimal(10,2)
	* @desc OpeMontantVenteSolidaire de la InfoCommandeViewVO
	*/
	protected $mOpeMontantVenteSolidaire;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la InfoCommandeViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la InfoCommandeViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la InfoCommandeViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la InfoCommandeViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la InfoCommandeViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la InfoCommandeViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProType()
	* @return tinyint(4)
	* @desc Renvoie le membre ProType de la InfoCommandeViewVO
	*/
	public function getProType() {
		return $this->mProType;
	}

	/**
	* @name setProType($pProType)
	* @param tinyint(4)
	* @desc Remplace le membre ProType de la InfoCommandeViewVO par $pProType
	*/
	public function setProType($pProType) {
		$this->mProType = $pProType;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la InfoCommandeViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la InfoCommandeViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la InfoCommandeViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la InfoCommandeViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la InfoCommandeViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la InfoCommandeViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la InfoCommandeViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la InfoCommandeViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

	/**
	* @name getOpeMontantLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantLivraison de la InfoCommandeViewVO
	*/
	public function getOpeMontantLivraison() {
		return $this->mOpeMontantLivraison;
	}

	/**
	* @name setOpeMontantLivraison($pOpeMontantLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantLivraison de la InfoCommandeViewVO par $pOpeMontantLivraison
	*/
	public function setOpeMontantLivraison($pOpeMontantLivraison) {
		$this->mOpeMontantLivraison = $pOpeMontantLivraison;
	}

	/**
	* @name getStoQuantiteLivraison()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteLivraison de la InfoCommandeViewVO
	*/
	public function getStoQuantiteLivraison() {
		return $this->mStoQuantiteLivraison;
	}

	/**
	* @name setStoQuantiteLivraison($pStoQuantiteLivraison)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteLivraison de la InfoCommandeViewVO par $pStoQuantiteLivraison
	*/
	public function setStoQuantiteLivraison($pStoQuantiteLivraison) {
		$this->mStoQuantiteLivraison = $pStoQuantiteLivraison;
	}

	/**
	* @name getStoQuantiteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteSolidaire de la InfoCommandeViewVO
	*/
	public function getStoQuantiteSolidaire() {
		return $this->mStoQuantiteSolidaire;
	}

	/**
	* @name setStoQuantiteSolidaire($pStoQuantiteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteSolidaire de la InfoCommandeViewVO par $pStoQuantiteSolidaire
	*/
	public function setStoQuantiteSolidaire($pStoQuantiteSolidaire) {
		$this->mStoQuantiteSolidaire = $pStoQuantiteSolidaire;
	}

	/**
	* @name getStoQuantiteVente()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteVente de la InfoCommandeViewVO
	*/
	public function getStoQuantiteVente() {
		return $this->mStoQuantiteVente;
	}

	/**
	* @name setStoQuantiteVente($pStoQuantiteVente)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteVente de la InfoCommandeViewVO par $pStoQuantiteVente
	*/
	public function setStoQuantiteVente($pStoQuantiteVente) {
		$this->mStoQuantiteVente = $pStoQuantiteVente;
	}

	/**
	* @name getStoQuantiteVenteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantiteVenteSolidaire de la InfoCommandeViewVO
	*/
	public function getStoQuantiteVenteSolidaire() {
		return $this->mStoQuantiteVenteSolidaire;
	}

	/**
	* @name setStoQuantiteVenteSolidaire($pStoQuantiteVenteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantiteVenteSolidaire de la InfoCommandeViewVO par $pStoQuantiteVenteSolidaire
	*/
	public function setStoQuantiteVenteSolidaire($pStoQuantiteVenteSolidaire) {
		$this->mStoQuantiteVenteSolidaire = $pStoQuantiteVenteSolidaire;
	}

	/**
	* @name getOpeMontantVente()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantVente de la InfoCommandeViewVO
	*/
	public function getOpeMontantVente() {
		return $this->mOpeMontantVente;
	}

	/**
	* @name setOpeMontantVente($pOpeMontantVente)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantVente de la InfoCommandeViewVO par $pOpeMontantVente
	*/
	public function setOpeMontantVente($pOpeMontantVente) {
		$this->mOpeMontantVente = $pOpeMontantVente;
	}

	/**
	* @name getOpeMontantVenteSolidaire()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontantVenteSolidaire de la InfoCommandeViewVO
	*/
	public function getOpeMontantVenteSolidaire() {
		return $this->mOpeMontantVenteSolidaire;
	}

	/**
	* @name setOpeMontantVenteSolidaire($pOpeMontantVenteSolidaire)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontantVenteSolidaire de la InfoCommandeViewVO par $pOpeMontantVenteSolidaire
	*/
	public function setOpeMontantVenteSolidaire($pOpeMontantVenteSolidaire) {
		$this->mOpeMontantVenteSolidaire = $pOpeMontantVenteSolidaire;
	}

}
?>