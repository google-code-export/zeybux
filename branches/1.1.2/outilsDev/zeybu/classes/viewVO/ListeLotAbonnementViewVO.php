<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/04/2012
// Fichier : ListeLotAbonnementViewVO.php
//
// Description : Classe ListeLotAbonnementViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeLotAbonnementViewVO
 * @author Julien PIERRE
 * @since 12/04/2012
 * @desc Classe représentant une ListeLotAbonnementViewVO
 */
class ListeLotAbonnementViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc LotAboId de la ListeLotAbonnementViewVO
	*/
	protected $mLotAboId;

	/**
	* @var int(11)
	* @desc LotAboIdProduitAbonnement de la ListeLotAbonnementViewVO
	*/
	protected $mLotAboIdProduitAbonnement;

	/**
	* @var decimal(10,2) 	
	* @desc LotAboTaille de la ListeLotAbonnementViewVO
	*/
	protected $mLotAboTaille;

	/**
	* @var decimal(10,2) 	
	* @desc LotAboPrix de la ListeLotAbonnementViewVO
	*/
	protected $mLotAboPrix;

	/**
	* @name getLotAboId()
	* @return int(11)
	* @desc Renvoie le membre LotAboId de la ListeLotAbonnementViewVO
	*/
	public function getLotAboId() {
		return $this->mLotAboId;
	}

	/**
	* @name setLotAboId($pLotAboId)
	* @param int(11)
	* @desc Remplace le membre LotAboId de la ListeLotAbonnementViewVO par $pLotAboId
	*/
	public function setLotAboId($pLotAboId) {
		$this->mLotAboId = $pLotAboId;
	}

	/**
	* @name getLotAboIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre LotAboIdProduitAbonnement de la ListeLotAbonnementViewVO
	*/
	public function getLotAboIdProduitAbonnement() {
		return $this->mLotAboIdProduitAbonnement;
	}

	/**
	* @name setLotAboIdProduitAbonnement($pLotAboIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre LotAboIdProduitAbonnement de la ListeLotAbonnementViewVO par $pLotAboIdProduitAbonnement
	*/
	public function setLotAboIdProduitAbonnement($pLotAboIdProduitAbonnement) {
		$this->mLotAboIdProduitAbonnement = $pLotAboIdProduitAbonnement;
	}

	/**
	* @name getLotAboTaille()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre LotAboTaille de la ListeLotAbonnementViewVO
	*/
	public function getLotAboTaille() {
		return $this->mLotAboTaille;
	}

	/**
	* @name setLotAboTaille($pLotAboTaille)
	* @param decimal(10,2) 	
	* @desc Remplace le membre LotAboTaille de la ListeLotAbonnementViewVO par $pLotAboTaille
	*/
	public function setLotAboTaille($pLotAboTaille) {
		$this->mLotAboTaille = $pLotAboTaille;
	}

	/**
	* @name getLotAboPrix()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre LotAboPrix de la ListeLotAbonnementViewVO
	*/
	public function getLotAboPrix() {
		return $this->mLotAboPrix;
	}

	/**
	* @name setLotAboPrix($pLotAboPrix)
	* @param decimal(10,2) 	
	* @desc Remplace le membre LotAboPrix de la ListeLotAbonnementViewVO par $pLotAboPrix
	*/
	public function setLotAboPrix($pLotAboPrix) {
		$this->mLotAboPrix = $pLotAboPrix;
	}

}
?>