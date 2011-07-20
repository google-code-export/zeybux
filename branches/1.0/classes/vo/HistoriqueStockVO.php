<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/07/2011
// Fichier : HistoriqueStockVO.php
//
// Description : Classe HistoriqueStockVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name HistoriqueStockVO
 * @author Julien PIERRE
 * @since 18/07/2011
 * @desc Classe représentant une HistoriqueStockVO
 */
class HistoriqueStockVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la HistoriqueStockVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc StoId de la HistoriqueStockVO
	*/
	protected $mStoId;

	/**
	* @var datetime
	* @desc Date de la HistoriqueStockVO
	*/
	protected $mDate;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la HistoriqueStockVO
	*/
	protected $mQuantite;

	/**
	* @var int(11)
	* @desc Type de la HistoriqueStockVO
	*/
	protected $mType;

	/**
	* @var int(11)
	* @desc IdCompte de la HistoriqueStockVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc IdDetailCommande de la HistoriqueStockVO
	*/
	protected $mIdDetailCommande;

	/**
	* @var int(11)
	* @desc IdOperation de la HistoriqueStockVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdConnexion de la HistoriqueStockVO
	*/
	protected $mIdConnexion;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la HistoriqueStockVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la HistoriqueStockVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getStoId()
	* @return int(11)
	* @desc Renvoie le membre StoId de la HistoriqueStockVO
	*/
	public function getStoId() {
		return $this->mStoId;
	}

	/**
	* @name setStoId($pStoId)
	* @param int(11)
	* @desc Remplace le membre StoId de la HistoriqueStockVO par $pStoId
	*/
	public function setStoId($pStoId) {
		$this->mStoId = $pStoId;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la HistoriqueStockVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la HistoriqueStockVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la HistoriqueStockVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la HistoriqueStockVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la HistoriqueStockVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la HistoriqueStockVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la HistoriqueStockVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la HistoriqueStockVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la HistoriqueStockVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la HistoriqueStockVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la HistoriqueStockVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la HistoriqueStockVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdConnexion()
	* @return int(11)
	* @desc Renvoie le membre IdConnexion de la HistoriqueStockVO
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param int(11)
	* @desc Remplace le membre IdConnexion de la HistoriqueStockVO par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}

}
?>