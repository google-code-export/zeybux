<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : AchatCommandeVR.php
//
// Description : Classe AchatCommandeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AchatCommandeVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une AchatCommandeVR
 */
class AchatCommandeVR extends DataTemplate
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
	 * @desc IdCompte de la AchatCommandeVR
	 */
	protected $mIdCompte;

	/**
	 * @var array(VRelement)
	 * @desc Produits de la AchatCommandeVR
	 */
	protected $mProduits;
	
	/**
	 * @var array(VRelement)
	 * @desc Produits de la AchatCommandeVR
	 */
	protected $mProduitsSolidaire;

	/**
	 * @var VRelement
	 * @desc Rechargement de la AchatCommandeVR
	 */
	protected $mRechargement;

	/**
	* @name AchatCommandeVR()
	* @return bool
	* @desc Constructeur
	*/
	function AchatCommandeVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mProduits = array();
		$this->mProduitsSolidaire = array();
		$this->mRechargement = new VRelement();
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
	
	/**
	* @name getProduitsSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement mProduitsSolidaire
	*/
	public function getProduitsSolidaire() {
		return $this->mProduitsSolidaire;
	}

	/**
	* @name setProduitsSolidaire($pProduitsSolidaire)
	* @param VRelement
	* @desc Remplace le mProduitsSolidaire par $pProduitsSolidaire
	*/
	public function setProduitsSolidaire($pProduitsSolidaire) {
		$this->mProduitsSolidaire = $pProduitsSolidaire;
	}

	/**
	* @name addProduitsSolidaire($pProduitsSolidaire)
	* @param VRelement
	* @desc Ajoute le $pProduitsSolidaire à mProduitsSolidaire
	*/
	public function addProduitsSolidaire($pProduitsSolidaire) {
		array_push($this->mProduitsSolidaire,$pProduitsSolidaire);
	}

	/**
	* @name getRechargement()
	* @return VRelement
	* @desc Renvoie le VRelement mRechargement
	*/
	public function getRechargement() {
		return $this->mRechargement;
	}

	/**
	* @name setRechargement($pRechargement)
	* @param VRelement
	* @desc Remplace le mRechargement par $pRechargement
	*/
	public function setRechargement($pRechargement) {
		$this->mRechargement = $pRechargement;
	}
}
?>