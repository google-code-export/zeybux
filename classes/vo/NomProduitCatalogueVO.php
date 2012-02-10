<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : NomProduitCatalogueVO.php
//
// Description : Classe FermeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name NomProduitCatalogueVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une NomProduitCatalogueVO
 */
class NomProduitCatalogueVO extends DataTemplate
{
	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;
	
	/**
	 * @var varchar(50)
	 * @desc Numero de la NomProduitCatalogueVO
	 */
	protected $mNumero;

	/**
	 * @var integer
	 * @desc IdNomProduit de la NomProduitCatalogueVO
	 */
	protected $mIdNomProduit;
	
	/**
	 * @var integer
	 * @desc IdCategorie de la NomProduitCatalogueVO
	 */
	protected $mIdCategorie;

	/**
	 * @var varchar(50)
	 * @desc CproNom de la NomProduitCatalogueVO
	 */
	protected $mCproNom;
	
	/**
	 * @var varchar(50)
	 * @desc Nom de la NomProduitCatalogueVO
	 */
	protected $mNom;
	
	/**
	 * @var text
	 * @desc Description de la NomProduitCatalogueVO
	 */
	protected $mDescription;

	/**
	 * @var array(ProducteurViewVO)
	 * @desc Producteurs de la NomProduitCatalogueVO
	 */
	protected $mProducteurs;
	
	/**
	 * @var array(CaracteristiqueViewVO)
	 * @desc Caracteristiques de la NomProduitCatalogueVO
	 */
	protected $mCaracteristiques;
	
	/**
	 * @var array(ModeleLotViewVO)
	 * @desc ModelesLot de la NomProduitCatalogueVO
	 */
	protected $mModelesLot;	
	
	/**
	* @name NomProduitCatalogueVO()
	* @desc Constructeur
	*/
	function NomProduitCatalogueVO() {
		$this->mProducteurs = array();
		$this->mCaracteristiques = array();
		$this->mModelesLot = array();
	}

	/**
	* @name getId()
	* @return integer
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return varchar(50)
	* @desc Renvoie le VRelement Numero
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param varchar(50)
	* @desc Remplace le VRelement Numero par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getIdNomProduit()
	* @return integer
	* @desc Renvoie le VRelement IdNomProduit
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param integer
	* @desc Remplace le VRelement IdNomProduit par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}
	
	/**
	* @name getIdCategorie()
	* @return integer
	* @desc Renvoie le VRelement IdCategorie
	*/
	public function getIdCategorie() {
		return $this->mIdCategorie;
	}

	/**
	* @name setIdCategorie($pIdCategorie)
	* @param integer
	* @desc Remplace le VRelement IdCategorie par $pIdCategorie
	*/
	public function setIdCategorie($pIdCategorie) {
		$this->mIdCategorie = $pIdCategorie;
	}
	
	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le VRelement mCproNom
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le mCproNom par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
		
	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le VRelement mNom
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le mNom par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le VRelement mDescription
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le mDescription par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}
	
	/**
	* @name getProducteurs()
	* @return array(ProducteurViewVO)
	* @desc Renvoie le VRelement mProducteurs
	*/
	public function getProducteurs() {
		return $this->mProducteurs;
	}

	/**
	* @name setProducteurs($pProducteurs)
	* @param array(ProducteurViewVO)
	* @desc Remplace le mProducteurs par $pProducteurs
	*/
	public function setProducteurs($pProducteurs) {
		$this->mProducteurs = $pProducteurs;
	}

	/**
	* @name addProducteurs($pProducteurs)
	* @param array(ProducteurViewVO)
	* @desc Ajoute le $pProducteurs à mProducteurs
	*/
	public function addProducteurs($pProducteurs) {
		array_push($this->mProducteurs,$pProducteurs);
	}
	
	/**
	* @name getCaracteristiques()
	* @return array(CaracteristiqueViewVO)
	* @desc Renvoie le VRelement mCaracteristiques
	*/
	public function getCaracteristiques() {
		return $this->mCaracteristiques;
	}

	/**
	* @name setCaracteristiques($pCaracteristiques)
	* @param array(CaracteristiqueViewVO)
	* @desc Remplace le mCaracteristiques par $pCaracteristiques
	*/
	public function setCaracteristiques($pCaracteristiques) {
		$this->mCaracteristiques = $pCaracteristiques;
	}

	/**
	* @name addCaracteristiques($pCaracteristiques)
	* @param array(CaracteristiqueViewVO)
	* @desc Ajoute le $pCaracteristiques à mCaracteristiques
	*/
	public function addCaracteristiques($pCaracteristiques) {
		array_push($this->mCaracteristiques,$pCaracteristiques);
	}
	
	/**
	* @name getModelesLot()
	* @return array(ModeleLotViewVO)
	* @desc Renvoie le VRelement mModelesLot
	*/
	public function getModelesLot() {
		return $this->mModelesLot;
	}

	/**
	* @name setModelesLot($pModelesLot)
	* @param array(ModeleLotViewVO)
	* @desc Remplace le mModelesLot par $pModelesLot
	*/
	public function setModelesLot($pModelesLot) {
		$this->mModelesLot = $pModelesLot;
	}

	/**
	* @name addModelesLot($pModelesLot)
	* @param array(ModeleLotViewVO)
	* @desc Ajoute le $pModelesLot à mModelesLot
	*/
	public function addModelesLot($pModelesLot) {
		array_push($this->mModelesLot,$pModelesLot);
	}
}
?>