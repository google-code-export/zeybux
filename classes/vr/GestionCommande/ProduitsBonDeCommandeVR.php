<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/01/2011
// Fichier : ProduitsBonDeCommandeVR.php
//
// Description : Classe ProduitsBonDeCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitsBonDeCommandeVR
 * @author Julien PIERRE
 * @since 18/01/2011
 * @desc Classe représentant une ProduitsBonDeCommandeVR
 */
class ProduitsBonDeCommandeVR extends DataTemplate
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
	 * @desc Id_commande de la ProduitsBonDeCommandeVR
	 */
	protected $mId_commande;

	/**
	 * @var VRelement
	 * @desc Id_producteur de la ProduitsBonDeCommandeVR
	 */
	protected $mId_producteur;

	/**
	 * @var array(VRelement)
	 * @desc Produits de la ProduitsBonDeCommandeVR
	 */
	protected $mProduits;

	/**
	* @name ProduitsBonDeCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitsBonDeCommandeVR() {
		$this->mValid = true;
		$this->mId = new VRelement();
		$this->mId_commande = new VRelement();
		$this->mId_producteur = new VRelement();
		$this->mExport = new VRelement();
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
	* @name getId_commande()
	* @return VRelement
	* @desc Renvoie le VRelement mId_commande
	*/
	public function getId_commande() {
		return $this->mId_commande;
	}

	/**
	* @name setId_commande($pId_commande)
	* @param VRelement
	* @desc Remplace le mId_commande par $pId_commande
	*/
	public function setId_commande($pId_commande) {
		$this->mId_commande = $pId_commande;
	}

	/**
	* @name getId_producteur()
	* @return VRelement
	* @desc Renvoie le VRelement mId_producteur
	*/
	public function getId_producteur() {
		return $this->mId_producteur;
	}

	/**
	* @name setId_producteur($pId_producteur)
	* @param VRelement
	* @desc Remplace le mId_producteur par $pId_producteur
	*/
	public function setId_producteur($pId_producteur) {
		$this->mId_producteur = $pId_producteur;
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