<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : ProducteurViewVO.php
//
// Description : Classe ProducteurViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProducteurViewVO
 * @author Julien PIERRE
 * @since 31/10/2011
 * @desc Classe représentant une ProducteurViewVO
 */
class ProducteurViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc PrdtId de la ProducteurViewVO
	*/
	protected $mPrdtId;

	/**
	* @var int(11)
	* @desc PrdtIdFerme de la ProducteurViewVO
	*/
	protected $mPrdtIdFerme;

	/**
	* @var varchar(20)
	* @desc PrdtNumero de la ProducteurViewVO
	*/
	protected $mPrdtNumero;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la ProducteurViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la ProducteurViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @var varchar(100)
	* @desc PrdtCourrielPrincipal de la ProducteurViewVO
	*/
	protected $mPrdtCourrielPrincipal;

	/**
	* @var varchar(100)
	* @desc PrdtCourrielSecondaire de la ProducteurViewVO
	*/
	protected $mPrdtCourrielSecondaire;

	/**
	* @var varchar(20)
	* @desc PrdtTelephonePrincipal de la ProducteurViewVO
	*/
	protected $mPrdtTelephonePrincipal;

	/**
	* @var varchar(20)
	* @desc PrdtTelephoneSecondaire de la ProducteurViewVO
	*/
	protected $mPrdtTelephoneSecondaire;

	/**
	* @var varchar(300)
	* @desc PrdtAdresse de la ProducteurViewVO
	*/
	protected $mPrdtAdresse;

	/**
	* @var varchar(10)
	* @desc PrdtCodePostal de la ProducteurViewVO
	*/
	protected $mPrdtCodePostal;

	/**
	* @var varchar(100)
	* @desc PrdtVille de la ProducteurViewVO
	*/
	protected $mPrdtVille;

	/**
	* @var date
	* @desc PrdtDateNaissance de la ProducteurViewVO
	*/
	protected $mPrdtDateNaissance;

	/**
	* @var text
	* @desc PrdtCommentaire de la ProducteurViewVO
	*/
	protected $mPrdtCommentaire;

	/**
	* @name getPrdtId()
	* @return int(11)
	* @desc Renvoie le membre PrdtId de la ProducteurViewVO
	*/
	public function getPrdtId() {
		return $this->mPrdtId;
	}

	/**
	* @name setPrdtId($pPrdtId)
	* @param int(11)
	* @desc Remplace le membre PrdtId de la ProducteurViewVO par $pPrdtId
	*/
	public function setPrdtId($pPrdtId) {
		$this->mPrdtId = $pPrdtId;
	}

	/**
	* @name getPrdtIdFerme()
	* @return int(11)
	* @desc Renvoie le membre PrdtIdFerme de la ProducteurViewVO
	*/
	public function getPrdtIdFerme() {
		return $this->mPrdtIdFerme;
	}

	/**
	* @name setPrdtIdFerme($pPrdtIdFerme)
	* @param int(11)
	* @desc Remplace le membre PrdtIdFerme de la ProducteurViewVO par $pPrdtIdFerme
	*/
	public function setPrdtIdFerme($pPrdtIdFerme) {
		$this->mPrdtIdFerme = $pPrdtIdFerme;
	}

	/**
	* @name getPrdtNumero()
	* @return varchar(20)
	* @desc Renvoie le membre PrdtNumero de la ProducteurViewVO
	*/
	public function getPrdtNumero() {
		return $this->mPrdtNumero;
	}

	/**
	* @name setPrdtNumero($pPrdtNumero)
	* @param varchar(20)
	* @desc Remplace le membre PrdtNumero de la ProducteurViewVO par $pPrdtNumero
	*/
	public function setPrdtNumero($pPrdtNumero) {
		$this->mPrdtNumero = $pPrdtNumero;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la ProducteurViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la ProducteurViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la ProducteurViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la ProducteurViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

	/**
	* @name getPrdtCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre PrdtCourrielPrincipal de la ProducteurViewVO
	*/
	public function getPrdtCourrielPrincipal() {
		return $this->mPrdtCourrielPrincipal;
	}

	/**
	* @name setPrdtCourrielPrincipal($pPrdtCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre PrdtCourrielPrincipal de la ProducteurViewVO par $pPrdtCourrielPrincipal
	*/
	public function setPrdtCourrielPrincipal($pPrdtCourrielPrincipal) {
		$this->mPrdtCourrielPrincipal = $pPrdtCourrielPrincipal;
	}

	/**
	* @name getPrdtCourrielSecondaire()
	* @return varchar(100)
	* @desc Renvoie le membre PrdtCourrielSecondaire de la ProducteurViewVO
	*/
	public function getPrdtCourrielSecondaire() {
		return $this->mPrdtCourrielSecondaire;
	}

	/**
	* @name setPrdtCourrielSecondaire($pPrdtCourrielSecondaire)
	* @param varchar(100)
	* @desc Remplace le membre PrdtCourrielSecondaire de la ProducteurViewVO par $pPrdtCourrielSecondaire
	*/
	public function setPrdtCourrielSecondaire($pPrdtCourrielSecondaire) {
		$this->mPrdtCourrielSecondaire = $pPrdtCourrielSecondaire;
	}

	/**
	* @name getPrdtTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre PrdtTelephonePrincipal de la ProducteurViewVO
	*/
	public function getPrdtTelephonePrincipal() {
		return $this->mPrdtTelephonePrincipal;
	}

	/**
	* @name setPrdtTelephonePrincipal($pPrdtTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre PrdtTelephonePrincipal de la ProducteurViewVO par $pPrdtTelephonePrincipal
	*/
	public function setPrdtTelephonePrincipal($pPrdtTelephonePrincipal) {
		$this->mPrdtTelephonePrincipal = $pPrdtTelephonePrincipal;
	}

	/**
	* @name getPrdtTelephoneSecondaire()
	* @return varchar(20)
	* @desc Renvoie le membre PrdtTelephoneSecondaire de la ProducteurViewVO
	*/
	public function getPrdtTelephoneSecondaire() {
		return $this->mPrdtTelephoneSecondaire;
	}

	/**
	* @name setPrdtTelephoneSecondaire($pPrdtTelephoneSecondaire)
	* @param varchar(20)
	* @desc Remplace le membre PrdtTelephoneSecondaire de la ProducteurViewVO par $pPrdtTelephoneSecondaire
	*/
	public function setPrdtTelephoneSecondaire($pPrdtTelephoneSecondaire) {
		$this->mPrdtTelephoneSecondaire = $pPrdtTelephoneSecondaire;
	}

	/**
	* @name getPrdtAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre PrdtAdresse de la ProducteurViewVO
	*/
	public function getPrdtAdresse() {
		return $this->mPrdtAdresse;
	}

	/**
	* @name setPrdtAdresse($pPrdtAdresse)
	* @param varchar(300)
	* @desc Remplace le membre PrdtAdresse de la ProducteurViewVO par $pPrdtAdresse
	*/
	public function setPrdtAdresse($pPrdtAdresse) {
		$this->mPrdtAdresse = $pPrdtAdresse;
	}

	/**
	* @name getPrdtCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre PrdtCodePostal de la ProducteurViewVO
	*/
	public function getPrdtCodePostal() {
		return $this->mPrdtCodePostal;
	}

	/**
	* @name setPrdtCodePostal($pPrdtCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre PrdtCodePostal de la ProducteurViewVO par $pPrdtCodePostal
	*/
	public function setPrdtCodePostal($pPrdtCodePostal) {
		$this->mPrdtCodePostal = $pPrdtCodePostal;
	}

	/**
	* @name getPrdtVille()
	* @return varchar(100)
	* @desc Renvoie le membre PrdtVille de la ProducteurViewVO
	*/
	public function getPrdtVille() {
		return $this->mPrdtVille;
	}

	/**
	* @name setPrdtVille($pPrdtVille)
	* @param varchar(100)
	* @desc Remplace le membre PrdtVille de la ProducteurViewVO par $pPrdtVille
	*/
	public function setPrdtVille($pPrdtVille) {
		$this->mPrdtVille = $pPrdtVille;
	}

	/**
	* @name getPrdtDateNaissance()
	* @return date
	* @desc Renvoie le membre PrdtDateNaissance de la ProducteurViewVO
	*/
	public function getPrdtDateNaissance() {
		return $this->mPrdtDateNaissance;
	}

	/**
	* @name setPrdtDateNaissance($pPrdtDateNaissance)
	* @param date
	* @desc Remplace le membre PrdtDateNaissance de la ProducteurViewVO par $pPrdtDateNaissance
	*/
	public function setPrdtDateNaissance($pPrdtDateNaissance) {
		$this->mPrdtDateNaissance = $pPrdtDateNaissance;
	}

	/**
	* @name getPrdtCommentaire()
	* @return text
	* @desc Renvoie le membre PrdtCommentaire de la ProducteurViewVO
	*/
	public function getPrdtCommentaire() {
		return $this->mPrdtCommentaire;
	}

	/**
	* @name setPrdtCommentaire($pPrdtCommentaire)
	* @param text
	* @desc Remplace le membre PrdtCommentaire de la ProducteurViewVO par $pPrdtCommentaire
	*/
	public function setPrdtCommentaire($pPrdtCommentaire) {
		$this->mPrdtCommentaire = $pPrdtCommentaire;
	}

}
?>