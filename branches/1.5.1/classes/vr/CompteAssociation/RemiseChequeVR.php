<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : RemiseChequeVR.php
//
// Description : Classe RemiseChequeVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name RemiseChequeVR
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une RemiseChequeVR
 */
class RemiseChequeVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Id de la RemiseChequeVR
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc Numero de la RemiseChequeVR
	 */
	protected $mNumero;
	
	/**
	 * @var VRelement
	 * @desc IdCompte de la RemiseChequeVR
	 */
	protected $mIdCompte;
	
	/**
	 * @var VRelement
	 * @desc Montant de la RemiseChequeVR
	 */
	protected $mMontant;
	
	/**
	 * @var array()
	 * @desc Operations de la RemiseChequeVR
	 */
	protected $mOperations;
	
	/**
	* @name RemiseChequeVR()
	* @return bool
	* @desc Constructeur
	*/
	function RemiseChequeVR() {
		parent::__construct();		
		$this->mId = new VRelement();
		$this->mNumero = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mMontant = new VRelement();		
		$this->mOperations = array();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement mId
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le mId par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	 * @name getNumero()
	 * @return VRelement
	 * @desc Renvoie le VRelement mNumero
	 */
	public function getNumero() {
		return $this->mNumero;
	}
	
	/**
	 * @name setNumero($pNumero)
	 * @param VRelement
	 * @desc Remplace le mNumero par $pNumero
	 */
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}
	
	/**
	 * @name getIdCompte()
	 * @return VRelement
	 * @desc Renvoie le VRelement mIdCompte
	 */
	public function getIdCompte() {
		return $this->mIdCompte;
	}
	
	/**
	 * @name setIdCompte($pIdCompte)
	 * @param VRelement
	 * @desc Remplace le mIdCompte par $pIdCompte
	 */
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
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
	 * @name getOperations()
	 * @return array()
	 * @desc Renvoie le VRelement mOperations
	 */
	public function getOperations() {
		return $this->mOperations;
	}
	
	/**
	 * @name setOperations($pOperations)
	 * @param array()
	 * @desc Remplace le mOperations par $pOperations
	 */
	public function setOperations($pOperations) {
		$this->mOperations = $pOperations;
	}
}
?>