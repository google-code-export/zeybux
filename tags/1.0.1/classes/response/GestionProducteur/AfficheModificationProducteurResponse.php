<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : AfficheModificationProducteurResponse.php
//
// Description : Classe AfficheModificationProducteurResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheModificationProducteurResponse
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe représentant une AfficheModificationProducteurResponse
 */
class AfficheModificationProducteurResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

		/**
	* @var int(11)
	* @desc Id de la AfficheModificationProducteurResponse
	*/
	protected $mId;
	
	/**
	* @var varchar(5)
	* @desc Numero de la AfficheModificationProducteurResponse
	*/
	protected $mNumero;

	/**
	* @var varchar(30)
	* @desc Compte de la AfficheModificationProducteurResponse
	*/
	protected $mCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la AfficheModificationProducteurResponse
	*/
	protected $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la AfficheModificationProducteurResponse
	*/
	protected $mPrenom;

	/**
	* @var varchar(100)
	* @desc CourrielPrincipal de la AfficheModificationProducteurResponse
	*/
	protected $mCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc CourrielSecondaire de la AfficheModificationProducteurResponse
	*/
	protected $mCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc TelephonePrincipal de la AfficheModificationProducteurResponse
	*/
	protected $mTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc TelephoneSecondaire de la AfficheModificationProducteurResponse
	*/
	protected $mTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc Adresse de la AfficheModificationProducteurResponse
	*/
	protected $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la AfficheModificationProducteurResponse
	*/
	protected $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la AfficheModificationProducteurResponse
	*/
	protected $mVille;

	/**
	* @var date
	* @desc DateNaissance de la AfficheModificationProducteurResponse
	*/
	protected $mDateNaissance;

	/**
	* @var text
	* @desc Commentaire de la AfficheModificationProducteurResponse
	*/
	protected $mCommentaire;
	
	/**
	* @name AfficheModificationProducteurResponse()
	* @desc Le constructeur
	*/
	public function AfficheModificationProducteurResponse() {
		$this->mValid = true;
	}
	
	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}
	
	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id du Producteur
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AfficheModificationProducteurResponse par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return varchar(5)
	* @desc Renvoie le membre Numero de la AfficheModificationProducteurResponse
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param varchar(5)
	* @desc Remplace le membre Numero de la AfficheModificationProducteurResponse par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getCompte()
	* @return varchar(30)
	* @desc Renvoie le membre Compte de la AfficheModificationProducteurResponse
	*/
	public function getCompte(){
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param varchar(30)
	* @desc Remplace le membre Compte de la AfficheModificationProducteurResponse par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la AfficheModificationProducteurResponse
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la AfficheModificationProducteurResponse par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre Prenom de la AfficheModificationProducteurResponse
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param varchar(50)
	* @desc Remplace le membre Prenom de la AfficheModificationProducteurResponse par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}

	/**
	* @name getCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielPrincipal de la AfficheModificationProducteurResponse
	*/
	public function getCourrielPrincipal() {
		return $this->mCourrielPrincipal;
	}

	/**
	* @name setCourrielPrincipal($pCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre CourrielPrincipal de la AfficheModificationProducteurResponse par $pCourrielPrincipal
	*/
	public function setCourrielPrincipal($pCourrielPrincipal) {
		$this->mCourrielPrincipal = $pCourrielPrincipal;
	}

	/**
	* @name getCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielSecondaire de la AfficheModificationProducteurResponse
	*/
	public function getCourrielSecondaire() {
		return $this->mCourrielSecondaire;
	}

	/**
	* @name setCourrielSecondaire($pCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre CourrielSecondaire de la AfficheModificationProducteurResponse par $pCourrielSecondaire
	*/
	public function setCourrielSecondaire($pCourrielSecondaire) {
		$this->mCourrielSecondaire = $pCourrielSecondaire;
	}

	/**
	* @name getTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre TelephonePrincipal de la AfficheModificationProducteurResponse
	*/
	public function getTelephonePrincipal() {
		return $this->mTelephonePrincipal;
	}

	/**
	* @name setTelephonePrincipal($pTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre TelephonePrincipal de la AfficheModificationProducteurResponse par $pTelephonePrincipal
	*/
	public function setTelephonePrincipal($pTelephonePrincipal) {
		$this->mTelephonePrincipal = $pTelephonePrincipal;
	}

	/**
	* @name getTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre TelephoneSecondaire de la AfficheModificationProducteurResponse
	*/
	public function getTelephoneSecondaire() {
		return $this->mTelephoneSecondaire;
	}

	/**
	* @name setTelephoneSecondaire($pTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre TelephoneSecondaire de la AfficheModificationProducteurResponse par $pTelephoneSecondaire
	*/
	public function setTelephoneSecondaire($pTelephoneSecondaire) {
		$this->mTelephoneSecondaire = $pTelephoneSecondaire;
	}

	/**
	* @name getAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre Adresse de la AfficheModificationProducteurResponse
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param varchar(300)
	* @desc Remplace le membre Adresse de la AfficheModificationProducteurResponse par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre CodePostal de la AfficheModificationProducteurResponse
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre CodePostal de la AfficheModificationProducteurResponse par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return varchar(100)
	* @desc Renvoie le membre Ville de la AfficheModificationProducteurResponse
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param varchar(100)
	* @desc Remplace le membre Ville de la AfficheModificationProducteurResponse par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateNaissance()
	* @return date
	* @desc Renvoie le membre DateNaissance de la AfficheModificationProducteurResponse
	*/
	public function getDateNaissance() {
		return $this->mDateNaissance;
	}

	/**
	* @name setDateNaissance($pDateNaissance)
	* @param date
	* @desc Remplace le membre DateNaissance de la AfficheModificationProducteurResponse par $pDateNaissance
	*/
	public function setDateNaissance($pDateNaissance) {
		$this->mDateNaissance = $pDateNaissance;
	}

	/**
	* @name getCommentaire()
	* @return text
	* @desc Renvoie le membre Commentaire de la AfficheModificationProducteurResponse
	*/
	public function getCommentaire() {
		return $this->mCommentaire;
	}

	/**
	* @name setCommentaire($pCommentaire)
	* @param text
	* @desc Remplace le membre Commentaire de la AfficheModificationProducteurResponse par $pCommentaire
	*/
	public function setCommentaire($pCommentaire) {
		$this->mCommentaire = $pCommentaire;
	}
}
?>