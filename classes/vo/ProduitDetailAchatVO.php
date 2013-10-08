<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : ProduitDetailAchatVO.php
//
// Description : Classe ProduitDetailAchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitDetailAchatVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une ProduitDetailAchatVO
 */
class ProduitDetailAchatVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitDetailAchatVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdStock de la ProduitDetailAchatVO
	*/
	protected $mIdStock;
	
	/**
	 * @var int(11)
	 * @desc IdDetailOperation de la ProduitDetailAchatVO
	 */
	protected $mDetailOperation;
	
	/**
	* @var int(11)
	* @desc IdStockSolidaire de la ProduitDetailAchatVO
	*/
	protected $mIdStockSolidaire;
	
	/**
	 * @var int(11)
	 * @desc IdDetailOperationSolidaire de la ProduitDetailAchatVO
	 */
	protected $mDetailOperationSolidaire;
	
	/**
	* @var int(11)
	* @desc IdDetailCommande de la ProduitDetailAchatVO
	*/
	protected $mIdDetailCommande;
	
	/**
	* @var int(11)
	* @desc IdModeleLot de la ProduitDetailAchatVO
	*/
	protected $mIdModeleLot;
	
	/**
	* @var int(11)
	* @desc IdDetailCommandeSolidaire de la ProduitDetailAchatVO
	*/
	protected $mIdDetailCommandeSolidaire;
	
	/**
	* @var int(11)
	* @desc IdModeleLotSolidaire de la ProduitDetailAchatVO
	*/
	protected $mIdModeleLotSolidaire;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la ProduitDetailAchatVO
	*/
	protected $mQuantite;

	/**
	* @var varchar(20)
	* @desc Unite de la ProduitDetailAchatVO
	*/
	protected $mUnite;

	/**
	* @var decimal(10,2)
	* @desc QuantiteSolidaire de la ProduitDetailAchatVO
	*/
	protected $mQuantiteSolidaire;
	
	/**
	 * @var varchar(20)
	 * @desc UniteSolidaire de la ProduitDetailAchatVO
	 */
	protected $mUniteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc Montant de la ProduitDetailAchatVO
	*/
	protected $mMontant;

	/**
	* @var decimal(10,2)
	* @desc MontantSolidaire de la ProduitDetailAchatVO
	*/
	protected $mMontantSolidaire;
	
	/**
	 * @name ProduitDetailAchatVO()
	 * @desc Le constructeur
	 */
	public function ProduitDetailAchatVO($pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null, $pIdDetailOperationSolidaire = null, $pIdDetailCommande = null, $pIdModeleLot = null, $pIdDetailCommandeSolidaire = null, $pIdModeleLotSolidaire = null, $pQuantite = null, $pUnite = null, $pQuantiteSolidaire = null, $pUniteSolidaire = null, $pMontant = null, $pMontantSolidaire = null) {
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
		if(!is_null($pIdDetailOperationSolidaire)) { $this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire; }
		if(!is_null($pIdDetailCommande)) { $this->mIdDetailCommande = $pIdDetailCommande; }
		if(!is_null($pIdModeleLot)) { $this->mIdModeleLot = $pIdModeleLot; }
		if(!is_null($pIdDetailCommandeSolidaire)) { $this->mIdDetailCommandeSolidaire = $pIdDetailCommandeSolidaire; }
		if(!is_null($pIdModeleLotSolidaire)) { $this->mIdModeleLotSolidaire = $pIdModeleLotSolidaire; }
		if(!is_null($pQuantite)) { $this->mQuantite = $pQuantite; }
		if(!is_null($pUnite)) { $this->mUnite = $pUnite; }
		if(!is_null($pQuantiteSolidaire)) { $this->mQuantiteSolidaire = $pQuantiteSolidaire; }
		if(!is_null($pUniteSolidaire)) { $this->mUniteSolidaire = $pUniteSolidaire; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }	
		if(!is_null($pMontantSolidaire)) { $this->mMontantSolidaire = $pMontantSolidaire; }	
	}
	
	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitDetailAchatVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitDetailAchatVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}
	
	/**
	* @name getIdStock()
	* @return int(11)
	* @desc Renvoie le membre IdStock de la ProduitDetailAchatVO
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param int(11)
	* @desc Remplace le membre IdStock de la ProduitDetailAchatVO par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}
	
	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la ProduitDetailAchatVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la ProduitDetailAchatVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}
	
	/**
	* @name getIdStockSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdStockSolidaire de la ProduitDetailAchatVO
	*/
	public function getIdStockSolidaire() {
		return $this->mIdStockSolidaire;
	}

	/**
	* @name setIdStockSolidaire($pIdStockSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdStockSolidaire de la ProduitDetailAchatVO par $pIdStockSolidaire
	*/
	public function setIdStockSolidaire($pIdStockSolidaire) {
		$this->mIdStockSolidaire = $pIdStockSolidaire;
	}
	
	/**
	* @name getIdDetailOperationSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperationSolidaire de la ProduitDetailAchatVO
	*/
	public function getIdDetailOperationSolidaire() {
		return $this->mIdDetailOperationSolidaire;
	}

	/**
	* @name setIdDetailOperationSolidaire($pIdDetailOperationSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperationSolidaire de la ProduitDetailAchatVO par $pIdDetailOperationSolidaire
	*/
	public function setIdDetailOperationSolidaire($pIdDetailOperationSolidaire) {
		$this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire;
	}
	
	/**
	* @name getIdDetailCommande()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommande de la ProduitDetailAchatVO
	*/
	public function getIdDetailCommande() {
		return $this->mIdDetailCommande;
	}

	/**
	* @name setIdDetailCommande($pIdDetailCommande)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommande de la ProduitDetailAchatVO par $pIdDetailCommande
	*/
	public function setIdDetailCommande($pIdDetailCommande) {
		$this->mIdDetailCommande = $pIdDetailCommande;
	}
	
	/**
	* @name getIdModeleLot()
	* @return int(11)
	* @desc Renvoie le membre IdModeleLot de la ProduitDetailAchatVO
	*/
	public function getIdModeleLot() {
		return $this->mIdModeleLot;
	}

	/**
	* @name setIdModeleLot($pIdModeleLot)
	* @param int(11)
	* @desc Remplace le membre IdModeleLot de la ProduitDetailAchatVO par $pIdModeleLot
	*/
	public function setIdModeleLot($pIdModeleLot) {
		$this->mIdModeleLot = $pIdModeleLot;
	}
	
	/**
	* @name getIdDetailCommandeSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdDetailCommandeSolidaire de la ProduitDetailAchatVO
	*/
	public function getIdDetailCommandeSolidaire() {
		return $this->mIdDetailCommandeSolidaire;
	}

	/**
	* @name setIdDetailCommandeSolidaire($pIdDetailCommandeSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdDetailCommandeSolidaire de la ProduitDetailAchatVO par $pIdDetailCommandeSolidaire
	*/
	public function setIdDetailCommandeSolidaire($pIdDetailCommandeSolidaire) {
		$this->mIdDetailCommandeSolidaire = $pIdDetailCommandeSolidaire;
	}
	
	/**
	* @name getIdModeleLotSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdModeleLotSolidaire de la ProduitDetailAchatVO
	*/
	public function getIdModeleLotSolidaire() {
		return $this->mIdModeleLotSolidaire;
	}

	/**
	* @name setIdModeleLotSolidaire($pIdModeleLotSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdModeleLotSolidaire de la ProduitDetailAchatVO par $pIdModeleLotSolidaire
	*/
	public function setIdModeleLotSolidaire($pIdModeleLotSolidaire) {
		$this->mIdModeleLotSolidaire = $pIdModeleLotSolidaire;
	}

	/**
	 * @name getQuantite()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Quantite de la ProduitDetailAchatVO
	 */
	public function getQuantite() {
		return $this->mQuantite;
	}
	
	/**
	 * @name setQuantite($pQuantite)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Quantite de la ProduitDetailAchatVO par $pQuantite
	 */
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la ProduitDetailAchatVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la ProduitDetailAchatVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	 * @name getQuantiteSolidaire()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre QuantiteSolidaire de la ProduitDetailAchatVO
	 */
	public function getQuantiteSolidaire() {
		return $this->mQuantiteSolidaire;
	}
	
	/**
	 * @name setQuantiteSolidaire($pQuantiteSolidaire)
	 * @param decimal(10,2)
	 * @desc Remplace le membre QuantiteSolidaire de la ProduitDetailAchatVO par $pQuantiteSolidaire
	 */
	public function setQuantiteSolidaire($pQuantiteSolidaire) {
		$this->mQuantiteSolidaire = $pQuantiteSolidaire;
	}

	/**
	* @name getUniteSolidaire()
	* @return varchar(20)
	* @desc Renvoie le membre UniteSolidaire de la ProduitDetailAchatVO
	*/
	public function getUniteSolidaire() {
		return $this->mUniteSolidaire;
	}

	/**
	* @name setUniteSolidaire($pUniteSolidaire)
	* @param varchar(20)
	* @desc Remplace le membre UniteSolidaire de la ProduitDetailAchatVO par $pUniteSolidaire
	*/
	public function setUniteSolidaire($pUniteSolidaire) {
		$this->mUniteSolidaire = $pUniteSolidaire;
	}

	/**
	 * @name getMontant()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Montant de la ProduitDetailAchatVO
	 */
	public function getMontant() {
		return $this->mMontant;
	}
	
	/**
	 * @name setMontant($pMontant)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Montant de la ProduitDetailAchatVO par $pMontant
	 */
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	 * @name getMontantSolidaire()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre MontantSolidaire de la ProduitDetailAchatVO
	 */
	public function getMontantSolidaire() {
		return $this->mMontantSolidaire;
	}
	
	/**
	 * @name setMontantSolidaire($pMontantSolidaire)
	 * @param decimal(10,2)
	 * @desc Remplace le membre MontantSolidaire de la ProduitDetailAchatVO par $pMontantSolidaire
	 */
	public function setMontantSolidaire($pMontantSolidaire) {
		$this->mMontantSolidaire = $pMontantSolidaire;
	}
}
?>