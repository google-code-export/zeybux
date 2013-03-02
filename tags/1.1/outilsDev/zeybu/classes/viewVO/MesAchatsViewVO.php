<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsViewVO.php
//
// Description : Classe MesAchatsViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MesAchatsViewVO
 * @author Julien PIERRE
 * @since 03/10/2011
 * @desc Classe représentant une MesAchatsViewVO
 */
class MesAchatsViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc OpeIdCompte de la MesAchatsViewVO
	*/
	protected $mOpeIdCompte;

	/**
	* @var int(11)
	* @desc ComId de la MesAchatsViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc ComNumero de la MesAchatsViewVO
	*/
	protected $mComNumero;

	/**
	* @var datetime
	* @desc ComDateMarcheDebut de la MesAchatsViewVO
	*/
	protected $mComDateMarcheDebut;

	/**
	* @name getOpeIdCompte()
	* @return int(11)
	* @desc Renvoie le membre OpeIdCompte de la MesAchatsViewVO
	*/
	public function getOpeIdCompte() {
		return $this->mOpeIdCompte;
	}

	/**
	* @name setOpeIdCompte($pOpeIdCompte)
	* @param int(11)
	* @desc Remplace le membre OpeIdCompte de la MesAchatsViewVO par $pOpeIdCompte
	*/
	public function setOpeIdCompte($pOpeIdCompte) {
		$this->mOpeIdCompte = $pOpeIdCompte;
	}

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la MesAchatsViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la MesAchatsViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la MesAchatsViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la MesAchatsViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getComDateMarcheDebut()
	* @return datetime
	* @desc Renvoie le membre ComDateMarcheDebut de la MesAchatsViewVO
	*/
	public function getComDateMarcheDebut() {
		return $this->mComDateMarcheDebut;
	}

	/**
	* @name setComDateMarcheDebut($pComDateMarcheDebut)
	* @param datetime
	* @desc Remplace le membre ComDateMarcheDebut de la MesAchatsViewVO par $pComDateMarcheDebut
	*/
	public function setComDateMarcheDebut($pComDateMarcheDebut) {
		$this->mComDateMarcheDebut = $pComDateMarcheDebut;
	}

}
?>