<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : DetailProduitAbonnementViewVO.php
//
// Description : Classe DetailProduitAbonnementViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProduitAbonnementViewVO
 * @author Julien PIERRE
 * @since 11/02/2012
 * @desc Classe représentant une DetailProduitAbonnementViewVO
 */
class DetailProduitAbonnementViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProAboId de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboId;

	/**
	* @var varchar(50)
	* @desc NproNom de la DetailProduitAbonnementViewVO
	*/
	protected $mNproNom;
	
	/**
	* @var varchar(20)
	* @desc ProAbUnite de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboUnite;

	/**
	* @var decimal(10,2)
	* @desc ProAboStockInitial de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboStockInitial;

	/**
	* @var decimal(10,2)
	* @desc ProAboMax de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboMax;

	/**
	* @var varchar(200)
	* @desc ProAboFrequence de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboFrequence;

	/**
	* @var decimal(10,2)
	* @desc ProAboReservation de la DetailProduitAbonnementViewVO
	*/
	protected $mProAboReservation;

	/**
	* @name getProAboId()
	* @return int(11)
	* @desc Renvoie le membre ProAboId de la DetailProduitAbonnementViewVO
	*/
	public function getProAboId() {
		return $this->mProAboId;
	}

	/**
	* @name setProAboId($pProAboId)
	* @param int(11)
	* @desc Remplace le membre ProAboId de la DetailProduitAbonnementViewVO par $pProAboId
	*/
	public function setProAboId($pProAboId) {
		$this->mProAboId = $pProAboId;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la DetailProduitAbonnementViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la DetailProduitAbonnementViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getProAboUnite()
	* @return varchar(20)
	* @desc Renvoie le membre ProAboUnite de la DetailProduitAbonnementViewVO
	*/
	public function getProAboUnite() {
		return $this->mProAboUnite;
	}

	/**
	* @name setProAboUnite($pProAboUnite)
	* @param varchar(20)
	* @desc Remplace le membre ProAboUnite de la DetailProduitAbonnementViewVO par $pProAboUnite
	*/
	public function setProAboUnite($pProAboUnite) {
		$this->mProAboUnite = $pProAboUnite;
	}

	/**
	* @name getProAboStockInitial()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProAboStockInitial de la DetailProduitAbonnementViewVO
	*/
	public function getProAboStockInitial() {
		return $this->mProAboStockInitial;
	}

	/**
	* @name setProAboStockInitial($pProAboStockInitial)
	* @param decimal(10,2)
	* @desc Remplace le membre ProAboStockInitial de la DetailProduitAbonnementViewVO par $pProAboStockInitial
	*/
	public function setProAboStockInitial($pProAboStockInitial) {
		$this->mProAboStockInitial = $pProAboStockInitial;
	}

	/**
	* @name getProAboMax()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProAboMax de la DetailProduitAbonnementViewVO
	*/
	public function getProAboMax() {
		return $this->mProAboMax;
	}

	/**
	* @name setProAboMax($pProAboMax)
	* @param decimal(10,2)
	* @desc Remplace le membre ProAboMax de la DetailProduitAbonnementViewVO par $pProAboMax
	*/
	public function setProAboMax($pProAboMax) {
		$this->mProAboMax = $pProAboMax;
	}

	/**
	* @name getProAboFrequence()
	* @return varchar(200)
	* @desc Renvoie le membre ProAboFrequence de la DetailProduitAbonnementViewVO
	*/
	public function getProAboFrequence() {
		return $this->mProAboFrequence;
	}

	/**
	* @name setProAboFrequence($pProAboFrequence)
	* @param varchar(200)
	* @desc Remplace le membre ProAboFrequence de la DetailProduitAbonnementViewVO par $pProAboFrequence
	*/
	public function setProAboFrequence($pProAboFrequence) {
		$this->mProAboFrequence = $pProAboFrequence;
	}

	/**
	* @name getProAboReservation()
	* @return decimal(10,2)
	* @desc Renvoie le membre ProAboReservation de la DetailProduitAbonnementViewVO
	*/
	public function getProAboReservation() {
		return $this->mProAboReservation;
	}

	/**
	* @name setProAboReservation($pProAboReservation)
	* @param decimal(10,2)
	* @desc Remplace le membre ProAboReservation de la DetailProduitAbonnementViewVO par $pProAboReservation
	*/
	public function setProAboReservation($pProAboReservation) {
		$this->mProAboReservation = $pProAboReservation;
	}

}
?>