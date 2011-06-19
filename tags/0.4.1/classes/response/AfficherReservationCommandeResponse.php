<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 19/10/2010
// Fichier : AfficherReservationCommandeResponse.php
//
// Description : Classe AfficherReservationCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficherReservationCommandeResponse
 * @author Julien PIERRE
 * @since 19/10/2010
 * @desc Classe représentant une AfficherReservationCommandeResponse
 */
class AfficherReservationCommandeResponse extends DataTemplate
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
	 * @var AdherentViewVO
	 * @desc L'adhérent
	 */
	protected $mAdherent;
	
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
	* @name getAdherent()
	* @return AdherentViewVO
	* @desc Renvoie l'Adherent
	*/
	public function getAdherent() {
		return $this->mAdherent;
	}

	/**
	* @name setAdherent($pAdherent)
	* @param AdherentViewVO
	* @desc Remplace l'Adherent par $pAdherent
	*/
	public function setAdherent($pAdherent) {
		$this->mAdherent = $pAdherent;
	}
}
?>