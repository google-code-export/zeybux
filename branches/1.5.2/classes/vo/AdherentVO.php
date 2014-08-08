<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2010
// Fichier : AdherentVO.php
//
// Description : Classe AdherentVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdherentVO
 * @author Julien PIERRE
 * @since 25/01/2010
 * @desc Classe représentant une AdherentVO
 */
class AdherentVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AdherentVO
	*/
	protected $mId;
	
	/**
	* @var varchar(5)
	* @desc Numero de la AdherentVO
	*/
	protected $mNumero;

	/**
	* @var int(11)
	* @desc IdCompte de la AdherentVO
	*/
	protected $mIdCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la AdherentVO
	*/
	protected $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la AdherentVO
	*/
	protected $mPrenom;

	/**
	* @var varchar(100)
	* @desc CourrielPrincipal de la AdherentVO
	*/
	protected $mCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc CourrielSecondaire de la AdherentVO
	*/
	protected $mCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc TelephonePrincipal de la AdherentVO
	*/
	protected $mTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc TelephoneSecondaire de la AdherentVO
	*/
	protected $mTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc Adresse de la AdherentVO
	*/
	protected $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la AdherentVO
	*/
	protected $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la AdherentVO
	*/
	protected $mVille;

	/**
	* @var date
	* @desc DateNaissance de la AdherentVO
	*/
	protected $mDateNaissance;

	/**
	* @var date
	* @desc DateAdhesion de la AdherentVO
	*/
	protected $mDateAdhesion;

	/**
	* @var datetime
	* @desc DateMaj de la AdherentVO
	*/
	protected $mDateMaj;

	/**
	* @var text
	* @desc Commentaire de la AdherentVO
	*/
	protected $mCommentaire;
	
	/**
	* @var tinyint(1)
	* @desc Etat de la AdherentVO
	*/
	protected $mEtat;
	
	/**
	 * @var array(OperationVO) 
	 * @desc liste des opérations de l'adhérent
	 */
	protected $mListeOperation;

	/**
	 * @var array(ModuleVO) 
	 * @desc liste des Modules autorisés à l'adhérent
	 */
	protected $mListeModule;
	
	/**
	 * @name AdherentVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function AdherentVO($pId = null, $pNumero = null, $pIdCompte = null, $pNom = null, $pPrenom = null, $pCourrielPrincipal = null, $pCourrielSecondaire = null, $pTelephonePrincipal = null, $pTelephoneSecondaire = null, $pAdresse = null, $pCodePostal = null, $pVille = null, $pDateNaissance = null, $pDateAdhesion = null, $pDateMaj = null, $pCommentaire = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pNumero)) { $this->mNumero = $pNumero; }
		if(!is_null($pIdCompte)) { $this->mIdCompte = $pIdCompte; }
		if(!is_null($pNom)) { $this->mNom = $pNom; }
		if(!is_null($pPrenom)) { $this->mPrenom = $pPrenom; }
		if(!is_null($pCourrielPrincipal)) { $this->mCourrielPrincipal = $pCourrielPrincipal; }
		if(!is_null($pCourrielSecondaire)) { $this->mCourrielSecondaire = $pCourrielSecondaire; }
		if(!is_null($pTelephonePrincipal)) { $this->mTelephonePrincipal = $pTelephonePrincipal; }
		if(!is_null($pTelephoneSecondaire)) { $this->mTelephoneSecondaire = $pTelephoneSecondaire; }
		if(!is_null($pAdresse)) { $this->mAdresse = $pAdresse; }
		if(!is_null($pCodePostal)) { $this->mCodePostal = $pCodePostal; }
		if(!is_null($pVille)) { $this->mVille = $pVille; }
		if(!is_null($pDateNaissance)) { $this->mDateNaissance = $pDateNaissance; }
		if(!is_null($pDateAdhesion)) { $this->mDateAdhesion = $pDateAdhesion; }
		if(!is_null($pDateMaj)) { $this->mDateMaj = $pDateMaj; }
		if(!is_null($pCommentaire)) { $this->mCommentaire = $pCommentaire; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}
	
	/**
	* @name getId()
	* @return integer
	* @desc Renvoie l'Id de l'Adherent
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AdherentVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return varchar(5)
	* @desc Renvoie le membre Numero de la AdherentVO
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param varchar(5)
	* @desc Remplace le membre Numero de la AdherentVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la AdherentVO
	*/
	public function getIdCompte(){
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la AdherentVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la AdherentVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la AdherentVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre Prenom de la AdherentVO
	*/
	public function getPrenom() {
		return $this->mPrenom;
	}

	/**
	* @name setPrenom($pPrenom)
	* @param varchar(50)
	* @desc Remplace le membre Prenom de la AdherentVO par $pPrenom
	*/
	public function setPrenom($pPrenom) {
		$this->mPrenom = $pPrenom;
	}

	/**
	* @name getCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielPrincipal de la AdherentVO
	*/
	public function getCourrielPrincipal() {
		return $this->mCourrielPrincipal;
	}

	/**
	* @name setCourrielPrincipal($pCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre CourrielPrincipal de la AdherentVO par $pCourrielPrincipal
	*/
	public function setCourrielPrincipal($pCourrielPrincipal) {
		$this->mCourrielPrincipal = $pCourrielPrincipal;
	}

	/**
	* @name getCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre CourrielSecondaire de la AdherentVO
	*/
	public function getCourrielSecondaire() {
		return $this->mCourrielSecondaire;
	}

	/**
	* @name setCourrielSecondaire($pCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre CourrielSecondaire de la AdherentVO par $pCourrielSecondaire
	*/
	public function setCourrielSecondaire($pCourrielSecondaire) {
		$this->mCourrielSecondaire = $pCourrielSecondaire;
	}

	/**
	* @name getTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre TelephonePrincipal de la AdherentVO
	*/
	public function getTelephonePrincipal() {
		return $this->mTelephonePrincipal;
	}

	/**
	* @name setTelephonePrincipal($pTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre TelephonePrincipal de la AdherentVO par $pTelephonePrincipal
	*/
	public function setTelephonePrincipal($pTelephonePrincipal) {
		$this->mTelephonePrincipal = $pTelephonePrincipal;
	}

	/**
	* @name getTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre TelephoneSecondaire de la AdherentVO
	*/
	public function getTelephoneSecondaire() {
		return $this->mTelephoneSecondaire;
	}

	/**
	* @name setTelephoneSecondaire($pTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre TelephoneSecondaire de la AdherentVO par $pTelephoneSecondaire
	*/
	public function setTelephoneSecondaire($pTelephoneSecondaire) {
		$this->mTelephoneSecondaire = $pTelephoneSecondaire;
	}

	/**
	* @name getAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre Adresse de la AdherentVO
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param varchar(300)
	* @desc Remplace le membre Adresse de la AdherentVO par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre CodePostal de la AdherentVO
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre CodePostal de la AdherentVO par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return varchar(100)
	* @desc Renvoie le membre Ville de la AdherentVO
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param varchar(100)
	* @desc Remplace le membre Ville de la AdherentVO par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateNaissance()
	* @return date
	* @desc Renvoie le membre DateNaissance de la AdherentVO
	*/
	public function getDateNaissance() {
		return $this->mDateNaissance;
	}

	/**
	* @name setDateNaissance($pDateNaissance)
	* @param date
	* @desc Remplace le membre DateNaissance de la AdherentVO par $pDateNaissance
	*/
	public function setDateNaissance($pDateNaissance) {
		$this->mDateNaissance = $pDateNaissance;
	}

	/**
	* @name getDateAdhesion()
	* @return date
	* @desc Renvoie le membre DateAdhesion de la AdherentVO
	*/
	public function getDateAdhesion() {
		return $this->mDateAdhesion;
	}

	/**
	* @name setDateAdhesion($pDateAdhesion)
	* @param date
	* @desc Remplace le membre DateAdhesion de la AdherentVO par $pDateAdhesion
	*/
	public function setDateAdhesion($pDateAdhesion) {
		$this->mDateAdhesion = $pDateAdhesion;
	}

	/**
	* @name getDateMaj()
	* @return datetime
	* @desc Renvoie le membre DateMaj de la AdherentVO
	*/
	public function getDateMaj() {
		return $this->mDateMaj;
	}

	/**
	* @name setDateMaj($pDateMaj)
	* @param datetime
	* @desc Remplace le membre DateMaj de la AdherentVO par $pDateMaj
	*/
	public function setDateMaj($pDateMaj) {
		$this->mDateMaj = $pDateMaj;
	}

	/**
	* @name getCommentaire()
	* @return text
	* @desc Renvoie le membre Commentaire de la AdherentVO
	*/
	public function getCommentaire() {
		return $this->mCommentaire;
	}

	/**
	* @name setCommentaire($pCommentaire)
	* @param text
	* @desc Remplace le membre Commentaire de la AdherentVO par $pCommentaire
	*/
	public function setCommentaire($pCommentaire) {
		$this->mCommentaire = $pCommentaire;
	}
	
	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la AdherentVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la AdherentVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

	/**
	* @name getListeOperation()
	* @return array(OperationVO)
	* @desc Renvoie la ListeOperation de l'Adherent
	*/
	public function getListeOperation() {
		return $this->mListeOperation;
	}

	/**
	* @name setListeOperation($pListeOperation)
	* @param array(OperationVO)
	* @desc Remplace la ListeOperation dans l'Adherent par $pListeOperation
	*/
	public function setListeOperation($pListeOperation) {
		$this->mListeOperation = $pListeOperation;
	}

	/**
	* @name getListeModule()
	* @return array(ModuleVO)
	* @desc Renvoie la ListeModule de l'Adherent
	*/
	public function getListeModule() {
		return $this->mListeModule;
	}

	/**
	* @name setListeModule($pListeModule)
	* @param array(ModuleVO)
	* @desc Remplace la ListeModule dans l'Adherent par $pListeModule
	*/
	public function setListeModule($pListeModule) {
		$this->mListeModule = $pListeModule;
	}
}
?>
