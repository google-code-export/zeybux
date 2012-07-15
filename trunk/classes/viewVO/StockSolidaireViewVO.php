<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : StockSolidaireViewVO.php
//
// Description : Classe StockSolidaireViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name StockSolidaireViewVO
 * @author Julien PIERRE
 * @since 25/01/2011
 * @desc Classe représentant une StockSolidaireViewVO
 */
class StockSolidaireViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ProIdCommande de la StockSolidaireViewVO
	*/
	protected $mProIdCommande;

	/**
	* @var int(11)
<<<<<<< .working
	* @desc ProIdCompteProducteur de la StockSolidaireViewVO
=======
	* @desc ProIdCompteFerme de la StockSolidaireViewVO
>>>>>>> .merge-right.r75
	*/
<<<<<<< .working
	protected $mProIdCompteProducteur;
=======
	protected $mProIdCompteFerme;
>>>>>>> .merge-right.r75

	/**
	* @var int(11)
	* @desc ProId de la StockSolidaireViewVO
	*/
	protected $mProId;

	/**
	* @var int(11)
	* @desc StoId de la StockSolidaireViewVO
	*/
	protected $mStoId;

	/**
	* @var int(11)
	* @desc DcomId de la StockSolidaireViewVO
	*/
	protected $mDcomId;

	/**
	* @var decimal(10,2)
	* @desc StoQuantite de la StockSolidaireViewVO
	*/
	protected $mStoQuantite;

	/**
	* @name getProIdCommande()
	* @return int(11)
	* @desc Renvoie le membre ProIdCommande de la StockSolidaireViewVO
	*/
	public function getProIdCommande() {
		return $this->mProIdCommande;
	}

	/**
	* @name setProIdCommande($pProIdCommande)
	* @param int(11)
	* @desc Remplace le membre ProIdCommande de la StockSolidaireViewVO par $pProIdCommande
	*/
	public function setProIdCommande($pProIdCommande) {
		$this->mProIdCommande = $pProIdCommande;
	}

	/**
<<<<<<< .working
	* @name getProIdCompteProducteur()
=======
	* @name getProIdCompteFerme()
>>>>>>> .merge-right.r75
	* @return int(11)
<<<<<<< .working
	* @desc Renvoie le membre ProIdCompteProducteur de la StockSolidaireViewVO
=======
	* @desc Renvoie le membre ProIdCompteFerme de la StockSolidaireViewVO
>>>>>>> .merge-right.r75
	*/
<<<<<<< .working
	public function getProIdCompteProducteur() {
		return $this->mProIdCompteProducteur;
=======
	public function getProIdCompteFerme() {
		return $this->mProIdCompteFerme;
>>>>>>> .merge-right.r75
	}

	/**
<<<<<<< .working
	* @name setProIdCompteProducteur($pProIdCompteProducteur)
=======
	* @name setProIdCompteFerme($pProIdCompteFerme)
>>>>>>> .merge-right.r75
	* @param int(11)
<<<<<<< .working
	* @desc Remplace le membre ProIdCompteProducteur de la StockSolidaireViewVO par $pProIdCompteProducteur
=======
	* @desc Remplace le membre ProIdCompteFerme de la StockSolidaireViewVO par $pProIdCompteFerme
>>>>>>> .merge-right.r75
	*/
<<<<<<< .working
	public function setProIdCompteProducteur($pProIdCompteProducteur) {
		$this->mProIdCompteProducteur = $pProIdCompteProducteur;
=======
	public function setProIdCompteFerme($pProIdCompteFerme) {
		$this->mProIdCompteFerme = $pProIdCompteFerme;
>>>>>>> .merge-right.r75
	}

	/**
	* @name getProId()
	* @return int(11)
	* @desc Renvoie le membre ProId de la StockSolidaireViewVO
	*/
	public function getProId() {
		return $this->mProId;
	}

	/**
	* @name setProId($pProId)
	* @param int(11)
	* @desc Remplace le membre ProId de la StockSolidaireViewVO par $pProId
	*/
	public function setProId($pProId) {
		$this->mProId = $pProId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la StockSolidaireViewVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la StockSolidaireViewVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getDcomId()
	* @return int(11)
	* @desc Renvoie le membre DcomId de la StockSolidaireViewVO
	*/
	public function getDcomId() {
		return $this->mDcomId;
	}

	/**
	* @name setDcomId($pDcomId)
	* @param int(11)
	* @desc Remplace le membre DcomId de la StockSolidaireViewVO par $pDcomId
	*/
	public function setDcomId($pDcomId) {
		$this->mDcomId = $pDcomId;
	}

	/**
	* @name getStoQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre StoQuantite de la StockSolidaireViewVO
	*/
	public function getStoQuantite() {
		return $this->mStoQuantite;
	}

	/**
	* @name setStoQuantite($pStoQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre StoQuantite de la StockSolidaireViewVO par $pStoQuantite
	*/
	public function setStoQuantite($pStoQuantite) {
		$this->mStoQuantite = $pStoQuantite;
	}

}
?>