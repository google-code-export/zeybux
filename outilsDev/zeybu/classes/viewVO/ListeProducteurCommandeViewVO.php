<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/01/2011
// Fichier : ListeProducteurCommandeViewVO.php
//
// Description : Classe ListeProducteurCommandeViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProducteurCommandeViewVO
 * @author Julien PIERRE
 * @since 03/01/2011
 * @desc Classe représentant une ListeProducteurCommandeViewVO
 */
class ListeProducteurCommandeViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc ComId de la ListeProducteurCommandeViewVO
	*/
	protected $mComId;

	/**
	* @var int(11)
	* @desc PrdtId de la ListeProducteurCommandeViewVO
	*/
	protected $mPrdtId;

	/**
	* @var varchar(50)
	* @desc PrdtNom de la ListeProducteurCommandeViewVO
	*/
	protected $mPrdtNom;

	/**
	* @var varchar(50)
	* @desc PrdtPrenom de la ListeProducteurCommandeViewVO
	*/
	protected $mPrdtPrenom;

	/**
	* @name getComId()
	* @return int(11)
	* @desc Renvoie le membre ComId de la ListeProducteurCommandeViewVO
	*/
	public function getComId() {
		return $this->mComId;
	}

	/**
	* @name setComId($pComId)
	* @param int(11)
	* @desc Remplace le membre ComId de la ListeProducteurCommandeViewVO par $pComId
	*/
	public function setComId($pComId) {
		$this->mComId = $pComId;
	}

	/**
	* @name getPrdtId()
	* @return int(11)
	* @desc Renvoie le membre PrdtId de la ListeProducteurCommandeViewVO
	*/
	public function getPrdtId() {
		return $this->mPrdtId;
	}

	/**
	* @name setPrdtId($pPrdtId)
	* @param int(11)
	* @desc Remplace le membre PrdtId de la ListeProducteurCommandeViewVO par $pPrdtId
	*/
	public function setPrdtId($pPrdtId) {
		$this->mPrdtId = $pPrdtId;
	}

	/**
	* @name getPrdtNom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtNom de la ListeProducteurCommandeViewVO
	*/
	public function getPrdtNom() {
		return $this->mPrdtNom;
	}

	/**
	* @name setPrdtNom($pPrdtNom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtNom de la ListeProducteurCommandeViewVO par $pPrdtNom
	*/
	public function setPrdtNom($pPrdtNom) {
		$this->mPrdtNom = $pPrdtNom;
	}

	/**
	* @name getPrdtPrenom()
	* @return varchar(50)
	* @desc Renvoie le membre PrdtPrenom de la ListeProducteurCommandeViewVO
	*/
	public function getPrdtPrenom() {
		return $this->mPrdtPrenom;
	}

	/**
	* @name setPrdtPrenom($pPrdtPrenom)
	* @param varchar(50)
	* @desc Remplace le membre PrdtPrenom de la ListeProducteurCommandeViewVO par $pPrdtPrenom
	*/
	public function setPrdtPrenom($pPrdtPrenom) {
		$this->mPrdtPrenom = $pPrdtPrenom;
	}

}
?>