<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/05/2010
// Fichier : MaxProduitCommandeVO.php
//
// Description : Classe MaxProduitCommandeVO
//
//****************************************************************

/**
 * @name MaxProduitCommandeVO
 * @author Julien PIERRE
 * @since 06/05/2010
 * @desc Classe représentant une MaxProduitCommandeVO
 */
class MaxProduitCommandeVO
{
	/**
	* @var int(11)
	* @desc Id de la MaxProduitCommandeVO
	*/
	private $mId;

	/**
	* @var int(11)
	* @desc IdCommande de la MaxProduitCommandeVO
	*/
	private $mIdCommande;

	/**
	* @var int(11)
	* @desc IdProduit de la MaxProduitCommandeVO
	*/
	private $mIdProduit;

	/**
	* @var int(11)
	* @desc MaxProduitCommande de la MaxProduitCommandeVO
	*/
	private $mMaxProduitCommande;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la MaxProduitCommandeVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la MaxProduitCommandeVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCommande()
	* @return int(11)
	* @desc Renvoie le membre IdCommande de la MaxProduitCommandeVO
	*/
	public function getIdCommande(){
		return $this->mIdCommande;
	}

	/**
	* @name setIdCommande($pIdCommande)
	* @param int(11)
	* @desc Remplace le membre IdCommande de la MaxProduitCommandeVO par $pIdCommande
	*/
	public function setIdCommande($pIdCommande) {
		$this->mIdCommande = $pIdCommande;
	}

	/**
	* @name getIdProduit()
	* @return int(11)
	* @desc Renvoie le membre IdProduit de la MaxProduitCommandeVO
	*/
	public function getIdProduit(){
		return $this->mIdProduit;
	}

	/**
	* @name setIdProduit($pIdProduit)
	* @param int(11)
	* @desc Remplace le membre IdProduit de la MaxProduitCommandeVO par $pIdProduit
	*/
	public function setIdProduit($pIdProduit) {
		$this->mIdProduit = $pIdProduit;
	}

	/**
	* @name getMaxProduitCommande()
	* @return int(11)
	* @desc Renvoie le membre MaxProduitCommande de la MaxProduitCommandeVO
	*/
	public function getMaxProduitCommande(){
		return $this->mMaxProduitCommande;
	}

	/**
	* @name setMaxProduitCommande($pMaxProduitCommande)
	* @param int(11)
	* @desc Remplace le membre MaxProduitCommande de la MaxProduitCommandeVO par $pMaxProduitCommande
	*/
	public function setMaxProduitCommande($pMaxProduitCommande) {
		$this->mMaxProduitCommande = $pMaxProduitCommande;
	}

}
?>