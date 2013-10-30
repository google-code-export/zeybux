<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/11/2010
// Fichier : AdherentVR.php
//
// Description : Classe AdherentVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name AdherentVR
 * @author Julien PIERRE
 * @since 09/11/2010
 * @desc Classe représentant une AdherentVR
 */
class AdherentVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc L'IdAdherentPrincipal de l'objet
	 */
	protected $mIdAdherentPrincipal;
	
	/**
	 * @var VRelement
	 * @desc L'IdAncienAdherentPrincipal de l'objet
	 */
	protected $mIdAncienAdherentPrincipal;

	/**
	 * @var VRelement
	 * @desc Numero de la AdherentVR
	 */
	protected $mNumero;

	/**
	 * @var VRelement
	 * @desc IdCompte de la AdherentVR
	 */
	protected $mIdCompte;

	/**
	 * @var VRelement
	 * @desc Compte de la AdherentVR
	 */
	protected $mCompte;

	/**
	 * @var VRelement
	 * @desc Nom de la AdherentVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Prenom de la AdherentVR
	 */
	protected $mPrenom;

	/**
	 * @var VRelement
	 * @desc CourrielPrincipal de la AdherentVR
	 */
	protected $mCourrielPrincipal;

	/**
	 * @var VRelement
	 * @desc CourrielSecondaire de la AdherentVR
	 */
	protected $mCourrielSecondaire;

	/**
	 * @var VRelement
	 * @desc TelephonePrincipal de la AdherentVR
	 */
	protected $mTelephonePrincipal;

	/**
	 * @var VRelement
	 * @desc TelephoneSecondaire de la AdherentVR
	 */
	protected $mTelephoneSecondaire;

	/**
	 * @var VRelement
	 * @desc Adresse de la AdherentVR
	 */
	protected $mAdresse;

	/**
	 * @var VRelement
	 * @desc CodePostal de la AdherentVR
	 */
	protected $mCodePostal;

	/**
	 * @var VRelement
	 * @desc Ville de la AdherentVR
	 */
	protected $mVille;

	/**
	 * @var VRelement
	 * @desc DateNaissance de la AdherentVR
	 */
	protected $mDateNaissance;

	/**
	 * @var VRelement
	 * @desc DateAdhesion de la AdherentVR
	 */
	protected $mDateAdhesion;

	/**
	 * @var VRelement
	 * @desc Commentaire de la AdherentVR
	 */
	protected $mCommentaire;

	/**
	 * @var array(VRelement)
	 * @desc Modules de la AdherentVR
	 */
	protected $mModules;

	/**
	* @name AdherentVR()
	* @return bool
	* @desc Constructeur
	*/
	function AdherentVR() {
		parent::__construct();
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdAdherentPrincipal = new VRelement();
		$this->mIdAncienAdherentPrincipal = new VRelement();
		$this->mNumero = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mCompte = new VRelement();
		$this->mNom = new VRelement();
		$this->mPrenom = new VRelement();
		$this->mCourrielPrincipal = new VRelement();
		$this->mCourrielSecondaire = new VRelement();
		$this->mTelephonePrincipal = new VRelement();
		$this->mTelephoneSecondaire = new VRelement();
		$this->mAdresse = new VRelement();
		$this->mCodePostal = new VRelement();
		$this->mVille = new VRelement();
		$this->mDateNaissance = new VRelement();
		$this->mDateAdhesion = new VRelement();
		$this->mCommentaire = new VRelement();
		$this->mModules = array();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	 * @name getIdAdherentPrincipal()
	 * @return VRelement
	 * @desc Renvoie le VRelement IdAdherentPrincipal
	 */
	public function getIdAdherentPrincipal() {
		return $this->mIdAdherentPrincipal;
	}
	
	/**
	 * @name setIdAdherentPrincipal($pIdAdherentPrincipal)
	 * @param VRelement
	 * @desc Remplace le VRelement IdAdherentPrincipal par $pIdAdherentPrincipal
	 */
	public function setIdAdherentPrincipal($pIdAdherentPrincipal) {
		$this->mIdAdherentPrincipal = $pIdAdherentPrincipal;
	}
	
	/**
	 * @name getIdAncienAdherentPrincipal()
	 * @return VRelement
	 * @desc Renvoie le VRelement IdAncienAdherentPrincipal
	 */
	public function getIdAncienAdherentPrincipal() {
		return $this->mIdAncienAdherentPrincipal;
	}
	
	/**
	 * @name setIdAncienAdherentPrincipal($pIdAncienAdherentPrincipal)
	 * @param VRelement
	 * @desc Remplace le VRelement IdAncienAdherentPrincipal par $pIdAncienAdherentPrincipal
	 */
	public function setIdAncienAdherentPrincipal($pIdAncienAdherentPrincipal) {
		$this->mIdAncienAdherentPrincipal = $pIdAncienAdherentPrincipal;
	}

	/**
	* @name getNumero()
	* @return VRelement
	* @desc Renvoie le VRelement mNumero
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param VRelement
	* @desc Remplace le mNumero par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getIdCompte()
	* @return VRelement
	* @desc Renvoie le VRelement mIdCompte
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param VRelement
	* @desc Remplace le mIdCompte par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getCompte()
	* @return VRelement
	* @desc Renvoie le VRelement mCompte
	*/
	public function getCompte() {
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param VRelement
	* @desc Remplace le mCompte par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}

	/**
	* @name getNom()
	* @return VRelement
	* @desc Renvoie le VRelement mNom
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param VRelement
	* @desc Remplace le mNom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return VRelement
	* @desc Renvoie le VRelement mPrenom
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param VRelement
	* @desc Remplace le mPrenom par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}

	/**
	* @name getCourrielPrincipal()
	* @return VRelement
	* @desc Renvoie le VRelement mCourrielPrincipal
	*/
	public function getCourrielPrincipal() {
		return $this->mCourrielPrincipal;
	}

	/**
	* @name setCourrielPrincipal($pCourrielPrincipal)
	* @param VRelement
	* @desc Remplace le mCourrielPrincipal par $pCourrielPrincipal
	*/
	public function setCourrielPrincipal($pCourrielPrincipal) {
		$this->mCourrielPrincipal = $pCourrielPrincipal;
	}

	/**
	* @name getCourrielSecondaire()
	* @return VRelement
	* @desc Renvoie le VRelement mCourrielSecondaire
	*/
	public function getCourrielSecondaire() {
		return $this->mCourrielSecondaire;
	}

	/**
	* @name setCourrielSecondaire($pCourrielSecondaire)
	* @param VRelement
	* @desc Remplace le mCourrielSecondaire par $pCourrielSecondaire
	*/
	public function setCourrielSecondaire($pCourrielSecondaire) {
		$this->mCourrielSecondaire = $pCourrielSecondaire;
	}

	/**
	* @name getTelephonePrincipal()
	* @return VRelement
	* @desc Renvoie le VRelement mTelephonePrincipal
	*/
	public function getTelephonePrincipal() {
		return $this->mTelephonePrincipal;
	}

	/**
	* @name setTelephonePrincipal($pTelephonePrincipal)
	* @param VRelement
	* @desc Remplace le mTelephonePrincipal par $pTelephonePrincipal
	*/
	public function setTelephonePrincipal($pTelephonePrincipal) {
		$this->mTelephonePrincipal = $pTelephonePrincipal;
	}

	/**
	* @name getTelephoneSecondaire()
	* @return VRelement
	* @desc Renvoie le VRelement mTelephoneSecondaire
	*/
	public function getTelephoneSecondaire() {
		return $this->mTelephoneSecondaire;
	}

	/**
	* @name setTelephoneSecondaire($pTelephoneSecondaire)
	* @param VRelement
	* @desc Remplace le mTelephoneSecondaire par $pTelephoneSecondaire
	*/
	public function setTelephoneSecondaire($pTelephoneSecondaire) {
		$this->mTelephoneSecondaire = $pTelephoneSecondaire;
	}

	/**
	* @name getAdresse()
	* @return VRelement
	* @desc Renvoie le VRelement mAdresse
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param VRelement
	* @desc Remplace le mAdresse par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return VRelement
	* @desc Renvoie le VRelement mCodePostal
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param VRelement
	* @desc Remplace le mCodePostal par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return VRelement
	* @desc Renvoie le VRelement mVille
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param VRelement
	* @desc Remplace le mVille par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateNaissance()
	* @return VRelement
	* @desc Renvoie le VRelement mDateNaissance
	*/
	public function getDateNaissance() {
		return $this->mDateNaissance;
	}

	/**
	* @name setDateNaissance($pDateNaissance)
	* @param VRelement
	* @desc Remplace le mDateNaissance par $pDateNaissance
	*/
	public function setDateNaissance($pDateNaissance) {
		$this->mDateNaissance = $pDateNaissance;
	}

	/**
	* @name getDateAdhesion()
	* @return VRelement
	* @desc Renvoie le VRelement mDateAdhesion
	*/
	public function getDateAdhesion() {
		return $this->mDateAdhesion;
	}

	/**
	* @name setDateAdhesion($pDateAdhesion)
	* @param VRelement
	* @desc Remplace le mDateAdhesion par $pDateAdhesion
	*/
	public function setDateAdhesion($pDateAdhesion) {
		$this->mDateAdhesion = $pDateAdhesion;
	}

	/**
	* @name getCommentaire()
	* @return VRelement
	* @desc Renvoie le VRelement mCommentaire
	*/
	public function getCommentaire() {
		return $this->mCommentaire;
	}

	/**
	* @name setCommentaire($pCommentaire)
	* @param VRelement
	* @desc Remplace le mCommentaire par $pCommentaire
	*/
	public function setCommentaire($pCommentaire) {
		$this->mCommentaire = $pCommentaire;
	}

	/**
	* @name getModules()
	* @return VRelement
	* @desc Renvoie le VRelement mModules
	*/
	public function getModules() {
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param VRelement
	* @desc Remplace le mModules par $pModules
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}

	/**
	* @name addModules($pModules)
	* @param VRelement
	* @desc Ajoute le $pModules à mModules
	*/
	public function addModules($pModules) {
		array_push($this->mModules,$pModules);
	}

}
?>