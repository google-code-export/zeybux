<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/08/2013
// Fichier : DetailFactureVO.php
//
// Description : Classe DetailFactureVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailFactureVO
 * @author Julien PIERRE
 * @since 18/08/2013
 * @desc Classe représentant une DetailFactureVO
 */
class DetailFactureVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdOperation de la DetailFactureVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdNomProduit de la DetailFactureVO
	*/
	protected $mIdNomProduit;

	/**
	* @var int(11)
	* @desc IdStock de la DetailFactureVO
	*/
	protected $mIdStock;

	/**
	* @var int(11)
	* @desc IdDetailOperation de la DetailFactureVO
	*/
	protected $mIdDetailOperation;

	/**
	* @var int(11)
	* @desc IdStockSolidaire de la DetailFactureVO
	*/
	protected $mIdStockSolidaire;

	/**
	 * @name DetailFactureVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function DetailFactureVO($pIdOperation = null, $pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null) {
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; }
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la DetailFactureVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la DetailFactureVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la DetailFactureVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la DetailFactureVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getIdStock()
	* @return int(11)
	* @desc Renvoie le membre IdStock de la DetailFactureVO
	*/
	public function getIdStock() {
		return $this->mIdStock;
	}

	/**
	* @name setIdStock($pIdStock)
	* @param int(11)
	* @desc Remplace le membre IdStock de la DetailFactureVO par $pIdStock
	*/
	public function setIdStock($pIdStock) {
		$this->mIdStock = $pIdStock;
	}

	/**
	* @name getIdDetailOperation()
	* @return int(11)
	* @desc Renvoie le membre IdDetailOperation de la DetailFactureVO
	*/
	public function getIdDetailOperation() {
		return $this->mIdDetailOperation;
	}

	/**
	* @name setIdDetailOperation($pIdDetailOperation)
	* @param int(11)
	* @desc Remplace le membre IdDetailOperation de la DetailFactureVO par $pIdDetailOperation
	*/
	public function setIdDetailOperation($pIdDetailOperation) {
		$this->mIdDetailOperation = $pIdDetailOperation;
	}

	/**
	* @name getIdStockSolidaire()
	* @return int(11)
	* @desc Renvoie le membre IdStockSolidaire de la DetailFactureVO
	*/
	public function getIdStockSolidaire() {
		return $this->mIdStockSolidaire;
	}

	/**
	* @name setIdStockSolidaire($pIdStockSolidaire)
	* @param int(11)
	* @desc Remplace le membre IdStockSolidaire de la DetailFactureVO par $pIdStockSolidaire
	*/
	public function setIdStockSolidaire($pIdStockSolidaire) {
		$this->mIdStockSolidaire = $pIdStockSolidaire;
	}

}
?>