<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : AbonnementListeAdherentViewVO.php
//
// Description : Classe AbonnementListeAdherentViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AbonnementListeAdherentViewVO
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe représentant une AbonnementListeAdherentViewVO
 */
class AbonnementListeAdherentViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc AdhId de la AbonnementListeAdherentViewVO
	*/
	protected $mAdhId;

	/**
	* @var varchar(20)
	* @desc AdhNumero de la AbonnementListeAdherentViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la AbonnementListeAdherentViewVO
	*/
	protected $mAdhNom;

	/**
	* @var varchar(50)
	* @desc AdhPrenom de la AbonnementListeAdherentViewVO
	*/
	protected $mAdhPrenom;

	/**
	* @var varchar(30)
	* @desc CptLabel de la AbonnementListeAdherentViewVO
	*/
	protected $mCptLabel;

	/**
	* @var int(11)
	* @desc CptId de la AbonnementListeAdherentViewVO
	*/
	protected $mCptId;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la AbonnementListeAdherentViewVO
	*/
	public function getAdhId() {
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la AbonnementListeAdherentViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}

	/**
	* @name getAdhNumero()
	* @return varchar(20)
	* @desc Renvoie le membre AdhNumero de la AbonnementListeAdherentViewVO
	*/
	public function getAdhNumero() {
		return $this->mAdhNumero;
	}

	/**
	* @name setAdhNumero($pAdhNumero)
	* @param varchar(20)
	* @desc Remplace le membre AdhNumero de la AbonnementListeAdherentViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la AbonnementListeAdherentViewVO
	*/
	public function getAdhNom() {
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la AbonnementListeAdherentViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la AbonnementListeAdherentViewVO
	*/
	public function getAdhPrenom() {
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la AbonnementListeAdherentViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}

	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la AbonnementListeAdherentViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la AbonnementListeAdherentViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}

	/**
	* @name getCptId()
	* @return int(11)
	* @desc Renvoie le membre CptId de la AbonnementListeAdherentViewVO
	*/
	public function getCptId() {
		return $this->mCptId;
	}

	/**
	* @name setCptId($pCptId)
	* @param int(11)
	* @desc Remplace le membre CptId de la AbonnementListeAdherentViewVO par $pCptId
	*/
	public function setCptId($pCptId) {
		$this->mCptId = $pCptId;
	}

}
?>