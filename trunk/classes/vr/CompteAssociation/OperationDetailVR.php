<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : OperationDetailVR.php
//
// Description : Classe OperationDetailVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name OperationDetailVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une OperationDetailVR
 */
class OperationDetailVR extends TemplateVR
{
	/**
	 * @var VRelement
	 * @desc L'Id de l'objet
	 */
	protected $mId;
	
	/**
	 * @var VRelement
	 * @desc L'IdCompte de l'objet
	 */
	protected $mIdCompte;
	
	/**
	 * @var VRelement
	 * @desc Le Libelle de l'objet
	 */
	protected $mLibelle;

	/**
	 * @var VRelement
	 * @desc Montant de la OperationDetailVR
	 */
	protected $mMontant;

	/**
	 * @var VRelement
	 * @desc TypePaiement de la OperationDetailVR
	 */
	protected $mTypePaiement;

	/**
	 * @var VRelement
	 * @desc ChampComplementaireObligatoire de la OperationDetailVR
	 */
	protected $mChampComplementaireObligatoire;

	/**
	 * @var VRelement
	 * @desc ChampComplementaire de la OperationDetailVR
	 */
	protected $mChampComplementaire;

	/**
	* @name OperationDetailVR()
	* @return bool
	* @desc Constructeur
	*/
	function OperationDetailVR() {
		parent::__construct();
		$this->mId = new VRelement();
		$this->mIdCompte = new VRelement();
		$this->mLibelle = new VRelement();
		$this->mMontant = new VRelement();
		$this->mTypePaiement = new VRelement();
		$this->mChampComplementaireObligatoire = new VRelement();
		$this->mChampComplementaire = new VRelement();
	}

	/**
	* @name getId()
	* @return VRelement
	* @desc Renvoie le VRelement Id
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param VRelement
	* @desc Remplace le VRelement Id par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return VRelement
	* @desc Renvoie le VRelement IdCompte
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param VRelement
	* @desc Remplace le VRelement IdCompte par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getLibelle()
	* @return VRelement
	* @desc Renvoie le VRelement Libelle
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param VRelement
	* @desc Remplace le VRelement Libelle par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
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
	* @name getChampComplementaireObligatoire()
	* @return VRelement
	* @desc Renvoie le VRelement mChampComplementaireObligatoire
	*/
	public function getChampComplementaireObligatoire() {
		return $this->mChampComplementaireObligatoire;
	}

	/**
	* @name setChampComplementaireObligatoire($pChampComplementaireObligatoire)
	* @param VRelement
	* @desc Remplace le mChampComplementaireObligatoire par $pChampComplementaireObligatoire
	*/
	public function setChampComplementaireObligatoire($pChampComplementaireObligatoire) {
		$this->mChampComplementaireObligatoire = $pChampComplementaireObligatoire;
	}

	/**
	* @name getChampComplementaire()
	* @return VRelement
	* @desc Renvoie le VRelement mChampComplementaire
	*/
	public function getChampComplementaire() {
		return $this->mChampComplementaire;
	}

	/**
	* @name setChampComplementaire($pChampComplementaire)
	* @param VRelement
	* @desc Remplace le mChampComplementaire par $pChampComplementaire
	*/
	public function setChampComplementaire($pChampComplementaire) {
		$this->mChampComplementaire = $pChampComplementaire;
	}
}
?>