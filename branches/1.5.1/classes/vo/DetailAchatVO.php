<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/09/2013
// Fichier : DetailAchatVO.php
//
// Description : Classe DetailAchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailAchatVO
 * @author Julien PIERRE
 * @since 07/09/2013
 * @desc Classe représentant une DetailAchatVO
 */
class DetailAchatVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdOperation de la DetailAchatVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdOperationSolidaire de la DetailAchatVO
	*/
	protected $mIdOperationSolidaire;

	/**
	* @var int(11)
	* @desc IdNomProduit de la DetailAchatVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdStock de la DetailAchatVO
	*/
	protected $mIdStock;

	/**
	* @var int(11)
	* @desc IdDetailOperation de la DetailAchatVO
	*/
	protected $mIdDetailOperation;

	/**
	* @var int(11)
	* @desc IdStockSolidaire de la DetailAchatVO
	*/
	protected $mIdStockSolidaire;

	/**
	* @var int(11)
	* @desc IdDetailOperationSolidaire de la DetailAchatVO
	*/
	protected $mIdDetailOperationSolidaire;

	/**
	 * @name DetailAchatVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function DetailAchatVO($pIdOperation = null, $pIdOperationSolidaire = null, $pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null, $pIdDetailOperationSolidaire = null) {
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; }
		if(!is_null($pIdOperationSolidaire)) { $this->mIdOperationSolidaire = $pIdOperationSolidaire; }
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
		if(!is_null($pIdDetailOperationSolidaire)) { $this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire; }
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la DetailAchatVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la DetailAchatVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdOperationSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdOperationSolidaire de la DetailAchatVO
	*/
	public function getIdOperationSolidaire() {
		return $this->mIdOperationSolidaire;
	}

	/**
	* @name setIdOperationSolidaire($pIdOperationSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdOperationSolidaire de la DetailAchatVO par $pIdOperationSolidaire
	*/
	public function setIdOperationSolidaire($pIdOperationSolidaire) {
		$this->mIdOperationSolidaire = $pIdOperationSolidaire;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la DetailAchatVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la DetailAchatVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getIdStock()
	* @return int(11)
	* @desc Renvoie le membre IdStock de la DetailAchatVO
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param int(11)
	* @desc Remplace le membre IdStock de la DetailAchatVO par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}

	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la DetailAchatVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la DetailAchatVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}

	/**
	* @name getIdStockSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdStockSolidaire de la DetailAchatVO
	*/
	public function getIdStockSolidaire() {
		return $this->mIdStockSolidaire;
	}

	/**
	* @name setIdStockSolidaire($pIdStockSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdStockSolidaire de la DetailAchatVO par $pIdStockSolidaire
	*/
	public function setIdStockSolidaire($pIdStockSolidaire) {
		$this->mIdStockSolidaire = $pIdStockSolidaire;
	}

	/**
	* @name getIdDetailOperationSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperationSolidaire de la DetailAchatVO
	*/
	public function getIdDetailOperationSolidaire() {
		return $this->mIdDetailOperationSolidaire;
	}

	/**
	* @name setIdDetailOperationSolidaire($pIdDetailOperationSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperationSolidaire de la DetailAchatVO par $pIdDetailOperationSolidaire
	*/
	public function setIdDetailOperationSolidaire($pIdDetailOperationSolidaire) {
		$this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire;
	}

}
?>