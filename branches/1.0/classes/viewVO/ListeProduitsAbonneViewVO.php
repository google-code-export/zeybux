<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/02/2012
// Fichier : ListeProduitsAbonneViewVO.php
//
// Description : Classe ListeProduitsAbonneViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitsAbonneViewVO
 * @author Julien PIERRE
 * @since 14/02/2012
 * @desc Classe représentant une ListeProduitsAbonneViewVO
 */
class ListeProduitsAbonneViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc CptAboIdCompte de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboIdCompte;

	/**
	* @var int(11)
	* @desc CptAboIdProduitAbonnement de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboIdProduitAbonnement;

	/**
	* @var int(11)
	* @desc CptAboId de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboId;

	/**
	* @var text
	* @desc FerNom de la ListeProduitsAbonneViewVO
	*/
	protected $mFerNom;

	/**
	* @var varchar(50)
	* @desc NproNom de la ListeProduitsAbonneViewVO
	*/
	protected $mNproNom;

	/**
	* @var varchar(50)
	* @desc CproNom de la ListeProduitsAbonneViewVO
	*/
	protected $mCproNom;

	/**
	* @var decimal(10,2)
	* @desc CptAboQuantite de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboQuantite;

	/**
	* @var varchar(20)
	* @desc ProAboUnite de la ListeProduitsAbonneViewVO
	*/
	protected $mProAboUnite;

	/**
	* @var dateTime
	* @desc CptAboDateDebutSuspension de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboDateDebutSuspension;

	/**
	* @var dateTime
	* @desc CptAboDateFinSuspension de la ListeProduitsAbonneViewVO
	*/
	protected $mCptAboDateFinSuspension;

	/**
	* @name getCptAboIdCompte()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdCompte de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboIdCompte() {
		return $this->mCptAboIdCompte;
	}

	/**
	* @name setCptAboIdCompte($pCptAboIdCompte)
	* @param int(11)
	* @desc Remplace le membre CptAboIdCompte de la ListeProduitsAbonneViewVO par $pCptAboIdCompte
	*/
	public function setCptAboIdCompte($pCptAboIdCompte) {
		$this->mCptAboIdCompte = $pCptAboIdCompte;
	}

	/**
	* @name getCptAboIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre CptAboIdProduitAbonnement de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboIdProduitAbonnement() {
		return $this->mCptAboIdProduitAbonnement;
	}

	/**
	* @name setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre CptAboIdProduitAbonnement de la ListeProduitsAbonneViewVO par $pCptAboIdProduitAbonnement
	*/
	public function setCptAboIdProduitAbonnement($pCptAboIdProduitAbonnement) {
		$this->mCptAboIdProduitAbonnement = $pCptAboIdProduitAbonnement;
	}

	/**
	* @name getCptAboId()
	* @return int(11)
	* @desc Renvoie le membre CptAboId de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboId() {
		return $this->mCptAboId;
	}

	/**
	* @name setCptAboId($pCptAboId)
	* @param int(11)
	* @desc Remplace le membre CptAboId de la ListeProduitsAbonneViewVO par $pCptAboId
	*/
	public function setCptAboId($pCptAboId) {
		$this->mCptAboId = $pCptAboId;
	}

	/**
	* @name getFerNom()
	* @return text
	* @desc Renvoie le membre FerNom de la ListeProduitsAbonneViewVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param text
	* @desc Remplace le membre FerNom de la ListeProduitsAbonneViewVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}
	
	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ListeProduitsAbonneViewVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ListeProduitsAbonneViewVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}

	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ListeProduitsAbonneViewVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ListeProduitsAbonneViewVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	* @name getProAboUnite()
	* @return varchar(20)
	* @desc Renvoie le membre ProAboUnite de la ListeProduitsAbonneViewVO
	*/
	public function getProAboUnite() {
		return $this->mProAboUnite;
	}

	/**
	* @name setProAboUnite($pProAboUnite)
	* @param varchar(20)
	* @desc Remplace le membre ProAboUnite de la ListeProduitsAbonneViewVO par $pProAboUnite
	*/
	public function setProAboUnite($pProAboUnite) {
		$this->mProAboUnite = $pProAboUnite;
	}

	/**
	* @name getCptAboQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptAboQuantite de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboQuantite() {
		return $this->mCptAboQuantite;
	}

	/**
	* @name setCptAboQuantite($pCptAboQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre CptAboQuantite de la ListeProduitsAbonneViewVO par $pCptAboQuantite
	*/
	public function setCptAboQuantite($pCptAboQuantite) {
		$this->mCptAboQuantite = $pCptAboQuantite;
	}

	/**
	* @name getCptAboDateDebutSuspension()
	* @return dateTime
	* @desc Renvoie le membre CptAboDateDebutSuspension de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboDateDebutSuspension() {
		return $this->mCptAboDateDebutSuspension;
	}

	/**
	* @name setCptAboDateDebutSuspension($pCptAboDateDebutSuspension)
	* @param dateTime
	* @desc Remplace le membre CptAboDateDebutSuspension de la ListeProduitsAbonneViewVO par $pCptAboDateDebutSuspension
	*/
	public function setCptAboDateDebutSuspension($pCptAboDateDebutSuspension) {
		$this->mCptAboDateDebutSuspension = $pCptAboDateDebutSuspension;
	}

	/**
	* @name getCptAboDateFinSuspension()
	* @return dateTime
	* @desc Renvoie le membre CptAboDateFinSuspension de la ListeProduitsAbonneViewVO
	*/
	public function getCptAboDateFinSuspension() {
		return $this->mCptAboDateFinSuspension;
	}

	/**
	* @name setCptAboDateFinSuspension($pCptAboDateFinSuspension)
	* @param dateTime
	* @desc Remplace le membre CptAboDateFinSuspension de la ListeProduitsAbonneViewVO par $pCptAboDateFinSuspension
	*/
	public function setCptAboDateFinSuspension($pCptAboDateFinSuspension) {
		$this->mCptAboDateFinSuspension = $pCptAboDateFinSuspension;
	}

}
?>