<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : HistoriqueSuspensionAbonnementVO.php
//
// Description : Classe HistoriqueSuspensionAbonnementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name HistoriqueSuspensionAbonnementVO
 * @author Julien PIERRE
 * @since 11/02/2012
 * @desc Classe représentant une HistoriqueSuspensionAbonnementVO
 */
class HistoriqueSuspensionAbonnementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc DateDebutSuspension de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mDateDebutSuspension;

	/**
	* @var int(11)
	* @desc DateFinSuspension de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mDateFinSuspension;

	/**
	* @var int(11)
	* @desc IdProduitAbonnement de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mIdProduitAbonnement;

	/**
	* @var int(11)
	* @desc IdCompte de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mIdCompte;

	/**
	* @var datetime
	* @desc Date de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc IdConnexion de la HistoriqueSuspensionAbonnementVO
	*/
	protected $mIdConnexion;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la HistoriqueSuspensionAbonnementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la HistoriqueSuspensionAbonnementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getDateDebutSuspension()
	* @return int(11)
	* @desc Renvoie le membre DateDebutSuspension de la HistoriqueSuspensionAbonnementVO
	*/
	public function getDateDebutSuspension() {
		return $this->mDateDebutSuspension;
	}

	/**
	* @name setDateDebutSuspension($pDateDebutSuspension)
	* @param int(11)
	* @desc Remplace le membre DateDebutSuspension de la HistoriqueSuspensionAbonnementVO par $pDateDebutSuspension
	*/
	public function setDateDebutSuspension($pDateDebutSuspension) {
		$this->mDateDebutSuspension = $pDateDebutSuspension;
	}

	/**
	* @name getDateFinSuspension()
	* @return int(11)
	* @desc Renvoie le membre DateFinSuspension de la HistoriqueSuspensionAbonnementVO
	*/
	public function getDateFinSuspension() {
		return $this->mDateFinSuspension;
	}

	/**
	* @name setDateFinSuspension($pDateFinSuspension)
	* @param int(11)
	* @desc Remplace le membre DateFinSuspension de la HistoriqueSuspensionAbonnementVO par $pDateFinSuspension
	*/
	public function setDateFinSuspension($pDateFinSuspension) {
		$this->mDateFinSuspension = $pDateFinSuspension;
	}

	/**
	* @name getIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre IdProduitAbonnement de la HistoriqueSuspensionAbonnementVO
	*/
	public function getIdProduitAbonnement() {
		return $this->mIdProduitAbonnement;
	}

	/**
	* @name setIdProduitAbonnement($pIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre IdProduitAbonnement de la HistoriqueSuspensionAbonnementVO par $pIdProduitAbonnement
	*/
	public function setIdProduitAbonnement($pIdProduitAbonnement) {
		$this->mIdProduitAbonnement = $pIdProduitAbonnement;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la HistoriqueSuspensionAbonnementVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la HistoriqueSuspensionAbonnementVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la HistoriqueSuspensionAbonnementVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la HistoriqueSuspensionAbonnementVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getIdConnexion()
	* @return int(11)
	* @desc Renvoie le membre IdConnexion de la HistoriqueSuspensionAbonnementVO
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param int(11)
	* @desc Remplace le membre IdConnexion de la HistoriqueSuspensionAbonnementVO par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}

}
?>