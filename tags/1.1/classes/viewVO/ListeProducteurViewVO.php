<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : ListeProducteurViewVO.php
//
// Description : Classe ListeProducteurViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProducteurViewVO
 * @author Julien PIERRE
 * @since 31/10/2011
 * @desc Classe représentant une ListeProducteurViewVO
 */
class ListeProducteurViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc PrdtIdFerme de la ListeProducteurViewVO
	*/
	protected $mPrdtIdFerme;

	/**
	* @var int(11)
	* @desc PrdtId de la ListeProducteurViewVO
	*/
	protected $mPrdtId;

	/**
	* @var varchar(20)
	* @desc PrdtNumero de la ListeProducteurViewVO
	*/
	protected $mPrdtNumero;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la ListeProducteurViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la ListeProducteurViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @var varchar(100)
	* @desc PrdtCourrielPrincipal de la ListeProducteurViewVO
	*/
	protected $mPrdtCourrielPrincipal;

	/**
	* @var varchar(20)
	* @desc PrdtTelephonePrincipal de la ListeProducteurViewVO
	*/
	protected $mPrdtTelephonePrincipal;

	/**
	* @name getPrdtIdFerme()
	* @return int(11)
	* @desc Renvoie le membre PrdtIdFerme de la ListeProducteurViewVO
	*/
	public function getPrdtIdFerme() {
		return $this->mPrdtIdFerme;
	}

	/**
	* @name setPrdtIdFerme($pPrdtIdFerme)
	* @param int(11)
	* @desc Remplace le membre PrdtIdFerme de la ListeProducteurViewVO par $pPrdtIdFerme
	*/
	public function setPrdtIdFerme($pPrdtIdFerme) {
		$this->mPrdtIdFerme = $pPrdtIdFerme;
	}

	/**
	* @name getPrdtId()
	* @return int(11)
	* @desc Renvoie le membre PrdtId de la ListeProducteurViewVO
	*/
	public function getPrdtId() {
		return $this->mPrdtId;
	}

	/**
	* @name setPrdtId($pPrdtId)
	* @param int(11)
	* @desc Remplace le membre PrdtId de la ListeProducteurViewVO par $pPrdtId
	*/
	public function setPrdtId($pPrdtId) {
		$this->mPrdtId = $pPrdtId;
	}

	/**
	* @name getPrdtNumero()
	* @return varchar(20)
	* @desc Renvoie le membre PrdtNumero de la ListeProducteurViewVO
	*/
	public function getPrdtNumero() {
		return $this->mPrdtNumero;
	}

	/**
	* @name setPrdtNumero($pPrdtNumero)
	* @param varchar(20)
	* @desc Remplace le membre PrdtNumero de la ListeProducteurViewVO par $pPrdtNumero
	*/
	public function setPrdtNumero($pPrdtNumero) {
		$this->mPrdtNumero = $pPrdtNumero;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la ListeProducteurViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la ListeProducteurViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la ListeProducteurViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la ListeProducteurViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

	/**
	* @name getPrdtCourrielPrincipal()
	* @return varchar(100)
	* @desc Renvoie le membre PrdtCourrielPrincipal de la ListeProducteurViewVO
	*/
	public function getPrdtCourrielPrincipal() {
		return $this->mPrdtCourrielPrincipal;
	}

	/**
	* @name setPrdtCourrielPrincipal($pPrdtCourrielPrincipal)
	* @param varchar(100)
	* @desc Remplace le membre PrdtCourrielPrincipal de la ListeProducteurViewVO par $pPrdtCourrielPrincipal
	*/
	public function setPrdtCourrielPrincipal($pPrdtCourrielPrincipal) {
		$this->mPrdtCourrielPrincipal = $pPrdtCourrielPrincipal;
	}

	/**
	* @name getPrdtTelephonePrincipal()
	* @return varchar(20)
	* @desc Renvoie le membre PrdtTelephonePrincipal de la ListeProducteurViewVO
	*/
	public function getPrdtTelephonePrincipal() {
		return $this->mPrdtTelephonePrincipal;
	}

	/**
	* @name setPrdtTelephonePrincipal($pPrdtTelephonePrincipal)
	* @param varchar(20)
	* @desc Remplace le membre PrdtTelephonePrincipal de la ListeProducteurViewVO par $pPrdtTelephonePrincipal
	*/
	public function setPrdtTelephonePrincipal($pPrdtTelephonePrincipal) {
		$this->mPrdtTelephonePrincipal = $pPrdtTelephonePrincipal;
	}

}
?>