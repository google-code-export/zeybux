<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : ProducteurVO.php
//
// Description : Classe ProducteurVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProducteurVO
 * @author Julien PIERRE
 * @since 22/12/2010
 * @desc Classe représentant une ProducteurVO
 */
class ProducteurVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ProducteurVO
	*/
	protected $mId;

	/**
	* @var varchar(100)
	* @desc MotPasse de la ProducteurVO
	*/
	protected $mMotPasse;

	/**
	* @var varchar(20)
	* @desc Numero de la ProducteurVO
	*/
	protected $mNumero;

	/**
	* @var int(11)
	* @desc IdCompte de la ProducteurVO
	*/
	protected $mIdCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la ProducteurVO
	*/
	protected $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la ProducteurVO
	*/
	protected $mPrenom;

	/**
	* @var varchar(100)
	* @desc CourrielPrincipal de la ProducteurVO
	*/
	protected $mCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc CourrielSecondaire de la ProducteurVO
	*/
	protected $mCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc TelephonePrincipal de la ProducteurVO
	*/
	protected $mTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc TelephoneSecondaire de la ProducteurVO
	*/
	protected $mTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc Adresse de la ProducteurVO
	*/
	protected $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la ProducteurVO
	*/
	protected $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la ProducteurVO
	*/
	protected $mVille;

	/**
	* @var date
	* @desc DateNaissance de la ProducteurVO
	*/
	protected $mDateNaissance;

	/**
	* @var date
	* @desc DateCreation de la ProducteurVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateMaj de la ProducteurVO
	*/
	protected $mDateMaj;

	/**
	* @var text
	* @desc Commentaire de la ProducteurVO
	*/
	protected $mCommentaire;

	/**
	* @var tinyint(4)
	* @desc Etat de la ProducteurVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ProducteurVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ProducteurVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getMotPasse()
	* @return varchar(100)
	* @desc Renvoie le membre MotPasse de la ProducteurVO
	*/
	public function getMotPasse() {
		return $this->mMotPasse;
	}

	/**
	* @name setMotPasse($pMotPasse)
	* @param varchar(100)
	* @desc Remplace le membre MotPasse de la ProducteurVO par $pMotPasse
	*/
	public function setMotPasse($pMotPasse) {
		$this->mMotPasse = $pMotPasse;
	}

	/**
	* @name getNumero()
	* @return varchar(20)
	* @desc Renvoie le membre Numero de la ProducteurVO
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param varchar(20)
	* @desc Remplace le membre Numero de la ProducteurVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la ProducteurVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la ProducteurVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la ProducteurVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la ProducteurVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre Prenom de la ProducteurVO
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param varchar(50)
	* @desc Remplace le membre Prenom de la ProducteurVO par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}

	/**
	* @name getCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielPrincipal de la ProducteurVO
	*/
	public function getCourrielPrincipal() {
		return $this->mCourrielPrincipal;
	}

	/**
	* @name setCourrielPrincipal($pCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre CourrielPrincipal de la ProducteurVO par $pCourrielPrincipal
	*/
	public function setCourrielPrincipal($pCourrielPrincipal) {
		$this->mCourrielPrincipal = $pCourrielPrincipal;
	}

	/**
	* @name getCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielSecondaire de la ProducteurVO
	*/
	public function getCourrielSecondaire() {
		return $this->mCourrielSecondaire;
	}

	/**
	* @name setCourrielSecondaire($pCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre CourrielSecondaire de la ProducteurVO par $pCourrielSecondaire
	*/
	public function setCourrielSecondaire($pCourrielSecondaire) {
		$this->mCourrielSecondaire = $pCourrielSecondaire;
	}

	/**
	* @name getTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre TelephonePrincipal de la ProducteurVO
	*/
	public function getTelephonePrincipal() {
		return $this->mTelephonePrincipal;
	}

	/**
	* @name setTelephonePrincipal($pTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre TelephonePrincipal de la ProducteurVO par $pTelephonePrincipal
	*/
	public function setTelephonePrincipal($pTelephonePrincipal) {
		$this->mTelephonePrincipal = $pTelephonePrincipal;
	}

	/**
	* @name getTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre TelephoneSecondaire de la ProducteurVO
	*/
	public function getTelephoneSecondaire() {
		return $this->mTelephoneSecondaire;
	}

	/**
	* @name setTelephoneSecondaire($pTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre TelephoneSecondaire de la ProducteurVO par $pTelephoneSecondaire
	*/
	public function setTelephoneSecondaire($pTelephoneSecondaire) {
		$this->mTelephoneSecondaire = $pTelephoneSecondaire;
	}

	/**
	* @name getAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre Adresse de la ProducteurVO
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param varchar(300)
	* @desc Remplace le membre Adresse de la ProducteurVO par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre CodePostal de la ProducteurVO
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre CodePostal de la ProducteurVO par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return varchar(100)
	* @desc Renvoie le membre Ville de la ProducteurVO
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param varchar(100)
	* @desc Remplace le membre Ville de la ProducteurVO par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateNaissance()
	* @return date
	* @desc Renvoie le membre DateNaissance de la ProducteurVO
	*/
	public function getDateNaissance() {
		return $this->mDateNaissance;
	}

	/**
	* @name setDateNaissance($pDateNaissance)
	* @param date
	* @desc Remplace le membre DateNaissance de la ProducteurVO par $pDateNaissance
	*/
	public function setDateNaissance($pDateNaissance) {
		$this->mDateNaissance = $pDateNaissance;
	}

	/**
	* @name getDateCreation()
	* @return date
	* @desc Renvoie le membre DateCreation de la ProducteurVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param date
	* @desc Remplace le membre DateCreation de la ProducteurVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateMaj()
	* @return datetime
	* @desc Renvoie le membre DateMaj de la ProducteurVO
	*/
	public function getDateMaj() {
		return $this->mDateMaj;
	}

	/**
	* @name setDateMaj($pDateMaj)
	* @param datetime
	* @desc Remplace le membre DateMaj de la ProducteurVO par $pDateMaj
	*/
	public function setDateMaj($pDateMaj) {
		$this->mDateMaj = $pDateMaj;
	}

	/**
	* @name getCommentaire()
	* @return text
	* @desc Renvoie le membre Commentaire de la ProducteurVO
	*/
	public function getCommentaire() {
		return $this->mCommentaire;
	}

	/**
	* @name setCommentaire($pCommentaire)
	* @param text
	* @desc Remplace le membre Commentaire de la ProducteurVO par $pCommentaire
	*/
	public function setCommentaire($pCommentaire) {
		$this->mCommentaire = $pCommentaire;
	}

	/**
	* @name getEtat()
	* @return tinyint(4)
	* @desc Renvoie le membre Etat de la ProducteurVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(4)
	* @desc Remplace le membre Etat de la ProducteurVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>