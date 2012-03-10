<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : CompteAbonnementVO.php
//
// Description : Classe CompteAbonnementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteAbonnementVO
 * @author Julien PIERRE
 * @since 11/02/2012
 * @desc Classe représentant une CompteAbonnementVO
 */
class CompteAbonnementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CompteAbonnementVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la CompteAbonnementVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc IdProduitAbonnement de la CompteAbonnementVO
	*/
	protected $mIdProduitAbonnement;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la CompteAbonnementVO
	*/
	protected $mQuantite;

	/**
	* @var datetime
	* @desc DateDebutSuspension de la CompteAbonnementVO
	*/
	protected $mDateDebutSuspension;

	/**
	* @var datetime
	* @desc DateFinSuspension de la CompteAbonnementVO
	*/
	protected $mDateFinSuspension;

	/**
	* @var tinyint(4)
	* @desc Etat de la CompteAbonnementVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CompteAbonnementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CompteAbonnementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la CompteAbonnementVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la CompteAbonnementVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre IdProduitAbonnement de la CompteAbonnementVO
	*/
	public function getIdProduitAbonnement() {
		return $this->mIdProduitAbonnement;
	}

	/**
	* @name setIdProduitAbonnement($pIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre IdProduitAbonnement de la CompteAbonnementVO par $pIdProduitAbonnement
	*/
	public function setIdProduitAbonnement($pIdProduitAbonnement) {
		$this->mIdProduitAbonnement = $pIdProduitAbonnement;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la CompteAbonnementVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la CompteAbonnementVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getDateDebutSuspension()
	* @return datetime
	* @desc Renvoie le membre DateDebutSuspension de la CompteAbonnementVO
	*/
	public function getDateDebutSuspension() {
		return $this->mDateDebutSuspension;
	}

	/**
	* @name setDateDebutSuspension($pDateDebutSuspension)
	* @param datetime
	* @desc Remplace le membre DateDebutSuspension de la CompteAbonnementVO par $pDateDebutSuspension
	*/
	public function setDateDebutSuspension($pDateDebutSuspension) {
		$this->mDateDebutSuspension = $pDateDebutSuspension;
	}

	/**
	* @name getDateFinSuspension()
	* @return datetime
	* @desc Renvoie le membre DateFinSuspension de la CompteAbonnementVO
	*/
	public function getDateFinSuspension() {
		return $this->mDateFinSuspension;
	}

	/**
	* @name setDateFinSuspension($pDateFinSuspension)
	* @param datetime
	* @desc Remplace le membre DateFinSuspension de la CompteAbonnementVO par $pDateFinSuspension
	*/
	public function setDateFinSuspension($pDateFinSuspension) {
		$this->mDateFinSuspension = $pDateFinSuspension;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la CompteAbonnementVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la CompteAbonnementVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>