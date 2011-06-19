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
	* @desc ComId de la InfoBonCommandeViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la InfoBonCommandeViewVO
	*/
	protected $mProIdProducteur;

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
	protected $mOpeMontant;

	/**
	* @var decimal(33,2)
	* @desc StoQuantite de la InfoBonCommandeViewVO
	*/
	protected $mStoQuantite;
	
	/**
	* @var varchar(50)
	* @desc PrdtNom de la InfoBonCommandeViewVO
	*/
	protected $mPrdtNom;
	
	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la InfoBonCommandeViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la InfoBonCommandeViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la InfoBonCommandeViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la InfoBonCommandeViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la InfoBonCommandeViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
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
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la InfoBonCommandeViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la InfoBonCommandeViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
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
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la InfoBonCommandeViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la InfoBonCommandeViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}
	
	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la InfoBonCommandeViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la InfoBonCommandeViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

}
?>