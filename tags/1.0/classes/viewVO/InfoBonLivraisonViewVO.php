<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : InfoBonLivraisonViewVO.php
//
// Description : Classe InfoBonLivraisonViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoBonLivraisonViewVO
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une InfoBonLivraisonViewVO
 */
class InfoBonLivraisonViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la InfoBonLivraisonViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
	* @desc ProIdCompteProducteur de la InfoBonLivraisonViewVO
	*/
	protected $mProIdCompteProducteur;

	/**
	* @var int(11)
	* @desc ProId de la InfoBonLivraisonViewVO
	*/
	protected $mProId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la InfoBonLivraisonViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la InfoBonLivraisonViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la InfoBonLivraisonViewVO
	*/
	protected $mDopeMontant;

	/**
	* @var decimal(33,2)
	* @desc StoQuantite de la InfoBonLivraisonViewVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var varchar(50)
	* @desc PrdtNom de la InfoBonLivraisonViewVO
	*/
	protected $mPrdtNom;
	
	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la InfoBonLivraisonViewVO
	*/
	protected $mPrdtPrenom;
	
	/**
	* @var int(11)
	* @desc DopeId de la InfoBonLivraisonViewVO
	*/
	protected $mDopeId;
	
	/**
	* @var int(11)
	* @desc StoId de la InfoBonLivraisonViewVO
	*/
	protected $mStoId;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la InfoBonLivraisonViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la InfoBonLivraisonViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
	* @name getProIdCompteProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdCompteProducteur de la InfoBonLivraisonViewVO
	*/
	public function getProIdCompteProducteur() {
		return $this->mProIdCompteProducteur;
	}

	/**
	* @name setProIdCompteProducteur($pProIdCompteProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdCompteProducteur de la InfoBonLivraisonViewVO par $pProIdCompteProducteur
	*/
	public function setProIdCompteProducteur($pProIdCompteProducteur) {
		$this->mProIdCompteProducteur = $pProIdCompteProducteur;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la InfoBonLivraisonViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la InfoBonLivraisonViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la InfoBonLivraisonViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la InfoBonLivraisonViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la InfoBonLivraisonViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la InfoBonLivraisonViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getDopeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre DopeMontant de la InfoBonLivraisonViewVO
	*/
	public function getDopeMontant() {
		return $this->mDopeMontant;
	}

	/**
	* @name setDopeMontant($pDopeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre DopeMontant de la InfoBonLivraisonViewVO par $pDopeMontant
	*/
	public function setDopeMontant($pDopeMontant) {
		$this->mDopeMontant = $pDopeMontant;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(33,2)
	* @desc Renvoie le membre StoQuantite de la InfoBonLivraisonViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(33,2)
	* @desc Remplace le membre StoQuantite de la InfoBonLivraisonViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}
	
	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la InfoBonLivraisonViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la InfoBonLivraisonViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}
	
	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la InfoBonLivraisonViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la InfoBonLivraisonViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}
	
	/**
	* @name getDopeId()
	* @return int(11)
	* @desc Renvoie le membre DopeId de la InfoBonLivraisonViewVO
	*/
	public function getDopeId() {
		return $this->mDopeId;
	}

	/**
	* @name setDopeId($pDopeId)
	* @param int(11)
	* @desc Remplace le membre DopeId de la InfoBonLivraisonViewVO par $pDopeId
	*/
	public function setDopeId($pDopeId) {
		$this->mDopeId = $pDopeId;
	}
	
	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la InfoBonLivraisonViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la InfoBonLivraisonViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}
}
?>