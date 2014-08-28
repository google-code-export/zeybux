<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/05/2014
// Fichier : InformationBancaireVO.php
//
// Description : Classe InformationBancaireVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InformationBancaireVO
 * @author Julien PIERRE
 * @since 11/05/2014
 * @desc Classe représentant une InformationBancaireVO
 */
class InformationBancaireVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la InformationBancaireVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la InformationBancaireVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc NumeroCompte de la InformationBancaireVO
	*/
	protected $mNumeroCompte;

	/**
	* @var varchar(100)
	* @desc RaisonSociale de la InformationBancaireVO
	*/
	protected $mRaisonSociale;

	/**
	* @var datetime
	* @desc DateCreation de la InformationBancaireVO
	*/
	protected $mDateCreation;

	/**
	* @var datetime
	* @desc DateModification de la InformationBancaireVO
	*/
	protected $mDateModification;

	/**
	* @var tinyint(1)
	* @desc Etat de la InformationBancaireVO
	*/
	protected $mEtat;

	/**
	 * @name InformationBancaireVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function InformationBancaireVO($pId = null, $pIdCompte = null, $pNumeroCompte = null, $pRaisonSociale = null, $pDateCreation = null, $pDateModification = null, $pEtat = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdCompte)) { $this->mIdCompte = $pIdCompte; }
		if(!is_null($pNumeroCompte)) { $this->mNumeroCompte = $pNumeroCompte; }
		if(!is_null($pRaisonSociale)) { $this->mRaisonSociale = $pRaisonSociale; }
		if(!is_null($pDateCreation)) { $this->mDateCreation = $pDateCreation; }
		if(!is_null($pDateModification)) { $this->mDateModification = $pDateModification; }
		if(!is_null($pEtat)) { $this->mEtat = $pEtat; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la InformationBancaireVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la InformationBancaireVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la InformationBancaireVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la InformationBancaireVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getNumeroCompte()
	* @return int(11)
	* @desc Renvoie le membre NumeroCompte de la InformationBancaireVO
	*/
	public function getNumeroCompte() {
		return $this->mNumeroCompte;
	}

	/**
	* @name setNumeroCompte($pNumeroCompte)
	* @param int(11)
	* @desc Remplace le membre NumeroCompte de la InformationBancaireVO par $pNumeroCompte
	*/
	public function setNumeroCompte($pNumeroCompte) {
		$this->mNumeroCompte = $pNumeroCompte;
	}

	/**
	* @name getRaisonSociale()
	* @return varchar(100)
	* @desc Renvoie le membre RaisonSociale de la InformationBancaireVO
	*/
	public function getRaisonSociale() {
		return $this->mRaisonSociale;
	}

	/**
	* @name setRaisonSociale($pRaisonSociale)
	* @param varchar(100)
	* @desc Remplace le membre RaisonSociale de la InformationBancaireVO par $pRaisonSociale
	*/
	public function setRaisonSociale($pRaisonSociale) {
		$this->mRaisonSociale = $pRaisonSociale;
	}

	/**
	* @name getDateCreation()
	* @return datetime
	* @desc Renvoie le membre DateCreation de la InformationBancaireVO
	*/
	public function getDateCreation() {
		return $this->mDateCreation;
	}

	/**
	* @name setDateCreation($pDateCreation)
	* @param datetime
	* @desc Remplace le membre DateCreation de la InformationBancaireVO par $pDateCreation
	*/
	public function setDateCreation($pDateCreation) {
		$this->mDateCreation = $pDateCreation;
	}

	/**
	* @name getDateModification()
	* @return datetime
	* @desc Renvoie le membre DateModification de la InformationBancaireVO
	*/
	public function getDateModification() {
		return $this->mDateModification;
	}

	/**
	* @name setDateModification($pDateModification)
	* @param datetime
	* @desc Remplace le membre DateModification de la InformationBancaireVO par $pDateModification
	*/
	public function setDateModification($pDateModification) {
		$this->mDateModification = $pDateModification;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la InformationBancaireVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la InformationBancaireVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>