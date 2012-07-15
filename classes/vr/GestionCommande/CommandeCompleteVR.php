<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : CommandeCompleteVR.php
//
// Description : Classe CommandeCompleteVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CommandeCompleteVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une CommandeCompleteVR
 */
class CommandeCompleteVR extends DataTemplate
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
	 * @desc Numero de la CommandeCompleteVR
	 */
	protected $mNumero;

	/**
	 * @var VRelement
	 * @desc Nom de la CommandeCompleteVR
	 */
	protected $mNom;

	/**
	 * @var VRelement
	 * @desc Description de la CommandeCompleteVR
	 */
	protected $mDescription;

	/**
	 * @var VRelement
	 * @desc DateMarcheDebut de la CommandeCompleteVR
	 */
	protected $mDateMarcheDebut;

	/**
	 * @var VRelement
	 * @desc TimeMarcheDebut de la CommandeCompleteVR
	 */
	protected $mTimeMarcheDebut;

	/**
	 * @var VRelement
	 * @desc DateMarcheFin de la CommandeCompleteVR
	 */
	protected $mDateMarcheFin;

	/**
	 * @var VRelement
	 * @desc TimeMarcheFin de la CommandeCompleteVR
	 */
	protected $mTimeMarcheFin;

	/**
	 * @var VRelement
	 * @desc DateDebutReservation de la CommandeCompleteVR
	 */
	protected $mDateDebutReservation;

	/**
	 * @var VRelement
	 * @desc TimeDebutReservation de la CommandeCompleteVR
	 */
	protected $mTimeDebutReservation;

	/**
	 * @var VRelement
	 * @desc DateFinReservation de la CommandeCompleteVR
	 */
	protected $mDateFinReservation;

	/**
	 * @var VRelement
	 * @desc TimeFinReservation de la CommandeCompleteVR
	 */
	protected $mTimeFinReservation;

	/**
	 * @var VRelement
	 * @desc Archive de la CommandeCompleteVR
	 */
	protected $mArchive;

	/**
	 * @var array(VRelement)
	 * @desc Produits de la CommandeCompleteVR
	 */
	protected $mProduits;

	/**
	* @name CommandeCompleteVR()
	* @return bool
	* @desc Constructeur
	*/
	function CommandeCompleteVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mNumero = new VRelement();
		$this->mNom = new VRelement();
		$this->mDescription = new VRelement();
		$this->mDateMarcheDebut = new VRelement();
		$this->mTimeMarcheDebut = new VRelement();
		$this->mDateMarcheFin = new VRelement();
		$this->mTimeMarcheFin = new VRelement();
		$this->mDateDebutReservation = new VRelement();
		$this->mTimeDebutReservation = new VRelement();
		$this->mDateFinReservation = new VRelement();
		$this->mTimeFinReservation = new VRelement();
		$this->mArchive = new VRelement();
		$this->mProduits = array();
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

	/**
	* @name getDateMarcheDebut()
	* @return VRelement
	* @desc Renvoie le VRelement mDateMarcheDebut
	*/
	public function getDateMarcheDebut() {
		return $this->mDateMarcheDebut;
	}

	/**
	* @name setDateMarcheDebut($pDateMarcheDebut)
	* @param VRelement
	* @desc Remplace le mDateMarcheDebut par $pDateMarcheDebut
	*/
	public function setDateMarcheDebut($pDateMarcheDebut) {
		$this->mDateMarcheDebut = $pDateMarcheDebut;
	}

	/**
	* @name getTimeMarcheDebut()
	* @return VRelement
	* @desc Renvoie le VRelement mTimeMarcheDebut
	*/
	public function getTimeMarcheDebut() {
		return $this->mTimeMarcheDebut;
	}

	/**
	* @name setTimeMarcheDebut($pTimeMarcheDebut)
	* @param VRelement
	* @desc Remplace le mTimeMarcheDebut par $pTimeMarcheDebut
	*/
	public function setTimeMarcheDebut($pTimeMarcheDebut) {
		$this->mTimeMarcheDebut = $pTimeMarcheDebut;
	}

	/**
	* @name getDateMarcheFin()
	* @return VRelement
	* @desc Renvoie le VRelement mDateMarcheFin
	*/
	public function getDateMarcheFin() {
		return $this->mDateMarcheFin;
	}

	/**
	* @name setDateMarcheFin($pDateMarcheFin)
	* @param VRelement
	* @desc Remplace le mDateMarcheFin par $pDateMarcheFin
	*/
	public function setDateMarcheFin($pDateMarcheFin) {
		$this->mDateMarcheFin = $pDateMarcheFin;
	}

	/**
	* @name getTimeMarcheFin()
	* @return VRelement
	* @desc Renvoie le VRelement mTimeMarcheFin
	*/
	public function getTimeMarcheFin() {
		return $this->mTimeMarcheFin;
	}

	/**
	* @name setTimeMarcheFin($pTimeMarcheFin)
	* @param VRelement
	* @desc Remplace le mTimeMarcheFin par $pTimeMarcheFin
	*/
	public function setTimeMarcheFin($pTimeMarcheFin) {
		$this->mTimeMarcheFin = $pTimeMarcheFin;
	}

	/**
	* @name getDateDebutReservation()
	* @return VRelement
	* @desc Renvoie le VRelement mDateDebutReservation
	*/
	public function getDateDebutReservation() {
		return $this->mDateDebutReservation;
	}

	/**
	* @name setDateDebutReservation($pDateDebutReservation)
	* @param VRelement
	* @desc Remplace le mDateDebutReservation par $pDateDebutReservation
	*/
	public function setDateDebutReservation($pDateDebutReservation) {
		$this->mDateDebutReservation = $pDateDebutReservation;
	}

	/**
	* @name getTimeDebutReservation()
	* @return VRelement
	* @desc Renvoie le VRelement mTimeDebutReservation
	*/
	public function getTimeDebutReservation() {
		return $this->mTimeDebutReservation;
	}

	/**
	* @name setTimeDebutReservation($pTimeDebutReservation)
	* @param VRelement
	* @desc Remplace le mTimeDebutReservation par $pTimeDebutReservation
	*/
	public function setTimeDebutReservation($pTimeDebutReservation) {
		$this->mTimeDebutReservation = $pTimeDebutReservation;
	}
	
	/**
	* @name getDateFinReservation()
	* @return VRelement
	* @desc Renvoie le VRelement mDateFinReservation
	*/
	public function getDateFinReservation() {
		return $this->mDateFinReservation;
	}

	/**
	* @name setDateFinReservation($pDateFinReservation)
	* @param VRelement
	* @desc Remplace le mDateFinReservation par $pDateFinReservation
	*/
	public function setDateFinReservation($pDateFinReservation) {
		$this->mDateFinReservation = $pDateFinReservation;
	}

	/**
	* @name getTimeFinReservation()
	* @return VRelement
	* @desc Renvoie le VRelement mTimeFinReservation
	*/
	public function getTimeFinReservation() {
		return $this->mTimeFinReservation;
	}

	/**
	* @name setTimeFinReservation($pTimeFinReservation)
	* @param VRelement
	* @desc Remplace le mTimeFinReservation par $pTimeFinReservation
	*/
	public function setTimeFinReservation($pTimeFinReservation) {
		$this->mTimeFinReservation = $pTimeFinReservation;
	}
	
	/**
	* @name getArchive()
	* @return VRelement
	* @desc Renvoie le VRelement mArchive
	*/
	public function getArchive() {
		return $this->mArchive;
	}

	/**
	* @name setArchive($pArchive)
	* @param VRelement
	* @desc Remplace le mArchive par $pArchive
	*/
	public function setArchive($pArchive) {
		$this->mArchive = $pArchive;
	}

	/**
	* @name getProduits()
	* @return VRelement
	* @desc Renvoie le VRelement mProduits
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param VRelement
	* @desc Remplace le mProduits par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}

	/**
	* @name addProduits($pProduits)
	* @param VRelement
	* @desc Ajoute le $pProduits à mProduits
	*/
	public function addProduits($pProduits) {
		array_push($this->mProduits,$pProduits);
	}
}
?>