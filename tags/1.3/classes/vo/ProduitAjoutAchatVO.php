<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/04/2013
// Fichier : ProduitAjoutAchatVO.php
//
// Description : Classe ProduitAjoutAchatVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ProduitAjoutAchatVO
 * @author Julien PIERRE
 * @since 14/04/2013
 * @desc Classe représentant une ProduitAjoutAchatVO
 */
class ProduitAjoutAchatVO  extends DataTemplate
{
	/**
	* @var int(11)
	* @desc Id de la ProduitAjoutAchatVO
	*/
	protected $mId;

	/**
	* @var int(11)
	* @desc IdCompte de la ProduitAjoutAchatVO
	*/
	protected $mIdCompte;

	/**
	* @var int(11)
	* @desc IdMarche de la ProduitAjoutAchatVO
	*/
	protected $mIdMarche;

	/**
	* @var int(11)
	* @desc IdOperation de la ProduitAjoutAchatVO
	*/
	protected $mIdOperation;

	/**
	* @var int(11)
	* @desc IdNomProduit de la ProduitAjoutAchatVO
	*/
	protected $mIdNomProduit;

	/**
	* @var decimal(10,2)
	* @desc Quantite de la ProduitAjoutAchatVO
	*/
	protected $mQuantite;

	/**
	* @var decimal(10,2)
	* @desc Prix de la ProduitAjoutAchatVO
	*/
	protected $mPrix;

	/**
	* @var int(1)
	* @desc Solidaire de la ProduitAjoutAchatVO
	*/
	protected $mSolidaire;

	/**
	* @name getId()
	* @return int(11)
	* @desc Renvoie le membre Id de la ProduitAjoutAchatVO
	*/
	public function getId() {
		return $this->mId;
	}

	/**
	* @name setId($pId)
	* @param int(11)
	* @desc Remplace le membre Id de la ProduitAjoutAchatVO par $pId
	*/
	public function setId($pId) {
		$this->mId = $pId;
	}

	/**
	* @name getIdCompte()
	* @return int(11)
	* @desc Renvoie le membre IdCompte de la ProduitAjoutAchatVO
	*/
	public function getIdCompte() {
		return $this->mIdCompte;
	}

	/**
	* @name setIdCompte($pIdCompte)
	* @param int(11)
	* @desc Remplace le membre IdCompte de la ProduitAjoutAchatVO par $pIdCompte
	*/
	public function setIdCompte($pIdCompte) {
		$this->mIdCompte = $pIdCompte;
	}

	/**
	* @name getIdMarche()
	* @return int(11)
	* @desc Renvoie le membre IdMarche de la ProduitAjoutAchatVO
	*/
	public function getIdMarche() {
		return $this->mIdMarche;
	}

	/**
	* @name setIdMarche($pIdMarche)
	* @param int(11)
	* @desc Remplace le membre IdMarche de la ProduitAjoutAchatVO par $pIdMarche
	*/
	public function setIdMarche($pIdMarche) {
		$this->mIdMarche = $pIdMarche;
	}

	/**
	* @name getIdOperation()
	* @return int(11)
	* @desc Renvoie le membre IdOperation de la ProduitAjoutAchatVO
	*/
	public function getIdOperation() {
		return $this->mIdOperation;
	}

	/**
	* @name setIdOperation($pIdOperation)
	* @param int(11)
	* @desc Remplace le membre IdOperation de la ProduitAjoutAchatVO par $pIdOperation
	*/
	public function setIdOperation($pIdOperation) {
		$this->mIdOperation = $pIdOperation;
	}

	/**
	* @name getIdNomProduit()
	* @return int(11)
	* @desc Renvoie le membre IdNomProduit de la ProduitAjoutAchatVO
	*/
	public function getIdNomProduit() {
		return $this->mIdNomProduit;
	}

	/**
	* @name setIdNomProduit($pIdNomProduit)
	* @param int(11)
	* @desc Remplace le membre IdNomProduit de la ProduitAjoutAchatVO par $pIdNomProduit
	*/
	public function setIdNomProduit($pIdNomProduit) {
		$this->mIdNomProduit = $pIdNomProduit;
	}

	/**
	* @name getQuantite()
	* @return decimal(10,2)
	* @desc Renvoie le membre Quantite de la ProduitAjoutAchatVO
	*/
	public function getQuantite() {
		return $this->mQuantite;
	}

	/**
	* @name setQuantite($pQuantite)
	* @param decimal(10,2)
	* @desc Remplace le membre Quantite de la ProduitAjoutAchatVO par $pQuantite
	*/
	public function setQuantite($pQuantite) {
		$this->mQuantite = $pQuantite;
	}

	/**
	* @name getPrix()
	* @return decimal(10,2)
	* @desc Renvoie le membre Prix de la ProduitAjoutAchatVO
	*/
	public function getPrix() {
		return $this->mPrix;
	}

	/**
	* @name setPrix($pPrix)
	* @param decimal(10,2)
	* @desc Remplace le membre Prix de la ProduitAjoutAchatVO par $pPrix
	*/
	public function setPrix($pPrix) {
		$this->mPrix = $pPrix;
	}

	/**
	 * @name getSolidaire()
	 * @return int(1)
	 * @desc Renvoie le membre Solidaire de la ProduitAjoutAchatVO
	 */
	public function getSolidaire() {
		return $this->mSolidaire;
	}
	
	/**
	 * @name setSolidaire($pSolidaire)
	 * @param int(1)
	 * @desc Remplace le membre Solidaire de la ProduitAjoutAchatVO par $pSolidaire
	 */
	public function setSolidaire($pSolidaire) {
		$this->mSolidaire = $pSolidaire;
	}

}
?>