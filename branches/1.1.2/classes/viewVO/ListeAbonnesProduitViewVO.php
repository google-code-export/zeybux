<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/02/2012
// Fichier : ListeAbonnesProduitViewVO.php
//
// Description : Classe ListeAbonnesProduitViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAbonnesProduitViewVO
 * @author Julien PIERRE
 * @since 14/02/2012
 * @desc Classe représentant une ListeAbonnesProduitViewVO
 */
class ListeAbonnesProduitViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CptAboIdProduitAbonnement de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboIdProduitAbonnement;

	/**
	* @var int(11)
	* @desc CptAboIdLotAbonnement de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboIdLotAbonnement;

	/**
	* @var int(11)
	* @desc CptAboIdCompte de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboIdCompte;

	/**
	* @var int(11)
	* @desc CptAboId de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboId;
	
	/**
	* @var varchar(20)
	* @desc AdhNumero de la ListeAbonnesProduitViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(30)
	* @desc CptLabel de la ListeAbonnesProduitViewVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAbonnesProduitViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAbonnesProduitViewVO
	*/
	protected $mAdhPrenom;
	
	/**
	* @var decimal(10,2)
	* @desc CptAboQuantite de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboQuantite;

	/**
	* @var int(11)
	* @desc ProAboIdNomProduit de la ListeAbonnesProduitViewVO
	*/
	protected $mProAboIdNomProduit;
	
	/**
	* @var dateTime
	* @desc CptAboDateDebutSuspension de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboDateDebutSuspension;
	
	/**
	* @var dateTime
	* @desc CptAboDateFinSuspension de la ListeAbonnesProduitViewVO
	*/
	protected $mCptAboDateFinSuspension;

	/**
	* @name getCptAboIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdProduitAbonnement de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboIdProduitAbonnement() {
		return $this->mCptAboIdProduitAbonnement;
	}

	/**
	* @name setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre CptAboIdProduitAbonnement de la ListeAbonnesProduitViewVO par $pCptAboIdProduitAbonnement
	*/
	public function setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement) {
		$this->mCptAboIdProduitAbonnement = $pCptAboIdProduitAbonnement;
	}

	/**
	* @name getCptAboIdLotAbonnement()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdLotAbonnement de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboIdLotAbonnement() {
		return $this->mCptAboIdLotAbonnement;
	}

	/**
	* @name setCptAboIdLotAbonnement($pCptAboIdLotAbonnement)
	* @param int(11)
	* @desc Remplace le membre CptAboIdLotAbonnement de la ListeAbonnesProduitViewVO par $pCptAboIdLotAbonnement
	*/
	public function setCptAboIdLotAbonnement($pCptAboIdLotAbonnement) {
		$this->mCptAboIdLotAbonnement = $pCptAboIdLotAbonnement;
	}

	/**
	* @name getCptAboIdCompte()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdCompte de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboIdCompte() {
		return $this->mCptAboIdCompte;
	}

	/**
	* @name setCptAboIdCompte($pCptAboIdCompte)
	* @param int(11)
	* @desc Remplace le membre CptAboIdCompte de la ListeAbonnesProduitViewVO par $pCptAboIdCompte
	*/
	public function setCptAboIdCompte($pCptAboIdCompte) {
		$this->mCptAboIdCompte = $pCptAboIdCompte;
	}

	/**
	* @name getCptAboId()
	* @return int(11)
	* @desc Renvoie le membre CptAboId de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboId() {
		return $this->mCptAboId;
	}

	/**
	* @name setCptAboId($pCptAboId)
	* @param int(11)
	* @desc Remplace le membre CptAboId de la ListeAbonnesProduitViewVO par $pCptAboId
	*/
	public function setCptAboId($pCptAboId) {
		$this->mCptAboId = $pCptAboId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la ListeAbonnesProduitViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la ListeAbonnesProduitViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la ListeAbonnesProduitViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la ListeAbonnesProduitViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAbonnesProduitViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAbonnesProduitViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAbonnesProduitViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAbonnesProduitViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getCptAboQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptAboQuantite de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboQuantite() {
		return $this->mCptAboQuantite;
	}

	/**
	* @name setCptAboQuantite($pCptAboQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre CptAboQuantite de la ListeAbonnesProduitViewVO par $pCptAboQuantite
	*/
	public function setCptAboQuantite($pCptAboQuantite) {
		$this->mCptAboQuantite = $pCptAboQuantite;
	}

	/**
	* @name getProAboIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre ProAboIdNomProduit de la ListeAbonnesProduitViewVO
	*/
	public function getProAboIdNomProduit() {
		return $this->mProAboIdNomProduit;
	}

	/**
	* @name setProAboIdNomProduit($pProAboIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre ProAboIdNomProduit de la ListeAbonnesProduitViewVO par $pProAboIdNomProduit
	*/
	public function setProAboIdNomProduit($pProAboIdNomProduit) {
		$this->mProAboIdNomProduit = $pProAboIdNomProduit;
	}

	/**
	* @name getCptAboDateDebutSuspension()
	* @return dateTime
	* @desc Renvoie le membre CptAboDateDebutSuspension de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboDateDebutSuspension() {
		return $this->mCptAboDateDebutSuspension;
	}

	/**
	* @name setCptAboDateDebutSuspension($pCptAboDateDebutSuspension)
	* @param dateTime
	* @desc Remplace le membre CptAboDateDebutSuspension de la ListeAbonnesProduitViewVO par $pCptAboDateDebutSuspension
	*/
	public function setCptAboDateDebutSuspension($pCptAboDateDebutSuspension) {
		$this->mCptAboDateDebutSuspension = $pCptAboDateDebutSuspension;
	}

	/**
	* @name getCptAboDateFinSuspension()
	* @return dateTime
	* @desc Renvoie le membre CptAboDateFinSuspension de la ListeAbonnesProduitViewVO
	*/
	public function getCptAboDateFinSuspension() {
		return $this->mCptAboDateFinSuspension;
	}

	/**
	* @name setCptAboDateFinSuspension($pCptAboDateFinSuspension)
	* @param dateTime
	* @desc Remplace le membre CptAboDateFinSuspension de la ListeAbonnesProduitViewVO par $pCptAboDateFinSuspension
	*/
	public function setCptAboDateFinSuspension($pCptAboDateFinSuspension) {
		$this->mCptAboDateFinSuspension = $pCptAboDateFinSuspension;
	}
}
?>