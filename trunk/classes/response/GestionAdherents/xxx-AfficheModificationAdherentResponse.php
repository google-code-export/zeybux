<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2010
// Fichier : AfficheModificationAdherentResponse.php
//
// Description : Classe AfficheModificationAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheModificationAdherentResponse
 * @author Julien PIERRE
 * @since 08/11/2010
 * @desc Classe représentant une AfficheModificationAdherentResponse
 */
class AfficheModificationAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

		/**
	* @var int(11)
	* @desc Id de la AfficheModificationAdherentResponse
	*/
	protected $mId;
	
	/**
	* @var varchar(5)
	* @desc Numero de la AfficheModificationAdherentResponse
	*/
	protected $mNumero;

	/**
	* @var varchar(30)
	* @desc Compte de la AfficheModificationAdherentResponse
	*/
	protected $mCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la AfficheModificationAdherentResponse
	*/
	protected $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la AfficheModificationAdherentResponse
	*/
	protected $mPrenom;

	/**
	* @var varchar(100)
	* @desc CourrielPrincipal de la AfficheModificationAdherentResponse
	*/
	protected $mCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc CourrielSecondaire de la AfficheModificationAdherentResponse
	*/
	protected $mCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc TelephonePrincipal de la AfficheModificationAdherentResponse
	*/
	protected $mTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc TelephoneSecondaire de la AfficheModificationAdherentResponse
	*/
	protected $mTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc Adresse de la AfficheModificationAdherentResponse
	*/
	protected $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la AfficheModificationAdherentResponse
	*/
	protected $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la AfficheModificationAdherentResponse
	*/
	protected $mVille;

	/**
	* @var date
	* @desc DateNaissance de la AfficheModificationAdherentResponse
	*/
	protected $mDateNaissance;

	/**
	* @var date
	* @desc DateAdhesion de la AfficheModificationAdherentResponse
	*/
	protected $mDateAdhesion;

	/**
	* @var text
	* @desc Commentaire de la AfficheModificationAdherentResponse
	*/
	protected $mCommentaire;
		
	/**
	 * @var array(AutorisationsVO) 
	 * @desc liste des Autorisations de l'adhérent
	 */
	protected $mAutorisations;
	
	/**
	 * @var array(ModuleVO)
	 * @desc Les modules
	 */
	protected $mModules;
	
	/**
	* @name AfficheModificationAdherentResponse()
	* @desc Le constructeur
	*/
	public function AfficheModificationAdherentResponse() {
		$this->mValid = true;
		$this->mModules = array();
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
	* @desc Renvoie l'Id de l'Adherent
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AfficheModificationAdherentResponse par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return varchar(5)
	* @desc Renvoie le membre Numero de la AfficheModificationAdherentResponse
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param varchar(5)
	* @desc Remplace le membre Numero de la AfficheModificationAdherentResponse par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getCompte()
	* @return varchar(30)
	* @desc Renvoie le membre Compte de la AfficheModificationAdherentResponse
	*/
	public function getCompte(){
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param varchar(30)
	* @desc Remplace le membre Compte de la AfficheModificationAdherentResponse par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la AfficheModificationAdherentResponse
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la AfficheModificationAdherentResponse par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre Prenom de la AfficheModificationAdherentResponse
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param varchar(50)
	* @desc Remplace le membre Prenom de la AfficheModificationAdherentResponse par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}

	/**
	* @name getCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielPrincipal de la AfficheModificationAdherentResponse
	*/
	public function getCourrielPrincipal() {
		return $this->mCourrielPrincipal;
	}

	/**
	* @name setCourrielPrincipal($pCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre CourrielPrincipal de la AfficheModificationAdherentResponse par $pCourrielPrincipal
	*/
	public function setCourrielPrincipal($pCourrielPrincipal) {
		$this->mCourrielPrincipal = $pCourrielPrincipal;
	}

	/**
	* @name getCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielSecondaire de la AfficheModificationAdherentResponse
	*/
	public function getCourrielSecondaire() {
		return $this->mCourrielSecondaire;
	}

	/**
	* @name setCourrielSecondaire($pCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre CourrielSecondaire de la AfficheModificationAdherentResponse par $pCourrielSecondaire
	*/
	public function setCourrielSecondaire($pCourrielSecondaire) {
		$this->mCourrielSecondaire = $pCourrielSecondaire;
	}

	/**
	* @name getTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre TelephonePrincipal de la AfficheModificationAdherentResponse
	*/
	public function getTelephonePrincipal() {
		return $this->mTelephonePrincipal;
	}

	/**
	* @name setTelephonePrincipal($pTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre TelephonePrincipal de la AfficheModificationAdherentResponse par $pTelephonePrincipal
	*/
	public function setTelephonePrincipal($pTelephonePrincipal) {
		$this->mTelephonePrincipal = $pTelephonePrincipal;
	}

	/**
	* @name getTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre TelephoneSecondaire de la AfficheModificationAdherentResponse
	*/
	public function getTelephoneSecondaire() {
		return $this->mTelephoneSecondaire;
	}

	/**
	* @name setTelephoneSecondaire($pTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre TelephoneSecondaire de la AfficheModificationAdherentResponse par $pTelephoneSecondaire
	*/
	public function setTelephoneSecondaire($pTelephoneSecondaire) {
		$this->mTelephoneSecondaire = $pTelephoneSecondaire;
	}

	/**
	* @name getAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre Adresse de la AfficheModificationAdherentResponse
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param varchar(300)
	* @desc Remplace le membre Adresse de la AfficheModificationAdherentResponse par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre CodePostal de la AfficheModificationAdherentResponse
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre CodePostal de la AfficheModificationAdherentResponse par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return varchar(100)
	* @desc Renvoie le membre Ville de la AfficheModificationAdherentResponse
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param varchar(100)
	* @desc Remplace le membre Ville de la AfficheModificationAdherentResponse par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateNaissance()
	* @return date
	* @desc Renvoie le membre DateNaissance de la AfficheModificationAdherentResponse
	*/
	public function getDateNaissance() {
		return $this->mDateNaissance;
	}

	/**
	* @name setDateNaissance($pDateNaissance)
	* @param date
	* @desc Remplace le membre DateNaissance de la AfficheModificationAdherentResponse par $pDateNaissance
	*/
	public function setDateNaissance($pDateNaissance) {
		$this->mDateNaissance = $pDateNaissance;
	}

	/**
	* @name getDateAdhesion()
	* @return date
	* @desc Renvoie le membre DateAdhesion de la AfficheModificationAdherentResponse
	*/
	public function getDateAdhesion() {
		return $this->mDateAdhesion;
	}

	/**
	* @name setDateAdhesion($pDateAdhesion)
	* @param date
	* @desc Remplace le membre DateAdhesion de la AfficheModificationAdherentResponse par $pDateAdhesion
	*/
	public function setDateAdhesion($pDateAdhesion) {
		$this->mDateAdhesion = $pDateAdhesion;
	}

	/**
	* @name getCommentaire()
	* @return text
	* @desc Renvoie le membre Commentaire de la AfficheModificationAdherentResponse
	*/
	public function getCommentaire() {
		return $this->mCommentaire;
	}

	/**
	* @name setCommentaire($pCommentaire)
	* @param text
	* @desc Remplace le membre Commentaire de la AfficheModificationAdherentResponse par $pCommentaire
	*/
	public function setCommentaire($pCommentaire) {
		$this->mCommentaire = $pCommentaire;
	}

	/**
	* @name getAutorisations()
	* @return array(AutorisationsVO)
	* @desc Renvoie la Autorisations de l'Adherent
	*/
	public function getAutorisations() {
		return $this->mAutorisations;
	}

	/**
	* @name setAutorisations($pAutorisations)
	* @param array(AutorisationsVO)
	* @desc Remplace la Autorisations dans l'Adherent par $pAutorisations
	*/
	public function setAutorisations($pAutorisations) {
		$this->mAutorisations = $pAutorisations;
	}

	/**
	* @name getModules()
	* @return array(ModuleVO)
	* @desc Renvoie le Modules
	*/
	public function getModules() {
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param array(ModuleVO)
	* @desc Remplace le Modules par $pModules
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}
	
	/**
	* @name addModules($pModules)
	* @param ModuleVO
	* @desc Ajoute $pModules à Modules
	*/
	public function addModules($pModules){
		array_push($this->mModules,$pModules);
	}
}
?>