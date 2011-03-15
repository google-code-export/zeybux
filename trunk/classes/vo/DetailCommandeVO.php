<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 16/05/2010
// Fichier : DetailCommandeVO.php
//
// Description : Classe DetailCommandeVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailCommandeVO
 * @author Julien PIERRE
 * @since 16/05/2010
 * @desc Classe représentant une DetailCommandeVO
 */
class DetailCommandeVO extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la DetailCommandeVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdProduit de la DetailCommandeVO
	*/
	protected $mIdProduit;

	/**
	* @var int(11)
	* @desc Taille de la DetailCommandeVO
	*/
	protected $mTaille;

	/**
	* @var decimal(10,2)
	* @desc Prix de la DetailCommandeVO
	*/
	protected $mPrix;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la DetailCommandeVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la DetailCommandeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdProduit()
	* @return int(11)
	* @desc Renvoie le membre IdProduit de la DetailCommandeVO
	*/
	public function getIdProduit(){
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param int(11)
	* @desc Remplace le membre IdProduit de la DetailCommandeVO par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

	/**
	* @name getTaille()
	* @return int(11)
	* @desc Renvoie le membre Taille de la DetailCommandeVO
	*/
	public function getTaille(){
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param int(11)
	* @desc Remplace le membre Taille de la DetailCommandeVO par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre Prix de la DetailCommandeVO
	*/
	public function getPrix(){
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre Prix de la DetailCommandeVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

}
?>