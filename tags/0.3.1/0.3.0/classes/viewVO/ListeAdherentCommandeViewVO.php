<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeAdherentCommandeViewVO.php
//
// Description : Classe ListeAdherentCommandeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentCommandeViewVO
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeAdherentCommandeViewVO
 */
class ListeAdherentCommandeViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc ComId de la ListeAdherentCommandeViewVO
	*/
	protected $mComId;
	
	/**
	* @var int(11)
	* @desc ComNumero de la ListeAdherentCommandeViewVO
	*/
	protected $mComNumero;

	/**
	* @var int(11)
	* @desc AdhId de la ListeAdherentCommandeViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeAdherentCommandeViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var int(11)
	* @desc AdhLabelCompte de la ListeAdherentCommandeViewVO
	*/
	protected $mAdhLabelCompte;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAdherentCommandeViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la ListeAdherentCommandeViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeAdherentCommandeViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeAdherentCommandeViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}
	
	/**
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le membre ComNumero de la ListeAdherentCommandeViewVO
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le membre ComNumero de la ListeAdherentCommandeViewVO par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAdherentCommandeViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAdherentCommandeViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeAdherentCommandeViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeAdherentCommandeViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhLabelCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhLabelCompte de la ListeAdherentCommandeViewVO
	*/
	public function getAdhLabelCompte() {
		return $this->mAdhLabelCompte;
	}

	/**
	* @name setAdhLabelCompte($pAdhLabelCompte)
	* @param int(11)
	* @desc Remplace le membre AdhLabelCompte de la ListeAdherentCommandeViewVO par $pAdhLabelCompte
	*/
	public function setAdhLabelCompte($pAdhLabelCompte) {
		$this->mAdhLabelCompte = $pAdhLabelCompte;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAdherentCommandeViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAdherentCommandeViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAdherentCommandeViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAdherentCommandeViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
}
?>