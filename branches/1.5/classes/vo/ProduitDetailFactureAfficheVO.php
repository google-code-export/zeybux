<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/08/2013
// Fichier : ProduitDetailFactureAfficheVO.php
//
// Description : Classe ProduitDetailFactureAfficheVO
//
//****************************************************************
include_once(CHEMIN_CLASSES_VO . "ProduitDetailFactureVO.php");

/**
 * @name ProduitDetailFactureAfficheVO
 * @author Julien PIERRE
 * @since 18/08/2013
 * @desc Classe représentant une ProduitDetailFactureAfficheVO
 */
class ProduitDetailFactureAfficheVO  extends ProduitDetailFactureVO
{
	/**
	* @var int(11)
	* @desc CproId de la ProduitDetailFactureAfficheVO
	*/
	protected $mCproId;

	/**
	* @var varchar(50)
	* @desc CproNom de la ProduitDetailFactureAfficheVO
	*/
	protected $mCproNom;
	
	/**
	 * @var varchar(50)
	 * @desc NproNumero de la ProduitDetailFactureAfficheVO
	 */
	protected $mNproNumero;
	
	/**
	* @var varchar(50)
	* @desc NproNom de la ProduitDetailFactureAfficheVO
	*/
	protected $mNproNom;
	
	/**
	 * @name ProduitDetailFactureAfficheVO()
	 * @desc Le constructeur
	 */
	public function ProduitDetailFactureAfficheVO($pIdNomProduit = null, $pIdStock = null, $pIdDetailOperation = null, $pIdStockSolidaire = null, $pQuantite = null, $pUnite = null, $pQuantiteSolidaire = null, $pUniteSolidaire = null, $pMontant = null, $pCproId = null, $pCproNom = null, $pNproNumero = null, $pNproNom = null) {
		if(!is_null($pIdNomProduit)) { $this->mIdNomProduit = $pIdNomProduit; }
		if(!is_null($pIdStock)) { $this->mIdStock = $pIdStock; }
		if(!is_null($pIdDetailOperation)) { $this->mIdDetailOperation = $pIdDetailOperation; }
		if(!is_null($pIdStockSolidaire)) { $this->mIdStockSolidaire = $pIdStockSolidaire; }
		if(!is_null($pQuantite)) { $this->mQuantite = $pQuantite; }
		if(!is_null($pUnite)) { $this->mUnite = $pUnite; }
		if(!is_null($pQuantiteSolidaire)) { $this->mQuantiteSolidaire = $pQuantiteSolidaire; }
		if(!is_null($pUniteSolidaire)) { $this->mUniteSolidaire = $pUniteSolidaire; }
		if(!is_null($pMontant)) { $this->mMontant = $pMontant; }
		if(!is_null($pCproId)) { $this->mCproId = $pCproId; }
		if(!is_null($pCproNom)) { $this->mCproNom = $pCproNom; }
		if(!is_null($pNproNumero)) { $this->mNproNumero = $pNproNumero; }
		if(!is_null($pNproNom)) { $this->mNproNom = $pNproNom; }
	}
	
	/**
	* @name getCproId()
	* @return int(11)
	* @desc Renvoie le membre CproId de la ProduitDetailFactureAfficheVO
	*/
	public function getCproId() {
		return $this->mCproId;
	}

	/**
	* @name setCproId($pCproId)
	* @param int(11)
	* @desc Remplace le membre CproId de la ProduitDetailFactureAfficheVO par $pCproId
	*/
	public function setCproId($pCproId) {
		$this->mCproId = $pCproId;
	}
	
	/**
	* @name getCproNom()
	* @return varchar(50)
	* @desc Renvoie le membre CproNom de la ProduitDetailFactureAfficheVO
	*/
	public function getCproNom() {
		return $this->mCproNom;
	}

	/**
	* @name setCproNom($pCproNom)
	* @param varchar(50)
	* @desc Remplace le membre CproNom de la ProduitDetailFactureAfficheVO par $pCproNom
	*/
	public function setCproNom($pCproNom) {
		$this->mCproNom = $pCproNom;
	}
	
	/**
	* @name getNproNumero()
	* @return varchar(50)
	* @desc Renvoie le membre NproNumero de la ProduitDetailFactureAfficheVO
	*/
	public function getNproNumero() {
		return $this->mNproNumero;
	}

	/**
	* @name setNproNumero($pNproNumero)
	* @param varchar(50)
	* @desc Remplace le membre NproNumero de la ProduitDetailFactureAfficheVO par $pNproNumero
	*/
	public function setNproNumero($pNproNumero) {
		$this->mNproNumero = $pNproNumero;
	}
	
	/**
	* @name getNproNom()
	* @return varchar(50)
	* @desc Renvoie le membre NproNom de la ProduitDetailFactureAfficheVO
	*/
	public function getNproNom() {
		return $this->mNproNom;
	}

	/**
	* @name setNproNom($pNproNom)
	* @param varchar(50)
	* @desc Remplace le membre NproNom de la ProduitDetailFactureAfficheVO par $pNproNom
	*/
	public function setNproNom($pNproNom) {
		$this->mNproNom = $pNproNom;
	}
}
?>