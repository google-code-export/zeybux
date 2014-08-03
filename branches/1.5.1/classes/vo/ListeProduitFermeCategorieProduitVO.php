<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/03/2012
// Fichier : ListeProduitFermeCategorieProduitVO.php
//
// Description : Classe ListeProduitFermeCategorieProduitVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProduitFermeCategorieProduitVO
 * @author Julien PIERRE
 * @since 01/03/2012
 * @desc Classe représentant une ListeProduitFermeCategorieProduitVO
 */
class ListeProduitFermeCategorieProduitVO extends DataTemplate
{
	/**
	* @var integer
	* @desc Produits de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mId;
	
	/**
	* @var varchar(50)
	* @desc Nom de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mNom;
	
	/**
	* @var decimal(10,2)
	* @desc Quantite de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mQuantite;
	
	/**
	* @var varchar(20)
	* @desc Unite de la ListeProduitFermeCategorieProduitVO
	*/
	protected $mUnite;
	
	/**
	* @name getId()
	* @return integer
	* @desc Renvoie le membre Id de la ListeProduitFermeCategorieProduitVO
	*/
	public function getId(){
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param integer
	* @desc Remplace le membre Id de la ListeProduitFermeCategorieProduitVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}
	
	/**
	* @name getNom()
	* @return varchar(50)
	* @desc Renvoie le membre Nom de la ListeProduitFermeCategorieProduitVO
	*/
	public function getNom(){
		return $this->mNom;
	}

	/**
	* @name setNom($pNom)
	* @param varchar(50)
	* @desc Remplace le membre Nom de la ListeProduitFermeCategorieProduitVO par $pNom
	*/
	public function setNom($pNom) {
		$this->mNom = $pNom;
	}
	
	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la ListeProduitFermeCategorieProduitVO
	*/
	public function getQuantite(){
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la ListeProduitFermeCategorieProduitVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}
	
	/**
	* @name getUnite()
	* @return varchar(20)
	* @desc Renvoie le membre Unite de la ListeProduitFermeCategorieProduitVO
	*/
	public function getUnite(){
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param varchar(20)
	* @desc Remplace le membre Unite de la ListeProduitFermeCategorieProduitVO par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}
}
?>