<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2013
// Fichier : ListeFactureVO.php
//
// Description : Classe ListeFactureVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFactureVO
 * @author Julien PIERRE
 * @since 10/08/2013
 * @desc Classe représentant une ListeFactureVO
 */
class ListeFactureVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ListeFactureVO
	*/
	protected $mId;

	/**
	* @var varchar(50)
	* @desc Valeur de la ListeFactureVO
	*/
	protected $mValeur;

	/**
	* @var datetime
	* @desc Date de la ListeFactureVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc Numero de la ListeFactureVO
	*/
	protected $mNumero;

	/**
	* @var text
	* @desc Nom de la ListeFactureVO
	*/
	protected $mNom;

	/**
	* @var decimal(10,2)
	* @desc Montant de la ListeFactureVO
	*/
	protected $mMontant;

	/**
	 * @name ListeFactureVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeFactureVO($pId = null, $pValeur = null, $pDate = null, $pNumero = null, $pNom = null, $pMontant = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pValeur)) { $this->mValeur = $pValeur; }
		if(!is_null($pDate)) { $this->mDate = $pDate; }
		if(!is_null($pNumero)) { $this->mNumero = $pNumero; }
		if(!is_null($pNom)) { $this->mNom = $pNom; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ListeFactureVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ListeFactureVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getValeur()
	* @return varchar(50)
	* @desc Renvoie le membre Valeur de la ListeFactureVO
	*/
	public function getValeur() {
		return $this->mValeur;
	}

	/**
	* @name setValeur($pValeur)
	* @param varchar(50)
	* @desc Remplace le membre Valeur de la ListeFactureVO par $pValeur
	*/
	public function setValeur($pValeur) {
		$this->mValeur = $pValeur;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la ListeFactureVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la ListeFactureVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getNumero()
	* @return int(11)
	* @desc Renvoie le membre Numero de la ListeFactureVO
	*/
	public function getNumero() {
		return $this->mNumero;
	}

	/**
	* @name setNumero($pNumero)
	* @param int(11)
	* @desc Remplace le membre Numero de la ListeFactureVO par $pNumero
	*/
	public function setNumero($pNumero) {
		$this->mNumero = $pNumero;
	}

	/**
	* @name getNom()
	* @return text
	* @desc Renvoie le membre Nom de la ListeFactureVO
	*/
	public function getNom() {
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param text
	* @desc Remplace le membre Nom de la ListeFactureVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la ListeFactureVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la ListeFactureVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

}
?>