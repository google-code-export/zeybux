<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/03/2012
// Fichier : DetailAbonnementResponse.php
//
// Description : Classe DetailAbonnementResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailAbonnementResponse
 * @author Julien PIERRE
 * @since 08/03/2012
 * @desc Classe représentant une DetailAbonnementResponse
 */
class DetailAbonnementResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AbonnementListeAdherentViewVo
	* @desc Produit de la DetailAbonnementResponse
	*/
	protected $mProduit;
	
	/**
	* @var DetailCompteAbonnementViewManager
	* @desc Abonnement de la DetailAbonnementResponse
	*/
	protected $mAbonnement;
	
	/**
	* @name DetailAbonnementResponse()
	* @desc Le constructeur de DetailAbonnementResponse
	*/	
	public function DetailAbonnementResponse() {
		$this->mValid = true;
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
	* @name getAbonnement()
	* @return DetailCompteAbonnementViewManager
	* @desc Renvoie le membre Abonnement de la DetailAbonnementResponse
	*/
	public function getAbonnement(){
		return $this->mAbonnement;
	}

	/**
	* @name setAbonnement($pAbonnement)
	* @param DetailCompteAbonnementViewManager
	* @desc Remplace le membre Abonnement de la DetailAbonnementResponse par $pAbonnement
	*/
	public function setAbonnement($pAbonnement) {
		$this->mAbonnement = $pAbonnement;
	}
}
?>