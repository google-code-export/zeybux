<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : EditerCommandeResponse.php
//
// Description : Classe EditerCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name EditerCommandeResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une EditerCommandeResponse
 */
class EditerCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var array(CommandeCompleteViewVO)
	 * @desc La commande
	 */
	protected $mCommande;
	
	/**
	 * @var array(StockProduitViewVO)
	 * @desc Les Stocks
	 */
	protected $mStock;
	
	/**
	 * @var array(StockVO)
	 * @desc Les Stocks Initiaux
	 */
	protected $mStockInitiaux;
	
	/**
	 * @var array(ListeAdherentCommandeViewVO)
	 * @desc La Liste des adhérents qui ont commandés
	 */
	protected $mListeAdherentCommande;
	
	/**
	* @name AfficheAjoutCommandeResponse()
	* @desc Le constructeur
	*/
	public function AfficheAjoutCommandeResponse() {
		$this->mValid = true;
		$this->mCommande = array();
		$this->mStock = array();
		$this->mStockInitiaux = array();
		$this->mListeAdherentCommande = array();
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
	* @name getCommande()
	* @return array(CommandeCompleteViewVO)
	* @desc Renvoie le Commande
	*/
	public function getCommande() {
		return $this->mCommande;
	}

	/**
	* @name setCommande($pCommande)
	* @param array(CommandeCompleteViewVO)
	* @desc Remplace le Commande par $pCommande
	*/
	public function setCommande($pCommande) {
		$this->mCommande = $pCommande;
	}
	
	/**
	* @name addCommande($pCommande)
	* @param CommandeCompleteViewVO
	* @desc Ajoute le $pCommande à Commande
	*/
	public function addCommande($pCommande) {
		array_push($this->mCommande, $pCommande);
	}
	
	/**
	* @name getStock()
	* @return array(StockProduitViewVO)
	* @desc Renvoie le Stock
	*/
	public function getStock() {
		return $this->mStock;
	}

	/**
	* @name setStock($pStock)
	* @param array(StockProduitViewVO)
	* @desc Remplace le Stock par $pStock
	*/
	public function setStock($pStock) {
		$this->mStock = $pStock;
	}
	
	/**
	* @name addStock($pStock)
	* @param StockProduitViewVO
	* @desc Ajoute Stock à $pStock
	*/
	public function addStock($pStock) {
		array_push($this->mStock, $pStock);
	}
	
	/**
	* @name getStockInitiaux()
	* @return array(StockVO)
	* @desc Renvoie le Stock Initiaux
	*/
	public function getStockInitiaux() {
		return $this->mStockInitiaux;
	}

	/**
	* @name setStockInitiaux($pStockInitiaux)
	* @param array(StockVO)
	* @desc Remplace le Stock par $pStock
	*/
	public function setStockInitiaux($pStockInitiaux) {
		$this->mStockInitiaux = $pStockInitiaux;
	}
	
	/**
	* @name addStockInitiaux($pStockInitiaux)
	* @param StockVO
	* @desc Ajoute StockInitiaux à $pStockInitiaux
	*/
	public function addStockInitiaux($pStockInitiaux) {
		array_push($this->mStockInitiaux, $pStockInitiaux);
	}
		
	/**
	* @name getListeAdherentCommande()
	* @return array(ListeAdherentCommandeViewVO)
	* @desc Renvoie le membre ListeAdherentCommande de la EditerCommandeResponse
	*/
	public function getListeAdherentCommande(){
		return $this->mListeAdherentCommande;
	}

	/**
	* @name setListeAdherentCommande($pListeAdherentCommande)
	* @param array(ListeAdherentCommandeViewVO)
	* @desc Remplace le membre ListeAdherentCommande de la EditerCommandeResponse par $pListeAdherentCommande
	*/
	public function setListeAdherentCommande($pListeAdherentCommande) {
		$this->mListeAdherentCommande = $pListeAdherentCommande;
	}
	
	/**
	* @name addListeAdherentCommande($pListeAdherentCommande)
	* @param ListeAdherentCommandeViewVO
	* @desc Ajoute $pListeAdherentCommande à ListeAdherentCommande
	*/
	public function addListeAdherentCommande($pListeAdherentCommande){
		array_push($this->mListeAdherentCommande,$pListeAdherentCommande);
	}
}
?>