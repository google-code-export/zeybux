<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/08/2013
// Fichier : FactureResponse.php
//
// Description : Classe FactureResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name FactureResponse
 * @author Julien PIERRE
 * @since 18/08/2013
 * @desc Classe représentant une FactureResponse
 */
class FactureResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var FactureVO
	* @desc La Facture de la FactureResponse
	*/
	protected $mFacture;
	
	/**
	 * @var array(BanqueVO)
	 * @desc Les Banques
	 */
	protected $mBanques;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;
	
	/**
	* @var FermeViewVO
	* @desc Ferme de la FactureResponse
	*/
	protected $mFerme;
	
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la FactureResponse
	*/
	protected $mListeProduit;
	
	/**
	* @name FactureResponse()
	* @desc Le constructeur
	*/
	public function FactureResponse($pFacture = null, $pBanques = null, $pTypePaiement = null, $pFerme = null, $pListeProduit = null) {
		$this->mValid = true;
		if(!is_null($pFacture)) {$this->mFacture = $pFacture; }
		if(!is_null($pBanques)) { $this->mBanques = $pBanques; } else { $this->mBanques = array(); }
		if(!is_null($pTypePaiement)) { $this->mTypePaiement = $pTypePaiement; } else { $this->mTypePaiement = array(); }
		if(!is_null($pFerme)) { $this->mFerme = $pFerme; }
		if(!is_null($pListeProduit)) { $this->mListeProduit = $pListeProduit; } else { $this->mListeProduit = array(); }
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
	* @name getFacture()
	* @return FactureVO
	* @desc Renvoie le membre Facture de la FactureResponse
	*/
	public function getFacture(){
		return $this->mFacture;
	}

	/**
	* @name setFacture($pFacture)
	* @param FactureVO
	* @desc Remplace le membre Facture de la FactureResponse par $pFacture
	*/
	public function setFacture($pFacture) {
		$this->mFacture = $pFacture;
	}
	
	/**
	* @name getBanques()
	* @return array(BanqueVO)
	* @desc Renvoie les Banques
	*/
	public function getBanques() {
		return $this->mBanques;
	}

	/**
	* @name setBanques($pBanques)
	* @param array(BanqueVO)
	* @desc Remplace les Banques par $pBanques
	*/
	public function setBanques($pBanques) {
		$this->mBanques = $pBanques;
	}
	
	/**
	 * @name addBanques($pBanque)
	 * @param BanqueVO
	 * @desc Ajoute la Banque à Banques
	 */
	public function addBanques($pBanque) {
		array_push($this->mBanques,$pBanque);
	}
	
	/**
	* @name getTypePaiement()
	* @return array(TypePaiementVO)
	* @desc Renvoie le TypePaiement
	*/
	public function getTypePaiement() {
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le TypePaiement par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}
	
	/**
	* @name addTypePaiement($pTypePaiement)
	* @param TypePaiementVO
	* @desc Ajoute le $pTypePaiement à TypePaiement
	*/
	public function addTypePaiement($pTypePaiement) {
		array_push($this->mTypePaiement, $pTypePaiement);
	}
		
	/**
	* @name getFerme()
	* @return FermeViewVO
	* @desc Renvoie le membre Ferme de la FactureResponse
	*/
	public function getFerme(){
		return $this->mFerme;
	}

	/**
	* @name setFerme($pFerme)
	* @param FermeViewVO
	* @desc Remplace le membre Ferme de la FactureResponse par $pFerme
	*/
	public function setFerme($pFerme) {
		$this->mFerme = $pFerme;
	}
	
	/**
	* @name getListeProduit()
	* @return array(NomProduitViewVO)
	* @desc Renvoie le membre ListeProduit de la FactureResponse
	*/
	public function getListeProduit(){
		return $this->mListeProduit;
	}

	/**
	* @name setListeProduit($pListeProduit)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre ListeProduit de la FactureResponse par $pListeProduit
	*/
	public function setListeProduit($pListeProduit) {
		$this->mListeProduit = $pListeProduit;
	}
	
	/**
	* @name addListeProduit($pListeProduit)
	* @param NomProduitViewVO
	* @desc Ajoute $pListeProduit à ListeProduit
	*/
	public function addListeProduit($pListeProduit){
		array_push($this->mListeProduit,$pListeProduit);
	}
}
?>