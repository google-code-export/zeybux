<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 07/09/2013
// Fichier : ProduitDetailAchatAfficheVO.php
//
// Description : Classe ProduitDetailAchatAfficheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "ProduitDetailAchatVO.php");

/**
 * @name ProduitDetailAchatAfficheVO
 * @author Julien PIERRE
 * @since 07/09/2013
 * @desc Classe représentant une ProduitDetailAchatAfficheVO
 */
class ProduitDetailAchatAfficheVO  extends ProduitDetailAchatVO
{
	/**
	* @var int(11)
	* @desc CproId de la ProduitDetailAchatAfficheVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la ProduitDetailAchatAfficheVO
	*/
	protected $mCproNom;
	
	/**
	 * @var varchar(50)
	 * @desc NproNumero de la ProduitDetailAchatAfficheVO
	 */
	protected $mNproNumero;
	
	/**
	* @var varchar(50)
	* @desc NproNom de la ProduitDetailAchatAfficheVO
	*/
	protected $mNproNom;
	
	/**
	 * @name ProduitDetailAchatAfficheVO()
	 * @desc Le constructeur
	 */
	public function ProduitDetailAchatAfficheVO($pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null, $pIdDetailOperationSolidaire = null, $pIdDetailCommande = null, $pIdModeleLot = null, $pIdDetailCommandeSolidaire = null, $pIdModeleLotSolidaire = null, $pQuantite = null, $pUnite = null, $pQuantiteSolidaire = null, $pUniteSolidaire = null, $pMontant = null, $pMontantSolidaire = null, $pCproId = null, $pCproNom = null, $pNproNumero = null, $pNproNom = null) {
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
		if(!is_null($pIdDetailOperationSolidaire)) { $this->mIdDetailOperationSolidaire = $pIdDetailOperationSolidaire; }
		if(!is_null($pIdDetailCommande)) { $this->mIdDetailCommande = $pIdDetailCommande; }
		if(!is_null($pIdModeleLot)) { $this->mIdModeleLot = $pIdModeleLot; }
		if(!is_null($pIdDetailCommandeSolidaire)) { $this->mIdDetailCommandeSolidaire = $pIdDetailCommandeSolidaire; }
		if(!is_null($pIdModeleLotSolidaire)) { $this->mIdModeleLotSolidaire = $pIdModeleLotSolidaire; }
		if(!is_null($pQuantite)) { $this->mQuantite = $pQuantite; }
		if(!is_null($pUnite)) { $this->mUnite = $pUnite; }
		if(!is_null($pQuantiteSolidaire)) { $this->mQuantiteSolidaire = $pQuantiteSolidaire; }
		if(!is_null($pUniteSolidaire)) { $this->mUniteSolidaire = $pUniteSolidaire; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }	
		if(!is_null($pMontantSolidaire)) { $this->mMontantSolidaire = $pMontantSolidaire; }	
		if(!is_null($pCproId)) { $this->mCproId = $pCproId; }
		if(!is_null($pCproNom)) { $this->mCproNom = $pCproNom; }
		if(!is_null($pNproNumero)) { $this->mNproNumero = $pNproNumero; }
		if(!is_null($pNproNom)) { $this->mNproNom = $pNproNom; }
	}
	
	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la ProduitDetailAchatAfficheVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la ProduitDetailAchatAfficheVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}
	
	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ProduitDetailAchatAfficheVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ProduitDetailAchatAfficheVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la ProduitDetailAchatAfficheVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la ProduitDetailAchatAfficheVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}
	
	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ProduitDetailAchatAfficheVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ProduitDetailAchatAfficheVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}
}
?>