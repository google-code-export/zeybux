<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/06/2013
// Fichier : OperationVO.php
//
// Description : Classe OperationVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationVO
 * @author Julien PIERRE
 * @since 15/06/2013
 * @desc Classe représentant une OperationVO
 */
class OperationVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la OperationVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la OperationVO
	*/
	protected $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la OperationVO
	*/
	protected $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la OperationVO
	*/
	protected $mLibelle;

	/**
	* @var datetime
	* @desc Date de la OperationVO
	*/
	protected $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la OperationVO
	*/
	protected $mTypePaiement;

	/**
	* @var int(11)
	* @desc Type de la OperationVO
	*/
	protected $mType;

	/**
	* @var datetime
	* @desc DateMaj de la OperationVO
	*/
	protected $mDateMaj;

	/**
	* @var int(11)
	* @desc IdLogin de la OperationVO
	*/
	protected $mIdLogin;
	
	/**
	* @name OperationVO()
	* @desc Le constructeur
	*/
	public function OperationVO($pId = null, $pIdCompte = null, $pMontant = null,$pLibelle = null, $pDate = null, $pTypePaiement = null, $pType = null, $pDateMaj = null, $pIdLogin = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pIdCompte)) { $this->mIdCompte = $pIdCompte; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pLibelle)) { $this->mLibelle = $pLibelle; }
		if(!is_null($pDate)) { $this->mDate = $pDate; }
		if(!is_null($pTypePaiement)) { $this->mTypePaiement = $pTypePaiement; }
		if(!is_null($pType)) { $this->mType = $pType; }
		if(!is_null($pDateMaj)) { $this->mDateMaj = $pDateMaj; }
		if(!is_null($pIdLogin)) { $this->mIdLogin = $pIdLogin; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la OperationVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la OperationVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la OperationVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la OperationVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre Montant de la OperationVO
	*/
	public function getMontant() {
		return $this->mMontant;
	}

	/**
	* @name setMontant($pMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre Montant de la OperationVO par $pMontant
	*/
	public function setMontant($pMontant) {
		$this->mMontant = $pMontant;
	}

	/**
	* @name getLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre Libelle de la OperationVO
	*/
	public function getLibelle() {
		return $this->mLibelle;
	}

	/**
	* @name setLibelle($pLibelle)
	* @param varchar(100)
	* @desc Remplace le membre Libelle de la OperationVO par $pLibelle
	*/
	public function setLibelle($pLibelle) {
		$this->mLibelle = $pLibelle;
	}

	/**
	* @name getDate()
	* @return datetime
	* @desc Renvoie le membre Date de la OperationVO
	*/
	public function getDate() {
		return $this->mDate;
	}

	/**
	* @name setDate($pDate)
	* @param datetime
	* @desc Remplace le membre Date de la OperationVO par $pDate
	*/
	public function setDate($pDate) {
		$this->mDate = $pDate;
	}

	/**
	* @name getTypePaiement()
	* @return int(11)
	* @desc Renvoie le membre TypePaiement de la OperationVO
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param int(11)
	* @desc Remplace le membre TypePaiement de la OperationVO par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}

	/**
	* @name getType()
	* @return int(11)
	* @desc Renvoie le membre Type de la OperationVO
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param int(11)
	* @desc Remplace le membre Type de la OperationVO par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}

	/**
	* @name getDateMaj()
	* @return datetime
	* @desc Renvoie le membre DateMaj de la OperationVO
	*/
	public function getDateMaj() {
		return $this->mDateMaj;
	}

	/**
	* @name setDateMaj($pDateMaj)
	* @param datetime
	* @desc Remplace le membre DateMaj de la OperationVO par $pDateMaj
	*/
	public function setDateMaj($pDateMaj) {
		$this->mDateMaj = $pDateMaj;
	}

	/**
	* @name getIdLogin()
	* @return int(11)
	* @desc Renvoie le membre IdLogin de la OperationVO
	*/
	public function getIdLogin() {
		return $this->mIdLogin;
	}

	/**
	* @name setIdLogin($pIdLogin)
	* @param int(11)
	* @desc Remplace le membre IdLogin de la OperationVO par $pIdLogin
	*/
	public function setIdLogin($pIdLogin) {
		$this->mIdLogin = $pIdLogin;
	}

}
?>