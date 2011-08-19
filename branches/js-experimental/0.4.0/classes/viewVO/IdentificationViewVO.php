<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/09/2010
// Fichier : IdentificationViewVO.php
//
// Description : Classe IdentificationViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdentificationViewVO
 * @author Julien PIERRE
 * @since 02/09/2010
 * @desc Classe représentant une IdentificationViewVO
 */
class IdentificationViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la IdentificationViewVO
	*/
	protected $mAdhId;
	
	/**
	* @var int(11)
	* @desc AdhIdCompte de la IdentificationViewVO
	*/
	protected $mAdhIdCompte;
	
	/**
	* @var varchar(5)
	* @desc AdhNumero de la IdentificationViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(100)
	* @desc AdhMotPasse de la IdentificationViewVO
	*/
	protected $mAdhMotPasse;

	/**
	* @var varchar(5)
	* @desc ModNom de la IdentificationViewVO
	*/
	protected $mModNom;
	
	/**
	* @var tinyint(1)
	* @desc AdhSuperZeybu de la IdentificationViewVO
	*/
	protected $mAdhSuperZeybu;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la IdentificationViewVO
	*/
	public function getAdhId(){
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la IdentificationViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhIdCompte()
	* @return int(11)
	* @desc Renvoie le membre AdhIdCompte de la IdentificationViewVO
	*/
	public function getAdhIdCompte(){
		return $this->mAdhIdCompte;
	}

	/**
	* @name setAdhIdCompte($pAdhIdCompte)
	* @param int(11)
	* @desc Remplace le membre AdhIdCompte de la IdentificationViewVO par $pAdhIdCompte
	*/
	public function setAdhIdCompte($pAdhIdCompte) {
		$this->mAdhIdCompte = $pAdhIdCompte;
	}
	
	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la IdentificationViewVO
	*/
	public function getAdhNumero(){
		return $this->mAdhNumero;
	}

	/**
	* @name setId($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la IdentificationViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhMotPasse()
	* @return varchar(100)
	* @desc Renvoie le membre AdhMotPasse de la CompteVO
	*/
	public function getAdhMotPasse(){
		return $this->mAdhMotPasse;
	}

	/**
	* @name setAdhMotPasse($pAdhMotPasse)
	* @param varchar(100)
	* @desc Remplace le membre AdhMotPasse de la IdentificationViewVO par $pAdhMotPasse
	*/
	public function setAdhMotPasse($pAdhMotPasse) {
		$this->mAdhMotPasse = $pAdhMotPasse;
	}

	/**
	* @name getModNom()
	* @return varchar(5)
	* @desc Renvoie le membre ModNom de la IdentificationViewVO
	*/
	public function getModNom(){
		return $this->mModNom;
	}

	/**
	* @name setModNom($pModNom)
	* @param varchar(5)
	* @desc Remplace le membre ModNom de la IdentificationViewVO par $pModNom
	*/
	public function setModNom($pModNom) {
		$this->mModNom = $pModNom;
	}
	
	/**
	* @name getAdhSuperZeybu()
	* @return tinyint(1)
	* @desc Renvoie le membre AdhSuperZeybu de la IdentificationViewVO
	*/
	public function getAdhSuperZeybu(){
		return $this->mAdhSuperZeybu;
	}

	/**
	* @name setAdhSuperZeybu($pAdhSuperZeybu)
	* @param tinyint(1)
	* @desc Remplace le membre AdhSuperZeybu de la IdentificationViewVO par $pAdhSuperZeybu
	*/
	public function setAdhSuperZeybu($pAdhSuperZeybu) {
		$this->mAdhSuperZeybu = $pAdhSuperZeybu;
	}
}
?>