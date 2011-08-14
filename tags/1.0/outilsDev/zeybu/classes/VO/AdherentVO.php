<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : AdherentVO.php
//
// Description : Classe AdherentVO
//
//****************************************************************

/**
 * @name AdherentVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une AdherentVO
 */
class AdherentVO
{
	/**
	* @var int(11)
	* @desc Id de la AdherentVO
	*/
	private $mId;

	/**
	* @var varchar(100)
	* @desc MotPasse de la AdherentVO
	*/
	private $mMotPasse;

	/**
	* @var varchar(5)
	* @desc Numero de la AdherentVO
	*/
	private $mNumero;

	/**
	* @var int(11)
	* @desc IdCompte de la AdherentVO
	*/
	private $mIdCompte;

	/**
	* @var varchar(50)
	* @desc Nom de la AdherentVO
	*/
	private $mNom;

	/**
	* @var varchar(50)
	* @desc Prenom de la AdherentVO
	*/
	private $mPrenom;

	/**
	* @var varchar(100)
	* @desc CourrielPrincipal de la AdherentVO
	*/
	private $mCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc CourrielSecondaire de la AdherentVO
	*/
	private $mCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc TelephonePrincipal de la AdherentVO
	*/
	private $mTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc TelephoneSecondaire de la AdherentVO
	*/
	private $mTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc Adresse de la AdherentVO
	*/
	private $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la AdherentVO
	*/
	private $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la AdherentVO
	*/
	private $mVille;

	/**
	* @var date
	* @desc DateNaissance de la AdherentVO
	*/
	private $mDateNaissance;

	/**
	* @var date
	* @desc DateAdhesion de la AdherentVO
	*/
	private $mDateAdhesion;

	/**
	* @var datetime
	* @desc DateMaj de la AdherentVO
	*/
	private $mDateMaj;

	/**
	* @var text
	* @desc Commentaire de la AdherentVO
	*/
	private $mCommentaire;

	/**
	* @var tinyint(1)
	* @desc SuperZeybu de la AdherentVO
	*/
	private $mSuperZeybu;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AdherentVO
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
	* @name getMotPasse()
	* @return varchar(100)
	* @desc Renvoie le membre MotPasse de la AdherentVO
	*/
	public function getMotPasse(){
		return $this->mMotPasse;
	}

	/**
	* @name setMotPasse($pMotPasse)
	* @param varchar(100)
	* @desc Remplace le membre MotPasse de la AdherentVO par $pMotPasse
	*/
	public function setMotPasse($pMotPasse) {
		$this->mMotPasse = $pMotPasse;
	}

	/**
	* @name getNumero()
	* @return varchar(5)
	* @desc Renvoie le membre Numero de la AdherentVO
	*/
	public function getNumero(){
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
	public function getNom(){
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
	public function getPrenom(){
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
	public function getCourrielPrincipal(){
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
	public function getCourrielSecondaire(){
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
	public function getTelephonePrincipal(){
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
	public function getTelephoneSecondaire(){
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
	public function getAdresse(){
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
	public function getCodePostal(){
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
	public function getVille(){
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
	public function getDateNaissance(){
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
	public function getDateAdhesion(){
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
	public function getDateMaj(){
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
	public function getCommentaire(){
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
	* @name getSuperZeybu()
	* @return tinyint(1)
	* @desc Renvoie le membre SuperZeybu de la AdherentVO
	*/
	public function getSuperZeybu(){
		return $this->mSuperZeybu;
	}

	/**
	* @name setSuperZeybu($pSuperZeybu)
	* @param tinyint(1)
	* @desc Remplace le membre SuperZeybu de la AdherentVO par $pSuperZeybu
	*/
	public function setSuperZeybu($pSuperZeybu) {
		$this->mSuperZeybu = $pSuperZeybu;
	}

}
?>