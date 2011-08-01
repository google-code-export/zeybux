<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : ProduitBonDeLivraisonVR.php
//
// Description : Classe ProduitBonDeLivraisonVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRelement.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitBonDeLivraisonVR
 * @author Julien PIERRE
 * @since 25/01/2011
 * @desc Classe représentant une ProduitBonDeLivraisonVR
 */
class ProduitBonDeLivraisonVR extends DataTemplate
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
	 * @desc Quantite de la ProduitBonDeLivraisonVR
	 */
	protected $mQuantite;

	/**
	 * @var VRelement
	 * @desc Prix de la ProduitBonDeLivraisonVR
	 */
	protected $mPrix;
	
	/**
	 * @var VRelement
	 * @desc QuantiteSolidaire de la ProduitBonDeLivraisonVR
	 */
	protected $mQuantiteSolidaire;

	/**
	* @name ProduitBonDeLivraisonVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitBonDeLivraisonVR() {
		$this->mValid = true;
		$this->mLog = new VRelement();
		$this->mId = new VRelement();
		$this->mQuantite = new VRelement();
		$this->mPrix = new VRelement();
		$this->mQuantiteSolidaire = new VRelement();
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
	* @name getQuantiteSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement mQuantiteSolidaire
	*/
	public function getQuantiteSolidaire() {
		return $this->mQuantiteSolidaire;
	}

	/**
	* @name setQuantiteSolidaire($pQuantiteSolidaire)
	* @param VRelement
	* @desc Remplace le mQuantiteSolidaire par $pQuantiteSolidaire
	*/
	public function setQuantiteSolidaire($pQuantiteSolidaire) {
		$this->mQuantiteSolidaire = $pQuantiteSolidaire;
	}
}
?>