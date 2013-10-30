<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : DetailAbonneResponse.php
//
// Description : Classe DetailAbonneResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailAbonneResponse
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe représentant une DetailAbonneResponse
 */
class DetailAbonneResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AbonnementListeAdherentViewVo
	* @desc Adherent de la DetailAbonneResponse
	*/
	protected $mAdherent;
	
	/**
	* @var array(ListeProduitsAbonneViewVo)
	* @desc Produits de la DetailAbonneResponse
	*/
	protected $mProduits;
	
	/**
	* @name DetailAbonneResponse()
	* @desc Le constructeur de DetailAbonneResponse
	*/	
	public function DetailAbonneResponse() {
		$this->mValid = true;
		$this->mProduits = array();
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
	* @name getAdherent()
	* @return AbonnementListeAdherentViewVo
	* @desc Renvoie l'adherent de l'élément
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AbonnementListeAdherentViewVo
	* @desc Remplace ll'adherent de l'élément par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
		
	/**
	* @name getProduits()
	* @return array(ListeProduitsAbonneViewVo)
	* @desc Renvoie le membre Produits de la DetailAbonneResponse
	*/
	public function getProduits(){
		return $this->mProduits;
	}

	/**
	* @name setProduits($pProduits)
	* @param array(ListeProduitsAbonneViewVo)
	* @desc Remplace le membre Produits de la DetailAbonneResponse par $pProduits
	*/
	public function setProduits($pProduits) {
		$this->mProduits = $pProduits;
	}
	
	/**
	* @name addProduits($pProduits)
	* @param ListeProduitsAbonneViewVo
	* @desc Ajoute $pProduits à Produits
	*/
	public function addProduits($pProduits){
		array_push($this->mProduits,$pProduits);
	}
}
?>