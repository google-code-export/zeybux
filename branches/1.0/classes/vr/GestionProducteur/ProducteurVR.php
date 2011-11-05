<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ProducteurVR.php
//
// Description : Classe ProducteurVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProducteurVR
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une ProducteurVR
 */
class ProducteurVR extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var VRelement
	 * @desc Le Log de l'objet
	 */
	protected $mLog;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc L'Id de la ferme
	 */
	protected $mIdFerme;

	/**
	 * @var VRelement
	 * @desc Nom de la ProducteurVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Prenom de la ProducteurVR
	 */
	protected $mPrenom;

	/**
	 * @var VRelement
	 * @desc DateNaissance de la ProducteurVR
	 */
	protected $mDateNaissance;

	/**
	 * @var VRelement
	 * @desc Commentaire de la ProducteurVR
	 */
	protected $mCommentaire;

	/**
	 * @var VRelement
	 * @desc CourrielPrincipal de la ProducteurVR
	 */
	protected $mCourrielPrincipal;

	/**
	 * @var VRelement
	 * @desc CourrielSecondaire de la ProducteurVR
	 */
	protected $mCourrielSecondaire;

	/**
	 * @var VRelement
	 * @desc TelephonePrincipal de la ProducteurVR
	 */
	protected $mTelephonePrincipal;

	/**
	 * @var VRelement
	 * @desc TelephoneSecondaire de la ProducteurVR
	 */
	protected $mTelephoneSecondaire;

	/**
	 * @var VRelement
	 * @desc Adresse de la ProducteurVR
	 */
	protected $mAdresse;

	/**
	 * @var VRelement
	 * @desc CodePostal de la ProducteurVR
	 */
	protected $mCodePostal;

	/**
	 * @var VRelement
	 * @desc Ville de la ProducteurVR
	 */
	protected $mVille;

	/**
	* @name ProducteurVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProducteurVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdFerme = new VRelement();
		$this->mNom = new VRelement();
		$this->mPrenom = new VRelement();
		$this->mDateNaissance = new VRelement();
		$this->mCommentaire = new VRelement();
		$this->mCourrielPrincipal = new VRelement();
		$this->mCourrielSecondaire = new VRelement();
		$this->mTelephonePrincipal = new VRelement();
		$this->mTelephoneSecondaire = new VRelement();
		$this->mAdresse = new VRelement();
		$this->mCodePostal = new VRelement();
		$this->mVille = new VRelement();
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
	* @name getLog()
	* @return VRelement
	* @desc Renvoie le VRelement Log
	*/
	public function getLog() {
		return $this->mLog;
	}

	/**
	* @name setLog($pLog)
	* @param VRelement
	* @desc Remplace le VRelement Log par $pLog
	*/
	public function setLog($pLog) {
		$this->mLog = $pLog;
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
	* @name getIdFerme()
	* @return VRelement
	* @desc Renvoie le VRelement IdFerme
	*/
	public function getIdFerme() {
		return $this->mIdFerme;
	}

	/**
	* @name setIdFerme($pIdFerme)
	* @param VRelement
	* @desc Remplace le VRelement IdFerme par $pIdFerme
	*/
	public function setIdFerme($pIdFerme) {
		$this->mIdFerme = $pIdFerme;
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

}
?>