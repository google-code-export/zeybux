<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/09/2010
// Fichier : InfoAchatCommandeResponse.php
//
// Description : Classe InfoAchatCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoAchatCommandeResponse
 * @author Julien PIERRE
 * @since 19/09/2010
 * @desc Classe représentant une InfoAchatCommandeResponse
 */
class InfoAchatCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

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
	 * @var array(StockProduitViewVO)
	 * @desc Les Stocks solidaire
	 */
	protected $mStockSolidaire;
	
	/**
	 * @var AdherentViewVO
	 * @desc L'Adherent
	 */
	protected $mAdherent;
	
	/**
	 * @var array(stockVO)
	 * @desc Les reservations
	 */
	protected $mReservation;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;

	/**
	* @name InfoAchatCommandeResponse()
	* @desc Le constructeur de InfoAchatCommandeResponse
	*/	
	public function InfoAchatCommandeResponse() {
		$this->mValid = true;
		$this->mCommande = array();
		$this->mStock = array();
		$this->mStockSolidaire = array();
		$this->mReservation = array();
		$this->mTypePaiement = array();
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
	* @desc Remplace le Stock par $pStock
	*/
	public function addStock($pStock) {
		array_push($this->mStock, $pStock);
	}
	
	/**
	* @name getStockSolidaire()
	* @return array(StockProduitViewVO)
	* @desc Renvoie le StockSolidaire
	*/
	public function getStockSolidaire() {
		return $this->mStockSolidaire;
	}

	/**
	* @name setStockSolidaire($pStockSolidaire)
	* @param array(StockProduitViewVO)
	* @desc Remplace le StockSolidaire par $pStockSolidaire
	*/
	public function setStockSolidaire($pStockSolidaire) {
		$this->mStockSolidaire = $pStockSolidaire;
	}
	
	/**
	* @name addStockSolidaire($pStockSolidaire)
	* @param StockProduitViewVO
	* @desc Remplace le StockSolidaire par $pStockSolidaire
	*/
	public function addStockSolidaire($pStockSolidaire) {
		array_push($this->mStockSolidaire, $pStockSolidaire);
	}
	
	/**
	* @name getAdherent()
	* @return AdherentViewVO
	* @desc Renvoie le Adherent
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace le Adherent par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
	
	/**
	* @name getReservation()
	* @return array(stockVO)
	* @desc Renvoie le Reservation
	*/
	public function getReservation() {
		return $this->mReservation;
	}

	/**
	* @name setReservation($pReservation)
	* @param array(stockVO)
	* @desc Remplace le Reservation par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
	}
	
	/**
	* @name addReservation($pReservation)
	* @param stockVO
	* @desc Ajoute le $pReservation à Reservation
	*/
	public function addReservation($pReservation) {
		array_push($this->mReservation, $pReservation);
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
}
?>