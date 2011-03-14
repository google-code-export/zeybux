<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/08/2010
// Fichier : ProduitCommandeVR.php
//
// Description : Classe ProduitCommandeVR
//
//****************************************************************

/**
 * @name ProduitCommandeVR
 * @author Julien PIERRE
 * @since 19/08/2010
 * @desc Classe représentant une ProduitCommandeVR
 */
class ProduitCommandeVR
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
	 * @desc IdNom de la ProduitCommandeVR
	 */
	private $mIdNom;


	/**
	 * @var VRelement
	 * @desc Nom de la ProduitCommandeVR
	 */
	private $mNom;


	/**
	 * @var VRelement
	 * @desc Description de la ProduitCommandeVR
	 */
	private $mDescription;


	/**
	 * @var VRelement
	 * @desc IdCategorie de la ProduitCommandeVR
	 */
	private $mIdCategorie;


	/**
	 * @var VRelement
	 * @desc Categorie de la ProduitCommandeVR
	 */
	private $mCategorie;


	/**
	 * @var VRelement
	 * @desc DescriptionCategorie de la ProduitCommandeVR
	 */
	private $mDescriptionCategorie;


	/**
	 * @var VRelement
	 * @desc Unite de la ProduitCommandeVR
	 */
	private $mUnite;


	/**
	 * @var VRelement
	 * @desc QteMaxCommande de la ProduitCommandeVR
	 */
	private $mQteMaxCommande;


	/**
	 * @var VRelement
	 * @desc QteRestante de la ProduitCommandeVR
	 */
	private $mQteRestante;


	/**
	 * @var VRelement
	 * @desc Lots de la ProduitCommandeVR
	 */
	private $mLots;

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
	* @name getIdNom()
	* @return VRelement
	* @desc Renvoie le VRelement mIdNom
	*/
	public function getIdNom() {
		return $this->mIdNom;
	}

	/**
	* @name setIdNom($pIdNom)
	* @param VRelement
	* @desc Remplace le mIdNom par $pIdNom
	*/
	public function setIdNom($pIdNom) {
		$this->mIdNom = $pIdNom;
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
	* @name getIdCategorie()
	* @return VRelement
	* @desc Renvoie le VRelement mIdCategorie
	*/
	public function getIdCategorie() {
		return $this->mIdCategorie;
	}

	/**
	* @name setIdCategorie($pIdCategorie)
	* @param VRelement
	* @desc Remplace le mIdCategorie par $pIdCategorie
	*/
	public function setIdCategorie($pIdCategorie) {
		$this->mIdCategorie = $pIdCategorie;
	}

	/**
	* @name getCategorie()
	* @return VRelement
	* @desc Renvoie le VRelement mCategorie
	*/
	public function getCategorie() {
		return $this->mCategorie;
	}

	/**
	* @name setCategorie($pCategorie)
	* @param VRelement
	* @desc Remplace le mCategorie par $pCategorie
	*/
	public function setCategorie($pCategorie) {
		$this->mCategorie = $pCategorie;
	}

	/**
	* @name getDescriptionCategorie()
	* @return VRelement
	* @desc Renvoie le VRelement mDescriptionCategorie
	*/
	public function getDescriptionCategorie() {
		return $this->mDescriptionCategorie;
	}

	/**
	* @name setDescriptionCategorie($pDescriptionCategorie)
	* @param VRelement
	* @desc Remplace le mDescriptionCategorie par $pDescriptionCategorie
	*/
	public function setDescriptionCategorie($pDescriptionCategorie) {
		$this->mDescriptionCategorie = $pDescriptionCategorie;
	}

	/**
	* @name getUnite()
	* @return VRelement
	* @desc Renvoie le VRelement mUnite
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param VRelement
	* @desc Remplace le mUnite par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	* @name getQteMaxCommande()
	* @return VRelement
	* @desc Renvoie le VRelement mQteMaxCommande
	*/
	public function getQteMaxCommande() {
		return $this->mQteMaxCommande;
	}

	/**
	* @name setQteMaxCommande($pQteMaxCommande)
	* @param VRelement
	* @desc Remplace le mQteMaxCommande par $pQteMaxCommande
	*/
	public function setQteMaxCommande($pQteMaxCommande) {
		$this->mQteMaxCommande = $pQteMaxCommande;
	}

	/**
	* @name getQteRestante()
	* @return VRelement
	* @desc Renvoie le VRelement mQteRestante
	*/
	public function getQteRestante() {
		return $this->mQteRestante;
	}

	/**
	* @name setQteRestante($pQteRestante)
	* @param VRelement
	* @desc Remplace le mQteRestante par $pQteRestante
	*/
	public function setQteRestante($pQteRestante) {
		$this->mQteRestante = $pQteRestante;
	}

	/**
	* @name getLots()
	* @return VRelement
	* @desc Renvoie le VRelement mLots
	*/
	public function getLots() {
		return $this->mLots;
	}

	/**
	* @name setLots($pLots)
	* @param VRelement
	* @desc Remplace le mLots par $pLots
	*/
	public function setLots($pLots) {
		$this->mLots = $pLots;
	}

}
?>
