<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : AchatVO.php
//
// Description : Classe AchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");
include_once(CHEMIN_CLASSES_VO . "DetailReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

/**
 * @name AchatVO
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une AchatVO
 */
class AchatVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la AchatVO
	*/
	protected $mId;
	
	/**
	* @var array(DetailReservationVO)
	* @desc Produits de la AchatVO
	*/
	protected $mDetailAchat;
	
	/**
	* @var array(DetailReservationVO)
	* @desc Produits Solidaire de la AchatVO
	*/
	protected $mDetailAchatSolidaire;
		
	/**
	* @name AchatVO()
	* @desc Le constructeur
	*/
	public function AchatVO() {
		$this->mId = new IdAchatVO();
		$this->mDetailAchat = array();
		$this->mDetailAchatSolidaire = array();
	}
	
	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la AchatVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la AchatVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	* @name getDetailAchat()
	* @return array(DetailReservationVO)
	* @desc Renvoie le membre DetailAchat de la AchatVO
	*/
	public function getDetailAchat(){
		return $this->mDetailAchat;
	}

	/**
	* @name setDetailAchat($pProduit)
	* @param array(DetailReservationVO)
	* @desc Remplace le membre DetailAchat de la AchatVO par $pDetailAchat
	*/
	public function setDetailAchat($pDetailAchat) {
		$this->mDetailAchat = $pDetailAchat;
	}
	
	/**
	* @name addDetailAchat($pProduit)
	* @return DetailReservationVO
	* @desc Ajoute $pProduit à DetailAchat
	*/
	public function addDetailAchat($pProduit){
		array_push($this->mDetailAchat,$pProduit);
	}
	
	/**
	* @name getDetailAchatSolidaire()
	* @return array(DetailReservationVO)
	* @desc Renvoie le membre DetailAchatSolidaire de la AchatVO
	*/
	public function getDetailAchatSolidaire(){
		return $this->mDetailAchatSolidaire;
	}

	/**
	* @name setDetailAchatSolidaire($pProduit)
	* @param array(DetailReservationVO)
	* @desc Remplace le membre DetailAchatSolidaire de la AchatVO par $pDetailAchatSolidaire
	*/
	public function setDetailAchatSolidaire($pDetailAchatSolidaire) {
		$this->mDetailAchatSolidaire = $pDetailAchatSolidaire;
	}
	
	/**
	* @name addDetailAchatSolidaire($pProduit)
	* @return DetailReservationVO
	* @desc Ajoute $pProduit à DetailAchatSolidaire
	*/
	public function addDetailAchatSolidaire($pProduit){
		array_push($this->mDetailAchatSolidaire,$pProduit);
	}
}
?>