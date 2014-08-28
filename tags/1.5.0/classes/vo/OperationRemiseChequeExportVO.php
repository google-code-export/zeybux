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
	 * @var varchar(200)
	 * @desc Date de la OperationRemiseChequeExportVO
	 */
	protected $mBanque;
	
	/**
	* @var varchar(50)
	* @desc Nom de la OperationRemiseChequeExportVO
	*/
	protected $mNom;
	
	/**
	 * @var varchar(50)
	 * @desc Prenom de la OperationRemiseChequeExportVO
	 */
	protected $mPrenom;

	/**
	 * @var decimal(10,2)
	 * @desc Montant de la OperationRemiseChequeExportVO
	 */
	protected $mMontant;

	/**
	* @var varchar(50)
	* @desc Numero de la OperationRemiseChequeExportVO
	*/
	protected $mNumero;
	
	/**
	 * @name OperationRemiseChequeExportVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationRemiseChequeExportVO($pBanque = null, $pNom = null, $pPrenom = null, $pMontant = null,  $pNumero = null) {
		if(!is_null($pBanque)) { $this->mBanque = $pBanque; }
		if(!is_null($pNom)) { $this->mNom = $pNom; }
		if(!is_null($pPrenom)) { $this->mPrenom = $pPrenom; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pNumero)) { $this->mNumero = $pNumero; }
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
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la OperationRemiseChequeExportVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la OperationRemiseChequeExportVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre Prenom de la OperationRemiseChequeExportVO
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param varchar(50)
	* @desc Remplace le membre Prenom de la OperationRemiseChequeExportVO par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
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
	
	/**
	 * @name getNumero()
	 * @return varchar(50)
	 * @desc Renvoie le membre Numero de la OperationRemiseChequeExportVO
	 */
	public function getNumero() {
		return $this->mNumero;
	}
	
	/**
	 * @name setNumero($pNumero)
	 * @param varchar(50)
	 * @desc Remplace le membre Numero de la OperationRemiseChequeExportVO par $pNumero
	 */
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}
}
?>