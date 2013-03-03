<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/03/2012
// Fichier : DetailProduitModifierResponse.php
//
// Description : Classe DetailProduitModifierResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProduitModifierResponse
 * @author Julien PIERRE
 * @since 04/03/2012
 * @desc Classe représentant une DetailProduitModifierResponse
 */
class DetailProduitModifierResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AbonnementListeAdherentViewVo
	* @desc Produit de la DetailProduitModifierResponse
	*/
	protected $mProduit;
		
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la DetailProduitModifierResponse
	*/
	protected $mUnite;
	
	/**
	* @name DetailProduitModifierResponse()
	* @desc Le constructeur de DetailProduitModifierResponse
	*/	
	public function DetailProduitModifierResponse() {
		$this->mValid = true;
		$this->mUnite = array();
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
	* @name getProduit()
	* @return AbonnementListeProduitViewVo
	* @desc Renvoie l'Produit de l'élément
	*/
	public function getProduit() {
		return $this->mProduit;
	}

	/**
	* @name setProduit($pProduit)
	* @param AbonnementListeProduitViewVo
	* @desc Remplace ll'Produit de l'élément par $pProduit
	*/
	public function setProduit($pProduit) {
		$this->mProduit = $pProduit;
	}
	
	/**
	* @name getUnite()
	* @return array(NomProduitViewVO)
	* @desc Renvoie le membre Unite de la UniteResponse
	*/
	public function getUnite(){
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre Unite de la UniteResponse par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}
	
	/**
	* @name addUnite($pUnite)
	* @param NomProduitViewVO
	* @desc Ajoute $pUnite à Unite
	*/
	public function addUnite($pUnite){
		array_push($this->mUnite,$pUnite);
	}
}
?>