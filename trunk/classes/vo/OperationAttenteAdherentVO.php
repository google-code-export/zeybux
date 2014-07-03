<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : OperationAttenteAdherentVO.php
//
// Description : Classe OperationAttenteAdherentVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAttenteAdherentVO
 * @author Julien PIERRE
 * @since 12/05/2012
 * @desc Classe représentant une OperationAttenteAdherentVO
 */
class OperationAttenteAdherentVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc AdhId de la OperationAttenteAdherentVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(20)
	* @desc AdhNumero de la OperationAttenteAdherentVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la OperationAttenteAdherentVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la OperationAttenteAdherentVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la OperationAttenteAdherentVO
	*/
	protected $mCptLabel;

	/**
	* @var decimal(10,2)
	* @desc CptSolde de la OperationAttenteAdherentVO
	*/
	protected $mCptSolde;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAttenteAdherentVO
	*/
	protected $mOpeMontant;

	/**
	* @var int(11)
	* @desc OpeTypePaiement de la OperationAttenteAdherentVO
	*/
	protected $mOpeTypePaiement;

	/**
	* @var array(ChampComplementaireDetailOperationVO)
	* @desc OpeTypePaiementChampComplementaire de la OperationAttenteAdherentVO
	*/
	protected $mOpeTypePaiementChampComplementaire;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAttenteAdherentVO
	*/
	protected $mOpeDate;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAttenteAdherentVO
	*/
	protected $mOpeLibelle;

	/**
	* @var int(11)
	* @desc OpeId de la OperationAttenteAdherentVO
	*/
	protected $mOpeId;

	/**
	 * @var int(11)
	 * @desc IdRemiseCheque de la OperationAttenteAdherentVO
	 */
	protected $mIdRemiseCheque;

	/**
	 * @var int(11)
	 * @desc NumeroRemiseCheque de la OperationAttenteAdherentVO
	 */
	protected $mNumeroRemiseCheque;
	
	/**
	 * @name OperationAttenteAdherentVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function OperationAttenteAdherentVO($pAdhId = null, $pAdhNumero = null, $pAdhNom = null, $pAdhPrenom = null, $pCptLabel = null, $pCptSolde = null,
			$pOpeMontant = null, $pOpeTypePaiement = null, $pOpeTypePaiementChamComplementaire = null, $pOpeDate = null, $pOpeLibelle = null, $pOpeId = null, $pIdRemiseCheque = null, $pNumeroRemiseCheque = null) {
		if(!is_null($pAdhId)) {$this->mAdhId = $pAdhId; }
		if(!is_null($pAdhNumero)) {$this->mAdhNumero = $pAdhNumero; }
		if(!is_null($pAdhNom)) {$this->mAdhNom = $pAdhNom; }
		if(!is_null($pAdhPrenom)) {$this->mAdhPrenom = $pAdhPrenom; }
		if(!is_null($pCptLabel)) {$this->mCptLabel = $pCptLabel; }
		if(!is_null($pCptSolde)) {$this->mCptSolde = $pCptSolde; }
		if(!is_null($pOpeMontant)) {$this->mOpeMontant = $pOpeMontant; }
		if(!is_null($pOpeTypePaiement)) {$this->mOpeTypePaiement = $pOpeTypePaiement; }
		if(!is_null($pOpeTypePaiementChamComplementaire)) {$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChamComplementaire; } else { $this->mOpeTypePaiementChampComplementaire = array();}
		if(!is_null($pOpeDate)) {$this->mOpeDate = $pOpeDate; }
		if(!is_null($pOpeLibelle)) {$this->mOpeLibelle = $pOpeLibelle; }
		if(!is_null($pOpeId)) {$this->mOpeId = $pOpeId; }
		if(!is_null($pIdRemiseCheque)) {$this->mIdRemiseCheque = $pIdRemiseCheque; }
		if(!is_null($pNumeroRemiseCheque)) {$this->mNumeroRemiseCheque = $pNumeroRemiseCheque; }
	}
	
	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la OperationAttenteAdherentVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la OperationAttenteAdherentVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la OperationAttenteAdherentVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la OperationAttenteAdherentVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la OperationAttenteAdherentVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la OperationAttenteAdherentVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la OperationAttenteAdherentVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la OperationAttenteAdherentVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la OperationAttenteAdherentVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la OperationAttenteAdherentVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre CptSolde de la OperationAttenteAdherentVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre CptSolde de la OperationAttenteAdherentVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAttenteAdherentVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAttenteAdherentVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre OpeTypePaiement de la OperationAttenteAdherentVO
	*/
	public function getOpeTypePaiement() {
		return $this->mOpeTypePaiement;
	}

	/**
	* @name setOpeTypePaiement($pOpeTypePaiement)
	* @param int(11)
	* @desc Remplace le membre OpeTypePaiement de la OperationAttenteAdherentVO par $pOpeTypePaiement
	*/
	public function setOpeTypePaiement($pOpeTypePaiement) {
		$this->mOpeTypePaiement = $pOpeTypePaiement;
	}

	/**
	* @name getOpeTypePaiementChampComplementaire()
	* @return array(ChampComplementaireDetailOperationVO)
	* @desc Renvoie le membre OpeTypePaiementChampComplementaire de la OperationAttenteAdherentVO
	*/
	public function getOpeTypePaiementChampComplementaire() {
		return $this->mOpeTypePaiementChampComplementaire;
	}

	/**
	* @name setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param array(ChampComplementaireDetailOperationVO)
	* @desc Remplace le membre OpeTypePaiementChampComplementaire de la OperationAttenteAdherentVO par $pOpeTypePaiementChampComplementaire
	*/
	public function setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		$this->mOpeTypePaiementChampComplementaire = $pOpeTypePaiementChampComplementaire;
	}

	/**
	* @name addOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire)
	* @param array(ChampComplementaireDetailOperationVO)
	* @desc Ajout $pOpeTypePaiementChampComplementaire au membre OpeTypePaiementChampComplementaire de la OperationAttenteAdherentVO par 
	*/
	public function addOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire) {
		array_push($this->mOpeTypePaiementChampComplementaire, $pOpeTypePaiementChampComplementaire);
	}
	
	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAttenteAdherentVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAttenteAdherentVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAttenteAdherentVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAttenteAdherentVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la OperationAttenteAdherentVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la OperationAttenteAdherentVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	 * @name getIdRemiseCheque()
	 * @return int(11)
	 * @desc Renvoie le membre IdRemiseCheque de la OperationAttenteAdherentVO
	 */
	public function getIdRemiseCheque() {
		return $this->mIdRemiseCheque;
	}
	
	/**
	 * @name setIdRemiseCheque($pIdRemiseCheque)
	 * @param int(11)
	 * @desc Remplace le membre IdRemiseCheque de la OperationAttenteAdherentVO par $pIdRemiseCheque
	 */
	public function setIdRemiseCheque($pIdRemiseCheque) {
		$this->mIdRemiseCheque = $pIdRemiseCheque;
	}

	/**
	 * @name getNumeroRemiseCheque()
	 * @return int(11)
	 * @desc Renvoie le membre NumeroRemiseCheque de la OperationAttenteAdherentVO
	 */
	public function getNumeroRemiseCheque() {
		return $this->mNumeroRemiseCheque;
	}
	
	/**
	 * @name setNumeroRemiseCheque($pNumeroRemiseCheque)
	 * @param int(11)
	 * @desc Remplace le membre NumeroRemiseCheque de la OperationAttenteAdherentVO par $pNumeroRemiseCheque
	 */
	public function setNumeroRemiseCheque($pNumeroRemiseCheque) {
		$this->mNumeroRemiseCheque = $pNumeroRemiseCheque;
	}
}
?>