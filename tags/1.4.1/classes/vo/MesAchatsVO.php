<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsVO.php
//
// Description : Classe MesAchatsVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MesAchatsVO
 * @author Julien PIERRE
 * @since 03/10/2011
 * @desc Classe représentant une MesAchatsVO
 */
class MesAchatsVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeMontant de la MesAchatsVO
	*/
	protected $mOpeMontant;

	/**
	 * @var int(11)
	 * @desc OpeId de la MesAchatsVO
	 */
	protected $mOpeId;
	
	/**
	* @var int(11)
	* @desc ComId de la MesAchatsVO
	*/
	protected $mComId;

	/**
	* @var varchar(100)
	* @desc ComNom de la MesAchatsVO
	*/
	protected $mComNom;

	/**
	* @var int(11)
	* @desc ComNumero de la MesAchatsVO
	*/
	protected $mComNumero;

	/**
	* @var datetime
	* @desc OpeDate de la MesAchatsVO
	*/
	protected $mOpeDate;

	/**
	 * @name MesAchatsVO()
	 * @desc Le constructeur
	 */
	public function MesAchatsVO($pOpeId = null, $pComId = null, $pComNom = null, $pComNumero = null, $pOpeDate = null, $pOpeMontant = null) {
		if(!is_null($pOpeId)) { $this->mOpeId = $pOpeId; }
		if(!is_null($pComId)) { $this->mComId = $pComId; }
		if(!is_null($pComNom)) { $this->mComNom = $pComNom; }
		if(!is_null($pComNumero)) { $this->mComNumero = $pComNumero; }
		if(!is_null($pOpeDate)) { $this->mOpeDate = $pOpeDate; }
		if(!is_null($pOpeMontant)) { $this->mOpeMontant = $pOpeMontant; }
	}
		
	/**
	* @name getOpeMontant()
	* @return int(11)
	* @desc Renvoie le membre OpeMontant de la MesAchatsVO
	*/
	public function getOpeMontant() {
		return $this->mOpeMontant;
	}

	/**
	* @name setOpeMontant($pOpeMontant)
	* @param int(11)
	* @desc Remplace le membre OpeMontant de la MesAchatsVO par $pOpeMontant
	*/
	public function setOpeMontant($pOpeMontant) {
		$this->mOpeMontant = $pOpeMontant;
	}

	/**
	* @name getOpeId()
	* @return int(11)
	* @desc Renvoie le membre OpeId de la MesAchatsVO
	*/
	public function getOpeId() {
		return $this->mOpeId;
	}

	/**
	* @name setOpeId($pOpeId)
	* @param int(11)
	* @desc Remplace le membre OpeId de la MesAchatsVO par $pOpeId
	*/
	public function setOpeId($pOpeId) {
		$this->mOpeId = $pOpeId;
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la MesAchatsVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la MesAchatsVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNom()
	* @return varchar(100)
	* @desc Renvoie le membre ComNom de la MesAchatsVO
	*/
	public function getComNom() {
		return $this->mComNom;
	}

	/**
	* @name setComNom($pComNom)
	* @param varchar(100)
	* @desc Remplace le membre ComNom de la MesAchatsVO par $pComNom
	*/
	public function setComNom($pComNom) {
		$this->mComNom = $pComNom;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la MesAchatsVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la MesAchatsVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getOpeDate()
	* @return datetime
	* @desc Renvoie le membre OpeDate de la MesAchatsVO
	*/
	public function getOpeDate() {
		return $this->mOpeDate;
	}

	/**
	* @name setOpeDate($pOpeDate)
	* @param datetime
	* @desc Remplace le membre OpeDate de la MesAchatsVO par $pOpeDate
	*/
	public function setOpeDate($pOpeDate) {
		$this->mOpeDate = $pOpeDate;
	}

}
?>