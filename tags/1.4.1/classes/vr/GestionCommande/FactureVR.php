<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : FactureVR.php
//
// Description : Classe FactureVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name FactureVR
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une FactureVR
 */
class FactureVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc Operation de la FactureVR
	 */
	protected $mOperation;
	
	/**
	 * @var VRelement
	 * @desc OperationProducteur de la FactureVR
	 */
	protected $mOperationProducteur;
	
	/**
	 * @var VRelement
	 * @desc OperationZeybu de la FactureVR
	 */
	protected $mOperationZeybu;
	
	/**
	 * @var VRelement
	 * @desc montant de la FactureVR
	 */
	protected $mMontant;
	
	/**
	 * @var VRelement
	 * @desc TypePaiement de la FactureVR
	 */
	protected $mTypePaiement;
	
	/**
	 * @var VRelement
	 * @desc ChampComplementaire de la FactureVR
	 */
	protected $mChampComplementaire;
	
	/**
	 * @var VRelement
	 * @desc Produits de la FactureVR
	 */
	protected $mProduits;
	
	/**
	* @name FactureVR()
	* @return bool
	* @desc Constructeur
	*/
	function FactureVR() {
		parent::__construct();		
		$this->mOperation = new VRelement();
		$this->mOperationProducteur = new VRelement();
		$this->mOperationZeybu = new VRelement();
		$this->mMontant = new VRelement();
		$this->mTypePaiement = new VRelement();
		$this->mChampComplementaire = array();
		$this->mProduits = array();
	}

	/**
	* @name getOperation()
	* @return VRelement
	* @desc Renvoie le VRelement mOperation
	*/
	public function getOperation() {
		return $this->mOperation;
	}

	/**
	* @name setOperation($pOperation)
	* @param VRelement
	* @desc Remplace le mOperation par $pOperation
	*/
	public function setOperation($pOperation) {
		$this->mOperation = $pOperation;
	}

	/**
	* @name getOperationProducteur()
	* @return VRelement
	* @desc Renvoie le VRelement mOperationProducteur
	*/
	public function getOperationProducteur() {
		return $this->mOperationProducteur;
	}

	/**
	* @name setOperationProducteur($pOperationProducteur)
	* @param VRelement
	* @desc Remplace le mOperationProducteur par $pOperationProducteur
	*/
	public function setOperationProducteur($pOperationProducteur) {
		$this->mOperationProducteur = $pOperationProducteur;
	}

	/**
	* @name getOperationZeybu()
	* @return VRelement
	* @desc Renvoie le VRelement mOperationZeybu
	*/
	public function getOperationZeybu() {
		return $this->mOperationZeybu;
	}

	/**
	* @name setOperationZeybu($pOperationZeybu)
	* @param VRelement
	* @desc Remplace le mOperationZeybu par $pOperationZeybu
	*/
	public function setOperationZeybu($pOperationZeybu) {
		$this->mOperationZeybu = $pOperationZeybu;
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
	* @name getTypePaiement()
	* @return VRelement
	* @desc Renvoie le VRelement mTypePaiement
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param VRelement
	* @desc Remplace le mTypePaiement par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getChampComplementaire()
	* @return array()
	* @desc Renvoie le VRelement mChampComplementaire
	*/
	public function getChampComplementaire() {
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pChampComplementaire)
	* @param array()
	* @desc Remplace le mChampComplementaire par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}

	/**
	* @name addChampComplementaire($pChampComplementaire)
	* @param array()
	* @desc Ajoute $pChampComplementaire au mChampComplementaire
	*/
	public function addChampComplementaire($pChampComplementaire) {
		array_push($this->mChampComplementaire, $pChampComplementaire);
	}

	/**
	* @name getProduits()
	* @return array()
	* @desc Renvoie le VRelement mProduits
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array()
	* @desc Remplace le mProduits par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}

	/**
	* @name addProduits($pProduits)
	* @param array()
	* @desc Ajoute $pProduits au mProduits
	*/
	public function addProduits($pProduits) {
		array_push($this->mProduits, $pProduits);
	}
}
?>