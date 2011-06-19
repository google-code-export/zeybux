<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : OperationVO.php
//
// Description : Classe OperationVO
//
//****************************************************************

/**
 * @name OperationVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une OperationVO
 */
class OperationVO
{
	/**
	* @var int(11)
	* @desc Id de la OperationVO
	*/
	private $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la OperationVO
	*/
	private $mIdCompte;

	/**
	* @var decimal(10,2)
	* @desc Montant de la OperationVO
	*/
	private $mMontant;

	/**
	* @var varchar(100)
	* @desc Libelle de la OperationVO
	*/
	private $mLibelle;

	/**
	* @var datetime
	* @desc Date de la OperationVO
	*/
	private $mDate;

	/**
	* @var int(11)
	* @desc TypePaiement de la OperationVO
	*/
	private $mTypePaiement;

	/**
	* @var varchar(50)
	* @desc TypePaiementChampComplementaire de la OperationVO
	*/
	private $mTypePaiementChampComplementaire;

	/**
	* @var int(11)
	* @desc Type de la OperationVO
	*/
	private $mType;

	/**
	* @var int(11)
	* @desc IdCommande de la OperationVO
	*/
	private $mIdCommande;

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
	* @name getTypePaiementChampComplementaire()
	* @return varchar(50)
	* @desc Renvoie le membre TypePaiementChampComplementaire de la OperationVO
	*/
	public function getTypePaiementChampComplementaire() {
		return $this->mTypePaiementChampComplementaire;
	}

	/**
	* @name setTypePaiementChampComplementaire($pTypePaiementChampComplementaire)
	* @param varchar(50)
	* @desc Remplace le membre TypePaiementChampComplementaire de la OperationVO par $pTypePaiementChampComplementaire
	*/
	public function setTypePaiementChampComplementaire($pTypePaiementChampComplementaire) {
		$this->mTypePaiementChampComplementaire = $pTypePaiementChampComplementaire;
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
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la OperationVO
	*/
	public function getIdCommande() {
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la OperationVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

}
?>