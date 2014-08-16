<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : DetailProduitResponse.php
//
// Description : Classe DetailProduitResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailProduitResponse
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une DetailProduitResponse
 */
class DetailProduitResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var AbonnementListeAdherentViewVo
	* @desc Produit de la DetailProduitResponse
	*/
	protected $mProduit;
	
	/**
	* @var array(ListeProduitsAbonneViewVo)
	* @desc Abonnes de la DetailProduitResponse
	*/
	protected $mAbonnes;
	
	/**
	* @name DetailProduitResponse()
	* @desc Le constructeur de DetailProduitResponse
	*/	
	public function DetailProduitResponse() {
		$this->mValid = true;
		$this->mAbonnes = array();
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
	* @name getAbonnes()
	* @return array(ListeAbonnesAbonneViewVo)
	* @desc Renvoie le membre Abonnes de la DetailProduitResponse
	*/
	public function getAbonnes(){
		return $this->mAbonnes;
	}

	/**
	* @name setAbonnes($pAbonnes)
	* @param array(ListeAbonnesAbonneViewVo)
	* @desc Remplace le membre Abonnes de la DetailProduitResponse par $pAbonnes
	*/
	public function setAbonnes($pAbonnes) {
		$this->mAbonnes = $pAbonnes;
	}
	
	/**
	* @name addAbonnes($pAbonnes)
	* @param ListeAbonnesAbonneViewVo
	* @desc Ajoute $pAbonnes à Abonnes
	*/
	public function addAbonnes($pAbonnes){
		array_push($this->mAbonnes,$pAbonnes);
	}
}
?>