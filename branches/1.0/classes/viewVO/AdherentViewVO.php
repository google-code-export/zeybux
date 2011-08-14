<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : AdherentViewVO.php
//
// Description : Classe AdherentViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AdherentViewVO
 * @author Julien PIERRE
 * @since 08/09/2010
 * @desc Classe représentant une AdherentViewVO
 */
class AdherentViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la AdherentViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la AdherentViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhIdCompte de la AdherentViewVO
	*/
	protected $mAdhIdCompte;
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la AdherentViewVO
	*/
	protected $mCptLabel;

	/**
	* @var varchar(50)
	* @desc AdhNom de la AdherentViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la AdherentViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(100)
	* @desc AdhCourrielPrincipal de la AdherentViewVO
	*/
	protected $mAdhCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc AdhCourrielSecondaire de la AdherentViewVO
	*/
	protected $mAdhCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc AdhTelephonePrincipal de la AdherentViewVO
	*/
	protected $mAdhTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc AdhTelephoneSecondaire de la AdherentViewVO
	*/
	protected $mAdhTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc AdhAdresse de la AdherentViewVO
	*/
	protected $mAdhAdresse;

	/**
	* @var varchar(10)
	* @desc AdhCodePostal de la AdherentViewVO
	*/
	protected $mAdhCodePostal;

	/**
	* @var varchar(100)
	* @desc AdhVille de la AdherentViewVO
	*/
	protected $mAdhVille;

	/**
	* @var date
	* @desc AdhDateNaissance de la AdherentViewVO
	*/
	protected $mAdhDateNaissance;

	/**
	* @var date
	* @desc AdhDateAdhesion de la AdherentViewVO
	*/
	protected $mAdhDateAdhesion;

	/**
	* @var datetime
	* @desc AdhDateMaj de la AdherentViewVO
	*/
	protected $mAdhDateMaj;

	/**
	* @var text
	* @desc AdhCommentaire de la AdherentViewVO
	*/
	protected $mAdhCommentaire;

	/**
	* @var decimal(32,2)
	* @desc CptSolde de la AdherentViewVO
	*/
	protected $mCptSolde;
	
	/**
	* @var tinyint(1)
	* @desc AdhEtat de la AdherentViewVO
	*/
	protected $mAdhEtat;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la AdherentViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la AdherentViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la AdherentViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la AdherentViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}
	
	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la AdherentViewVO
	*/
	public function getAdhIdCompte() {
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la AdherentViewVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la AdherentViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la AdherentViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la AdherentViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la AdherentViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la AdherentViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la AdherentViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getAdhCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre AdhCourrielPrincipal de la AdherentViewVO
	*/
	public function getAdhCourrielPrincipal() {
		return $this->mAdhCourrielPrincipal;
	}

	/**
	* @name setAdhCourrielPrincipal($pAdhCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre AdhCourrielPrincipal de la AdherentViewVO par $pAdhCourrielPrincipal
	*/
	public function setAdhCourrielPrincipal($pAdhCourrielPrincipal) {
		$this->mAdhCourrielPrincipal = $pAdhCourrielPrincipal;
	}

	/**
	* @name getAdhCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre AdhCourrielSecondaire de la AdherentViewVO
	*/
	public function getAdhCourrielSecondaire() {
		return $this->mAdhCourrielSecondaire;
	}

	/**
	* @name setAdhCourrielSecondaire($pAdhCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre AdhCourrielSecondaire de la AdherentViewVO par $pAdhCourrielSecondaire
	*/
	public function setAdhCourrielSecondaire($pAdhCourrielSecondaire) {
		$this->mAdhCourrielSecondaire = $pAdhCourrielSecondaire;
	}

	/**
	* @name getAdhTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre AdhTelephonePrincipal de la AdherentViewVO
	*/
	public function getAdhTelephonePrincipal() {
		return $this->mAdhTelephonePrincipal;
	}

	/**
	* @name setAdhTelephonePrincipal($pAdhTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre AdhTelephonePrincipal de la AdherentViewVO par $pAdhTelephonePrincipal
	*/
	public function setAdhTelephonePrincipal($pAdhTelephonePrincipal) {
		$this->mAdhTelephonePrincipal = $pAdhTelephonePrincipal;
	}

	/**
	* @name getAdhTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre AdhTelephoneSecondaire de la AdherentViewVO
	*/
	public function getAdhTelephoneSecondaire() {
		return $this->mAdhTelephoneSecondaire;
	}

	/**
	* @name setAdhTelephoneSecondaire($pAdhTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre AdhTelephoneSecondaire de la AdherentViewVO par $pAdhTelephoneSecondaire
	*/
	public function setAdhTelephoneSecondaire($pAdhTelephoneSecondaire) {
		$this->mAdhTelephoneSecondaire = $pAdhTelephoneSecondaire;
	}

	/**
	* @name getAdhAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre AdhAdresse de la AdherentViewVO
	*/
	public function getAdhAdresse() {
		return $this->mAdhAdresse;
	}

	/**
	* @name setAdhAdresse($pAdhAdresse)
	* @param varchar(300)
	* @desc Remplace le membre AdhAdresse de la AdherentViewVO par $pAdhAdresse
	*/
	public function setAdhAdresse($pAdhAdresse) {
		$this->mAdhAdresse = $pAdhAdresse;
	}

	/**
	* @name getAdhCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre AdhCodePostal de la AdherentViewVO
	*/
	public function getAdhCodePostal() {
		return $this->mAdhCodePostal;
	}

	/**
	* @name setAdhCodePostal($pAdhCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre AdhCodePostal de la AdherentViewVO par $pAdhCodePostal
	*/
	public function setAdhCodePostal($pAdhCodePostal) {
		$this->mAdhCodePostal = $pAdhCodePostal;
	}

	/**
	* @name getAdhVille()
	* @return varchar(100)
	* @desc Renvoie le membre AdhVille de la AdherentViewVO
	*/
	public function getAdhVille() {
		return $this->mAdhVille;
	}

	/**
	* @name setAdhVille($pAdhVille)
	* @param varchar(100)
	* @desc Remplace le membre AdhVille de la AdherentViewVO par $pAdhVille
	*/
	public function setAdhVille($pAdhVille) {
		$this->mAdhVille = $pAdhVille;
	}

	/**
	* @name getAdhDateNaissance()
	* @return date
	* @desc Renvoie le membre AdhDateNaissance de la AdherentViewVO
	*/
	public function getAdhDateNaissance() {
		return $this->mAdhDateNaissance;
	}

	/**
	* @name setAdhDateNaissance($pAdhDateNaissance)
	* @param date
	* @desc Remplace le membre AdhDateNaissance de la AdherentViewVO par $pAdhDateNaissance
	*/
	public function setAdhDateNaissance($pAdhDateNaissance) {
		$this->mAdhDateNaissance = $pAdhDateNaissance;
	}

	/**
	* @name getAdhDateAdhesion()
	* @return date
	* @desc Renvoie le membre AdhDateAdhesion de la AdherentViewVO
	*/
	public function getAdhDateAdhesion() {
		return $this->mAdhDateAdhesion;
	}

	/**
	* @name setAdhDateAdhesion($pAdhDateAdhesion)
	* @param date
	* @desc Remplace le membre AdhDateAdhesion de la AdherentViewVO par $pAdhDateAdhesion
	*/
	public function setAdhDateAdhesion($pAdhDateAdhesion) {
		$this->mAdhDateAdhesion = $pAdhDateAdhesion;
	}

	/**
	* @name getAdhDateMaj()
	* @return datetime
	* @desc Renvoie le membre AdhDateMaj de la AdherentViewVO
	*/
	public function getAdhDateMaj() {
		return $this->mAdhDateMaj;
	}

	/**
	* @name setAdhDateMaj($pAdhDateMaj)
	* @param datetime
	* @desc Remplace le membre AdhDateMaj de la AdherentViewVO par $pAdhDateMaj
	*/
	public function setAdhDateMaj($pAdhDateMaj) {
		$this->mAdhDateMaj = $pAdhDateMaj;
	}

	/**
	* @name getAdhCommentaire()
	* @return text
	* @desc Renvoie le membre AdhCommentaire de la AdherentViewVO
	*/
	public function getAdhCommentaire() {
		return $this->mAdhCommentaire;
	}

	/**
	* @name setAdhCommentaire($pAdhCommentaire)
	* @param text
	* @desc Remplace le membre AdhCommentaire de la AdherentViewVO par $pAdhCommentaire
	*/
	public function setAdhCommentaire($pAdhCommentaire) {
		$this->mAdhCommentaire = $pAdhCommentaire;
	}

	/**
	* @name getCptSolde()
	* @return decimal(32,2)
	* @desc Renvoie le membre CptSolde de la AdherentViewVO
	*/
	public function getCptSolde() {
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(32,2)
	* @desc Remplace le membre CptSolde de la AdherentViewVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}
	
	/**
	* @name getAdhEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre AdhEtat de la AdherentViewVO
	*/
	public function getAdhEtat() {
		return $this->mAdhEtat;
	}

	/**
	* @name setAdhEtat($pAdhEtat)
	* @param tinyint(1)
	* @desc Remplace le membre AdhEtat de la AdherentViewVO par $pAdhEtat
	*/
	public function setAdhEtat($pAdhEtat) {
		$this->mAdhEtat = $pAdhEtat;
	}
}
?>