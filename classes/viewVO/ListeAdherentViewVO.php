<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/09/2010
// Fichier : ListeAdherentViewVO.php
//
// Description : Classe ListeAdherentViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentViewVO
 * @author Julien PIERRE
 * @since 05/09/2010
 * @desc Classe représentant une ListeAdherentViewVO
 */
class ListeAdherentViewVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc AdhId de la ListeAdherentViewVO
	*/
	protected $mAdhId;
	
	/**
	* @var varchar(5)
	* @desc AdhNumero de la ListeAdherentViewVO
	*/
	protected $mAdhNumero;

	/**
	* @var varchar(50)
	* @desc AdhNom de la ListeAdherentViewVO
	*/
	protected $mAdhNom;
	
	/**
	* @var varchar(50)
	* @desc AdhPrenom de la AdhPrenomViewVO
	*/
	protected $mAdhPrenom;
	
	/**
	* @var varchar(100)
	* @desc AdhCourrielPrincipal de la ListeAdherentViewVO
	*/
	protected $mAdhCourrielPrincipal;
	
	/**
	* @var decimal(32,2)
	* @desc CptSolde de la ListeAdherentViewVO
	*/
	protected $mCptSolde;
	
	
	/**
	* @var varchar(30)
	* @desc CptLabel de la AdherentViewVO
	*/
	protected $mCptLabel;

	/**
	* @name getAdhId()
	* @return int(11)
	* @desc Renvoie le membre AdhId de la ListeAdherentViewVO
	*/
	public function getAdhId(){
		return $this->mAdhId;
	}

	/**
	* @name setAdhId($pAdhId)
	* @param int(11)
	* @desc Remplace le membre AdhId de la ListeAdherentViewVO par $pAdhId
	*/
	public function setAdhId($pAdhId) {
		$this->mAdhId = $pAdhId;
	}
	
	/**
	* @name getAdhNumero()
	* @return varchar(5)
	* @desc Renvoie le membre AdhNumero de la ListeAdherentViewVO
	*/
	public function getAdhNumero(){
		return $this->mAdhNumero;
	}

	/**
	* @name setId($pAdhNumero)
	* @param varchar(5)
	* @desc Remplace le membre AdhNumero de la ListeAdherentViewVO par $pAdhNumero
	*/
	public function setAdhNumero($pAdhNumero) {
		$this->mAdhNumero = $pAdhNumero;
	}

	/**
	* @name getAdhNom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhNom de la ListeAdherentViewVO
	*/
	public function getAdhNom(){
		return $this->mAdhNom;
	}

	/**
	* @name setAdhNom($pAdhNom)
	* @param varchar(50)
	* @desc Remplace le membre AdhNom de la ListeAdherentViewVO par $pAdhNom
	*/
	public function setAdhNom($pAdhNom) {
		$this->mAdhNom = $pAdhNom;
	}

	/**
	* @name getAdhPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre AdhPrenom de la ListeAdherentViewVO
	*/
	public function getAdhPrenom(){
		return $this->mAdhPrenom;
	}

	/**
	* @name setAdhPrenom($pAdhPrenom)
	* @param varchar(50)
	* @desc Remplace le membre AdhPrenom de la ListeAdherentViewVO par $pAdhPrenom
	*/
	public function setAdhPrenom($pAdhPrenom) {
		$this->mAdhPrenom = $pAdhPrenom;
	}
		
	/**
	* @name getAdhCourrielPrincipal()
	* @return  varchar(100)
	* @desc Renvoie le membre AdhCourrielPrincipal de la ListeAdherentViewVO
	*/
	public function getAdhCourrielPrincipal(){
		return $this->mAdhCourrielPrincipal;
	}

	/**
	* @name setAdhCourrielPrincipal($pAdhCourrielPrincipal)
	* @param  varchar(100)
	* @desc Remplace le membre AdhCourrielPrincipal de la ListeAdherentViewVO par $pAdhCourrielPrincipal
	*/
	public function setAdhCourrielPrincipal($pAdhCourrielPrincipal) {
		$this->mAdhCourrielPrincipal = $pAdhCourrielPrincipal;
	}
	
	/**
	* @name getCptSolde()
	* @return decimal(32,2)
	* @desc Renvoie le membre CptSolde de la ListeAdherentViewVO
	*/
	public function getCptSolde(){
		return $this->mCptSolde;
	}

	/**
	* @name setCptSolde($pCptSolde)
	* @param decimal(32,2)
	* @desc Remplace le membre CptSolde de la ListeAdherentViewVO par $pCptSolde
	*/
	public function setCptSolde($pCptSolde) {
		$this->mCptSolde = $pCptSolde;
	}
	
	/**
	* @name getCptLabel()
	* @return varchar(30)
	* @desc Renvoie le membre CptLabel de la AdherentViewVO
	*/
	public function getCptLabel() {
		return $this->mCptLabel;
	}

	/**
	* @name setCptLabel($pCptLabel)
	* @param varchar(30)
	* @desc Remplace le membre CptLabel de la AdherentViewVO par $pCptLabel
	*/
	public function setCptLabel($pCptLabel) {
		$this->mCptLabel = $pCptLabel;
	}
}
?>