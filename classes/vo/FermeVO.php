<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeVO.php
//
// Description : Classe FermeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FermeVO
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une FermeVO
 */
class FermeVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la FermeVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc Numero de la FermeVO
	*/
	protected $mNumero;

	/**
	* @var text
	* @desc Nom de la FermeVO
	*/
	protected $mNom;

	/**
	* @var int(11)
	* @desc IdCompte de la FermeVO
	*/
	protected $mIdCompte;

	/**
	* @var int(9)
	* @desc Siren de la FermeVO
	*/
	protected $mSiren;

	/**
	* @var varchar(300)
	* @desc Adresse de la FermeVO
	*/
	protected $mAdresse;

	/**
	* @var varchar(10)
	* @desc CodePostal de la FermeVO
	*/
	protected $mCodePostal;

	/**
	* @var varchar(100)
	* @desc Ville de la FermeVO
	*/
	protected $mVille;

	/**
	* @var date
	* @desc DateAdhesion de la FermeVO
	*/
	protected $mDateAdhesion;

	/**
	* @var text
	* @desc Description de la FermeVO
	*/
	protected $mDescription;

	/**
	* @var tinyint(1)
	* @desc Etat de la FermeVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la FermeVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la FermeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getNumero()
	* @return int(11)
	* @desc Renvoie le membre Numero de la FermeVO
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param int(11)
	* @desc Remplace le membre Numero de la FermeVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getNom()
	* @return text
	* @desc Renvoie le membre Nom de la FermeVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param text
	* @desc Remplace le membre Nom de la FermeVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la FermeVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la FermeVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getSiren()
	* @return int(9)
	* @desc Renvoie le membre Siren de la FermeVO
	*/
	public function getSiren() {
		return $this->mSiren;
	}

	/**
	* @name setSiren($pSiren)
	* @param int(9)
	* @desc Remplace le membre Siren de la FermeVO par $pSiren
	*/
	public function setSiren($pSiren) {
		$this->mSiren = $pSiren;
	}

	/**
	* @name getAdresse()
	* @return varchar(300)
	* @desc Renvoie le membre Adresse de la FermeVO
	*/
	public function getAdresse() {
		return $this->mAdresse;
	}

	/**
	* @name setAdresse($pAdresse)
	* @param varchar(300)
	* @desc Remplace le membre Adresse de la FermeVO par $pAdresse
	*/
	public function setAdresse($pAdresse) {
		$this->mAdresse = $pAdresse;
	}

	/**
	* @name getCodePostal()
	* @return varchar(10)
	* @desc Renvoie le membre CodePostal de la FermeVO
	*/
	public function getCodePostal() {
		return $this->mCodePostal;
	}

	/**
	* @name setCodePostal($pCodePostal)
	* @param varchar(10)
	* @desc Remplace le membre CodePostal de la FermeVO par $pCodePostal
	*/
	public function setCodePostal($pCodePostal) {
		$this->mCodePostal = $pCodePostal;
	}

	/**
	* @name getVille()
	* @return varchar(100)
	* @desc Renvoie le membre Ville de la FermeVO
	*/
	public function getVille() {
		return $this->mVille;
	}

	/**
	* @name setVille($pVille)
	* @param varchar(100)
	* @desc Remplace le membre Ville de la FermeVO par $pVille
	*/
	public function setVille($pVille) {
		$this->mVille = $pVille;
	}

	/**
	* @name getDateAdhesion()
	* @return date
	* @desc Renvoie le membre DateAdhesion de la FermeVO
	*/
	public function getDateAdhesion() {
		return $this->mDateAdhesion;
	}

	/**
	* @name setDateAdhesion($pDateAdhesion)
	* @param date
	* @desc Remplace le membre DateAdhesion de la FermeVO par $pDateAdhesion
	*/
	public function setDateAdhesion($pDateAdhesion) {
		$this->mDateAdhesion = $pDateAdhesion;
	}

	/**
	* @name getDescription()
	* @return text
	* @desc Renvoie le membre Description de la FermeVO
	*/
	public function getDescription() {
		return $this->mDescription;
	}

	/**
	* @name setDescription($pDescription)
	* @param text
	* @desc Remplace le membre Description de la FermeVO par $pDescription
	*/
	public function setDescription($pDescription) {
		$this->mDescription = $pDescription;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la FermeVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la FermeVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>