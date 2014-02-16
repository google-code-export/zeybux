<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : AchatVR.php
//
// Description : Classe AchatVR
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );

/**
 * @name AchatVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une AchatVR
 */
class AchatVR extends TemplateVR
{
	/**
	* @var OperationDetailVO
	* @desc OperationAchat de la AchatVR
	*/
	protected $mOperationAchat;

	/**
	* @var OperationDetailVO
	* @desc OperationAchatSolidaire de la AchatVR
	*/
	protected $mOperationAchatSolidaire;

	/**
	* @var array(ProduitDetailAchatVR)
	* @desc Produits de la AchatVR
	*/
	protected $mProduits;

	/**
	* @var OperationDetailVO
	* @desc Rechargement de la AchatVR
	*/
	protected $mRechargement;

	/**
	* @name AchatVR()
	* @return bool
	* @desc Constructeur
	*/
	function AchatVR() {
		parent::__construct();
		$this->mOperationAchat = new VRelement();
		$this->mOperationAchatSolidaire = new VRelement();
		$this->mProduits = array();
		$this->mRechargement = new VRelement();
	}

	/**
	* @name getOperationAchat()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationAchat de la AchatVR
	*/
	public function getOperationAchat() {
		return $this->mOperationAchat;
	}

	/**
	* @name setOperationAchat($pOperationAchat)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationAchat de la AchatVR par $pOperationAchat
	*/
	public function setOperationAchat($pOperationAchat) {
		$this->mOperationAchat = $pOperationAchat;
	}
	
	/**
	* @name getOperationAchatSolidaire()
	* @return OperationDetailVO
	* @desc Renvoie le membre OperationAchatSolidaire de la AchatVR
	*/
	public function getOperationAchatSolidaire() {
		return $this->mOperationAchatSolidaire;
	}

	/**
	* @name setOperationAchatSolidaire($pOperationAchatSolidaire)
	* @param OperationDetailVO
	* @desc Remplace le membre OperationAchatSolidaire de la AchatVR par $pOperationAchatSolidaire
	*/
	public function setOperationAchatSolidaire($pOperationAchatSolidaire) {
		$this->mOperationAchatSolidaire = $pOperationAchatSolidaire;
	}
		
	/**
	* @name getProduits()
	* @return array(ProduitDetailAchatVR)
	* @desc Renvoie le membre Produits de la AchatVR
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduit)
	* @param array(ProduitDetailAchatVR)
	* @desc Remplace le membre Produits de la AchatVR par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduit)
	* @return ProduitDetailAchatVR
	* @desc Ajoute $pProduit à Produits
	*/
	public function addProduits($pProduit){
		array_push($this->mProduits,$pProduit);
	}
	
	/**
	* @name getRechargement()
	* @return OperationDetailVO
	* @desc Renvoie le membre Rechargement de la AchatVR
	*/
	public function getRechargement() {
		return $this->mRechargement;
	}

	/**
	* @name setRechargement($pRechargement)
	* @param OperationDetailVO
	* @desc Remplace le membre Rechargement de la AchatVR par $pRechargement
	*/
	public function setRechargement($pRechargement) {
		$this->mRechargement = $pRechargement;
	}
}
?>