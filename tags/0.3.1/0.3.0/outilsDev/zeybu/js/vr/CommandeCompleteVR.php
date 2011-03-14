<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/08/2010
// Fichier : CommandeCompleteVR.php
//
// Description : Classe CommandeCompleteVR
//
//****************************************************************

/**
 * @name CommandeCompleteVR
 * @author Julien PIERRE
 * @since 08/08/2010
 * @desc Classe représentant une CommandeCompleteVR
 */
class CommandeCompleteVR
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	private $mValid;

	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	private $mId;

	/**
	 * @var VRelement
	 * @desc Numero de la CommandeCompleteVR
	 */
	private $mNumero;


	/**
	 * @var VRelement
	 * @desc Nom de la CommandeCompleteVR
	 */
	private $mNom;


	/**
	 * @var VRelement
	 * @desc Description de la CommandeCompleteVR
	 */
	private $mDescription;


	/**
	 * @var VRelement
	 * @desc DateMarcheDebut de la CommandeCompleteVR
	 */
	private $mDateMarcheDebut;


	/**
	 * @var VRelement
	 * @desc TimeMarcheDebut de la CommandeCompleteVR
	 */
	private $mTimeMarcheDebut;


	/**
	 * @var VRelement
	 * @desc DateMarcheFin de la CommandeCompleteVR
	 */
	private $mDateMarcheFin;


	/**
	 * @var VRelement
	 * @desc TimeMarcheFin de la CommandeCompleteVR
	 */
	private $mTimeMarcheFin;


	/**
	 * @var VRelement
	 * @desc DateFinReservation de la CommandeCompleteVR
	 */
	private $mDateFinReservation;


	/**
	 * @var VRelement
	 * @desc TimeFinReservation de la CommandeCompleteVR
	 */
	private $mTimeFinReservation;


	/**
	 * @var VRelement
	 * @desc Archive de la CommandeCompleteVR
	 */
	private $mArchive;


	/**
	 * @var VRelement
	 * @desc Produits de la CommandeCompleteVR
	 */
	private $mProduits;

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

}
?>
