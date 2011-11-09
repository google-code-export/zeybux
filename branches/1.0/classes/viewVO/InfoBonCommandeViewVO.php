<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/01/2011
// Fichier : InfoBonCommandeViewVO.php
//
// Description : Classe InfoBonCommandeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoBonCommandeViewVO
 * @author Julien PIERRE
 * @since 15/01/2011
 * @desc Classe représentant une InfoBonCommandeViewVO
 */
class InfoBonCommandeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la InfoBonCommandeViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteFerme de la InfoBonCommandeViewVO
	*/
	protected $mProIdCompteFerme;

	/**
	* @var int(11)
	* @desc ProId de la InfoBonCommandeViewVO
	*/
	protected $mProId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la InfoBonCommandeViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la InfoBonCommandeViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la InfoBonCommandeViewVO
	*/
	protected $mDopeMontant;

	/**
	* @var decimal(33,2)
	* @desc StoQuantite de la InfoBonCommandeViewVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var varchar(50)
	* @desc FerNom de la InfoBonCommandeViewVO
	*/
	protected $mFerNom;
	
	/**
	* @var int(11)
	* @desc DopeId de la InfoBonCommandeViewVO
	*/
	protected $mDopeId;
	
	/**
	* @var int(11)
	* @desc StoId de la InfoBonCommandeViewVO
	*/
	protected $mStoId;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la InfoBonCommandeViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la InfoBonCommandeViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdCompteFerme()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteFerme de la InfoBonCommandeViewVO
	*/
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
	}

	/**
	* @name setProIdCompteFerme($pProIdCompteFerme)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteFerme de la InfoBonCommandeViewVO par $pProIdCompteFerme
	*/
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la InfoBonCommandeViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la InfoBonCommandeViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la InfoBonCommandeViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la InfoBonCommandeViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la InfoBonCommandeViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la InfoBonCommandeViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre DopeMontant de la InfoBonCommandeViewVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre DopeMontant de la InfoBonCommandeViewVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(33,2)
	* @desc Renvoie le membre StoQuantite de la InfoBonCommandeViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(33,2)
	* @desc Remplace le membre StoQuantite de la InfoBonCommandeViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getFerNom()
	* @return varchar(50)
	* @desc Renvoie le membre FerNom de la InfoBonCommandeViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param varchar(50)
	* @desc Remplace le membre FerNom de la InfoBonCommandeViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}
	
	/**
	* @name getDopeId()
	* @return int(11)
	* @desc Renvoie le membre DopeId de la InfoBonCommandeViewVO
	*/
	public function getDopeId() {
		return $this->mDopeId;
	}

	/**
	* @name setDopeId($pDopeId)
	* @param int(11)
	* @desc Remplace le membre DopeId de la InfoBonCommandeViewVO par $pDopeId
	*/
	public function setDopeId($pDopeId) {
		$this->mDopeId = $pDopeId;
	}
	
	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la InfoBonCommandeViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la InfoBonCommandeViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

}
?>