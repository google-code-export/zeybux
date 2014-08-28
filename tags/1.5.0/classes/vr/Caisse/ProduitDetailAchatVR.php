<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : ProduitDetailAchatVR.php
//
// Description : Classe ProduitDetailAchatVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name ProduitDetailAchatVR
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une ProduitDetailAchatVR
 */
class ProduitDetailAchatVR extends TemplateVR
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
	 * @desc L'IdDetailOperationSolidaire de l'objet
	 */
	protected $mIdDetailOperationSolidaire;

	/**
	 * @var VRelement
	 * @desc L'IdDetailCommande de l'objet
	 */
	protected $mIdDetailCommande;

	/**
	 * @var VRelement
	 * @desc L'IdModeleLot de l'objet
	 */
	protected $mIdModeleLot;

	/**
	 * @var VRelement
	 * @desc L'IdDetailCommandeSolidaire de l'objet
	 */
	protected $mIdDetailCommandeSolidaire;

	/**
	 * @var VRelement
	 * @desc L'IdModeleLotSolidaire de l'objet
	 */
	protected $mIdModeleLotSolidaire;
	
	/**
	 * @var VRelement
	 * @desc Quantite de la ProduitDetailAchatVR
	 */
	protected $mQuantite;

	/**
	 * @var VRelement
	 * @desc Unite de la ProduitDetailAchatVR
	 */
	protected $mUnite;
	
	/**
	 * @var VRelement
	 * @desc QuantiteSolidaire de la ProduitDetailAchatVR
	 */
	protected $mQuantiteSolidaire;

	/**
	 * @var VRelement
	 * @desc UniteSolidaire de la ProduitDetailAchatVR
	 */
	protected $mUniteSolidaire;

	/**
	 * @var VRelement
	 * @desc Montant de la ProduitDetailAchatVR
	 */
	protected $mMontant;

	/**
	 * @var VRelement
	 * @desc MontantSolidaire de la ProduitDetailAchatVR
	 */
	protected $mMontantSolidaire;

	/**
	* @name ProduitDetailAchatVR()
	* @return bool
	* @desc Constructeur
	*/
	function ProduitDetailAchatVR() {
		parent::__construct();		
		$this->mIdNomProduit = new VRelement();
		$this->mIdStock = new VRelement();
		$this->mIdDetailOperation = new VRelement();
		$this->mIdStockSolidaire = new VRelement();
		$this->mIdDetailOperationSolidaire = new VRelement();
		$this->mIdDetailCommande = new VRelement();
		$this->mIdModeleLot = new VRelement();
		$this->mIdDetailCommandeSolidaire = new VRelement();
		$this->mIdModeleLotSolidaire = new VRelement();
		$this->mQuantite = new VRelement();
		$this->mUnite = new VRelement();
		$this->mQuantiteSolidaire = new VRelement();
		$this->mUniteSolidaire = new VRelement();
		$this->mMontant = new VRelement();
		$this->mMontantSolidaire = new VRelement();
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
	* @name getIdDetailOperationSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement IdDetailOperationSolidaire
	*/
	public function getIdDetailOperationSolidaire() {
		return $this->mIdDetailOperationSolidaire;
	}

	/**
	* @name setIdDetailOperationSolidaire($pIdDetailOperationSolidaire)
	* @param VRelement
	* @desc Remplace le VRelement IdDetailOperationSolidaire par $pIdDetailOperationSolidaire
	*/
	public function setIdDetailOperationSolidaire($pIdDetailOperationSolidaire) {
		$this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire;
	}

	/**
	* @name getIdDetailCommande()
	* @return VRelement
	* @desc Renvoie le VRelement IdDetailCommande
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param VRelement
	* @desc Remplace le VRelement IdDetailCommande par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}

	/**
	* @name getIdModeleLot()
	* @return VRelement
	* @desc Renvoie le VRelement IdModeleLot
	*/
	public function getIdModeleLot() {
		return $this->mIdModeleLot;
	}

	/**
	* @name setIdModeleLot($pIdModeleLot)
	* @param VRelement
	* @desc Remplace le VRelement IdModeleLot par $pIdModeleLot
	*/
	public function setIdModeleLot($pIdModeleLot) {
		$this->mIdModeleLot = $pIdModeleLot;
	}

	/**
	* @name getIdDetailCommandeSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement IdDetailCommandeSolidaire
	*/
	public function getIdDetailCommandeSolidaire() {
		return $this->mIdDetailCommandeSolidaire;
	}

	/**
	* @name setIdDetailCommandeSolidaire($pIdDetailCommandeSolidaire)
	* @param VRelement
	* @desc Remplace le VRelement IdDetailCommandeSolidaire par $pIdDetailCommandeSolidaire
	*/
	public function setIdDetailCommandeSolidaire($pIdDetailCommandeSolidaire) {
		$this->mIdDetailCommandeSolidaire = $pIdDetailCommandeSolidaire;
	}

	/**
	* @name getIdModeleLotSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement IdModeleLotSolidaire
	*/
	public function getIdModeleLotSolidaire() {
		return $this->mIdModeleLotSolidaire;
	}

	/**
	* @name setIdModeleLotSolidaire($pIdModeleLotSolidaire)
	* @param VRelement
	* @desc Remplace le VRelement IdModeleLotSolidaire par $pIdModeleLotSolidaire
	*/
	public function setIdModeleLotSolidaire($pIdModeleLotSolidaire) {
		$this->mIdModeleLotSolidaire = $pIdModeleLotSolidaire;
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

	/**
	* @name getMontantSolidaire()
	* @return VRelement
	* @desc Renvoie le VRelement mMontantSolidaire
	*/
	public function getMontantSolidaire() {
		return $this->mMontantSolidaire;
	}

	/**
	* @name setMontantSolidaire($pMontantSolidaire)
	* @param VRelement
	* @desc Remplace le mMontantSolidaire par $pMontantSolidaire
	*/
	public function setMontantSolidaire($pMontantSolidaire) {
		$this->mMontantSolidaire = $pMontantSolidaire;
	}
}
?>