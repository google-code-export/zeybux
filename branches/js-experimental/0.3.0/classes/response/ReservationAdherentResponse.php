<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : ReservationAdherentResponse.php
//
// Description : Classe ReservationAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ReservationAdherentResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une ReservationAdherentResponse
 */
class ReservationAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var AdherentViewVO
	 * @desc L'adhérent
	 */
	protected $mAdherent;
	
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
	 * @var array(stockVO)
	 * @desc Les reservations
	 */
	protected $mReservation;
	
	/**
	* @name InfoAchatCommandeResponse()
	* @desc Le constructeur de InfoAchatCommandeResponse
	*/	
	public function InfoAchatCommandeResponse() {
		$this->mValid = true;
		$this->mCommande = array();
		$this->mStock = array();
		$this->mReservation = array();
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
	* @return AdherentViewVO
	* @desc Renvoie mAdherent
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace mAdherent de l'élément par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
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
	* @return CommandeCompleteViewVO
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
}
?>