<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/08/2010
// Fichier : ProduitCommandeVR.php
//
// Description : Classe ProduitCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitCommandeVR
 * @author Julien PIERRE
 * @since 29/08/2010
 * @desc Classe représentant une ProduitCommandeVR
 */
class ProduitCommandeVR extends DataTemplate
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
	 * @var integer 
	 * @desc ID de la ProduitCommandeVR
	 */
	protected $mIdProducteur;

	/**
	 * @var VRelement
	 * @desc IdNom de la ProduitCommandeVR
	 */
	protected $mIdNom;


	/**
	 * @var VRelement
	 * @desc Nom de la ProduitCommandeVR
	 */
	protected $mNom;


	/**
	 * @var VRelement
	 * @desc IdCategorie de la ProduitCommandeVR
	 */
	protected $mIdCategorie;


	/**
	 * @var VRelement
	 * @desc Categorie de la ProduitCommandeVR
	 */
	protected $mCategorie;


	/**
	 * @var VRelement
	 * @desc DescriptionCategorie de la ProduitCommandeVR
	 */
	protected $mDescriptionCategorie;


	/**
	 * @var VRelement
	 * @desc Unite de la ProduitCommandeVR
	 */
	protected $mUnite;


	/**
	 * @var VRelement
	 * @desc QteMaxCommande de la ProduitCommandeVR
	 */
	protected $mQteMaxCommande;


	/**
	 * @var VRelement
	 * @desc QteRestante de la ProduitCommandeVR
	 */
	protected $mQteRestante;


	/**
	 * @var array(VRelement)
	 * @desc Lots de la ProduitCommandeVR
	 */
	protected $mLots;

	/**
	* @name ProduitCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdProducteur = new VRelement();
		$this->mIdNom = new VRelement();
		$this->mNom = new VRelement();
		$this->mIdCategorie = new VRelement();
		$this->mCategorie = new VRelement();
		$this->mDescriptionCategorie = new VRelement();
		$this->mUnite = new VRelement();
		$this->mQteMaxCommande = new VRelement();
		$this->mQteRestante = new VRelement();
		$this->mLots = array();
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
	* @name getIdProducteur()
	* @return VRelement
	* @desc Renvoie le VRelement IdProducteur
	*/
	public function getIdProducteur() {
		return $this->mIdProducteur;
	}

	/**
	* @name setIdProducteur($pIdProducteur)
	* @param VRelement
	* @desc Remplace le VRelement IdProducteur par $pIdProducteur
	*/
	public function setIdProducteur($pIdProducteur) {
		$this->mIdProducteur = $pIdProducteur;
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

	/**
	* @name addLots($pLots)
	* @param VRelement
	* @desc Ajoute le $pLots à mLots
	*/
	public function addLots($pLots) {
		array_push($this->mLots,$pLots);
	}
}
?>