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

/**
 * @name AchatVO
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une AchatVO
 */
class AchatVO extends DataTemplate
{
	/**
	* @var OperationDetailVO
	* @desc OperationAchat de la AchatVO
	*/
	protected $mOperationAchat;

	/**
	* @var OperationDetailVO
	* @desc OperationAchatSolidaire de la AchatVO
	*/
	protected $mOperationAchatSolidaire;

	/**
	* @var array(ProduitDetailAchatVO)
	* @desc Produits de la AchatVO
	*/
	protected $mProduits;

	/**
	* @var OperationDetailVO
	* @desc Rechargement de la AchatVO
	*/
	protected $mRechargement;
		
	/**
	* @name AchatVO()
	* @desc Le constructeur
	*/
	function AchatVO($pOperationAchat = null, $pOperationAchatSolidaire = null, $pProduits = null, $pRechargement = null) {
		if(!is_null($pOperationAchat)) {$this->mOperationAchat = $pOperationAchat; }
		if(!is_null($pOperationAchatSolidaire)) {$this->mOperationAchatSolidaire = $pOperationAchatSolidaire; }
		if(!is_null($pProduits)) {$this->mProduits = $pProduits; } else { $this->mProduits = array(); }	
		if(!is_null($pRechargement)) {$this->mRechargement = $pRechargement; }	
	}
	
	/**
	* @name getOperationAchat()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationAchat de la AchatVO
	*/
	public function getOperationAchat() {
		return $this->mOperationAchat;
	}

	/**
	* @name setOperationAchat($pOperationAchat)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationAchat de la AchatVO par $pOperationAchat
	*/
	public function setOperationAchat($pOperationAchat) {
		$this->mOperationAchat = $pOperationAchat;
	}
	
	/**
	* @name getOperationAchatSolidaire()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationAchatSolidaire de la AchatVO
	*/
	public function getOperationAchatSolidaire() {
		return $this->mOperationAchatSolidaire;
	}

	/**
	* @name setOperationAchatSolidaire($pOperationAchatSolidaire)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationAchatSolidaire de la AchatVO par $pOperationAchatSolidaire
	*/
	public function setOperationAchatSolidaire($pOperationAchatSolidaire) {
		$this->mOperationAchatSolidaire = $pOperationAchatSolidaire;
	}
		
	/**
	* @name getProduits()
	* @return array(ProduitDetailAchatVO)
	* @desc Renvoie le membre Produits de la AchatVO
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduit)
	* @param array(ProduitDetailAchatVO)
	* @desc Remplace le membre Produits de la AchatVO par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduit)
	* @return ProduitDetailAchatVO
	* @desc Ajoute $pProduit à Produits
	*/
	public function addProduits($pProduit){
		array_push($this->mProduits,$pProduit);
	}
	
	/**
	* @name getRechargement()
	* @return OperationDetailVO
	* @desc Renvoie le membre Rechargement de la AchatVO
	*/
	public function getRechargement() {
		return $this->mRechargement;
	}

	/**
	* @name setRechargement($pRechargement)
	* @param OperationDetailVO
	* @desc Remplace le membre Rechargement de la AchatVO par $pRechargement
	*/
	public function setRechargement($pRechargement) {
		$this->mRechargement = $pRechargement;
	}
}
?>