<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitCatalogueVR.php
//
// Description : Classe FermeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitCatalogueVR
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitCatalogueVR
 */
class NomProduitCatalogueVR extends DataTemplate
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
	 * @desc IdNomProduit de la NomProduitCatalogueVR
	 */
	protected $mIdNomProduit;
	
	/**
	 * @var VRelement
	 * @desc IdCategorie de la NomProduitCatalogueVR
	 */
	protected $mIdCategorie;

	
	/**
	 * @var VRelement
	 * @desc Nom de la NomProduitCatalogueVR
	 */
	protected $mNom;
	
	/**
	 * @var VRelement
	 * @desc Description de la NomProduitCatalogueVR
	 */
	protected $mDescription;

	/**
	 * @var VRelement
	 * @desc Producteurs de la NomProduitCatalogueVR
	 */
	protected $mProducteurs;
	
	/**
	 * @var VRelement
	 * @desc Caracteristiques de la NomProduitCatalogueVR
	 */
	protected $mCaracteristiques;
	
	/**
	 * @var VRelement
	 * @desc ModelesLot de la NomProduitCatalogueVR
	 */
	protected $mModelesLot;	
	
	/**
	* @name NomProduitCatalogueVR()
	* @desc Constructeur
	*/
	function NomProduitCatalogueVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdNomProduit = new VRelement();
		$this->mIdCategorie = new VRelement();
		$this->mNom = new VRelement();		
		$this->mDescription = new VRelement();
		$this->mProducteurs = new VRelement();
		$this->mCaracteristiques = new VRelement();
		$this->mModelesLot = array();
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
	* @name getIdNomProduit()
	* @return VRelement
	* @desc Renvoie le VRelement IdNomProduit
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param VRelement
	* @desc Remplace le VRelement IdNomProduit par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}
	
	/**
	* @name getIdCategorie()
	* @return VRelement
	* @desc Renvoie le VRelement IdCategorie
	*/
	public function getIdCategorie() {
		return $this->mIdCategorie;
	}

	/**
	* @name setIdCategorie($pIdCategorie)
	* @param VRelement
	* @desc Remplace le VRelement IdCategorie par $pIdCategorie
	*/
	public function setIdCategorie($pIdCategorie) {
		$this->mIdCategorie = $pIdCategorie;
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
	* @name getProducteurs()
	* @return VRelement
	* @desc Renvoie le VRelement mProducteurs
	*/
	public function getProducteurs() {
		return $this->mProducteurs;
	}

	/**
	* @name setProducteurs($pProducteurs)
	* @param VRelement
	* @desc Remplace le mProducteurs par $pProducteurs
	*/
	public function setProducteurs($pProducteurs) {
		$this->mProducteurs = $pProducteurs;
	}

	/**
	* @name addProducteurs($pProducteurs)
	* @param VRelement
	* @desc Ajoute le $pProducteurs à mProducteurs
	*/
	public function addProducteurs($pProducteurs) {
		array_push($this->mProducteurs,$pProducteurs);
	}
	
	/**
	* @name getCaracteristiques()
	* @return VRelement
	* @desc Renvoie le VRelement mCaracteristiques
	*/
	public function getCaracteristiques() {
		return $this->mCaracteristiques;
	}

	/**
	* @name setCaracteristiques($pCaracteristiques)
	* @param VRelement
	* @desc Remplace le mCaracteristiques par $pCaracteristiques
	*/
	public function setCaracteristiques($pCaracteristiques) {
		$this->mCaracteristiques = $pCaracteristiques;
	}

	/**
	* @name addCaracteristiques($pCaracteristiques)
	* @param VRelement
	* @desc Ajoute le $pCaracteristiques à mCaracteristiques
	*/
	public function addCaracteristiques($pCaracteristiques) {
		array_push($this->mCaracteristiques,$pCaracteristiques);
	}
	
	/**
	* @name getModelesLot()
	* @return VRelement
	* @desc Renvoie le VRelement mModelesLot
	*/
	public function getModelesLot() {
		return $this->mModelesLot;
	}

	/**
	* @name setModelesLot($pModelesLot)
	* @param VRelement
	* @desc Remplace le mModelesLot par $pModelesLot
	*/
	public function setModelesLot($pModelesLot) {
		$this->mModelesLot = $pModelesLot;
	}

	/**
	* @name addModelesLot($pModelesLot)
	* @param VRelement
	* @desc Ajoute le $pModelesLot à mModelesLot
	*/
	public function addModelesLot($pModelesLot) {
		array_push($this->mModelesLot,$pModelesLot);
	}
}
?>