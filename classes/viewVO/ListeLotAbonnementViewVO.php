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
	* @desc Id de la ListeLotAbonnementViewVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdProduitAbonnement de la ListeLotAbonnementViewVO
	*/
	protected $mIdProduitAbonnement;

	/**
	* @var decimal(10,2) 	
	* @desc Taille de la ListeLotAbonnementViewVO
	*/
	protected $mTaille;

	/**
	* @var decimal(10,2) 	
	* @desc Prix de la ListeLotAbonnementViewVO
	*/
	protected $mPrix;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ListeLotAbonnementViewVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ListeLotAbonnementViewVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdProduitAbonnement()
	* @return int(11)
	* @desc Renvoie le membre IdProduitAbonnement de la ListeLotAbonnementViewVO
	*/
	public function getIdProduitAbonnement() {
		return $this->mIdProduitAbonnement;
	}

	/**
	* @name setIdProduitAbonnement($pIdProduitAbonnement)
	* @param int(11)
	* @desc Remplace le membre IdProduitAbonnement de la ListeLotAbonnementViewVO par $pIdProduitAbonnement
	*/
	public function setIdProduitAbonnement($pIdProduitAbonnement) {
		$this->mIdProduitAbonnement = $pIdProduitAbonnement;
	}

	/**
	* @name getTaille()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre Taille de la ListeLotAbonnementViewVO
	*/
	public function getTaille() {
		return $this->mTaille;
	}

	/**
	* @name setTaille($pTaille)
	* @param decimal(10,2) 	
	* @desc Remplace le membre Taille de la ListeLotAbonnementViewVO par $pTaille
	*/
	public function setTaille($pTaille) {
		$this->mTaille = $pTaille;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2) 	
	* @desc Renvoie le membre Prix de la ListeLotAbonnementViewVO
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2) 	
	* @desc Remplace le membre Prix de la ListeLotAbonnementViewVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

}
?>