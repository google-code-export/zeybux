<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : OperationBonLivraisonViewVO.php
//
// Description : Classe OperationBonLivraisonViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationBonLivraisonViewVO
 * @author Julien PIERRE
 * @since 25/01/2011
 * @desc Classe représentant une OperationBonLivraisonViewVO
 */
class OperationBonLivraisonViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ComId de la OperationBonLivraisonViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ProIdProducteur de la OperationBonLivraisonViewVO
	*/
	protected $mProIdProducteur;

	/**
	* @var int(11)
	* @desc ProId de la OperationBonLivraisonViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc OpeId de la OperationBonLivraisonViewVO
	*/
	protected $mOpeId;

	/**
	* @var varchar(20)
	* @desc ProUniteMesure de la OperationBonLivraisonViewVO
	*/
	protected $mProUniteMesure;

	/**
	* @var varchar(50)
	* @desc NproNom de la OperationBonLivraisonViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationBonLivraisonViewVO
	*/
	protected $mOpeMontant;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la OperationBonLivraisonViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la OperationBonLivraisonViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getProIdProducteur()
	* @return int(11)
	* @desc Renvoie le membre ProIdProducteur de la OperationBonLivraisonViewVO
	*/
	public function getProIdProducteur() {
		return $this->mProIdProducteur;
	}

	/**
	* @name setProIdProducteur($pProIdProducteur)
	* @param int(11)
	* @desc Remplace le membre ProIdProducteur de la OperationBonLivraisonViewVO par $pProIdProducteur
	*/
	public function setProIdProducteur($pProIdProducteur) {
		$this->mProIdProducteur = $pProIdProducteur;
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la OperationBonLivraisonViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la OperationBonLivraisonViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationBonLivraisonViewVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationBonLivraisonViewVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getProUniteMesure()
	* @return varchar(20)
	* @desc Renvoie le membre ProUniteMesure de la OperationBonLivraisonViewVO
	*/
	public function getProUniteMesure() {
		return $this->mProUniteMesure;
	}

	/**
	* @name setProUniteMesure($pProUniteMesure)
	* @param varchar(20)
	* @desc Remplace le membre ProUniteMesure de la OperationBonLivraisonViewVO par $pProUniteMesure
	*/
	public function setProUniteMesure($pProUniteMesure) {
		$this->mProUniteMesure = $pProUniteMesure;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la OperationBonLivraisonViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la OperationBonLivraisonViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationBonLivraisonViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationBonLivraisonViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

}
?>