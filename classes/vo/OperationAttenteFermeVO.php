<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteFermeVO.php
//
// Description : Classe OperationAttenteFermeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAttenteFermeVO
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une OperationAttenteFermeVO
 */
class OperationAttenteFermeVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc FerId de la OperationAttenteFermeVO
	*/
	protected $mFerId;

	/**
	* @var varchar(20)
	* @desc FerNumero de la OperationAttenteFermeVO
	*/
	protected $mFerNumero;

	/**
	* @var varchar(50)
	* @desc FerNom de la OperationAttenteFermeVO
	*/
	protected $mFerNom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationAttenteFermeVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc CptSolde de la OperationAttenteFermeVO
	*/
	protected $mCptSolde;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAttenteFermeVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la OperationAttenteFermeVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @var array(ChampComplementaireDetailOperationVO)
	* @desc OpeTypePaiementChampComplementaire de la OperationAttenteFermeVO
	*/
	protected $mOpeTypePaiementChampComplementaire;
	
	/**
	* @var datetime
	* @desc OpeDate de la OperationAttenteFermeVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAttenteFermeVO
	*/
	protected $mOpeLibelle;

	/**
	* @var int(11)
	* @desc OpeId de la OperationAttenteFermeVO
	*/
	protected $mOpeId;
	
	/**
	 * @name OperationAttenteFermeVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationAttenteFermeVO() {
		$this->mOpeTypePaiementChampComplementaire = array();
	}

	/**
	* @name getFerId()
	* @return int(11)
	* @desc Renvoie le membre FerId de la OperationAttenteFermeVO
	*/
	public function getFerId() {
		return $this->mFerId;
	}

	/**
	* @name setFerId($pFerId)
	* @param int(11)
	* @desc Remplace le membre FerId de la OperationAttenteFermeVO par $pFerId
	*/
	public function setFerId($pFerId) {
		$this->mFerId = $pFerId;
	}

	/**
	* @name getFerNumero()
	* @return varchar(20)
	* @desc Renvoie le membre FerNumero de la OperationAttenteFermeVO
	*/
	public function getFerNumero() {
		return $this->mFerNumero;
	}

	/**
	* @name setFerNumero($pFerNumero)
	* @param varchar(20)
	* @desc Remplace le membre FerNumero de la OperationAttenteFermeVO par $pFerNumero
	*/
	public function setFerNumero($pFerNumero) {
		$this->mFerNumero = $pFerNumero;
	}

	/**
	* @name getFerNom()
	* @return varchar(50)
	* @desc Renvoie le membre FerNom de la OperationAttenteFermeVO
	*/
	public function getFerNom() {
		return $this->mFerNom;
	}

	/**
	* @name setFerNom($pFerNom)
	* @param varchar(50)
	* @desc Remplace le membre FerNom de la OperationAttenteFermeVO par $pFerNom
	*/
	public function setFerNom($pFerNom) {
		$this->mFerNom = $pFerNom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationAttenteFermeVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationAttenteFermeVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptSolde de la OperationAttenteFermeVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre CptSolde de la OperationAttenteFermeVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAttenteFermeVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAttenteFermeVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la OperationAttenteFermeVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la OperationAttenteFermeVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}
	
	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return array(ChampComplementaireDetailOperationVO)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAttenteFermeVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param array(ChampComplementaireDetailOperationVO)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAttenteFermeVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}

	/**
	* @name addOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param array(ChampComplementaireDetailOperationVO)
	* @desc Ajout $pOpeTypePaiementChampComplementaire au membre OpeTypePaiementChampComplementaire de la OperationAttenteFermeVO par 
	*/
	public function addOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		array_push($this->mOpeTypePaiementChampComplementaire, $pOpeTypePaiementChampComplementaire);
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAttenteFermeVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAttenteFermeVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAttenteFermeVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAttenteFermeVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationAttenteFermeVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationAttenteFermeVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

}
?>