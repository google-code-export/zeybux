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
	protected $mValid = true;

	/**
	 * @var MarcheVO
	 * @desc Le Marche
	 */
	protected $mMarche;
	
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
	 * @var array(AchatVO)
	 * @desc Les Achats
	 */
	protected $mAchats;
	
	/**
	 * @var array(BanqueVO)
	 * @desc Les Banques
	 */
	protected $mBanques;

	/**
	* @name InfoAchatCommandeResponse()
	* @desc Le constructeur de InfoAchatCommandeResponse
	*/	
	public function InfoAchatCommandeResponse() {
		$this->mValid = true;
		$this->mMarche = array();
		$this->mStock = array();
		$this->mStockSolidaire = array();
		$this->mReservation = array();
		$this->mTypePaiement = array();
		$this->mAchats = array();
		$this->mBanques = array();
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
	* @name getMarche()
	* @return array(MarcheCompleteViewVO)
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param array(MarcheCompleteViewVO)
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}
	
	/**
	* @name addMarche($pMarche)
	* @param MarcheCompleteViewVO
	* @desc Ajoute le $pMarche à Marche
	*/
	public function addMarche($pMarche) {
		array_push($this->mMarche, $pMarche);
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
	
	/**
	* @name getAchats()
	* @return array(AchatVO)
	* @desc Renvoie le Achats
	*/
	public function getAchats() {
		return $this->mAchats;
	}

	/**
	* @name setAchats($pAchats)
	* @param array(AchatVO)
	* @desc Remplace le Achats par $pAchats
	*/
	public function setAchats($pAchats) {
		$this->mAchats = $pAchats;
	}
	
	/**
	* @name addAchats($pAchats)
	* @param AchatVO
	* @desc Ajoute le $pAchats à Achats
	*/
	public function addAchats($pAchats) {
		array_push($this->mAchats, $pAchats);
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
}
?>