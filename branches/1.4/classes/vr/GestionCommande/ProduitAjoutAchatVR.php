<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/04/2013
// Fichier : ProduitAjoutAchatVR.php
//
// Description : Classe ProduitAjoutAchatVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitAjoutAchatVR
 * @author Julien PIERRE
 * @since 14/04/2013
 * @desc Classe représentant une ProduitAjoutAchatVR
 */
class ProduitAjoutAchatVR extends DataTemplate
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
	 * @desc IdCompte de la ProduitAjoutAchatVR
	 */
	protected $mIdCompte;

	/**
	 * @var VRelement
	 * @desc IdMarche de la ProduitAjoutAchatVR
	 */
	protected $mIdMarche;

	/**
	 * @var VRelement
	 * @desc IdOperation de la ProduitAjoutAchatVR
	 */
	protected $mIdOperation;

	/**
	 * @var VRelement
	 * @desc IdNomProduit de la ProduitAjoutAchatVR
	 */
	protected $mIdNomProduit;

	/**
	 * @var VRelement
	 * @desc Quantite de la ProduitAjoutAchatVR
	 */
	protected $mQuantite;

	/**
	 * @var VRelement
	 * @desc Prix de la ProduitAjoutAchatVR
	 */
	protected $mPrix;

	/**
	 * @var VRelement
	 * @desc Solidaire de la ProduitAjoutAchatVR
	 */
	protected $mSolidaire;

	/**
	* @name ProduitAjoutAchatVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitAjoutAchatVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mIdMarche = new VRelement();
		$this->mIdOperation = new VRelement();
		$this->mIdNomProduit = new VRelement();
		$this->mQuantite = new VRelement();
		$this->mPrix = new VRelement();
		$this->mSolidaire = new VRelement();
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
	* @name getIdMarche()
	* @return VRelement
	* @desc Renvoie le VRelement mIdMarche
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param VRelement
	* @desc Remplace le mIdMarche par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}

	/**
	* @name getIdOperation()
	* @return VRelement
	* @desc Renvoie le VRelement mIdOperation
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param VRelement
	* @desc Remplace le mIdOperation par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdNomProduit()
	* @return VRelement
	* @desc Renvoie le VRelement mIdNomProduit
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param VRelement
	* @desc Remplace le mIdNomProduit par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getQuantite()
	* @return VRelement
	* @desc Renvoie le VRelement mQuantite
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param VRelement
	* @desc Remplace le mQuantite par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getPrix()
	* @return VRelement
	* @desc Renvoie le VRelement mPrix
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param VRelement
	* @desc Remplace le mPrix par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

	/**
	* @name getSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement mSolidaire
	*/
	public function getSolidaire() {
		return $this->mSolidaire;
	}

	/**
	* @name setSolidaire($pSolidaire)
	* @param VRelement
	* @desc Remplace le mSolidaire par $pSolidaire
	*/
	public function setSolidaire($pSolidaire) {
		$this->mSolidaire = $pSolidaire;
	}

}
?>