<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : DetailCompteAbonnementViewVO.php
//
// Description : Classe DetailCompteAbonnementViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailCompteAbonnementViewVO
 * @author Julien PIERRE
 * @since 11/02/2012
 * @desc Classe représentant une DetailCompteAbonnementViewVO
 */
class DetailCompteAbonnementViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CptAboId de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboId;
	
	/**
	* @var int(11)
	* @desc CptAboIdProduitAbonnement de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboIdProduitAbonnement;
	
	/**
	* @var int(11)
	* @desc CptAboIdLotAbonnement de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboIdLotAbonnement;

	/**
	* @var varchar(30)
	* @desc CptLabel de la DetailCompteAbonnementViewVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(50)
	* @desc NproNom de la DetailCompteAbonnementViewVO
	*/
	protected $mNproNom;

	/**
	* @var decimal(10,2)
	* @desc CptAboQuantite de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboQuantite;

	/**
	* @var datetime
	* @desc CptAboDateDebutSuspension de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboDateDebutSuspension;

	/**
	* @var datetime
	* @desc CptAboDateFinSuspension de la DetailCompteAbonnementViewVO
	*/
	protected $mCptAboDateFinSuspension;

	/**
	* @name getCptAboId()
	* @return int(11)
	* @desc Renvoie le membre CptAboId de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboId() {
		return $this->mCptAboId;
	}

	/**
	* @name setCptAboId($pCptAboId)
	* @param int(11)
	* @desc Remplace le membre CptAboId de la DetailCompteAbonnementViewVO par $pCptAboId
	*/
	public function setCptAboId($pCptAboId) {
		$this->mCptAboId = $pCptAboId;
	}

	/**
	* @name getCptAboIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdProduitAbonnement de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboIdProduitAbonnement() {
		return $this->mCptAboIdProduitAbonnement;
	}

	/**
	* @name setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre CptAboIdProduitAbonnement de la DetailCompteAbonnementViewVO par $pCptAboIdProduitAbonnement
	*/
	public function setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement) {
		$this->mCptAboIdProduitAbonnement = $pCptAboIdProduitAbonnement;
	}

	/**
	* @name getCptAboIdLotAbonnement()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdLotAbonnement de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboIdLotAbonnement() {
		return $this->mCptAboIdLotAbonnement;
	}

	/**
	* @name setCptAboIdLotAbonnement($pCptAboIdLotAbonnement)
	* @param int(11)
	* @desc Remplace le membre CptAboIdLotAbonnement de la DetailCompteAbonnementViewVO par $pCptAboIdLotAbonnement
	*/
	public function setCptAboIdLotAbonnement($pCptAboIdLotAbonnement) {
		$this->mCptAboIdLotAbonnement = $pCptAboIdLotAbonnement;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la DetailCompteAbonnementViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la DetailCompteAbonnementViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la DetailCompteAbonnementViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la DetailCompteAbonnementViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCptAboQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptAboQuantite de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboQuantite() {
		return $this->mCptAboQuantite;
	}

	/**
	* @name setCptAboQuantite($pCptAboQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre CptAboQuantite de la DetailCompteAbonnementViewVO par $pCptAboQuantite
	*/
	public function setCptAboQuantite($pCptAboQuantite) {
		$this->mCptAboQuantite = $pCptAboQuantite;
	}

	/**
	* @name getCptAboDateDebutSuspension()
	* @return datetime
	* @desc Renvoie le membre CptAboDateDebutSuspension de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboDateDebutSuspension() {
		return $this->mCptAboDateDebutSuspension;
	}

	/**
	* @name setCptAboDateDebutSuspension($pCptAboDateDebutSuspension)
	* @param datetime
	* @desc Remplace le membre CptAboDateDebutSuspension de la DetailCompteAbonnementViewVO par $pCptAboDateDebutSuspension
	*/
	public function setCptAboDateDebutSuspension($pCptAboDateDebutSuspension) {
		$this->mCptAboDateDebutSuspension = $pCptAboDateDebutSuspension;
	}

	/**
	* @name getCptAboDateFinSuspension()
	* @return datetime
	* @desc Renvoie le membre CptAboDateFinSuspension de la DetailCompteAbonnementViewVO
	*/
	public function getCptAboDateFinSuspension() {
		return $this->mCptAboDateFinSuspension;
	}

	/**
	* @name setCptAboDateFinSuspension($pCptAboDateFinSuspension)
	* @param datetime
	* @desc Remplace le membre CptAboDateFinSuspension de la DetailCompteAbonnementViewVO par $pCptAboDateFinSuspension
	*/
	public function setCptAboDateFinSuspension($pCptAboDateFinSuspension) {
		$this->mCptAboDateFinSuspension = $pCptAboDateFinSuspension;
	}

}
?>