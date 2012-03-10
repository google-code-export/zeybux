<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/11/2011
// Fichier : InfoFormulaireModifierProduitResponse.php
//
// Description : Classe InfoFormulaireModifierProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoFormulaireModifierProduitResponse
 * @author Julien PIERRE
 * @since 05/11/2011
 * @desc Classe représentant une InfoFormulaireModifierProduitResponse
 */
class InfoFormulaireModifierProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ProducteurViewVO)
	* @desc ListeProducteur de la InfoFormulaireModifierProduitResponse
	*/
	protected $mListeProducteur;
	
	/**
	* @var array(ListeCaracteristiqueViewVO)
	* @desc ListeCaracteristique de la InfoFormulaireModifierProduitResponse
	*/
	protected $mListeCaracteristique;
	
	/**
	* @var NomProduitCatalogueVO
	* @desc DetailProduit de la DetailProduitResponse
	*/
	protected $mProduit;
	
	/**
	* @name InfoFormulaireModifierProduitResponse()
	* @desc Le constructeur de InfoFormulaireModifierProduitResponse
	*/	
	public function InfoFormulaireModifierProduitResponse() {
		$this->mValid = true;
		$this->mListeProducteur = array();
		$this->mListeCaracteristique = array();
	}
	
	/**
	* @name getValid()
	* @return bool
	* @desc Renvoie la validite de l'élément
	*/
	public function getValid() {
		return $this->mValid;
	}

	/**
	* @name setValid($pValid)
	* @param bool
	* @desc Remplace la validite de l'élément par $pValid
	*/
	public function setValid($pValid) {
		$this->mValid = $pValid;
	}
		
	/**
	* @name getListeProducteur()
	* @return array(ProducteurViewVO)
	* @desc Renvoie le membre ListeProducteur de la InfoFormulaireModifierProduitResponse
	*/
	public function getListeProducteur(){
		return $this->mListeProducteur;
	}

	/**
	* @name setListeProducteur($pListeProducteur)
	* @param array(ProducteurViewVO)
	* @desc Remplace le membre ListeProducteur de la InfoFormulaireModifierProduitResponse par $pListeProducteur
	*/
	public function setListeProducteur($pListeProducteur) {
		$this->mListeProducteur = $pListeProducteur;
	}
	
	/**
	* @name addListeProducteur($pListeProducteur)
	* @param ProducteurViewVO
	* @desc Ajoute $pListeProducteur à ListeProducteur
	*/
	public function addListeProducteur($pListeProducteur){
		array_push($this->mListeProducteur,$pListeProducteur);
	}
	
	/**
	* @name getListeCaracteristique()
	* @return array(ListeCaracteristiqueViewVO)
	* @desc Renvoie le membre ListeCaracteristique de la ListeCaracteristiqueResponse
	*/
	public function getListeCaracteristique(){
		return $this->mListeCaracteristique;
	}

	/**
	* @name setListeCaracteristique($pListeCaracteristique)
	* @param array(ListeCaracteristiqueViewVO)
	* @desc Remplace le membre ListeCaracteristique de la ListeCaracteristiqueResponse par $pListeCaracteristique
	*/
	public function setListeCaracteristique($pListeCaracteristique) {
		$this->mListeCaracteristique = $pListeCaracteristique;
	}
	
	/**
	* @name addListeCaracteristique($pListeCaracteristique)
	* @param ListeCaracteristiqueViewVO
	* @desc Ajoute $pListeCaracteristique à ListeCaracteristique
	*/
	public function addListeCaracteristique($pListeCaracteristique){
		array_push($this->mListeCaracteristique,$pListeCaracteristique);
	}
	
	/**
	* @name getProduit()
	* @return NomProduitCatalogueVO
	* @desc Renvoie le membre Produit de la DetailProduitResponse
	*/
	public function getProduit(){
		return $this->mProduit;
	}

	/**
	* @name setProduit($pProduit)
	* @param NomProduitCatalogueVO
	* @desc Remplace le membre Produit de la DetailProduitResponse par $pProduit
	*/
	public function setProduit($pProduit) {
		$this->mProduit = $pProduit;
	}
}
?>