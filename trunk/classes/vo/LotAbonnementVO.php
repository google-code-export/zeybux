<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/04/2012
// Fichier : LotAbonnementVO.php
//
// Description : Classe LotAbonnementVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name LotAbonnementVO
 * @author Julien PIERRE
 * @since 12/04/2012
 * @desc Classe représentant une LotAbonnementVO
 */
class LotAbonnementVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la LotAbonnementVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdProduitAbonnement de la LotAbonnementVO
	*/
	protected $mIdProduitAbonnement;

	/**
	* @var decimal(10,2)
	* @desc Taille de la LotAbonnementVO
	*/
	protected $mTaille;

	/**
	* @var decimal(10,2)
	* @desc Prix de la LotAbonnementVO
	*/
	protected $mPrix;

	/**
	* @var tinyint(1)
	* @desc Etat de la LotAbonnementVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la LotAbonnementVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la LotAbonnementVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre IdProduitAbonnement de la LotAbonnementVO
	*/
	public function getIdProduitAbonnement() {
		return $this->mIdProduitAbonnement;
	}

	/**
	* @name setIdProduitAbonnement($pIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre IdProduitAbonnement de la LotAbonnementVO par $pIdProduitAbonnement
	*/
	public function setIdProduitAbonnement($pIdProduitAbonnement) {
		$this->mIdProduitAbonnement = $pIdProduitAbonnement;
	}

	/**
	* @name getTaille()
	* @return decimal(10,2)
	* @desc Renvoie le membre Taille de la LotAbonnementVO
	*/
	public function getTaille() {
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param decimal(10,2)
	* @desc Remplace le membre Taille de la LotAbonnementVO par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre Prix de la LotAbonnementVO
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre Prix de la LotAbonnementVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la LotAbonnementVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la LotAbonnementVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>