<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/08/2011
// Fichier : AchatAdherentResponse.php
//
// Description : Classe AchatAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AchatAdherentResponse
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe représentant une AchatAdherentResponse
 */
class AchatAdherentResponse extends DataTemplate
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
	 * @var ReservationVO
	 * @desc Les reservations
	 */
	protected $mReservation;
	
	/**
	 * @var array(AchatVO)
	 * @desc Les achats
	 */
	protected $mAchats;
	
	/**
	 * @var array(DetailProduitVO)
	 * @desc Le détail des produits
	 */
	protected $mDetailProduit;
	
	/**
	* @name InfoAchatCommandeResponse()
	* @desc Le constructeur de InfoAchatCommandeResponse
	*/	
	public function InfoAchatCommandeResponse() {
		$this->mValid = true;
		$this->mDetailProduit = array();
		$this->mAchats = array();
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
	* @name getReservation()
	* @return ReservationVO
	* @desc Renvoie le Reservation
	*/
	public function getReservation() {
		return $this->mReservation;
	}

	/**
	* @name setReservation($pReservation)
	* @param ReservationVO
	* @desc Remplace le Reservation par $pReservation
	*/
	public function setReservation($pReservation) {
		$this->mReservation = $pReservation;
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
	* @name addAchats($pAchat)
	* @param AchatVO
	* @desc Ajoute Achats à $pAchats
	*/
	public function addAchats($pAchat) {
		array_push($this->mAchats,$pAchat);
	}

	/**
	 * @name getDetailProduit()
	 * @return array(DetailProduitVO)
	 * @desc Renvoie le DetailProduit
	 */
	public function getDetailProduit() {
		return $this->mDetailProduit;
	}
	
	/**
	 * @name setDetailProduit($pDetailProduit)
	 * @param array(DetailProduitVO)
	 * @desc Remplace le DetailProduit par $pDetailProduit
	 */
	public function setDetailProduit($pDetailProduit) {
		$this->mDetailProduit = $pDetailProduit;
	}
	
	/**
	 * @name addDetailProduit($pDetailProduit)
	 * @param DetailProduitVO
	 * @desc Ajoute DetailProduit à $pDetailProduit
	 */
	public function addDetailProduit($pDetailProduit) {
		array_push($this->mDetailProduit,$pDetailProduit);
	}
}
?>