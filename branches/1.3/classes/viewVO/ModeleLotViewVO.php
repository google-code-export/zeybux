<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : ModeleLotViewVO.php
//
// Description : Classe ModeleLotViewVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModeleLotViewVO
 * @author Julien PIERRE
 * @since 03/11/2011
 * @desc Classe représentant une ModeleLotViewVO
 */
class ModeleLotViewVO  extends DataTemplate	
{
	/**
	* @var int(11)
	* @desc MLotId de la ModeleLotViewVO
	*/
	protected $mMLotId;

	/**
	* @var int(11)
	* @desc MLotIdNomProduit de la ModeleLotViewVO
	*/
	protected $mMLotIdNomProduit;

	/**
	* @var decimal(10,2)
	* @desc MLotQuantite de la ModeleLotViewVO
	*/
	protected $mMLotQuantite;

	/**
	* @var varchar(20)
	* @desc MLotUnite de la ModeleLotViewVO
	*/
	protected $mMLotUnite;

	/**
	* @var decimal(10,2)
	* @desc MLotPrix de la ModeleLotViewVO
	*/
	protected $mMLotPrix;

	/**
	* @name getMLotId()
	* @return int(11)
	* @desc Renvoie le membre MLotId de la ModeleLotViewVO
	*/
	public function getMLotId() {
		return $this->mMLotId;
	}

	/**
	* @name setMLotId($pMLotId)
	* @param int(11)
	* @desc Remplace le membre MLotId de la ModeleLotViewVO par $pMLotId
	*/
	public function setMLotId($pMLotId) {
		$this->mMLotId = $pMLotId;
	}

	/**
	* @name getMLotIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre MLotIdNomProduit de la ModeleLotViewVO
	*/
	public function getMLotIdNomProduit() {
		return $this->mMLotIdNomProduit;
	}

	/**
	* @name setMLotIdNomProduit($pMLotIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre MLotIdNomProduit de la ModeleLotViewVO par $pMLotIdNomProduit
	*/
	public function setMLotIdNomProduit($pMLotIdNomProduit) {
		$this->mMLotIdNomProduit = $pMLotIdNomProduit;
	}

	/**
	* @name getMLotQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre MLotQuantite de la ModeleLotViewVO
	*/
	public function getMLotQuantite() {
		return $this->mMLotQuantite;
	}

	/**
	* @name setMLotQuantite($pMLotQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre MLotQuantite de la ModeleLotViewVO par $pMLotQuantite
	*/
	public function setMLotQuantite($pMLotQuantite) {
		$this->mMLotQuantite = $pMLotQuantite;
	}

	/**
	* @name getMLotUnite()
	* @return varchar(20)
	* @desc Renvoie le membre MLotUnite de la ModeleLotViewVO
	*/
	public function getMLotUnite() {
		return $this->mMLotUnite;
	}

	/**
	* @name setMLotUnite($pMLotUnite)
	* @param varchar(20)
	* @desc Remplace le membre MLotUnite de la ModeleLotViewVO par $pMLotUnite
	*/
	public function setMLotUnite($pMLotUnite) {
		$this->mMLotUnite = $pMLotUnite;
	}

	/**
	* @name getMLotPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre MLotPrix de la ModeleLotViewVO
	*/
	public function getMLotPrix() {
		return $this->mMLotPrix;
	}

	/**
	* @name setMLotPrix($pMLotPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre MLotPrix de la ModeleLotViewVO par $pMLotPrix
	*/
	public function setMLotPrix($pMLotPrix) {
		$this->mMLotPrix = $pMLotPrix;
	}

}
?>