<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationAvenirViewVO.php
//
// Description : Classe OperationAvenirViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAvenirViewVO
 * @author Julien PIERRE
 * @since 08/09/2010
 * @desc Classe représentant une OperationAvenirViewVO
 */
class OperationAvenirViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeIdCompte de la OperationAvenirViewVO
	*/
	protected $mOpeIdCompte;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAvenirViewVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAvenirViewVO
	*/
	protected $mOpeLibelle;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAvenirViewVO
	*/
	protected $mOpeDate;
	
	/**
	* @var datetime
	* @desc ComDateMarche de la OperationAvenirViewVO
	*/
	protected $mComDateMarche;

	/**
	* @name getOpeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre OpeIdCompte de la OperationAvenirViewVO
	*/
	public function getOpeIdCompte() {
		return $this->mOpeIdCompte;
	}

	/**
	* @name setOpeIdCompte($pOpeIdCompte)
	* @param int(11)
	* @desc Remplace le membre OpeIdCompte de la OperationAvenirViewVO par $pOpeIdCompte
	*/
	public function setOpeIdCompte($pOpeIdCompte) {
		$this->mOpeIdCompte = $pOpeIdCompte;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAvenirViewVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAvenirViewVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAvenirViewVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAvenirViewVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAvenirViewVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAvenirViewVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}
	
	/**
	* @name getComDateMarche()
	* @return datetime
	* @desc Renvoie le membre ComDateMarche de la OperationAvenirViewVO
	*/
	public function getComDateMarche() {
		return $this->mComDateMarche;
	}

	/**
	* @name setComDateMarche($pComDateMarche)
	* @param datetime
	* @desc Remplace le membre ComDateMarche de la OperationAvenirViewVO par $pComDateMarche
	*/
	public function setComDateMarche($pComDateMarche) {
		$this->mComDateMarche = $pComDateMarche;
	}
}
?>