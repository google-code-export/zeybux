<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : ProduitDetailFactureVO.php
//
// Description : Classe ProduitDetailFactureVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitDetailFactureVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une ProduitDetailFactureVO
 */
class ProduitDetailFactureVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitDetailFactureVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdStock de la ProduitDetailFactureVO
	*/
	protected $mIdStock;
	
	/**
	 * @var int(11)
	 * @desc IdDetailOperation de la ProduitDetailFactureVO
	 */
	protected $mDetailOperation;
	
	/**
	* @var int(11)
	* @desc IdStockSolidaire de la ProduitDetailFactureVO
	*/
	protected $mIdStockSolidaire;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la ProduitDetailFactureVO
	*/
	protected $mQuantite;

	/**
	* @var varchar(20)
	* @desc Unite de la ProduitDetailFactureVO
	*/
	protected $mUnite;

	/**
	* @var decimal(10,2)
	* @desc QuantiteSolidaire de la ProduitDetailFactureVO
	*/
	protected $mQuantiteSolidaire;
	
	/**
	 * @var varchar(20)
	 * @desc UniteSolidaire de la ProduitDetailFactureVO
	 */
	protected $mUniteSolidaire;

	/**
	* @var decimal(10,2)
	* @desc Montant de la ProduitDetailFactureVO
	*/
	protected $mMontant;
	
	/**
	 * @name ProduitDetailFactureVO()
	 * @desc Le constructeur
	 */
	public function ProduitDetailFactureVO($pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null, $pQuantite = null, $pUnite = null, $pQuantiteSolidaire = null, $pUniteSolidaire = null, $pMontant = null) {
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
		if(!is_null($pQuantite)) { $this->mQuantite = $pQuantite; }
		if(!is_null($pUnite)) { $this->mUnite = $pUnite; }
		if(!is_null($pQuantiteSolidaire)) { $this->mQuantiteSolidaire = $pQuantiteSolidaire; }
		if(!is_null($pUniteSolidaire)) { $this->mUniteSolidaire = $pUniteSolidaire; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }	
	}
	
	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitDetailFactureVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitDetailFactureVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}
	
	/**
	* @name getIdStock()
	* @return int(11)
	* @desc Renvoie le membre IdStock de la ProduitDetailFactureVO
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param int(11)
	* @desc Remplace le membre IdStock de la ProduitDetailFactureVO par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}
	
	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la ProduitDetailFactureVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la ProduitDetailFactureVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}
	
	/**
	* @name getIdStockSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdStockSolidaire de la ProduitDetailFactureVO
	*/
	public function getIdStockSolidaire() {
		return $this->mIdStockSolidaire;
	}

	/**
	* @name setIdStockSolidaire($pIdStockSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdStockSolidaire de la ProduitDetailFactureVO par $pIdStockSolidaire
	*/
	public function setIdStockSolidaire($pIdStockSolidaire) {
		$this->mIdStockSolidaire = $pIdStockSolidaire;
	}

	/**
	 * @name getQuantite()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Quantite de la ProduitDetailFactureVO
	 */
	public function getQuantite() {
		return $this->mQuantite;
	}
	
	/**
	 * @name setQuantite($pQuantite)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Quantite de la ProduitDetailFactureVO par $pQuantite
	 */
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la ProduitDetailFactureVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la ProduitDetailFactureVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	 * @name getQuantiteSolidaire()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre QuantiteSolidaire de la ProduitDetailFactureVO
	 */
	public function getQuantiteSolidaire() {
		return $this->mQuantiteSolidaire;
	}
	
	/**
	 * @name setQuantiteSolidaire($pQuantiteSolidaire)
	 * @param decimal(10,2)
	 * @desc Remplace le membre QuantiteSolidaire de la ProduitDetailFactureVO par $pQuantiteSolidaire
	 */
	public function setQuantiteSolidaire($pQuantiteSolidaire) {
		$this->mQuantiteSolidaire = $pQuantiteSolidaire;
	}

	/**
	* @name getUniteSolidaire()
	* @return varchar(20)
	* @desc Renvoie le membre UniteSolidaire de la ProduitDetailFactureVO
	*/
	public function getUniteSolidaire() {
		return $this->mUniteSolidaire;
	}

	/**
	* @name setUniteSolidaire($pUniteSolidaire)
	* @param varchar(20)
	* @desc Remplace le membre UniteSolidaire de la ProduitDetailFactureVO par $pUniteSolidaire
	*/
	public function setUniteSolidaire($pUniteSolidaire) {
		$this->mUniteSolidaire = $pUniteSolidaire;
	}

	/**
	 * @name getMontant()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Montant de la ProduitDetailFactureVO
	 */
	public function getMontant() {
		return $this->mMontant;
	}
	
	/**
	 * @name setMontant($pMontant)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Montant de la ProduitDetailFactureVO par $pMontant
	 */
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}
}
?>