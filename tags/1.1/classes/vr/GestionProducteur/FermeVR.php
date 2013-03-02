<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeVR.php
//
// Description : Classe FermeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FermeVR
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une FermeVR
 */
class FermeVR extends DataTemplate
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
	 * @desc Numero de la FermeVR
	 */
	protected $mNumero;

	/**
	 * @var VRelement
	 * @desc Compte de la FermeVR
	 */
	protected $mCompte;

	/**
	 * @var VRelement
	 * @desc Siren de la FermeVR
	 */
	protected $mSiren;

	/**
	 * @var VRelement
	 * @desc Nom de la FermeVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Adresse de la FermeVR
	 */
	protected $mAdresse;

	/**
	 * @var VRelement
	 * @desc CodePostal de la FermeVR
	 */
	protected $mCodePostal;

	/**
	 * @var VRelement
	 * @desc Ville de la FermeVR
	 */
	protected $mVille;

	/**
	 * @var VRelement
	 * @desc DateAdhesion de la FermeVR
	 */
	protected $mDateAdhesion;

	/**
	 * @var VRelement
	 * @desc Description de la FermeVR
	 */
	protected $mDescription;

	/**
	* @name FermeVR()
	* @desc Constructeur
	*/
	function FermeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mNumero = new VRelement();
		$this->mCompte = new VRelement();
		$this->mSiren = new VRelement();
		$this->mNom = new VRelement();
		$this->mAdresse = new VRelement();
		$this->mCodePostal = new VRelement();
		$this->mVille = new VRelement();
		$this->mDateAdhesion = new VRelement();
		$this->mDescription = new VRelement();
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
	* @name getSiren()
	* @return VRelement
	* @desc Renvoie le VRelement mSiren
	*/
	public function getSiren() {
		return $this->mSiren;
	}

	/**
	* @name setSiren($pSiren)
	* @param VRelement
	* @desc Remplace le mSiren par $pSiren
	*/
	public function setSiren($pSiren) {
		$this->mSiren = $pSiren;
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
	* @name getDescription()
	* @return VRelement
	* @desc Renvoie le VRelement mDescription
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param VRelement
	* @desc Remplace le mDescription par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}
}
?>