<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationAvenirVO.php
//
// Description : Classe OperationAvenirVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name OperationAvenirVO
 * @author Julien PIERRE
 * @since 08/09/2010
 * @desc Classe représentant une OperationAvenirVO
 */
class OperationAvenirVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc OpeId de la OperationAvenirVO
	*/
	protected $mOpeId;
	
	/**
	* @var int(11)
	* @desc OpeIdCompte de la OperationAvenirVO
	*/
	protected $mOpeIdCompte;

	/**
	* @var decimal(10,2)
	* @desc OpeMontant de la OperationAvenirVO
	*/
	protected $mOpeMontant;

	/**
	* @var varchar(100)
	* @desc OpeLibelle de la OperationAvenirVO
	*/
	protected $mOpeLibelle;

	/**
	* @var datetime
	* @desc OpeDate de la OperationAvenirVO
	*/
	protected $mOpeDate;
	
	/**
	* @var datetime
	* @desc ComDateMarche de la OperationAvenirVO
	*/
	protected $mComDateMarche;

	/**
	 * @name getOpeId()
	 * @return int(11)
	 * @desc Renvoie le membre OpeId de la OperationAvenirVO
	 */
	public function getOpeId() {
		return $this->mOpeId;
	}
	
	/**
	 * @name setOpeId($pOpeId)
	 * @param int(11)
	 * @desc Remplace le membre OpeId de la OperationAvenirVO par $pOpeId
	 */
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}
	
	/**
	* @name getOpeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre OpeIdCompte de la OperationAvenirVO
	*/
	public function getOpeIdCompte() {
		return $this->mOpeIdCompte;
	}

	/**
	* @name setOpeIdCompte($pOpeIdCompte)
	* @param int(11)
	* @desc Remplace le membre OpeIdCompte de la OperationAvenirVO par $pOpeIdCompte
	*/
	public function setOpeIdCompte($pOpeIdCompte) {
		$this->mOpeIdCompte = $pOpeIdCompte;
	}

	/**
	* @name getOpeMontant()
	* @return decimal(10,2)
	* @desc Renvoie le membre OpeMontant de la OperationAvenirVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param decimal(10,2)
	* @desc Remplace le membre OpeMontant de la OperationAvenirVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeLibelle()
	* @return varchar(100)
	* @desc Renvoie le membre OpeLibelle de la OperationAvenirVO
	*/
	public function getOpeLibelle() {
		return $this->mOpeLibelle;
	}

	/**
	* @name setOpeLibelle($pOpeLibelle)
	* @param varchar(100)
	* @desc Remplace le membre OpeLibelle de la OperationAvenirVO par $pOpeLibelle
	*/
	public function setOpeLibelle($pOpeLibelle) {
		$this->mOpeLibelle = $pOpeLibelle;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la OperationAvenirVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la OperationAvenirVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}
	
	/**
	* @name getComDateMarche()
	* @return datetime
	* @desc Renvoie le membre ComDateMarche de la OperationAvenirVO
	*/
	public function getComDateMarche() {
		return $this->mComDateMarche;
	}

	/**
	* @name setComDateMarche($pComDateMarche)
	* @param datetime
	* @desc Remplace le membre ComDateMarche de la OperationAvenirVO par $pComDateMarche
	*/
	public function setComDateMarche($pComDateMarche) {
		$this->mComDateMarche = $pComDateMarche;
	}
}
?>