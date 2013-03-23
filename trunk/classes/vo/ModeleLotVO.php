<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2011
// Fichier : ModeleLotVO.php
//
// Description : Classe ModeleLotVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ModeleLotVO
 * @author Julien PIERRE
 * @since 02/11/2011
 * @desc Classe représentant une ModeleLotVO
 */
class ModeleLotVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ModeleLotVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdNomProduit de la ModeleLotVO
	*/
	protected $mIdNomProduit;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la ModeleLotVO
	*/
	protected $mQuantite;

	/**
	* @var varchar(20)
	* @desc Unite de la ModeleLotVO
	*/
	protected $mUnite;

	/**
	* @var decimal(10,2)
	* @desc Prix de la ModeleLotVO
	*/
	protected $mPrix;

	/**
	* @var tinyint(1)
	* @desc Etat de la ModeleLotVO
	*/
	protected $mEtat;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ModeleLotVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ModeleLotVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ModeleLotVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ModeleLotVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la ModeleLotVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la ModeleLotVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la ModeleLotVO
	*/
	public function getUnite() {
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la ModeleLotVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre Prix de la ModeleLotVO
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre Prix de la ModeleLotVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

	/**
	* @name getEtat()
	* @return tinyint(1)
	* @desc Renvoie le membre Etat de la ModeleLotVO
	*/
	public function getEtat() {
		return $this->mEtat;
	}

	/**
	* @name setEtat($pEtat)
	* @param tinyint(1)
	* @desc Remplace le membre Etat de la ModeleLotVO par $pEtat
	*/
	public function setEtat($pEtat) {
		$this->mEtat = $pEtat;
	}

}
?>