<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : ProduitDetailFactureVR.php
//
// Description : Classe ProduitDetailFactureVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name ProduitDetailFactureVR
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une ProduitDetailFactureVR
 */
class ProduitDetailFactureVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc L'IdNomProduit de l'objet
	 */
	protected $mIdNomProduit;
	
	/**
	 * @var VRelement
	 * @desc L'IdStock de l'objet
	 */
	protected $mIdStock;
	
	/**
	 * @var VRelement
	 * @desc L'IdDetailOperation de l'objet
	 */
	protected $mIdDetailOperation;
	
	/**
	 * @var VRelement
	 * @desc L'IdStockSolidaire de l'objet
	 */
	protected $mIdStockSolidaire;
	
	/**
	 * @var VRelement
	 * @desc Quantite de la ProduitDetailFactureVR
	 */
	protected $mQuantite;

	/**
	 * @var VRelement
	 * @desc Unite de la ProduitDetailFactureVR
	 */
	protected $mUnite;
	
	/**
	 * @var VRelement
	 * @desc QuantiteSolidaire de la ProduitDetailFactureVR
	 */
	protected $mQuantiteSolidaire;

	/**
	 * @var VRelement
	 * @desc UniteSolidaire de la ProduitDetailFactureVR
	 */
	protected $mUniteSolidaire;

	/**
	 * @var VRelement
	 * @desc Montant de la ProduitDetailFactureVR
	 */
	protected $mMontant;

	/**
	* @name ProduitDetailFactureVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitDetailFactureVR() {
		parent::__construct();		
		$this->mIdNomProduit = new VRelement();
		$this->mIdStock = new VRelement();
		$this->mIdDetailOperation = new VRelement();
		$this->mIdStockSolidaire = new VRelement();
		$this->mQuantite = new VRelement();
		$this->mUnite = new VRelement();
		$this->mQuantiteSolidaire = new VRelement();
		$this->mUniteSolidaire = new VRelement();
		$this->mMontant = new VRelement();
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
	* @name getIdStock()
	* @return VRelement
	* @desc Renvoie le VRelement IdStock
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param VRelement
	* @desc Remplace le VRelement IdStock par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}

	/**
	* @name getIdDetailOperation()
	* @return VRelement
	* @desc Renvoie le VRelement IdDetailOperation
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param VRelement
	* @desc Remplace le VRelement IdDetailOperation par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}

	/**
	* @name getIdStockSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement IdStockSolidaire
	*/
	public function getIdStockSolidaire() {
		return $this->mIdStockSolidaire;
	}

	/**
	* @name setIdStockSolidaire($pIdStockSolidaire)
	* @param VRelement
	* @desc Remplace le VRelement IdStockSolidaire par $pIdStockSolidaire
	*/
	public function setIdStockSolidaire($pIdStockSolidaire) {
		$this->mIdStockSolidaire = $pIdStockSolidaire;
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

	/**
	* @name getUniteSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement mUniteSolidaire
	*/
	public function getUniteSolidaire() {
		return $this->mUniteSolidaire;
	}

	/**
	* @name setUniteSolidaire($pUniteSolidaire)
	* @param VRelement
	* @desc Remplace le mUniteSolidaire par $pUniteSolidaire
	*/
	public function setUniteSolidaire($pUniteSolidaire) {
		$this->mUniteSolidaire = $pUniteSolidaire;
	}

	/**
	* @name getMontant()
	* @return VRelement
	* @desc Renvoie le VRelement mMontant
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param VRelement
	* @desc Remplace le mMontant par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}
}
?>