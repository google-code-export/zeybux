<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : OperationRemiseChequePresentationVO.php
//
// Description : Classe OperationRemiseChequePresentationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationRemiseChequePresentationVO
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une OperationRemiseChequePresentationVO
 */
class OperationRemiseChequePresentationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc IdOperation de la OperationRemiseChequePresentationVO
	*/
	protected $mIdOperation;

	/**
	* @var datetime
	* @desc Date de la OperationRemiseChequePresentationVO
	*/
	protected $mDate;

	/**
	* @var varchar(5)
	* @desc NumeroAdherent de la OperationRemiseChequePresentationVO
	*/
	protected $mNumeroAdherent;

	/**
	* @var varchar(30)
	* @desc Compte de la OperationRemiseChequePresentationVO
	*/
	protected $mCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la OperationRemiseChequePresentationVO
	*/
	protected $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la OperationRemiseChequePresentationVO
	*/
	protected $mPrenom;
	
	/**
	 * @var decimal(10,2)
	 * @desc Montant de la OperationRemiseChequePresentationVO
	 */
	protected $mMontant;

	/**
	* @var varchar(50)
	* @desc NumeroCheque de la OperationRemiseChequePresentationVO
	*/
	protected $mNumeroCheque;
	
	/**
	 * @name OperationRemiseChequePresentationVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationRemiseChequePresentationVO($pIdOperation = null, $pDate = null, $pNumeroAdherent = null, $pCompte = null, $pNom = null, $pPrenom = null, $pMontant = null, $pNumeroCheque = null) {
		if(!is_null($pIdOperation)) { $this->mIdOperation = $pIdOperation; }
		if(!is_null($pDate)) { $this->mDate = $pDate; }
		if(!is_null($pNumeroAdherent)) { $this->mNumeroAdherent = $pNumeroAdherent; }
		if(!is_null($pCompte)) { $this->mCompte = $pCompte; }
		if(!is_null($pNom)) { $this->mNom = $pNom; }
		if(!is_null($pPrenom)) { $this->mPrenom = $pPrenom; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pNumeroCheque)) { $this->mNumeroCheque = $pNumeroCheque; }
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la OperationRemiseChequePresentationVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la OperationRemiseChequePresentationVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la OperationRemiseChequePresentationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la OperationRemiseChequePresentationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getNumeroAdherent()
	* @return varchar(5)
	* @desc Renvoie le membre NumeroAdherent de la OperationRemiseChequePresentationVO
	*/
	public function getNumeroAdherent() {
		return $this->mNumeroAdherent;
	}

	/**
	* @name setNumeroAdherent($pNumeroAdherent)
	* @param varchar(5)
	* @desc Remplace le membre NumeroAdherent de la OperationRemiseChequePresentationVO par $pNumeroAdherent
	*/
	public function setNumeroAdherent($pNumeroAdherent) {
		$this->mNumeroAdherent = $pNumeroAdherent;
	}

	/**
	* @name getCompte()
	* @return varchar(30)
	* @desc Renvoie le membre Compte de la OperationRemiseChequePresentationVO
	*/
	public function getCompte() {
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param varchar(30)
	* @desc Remplace le membre Compte de la OperationRemiseChequePresentationVO par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}
	
	/**
	 * @name getNom()
	 * @return varchar(50)
	 * @desc Renvoie le membre Nom de la OperationRemiseChequePresentationVO
	 */
	public function getNom() {
		return $this->mNom;
	}
	
	/**
	 * @name setNom($pNom)
	 * @param varchar(50)
	 * @desc Remplace le membre Nom de la OperationRemiseChequePresentationVO par $pNom
	 */
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	 * @name getPrenom()
	 * @return varchar(50)
	 * @desc Renvoie le membre Prenom de la OperationRemiseChequePresentationVO
	 */
	public function getPrenom() {
		return $this->mPrenom;
	}
	
	/**
	 * @name setPrenom($pPrenom)
	 * @param varchar(50)
	 * @desc Remplace le membre Prenom de la OperationRemiseChequePresentationVO par $pPrenom
	 */
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}
	
	/**
	 * @name getMontant()
	 * @return decimal(10,2)
	 * @desc Renvoie le membre Montant de la OperationRemiseChequePresentationVO
	 */
	public function getMontant() {
		return $this->mMontant;
	}
	
	/**
	 * @name setMontant($pMontant)
	 * @param decimal(10,2)
	 * @desc Remplace le membre Montant de la OperationRemiseChequePresentationVO par $pMontant
	 */
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}
	
	/**
	 * @name getNumeroCheque()
	 * @return varchar(50)
	 * @desc Renvoie le membre NumeroCheque de la OperationRemiseChequePresentationVO
	 */
	public function getNumeroCheque() {
		return $this->mNumeroCheque;
	}
	
	/**
	 * @name setNumeroCheque($pNumeroCheque)
	 * @param varchar(50)
	 * @desc Remplace le membre NumeroCheque de la OperationRemiseChequePresentationVO par $pNumeroCheque
	 */
	public function setNumeroCheque($pNumeroCheque) {
		$this->mNumeroCheque = $pNumeroCheque;
	}
}
?>