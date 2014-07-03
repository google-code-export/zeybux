<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : OperationRemiseChequeExportVO.php
//
// Description : Classe OperationRemiseChequeExportVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationRemiseChequeExportVO
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une OperationRemiseChequeExportVO
 */
class OperationRemiseChequeExportVO  extends DataTemplate
{
	/**
	 * @var decimal(10,2)
	 * @desc Montant de la OperationRemiseChequeExportVO
	 */
	protected $mMontant;
	
	/**
	* @var int(11)
	* @desc IdOperation de la OperationRemiseChequeExportVO
	*/
	protected $mNombreCheque;

	/**
	* @var varchar(200)
	* @desc Date de la OperationRemiseChequeExportVO
	*/
	protected $mBanque;

	/**
	* @var decimal(10,2)
	* @desc NumeroAdherent de la OperationRemiseChequeExportVO
	*/
	protected $mTotal;
	
	/**
	 * @name OperationRemiseChequeExportVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationRemiseChequeExportVO($pBanque = null, $pNombreCheque = null, $pMontant = null,   $pTotal = null) {
		if(!is_null($pBanque)) { $this->mBanque = $pBanque; }
		if(!is_null($pNombreCheque)) { $this->mNombreCheque = $pNombreCheque; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pTotal)) { $this->mTotal = $pTotal; }
	}

	/**
	* @name getNombreCheque()
	* @return int(11)
	* @desc Renvoie le membre NombreCheque de la OperationRemiseChequeExportVO
	*/
	public function getNombreCheque() {
		return $this->mNombreCheque;
	}

	/**
	* @name setNombreCheque($pNombreCheque)
	* @param int(11)
	* @desc Remplace le membre NombreCheque de la OperationRemiseChequeExportVO par $pNombreCheque
	*/
	public function setNombreCheque($pNombreCheque) {
		$this->mNombreCheque = $pNombreCheque;
	}

	/**
	* @name getBanque()
	* @return varchar(200)
	* @desc Renvoie le membre Banque de la OperationRemiseChequeExportVO
	*/
	public function getBanque() {
		return $this->mBanque;
	}

	/**
	* @name setBanque($pBanque)
	* @param varchar(200)
	* @desc Remplace le membre Banque de la OperationRemiseChequeExportVO par $pBanque
	*/
	public function setBanque($pBanque) {
		$this->mBanque = $pBanque;
	}

	/**
	* @name getTotal()
	* @return decimal(10,2)
	* @desc Renvoie le membre Total de la OperationRemiseChequeExportVO
	*/
	public function getTotal() {
		return $this->mTotal;
	}

	/**
	* @name setTotal($pTotal)
	* @param decimal(10,2)
	* @desc Remplace le membre Total de la OperationRemiseChequeExportVO par $pTotal
	*/
	public function setTotal($pTotal) {
		$this->mTotal = $pTotal;
	}
	
	/**
	 * @name getMontant()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Montant de la OperationRemiseChequeExportVO
	 */
	public function getMontant() {
		return $this->mMontant;
	}
	
	/**
	 * @name setMontant($pMontant)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Montant de la OperationRemiseChequeExportVO par $pMontant
	 */
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}
}
?>