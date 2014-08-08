<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2013
// Fichier : FactureVO.php
//
// Description : Classe FactureVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FactureVO
 * @author Julien PIERRE
 * @since 04/08/2013
 * @desc Classe représentant une FactureVO
 */
class FactureVO  extends DataTemplate
{
	/**
	* @var OperationDetailVO
	* @desc Id de la FactureVO
	*/
	protected $mId;

	/**
	* @var OperationDetailVO
	* @desc OperationProducteur de la FactureVO
	*/
	protected $mOperationProducteur;

	/**
	* @var OperationDetailVO
	* @desc OperationZeybu de la FactureVO
	*/
	protected $mOperationZeybu;

	/**
	* @var array(ProduitBonDeLivraisonVO)
	* @desc Produits de la FactureVO
	*/
	protected $mProduits;

	/**
	 * @name FactureVO()
	 * @return bool
	 * @desc Constructeur
	 */
	function FactureVO($pId = null, $pOperationProducteur = null, $pOperationZeybu = null, $pProduits = null) {
		if(!is_null($pId)) {$this->mId = $pId; }
		if(!is_null($pOperationProducteur)) {$this->mOperationProducteur = $pOperationProducteur; }
		if(!is_null($pOperationZeybu)) {$this->mOperationZeybu = $pOperationZeybu; }
		if(!is_null($pProduits)) {$this->mProduits = $pProduits; } else { $this->mProduits = array(); }		
	}
	
	/**
	* @name getId()
	* @return OperationDetailVO
	* @desc Renvoie le membre Id de la FactureVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param OperationDetailVO
	* @desc Remplace le membre Id de la FactureVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getOperationProducteur()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationProducteur de la FactureVO
	*/
	public function getOperationProducteur() {
		return $this->mOperationProducteur;
	}

	/**
	* @name setOperationProducteur($pOperationProducteur)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationProducteur de la FactureVO par $pOperationProducteur
	*/
	public function setOperationProducteur($pOperationProducteur) {
		$this->mOperationProducteur = $pOperationProducteur;
	}

	/**
	* @name getOperationZeybu()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationZeybu de la FactureVO
	*/
	public function getOperationZeybu() {
		return $this->mOperationZeybu;
	}

	/**
	* @name setOperationZeybu($pOperationZeybu)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationZeybu de la FactureVO par $pOperationZeybu
	*/
	public function setOperationZeybu($pOperationZeybu) {
		$this->mOperationZeybu = $pOperationZeybu;
	}

	/**
	* @name getProduits()
	* @return array(ProduitBonDeLivraisonVO)
	* @desc Renvoie le membre Produits de la FactureVO
	*/
	public function getProduits() {
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(ProduitBonDeLivraisonVO)
	* @desc Remplace le membre Produits de la FactureVO par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	 * @name addtProduits($pProduits)
	 * @param ProduitBonDeLivraisonVO
	 * @desc Ajoute $pProduits au membre Produits de la FactureVO 
	 */
	public function addtProduits($pProduits) {
		array_push($this->mProduits, $pProduits);
	}
}
?>