<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/10/2013
// Fichier : CompteVO.php
//
// Description : Classe CompteVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteVO
 * @author Julien PIERRE
 * @since 13/10/2013
 * @desc Classe représentant une CompteVO
 */
class CompteVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la CompteVO
	*/
	protected $mId;

	/**
	* @var varchar(30)
	* @desc Label de la CompteVO
	*/
	protected $mLabel;

	/**
	* @var decimal(10,2)
	* @desc Solde de la CompteVO
	*/
	protected $mSolde;

	/**
	* @var int(11)
	* @desc IdAdherentPrincipal de la CompteVO
	*/
	protected $mIdAdherentPrincipal;

	/**
	 * @name CompteVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function CompteVO($pId = null, $pLabel = null, $pSolde = null, $pIdAdherentPrincipal = null) {
		if(!is_null($pId)) { $this->mId = $pId; }
		if(!is_null($pLabel)) { $this->mLabel = $pLabel; }
		if(!is_null($pSolde)) { $this->mSolde = $pSolde; }
		if(!is_null($pIdAdherentPrincipal)) { $this->mIdAdherentPrincipal = $pIdAdherentPrincipal; }
	}

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la CompteVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la CompteVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getLabel()
	* @return varchar(30)
	* @desc Renvoie le membre Label de la CompteVO
	*/
	public function getLabel() {
		return $this->mLabel;
	}

	/**
	* @name setLabel($pLabel)
	* @param varchar(30)
	* @desc Remplace le membre Label de la CompteVO par $pLabel
	*/
	public function setLabel($pLabel) {
		$this->mLabel = $pLabel;
	}

	/**
	* @name getSolde()
	* @return decimal(10,2)
	* @desc Renvoie le membre Solde de la CompteVO
	*/
	public function getSolde() {
		return $this->mSolde;
	}

	/**
	* @name setSolde($pSolde)
	* @param decimal(10,2)
	* @desc Remplace le membre Solde de la CompteVO par $pSolde
	*/
	public function setSolde($pSolde) {
		$this->mSolde = $pSolde;
	}

	/**
	* @name getIdAdherentPrincipal()
	* @return int(11)
	* @desc Renvoie le membre IdAdherentPrincipal de la CompteVO
	*/
	public function getIdAdherentPrincipal() {
		return $this->mIdAdherentPrincipal;
	}

	/**
	* @name setIdAdherentPrincipal($pIdAdherentPrincipal)
	* @param int(11)
	* @desc Remplace le membre IdAdherentPrincipal de la CompteVO par $pIdAdherentPrincipal
	*/
	public function setIdAdherentPrincipal($pIdAdherentPrincipal) {
		$this->mIdAdherentPrincipal = $pIdAdherentPrincipal;
	}

}
?>