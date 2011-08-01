<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : AfficheBonDeLivraisonResponse.php
//
// Description : Classe AfficheBonDeLivraisonResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheBonDeLivraisonResponse
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une AfficheBonDeLivraisonResponse
 */
class AfficheBonDeLivraisonResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;

	/**
	 * @var int(11)
	 * @desc Le numero de la commande
	 */
	protected $mComNumero;
	
	/**
	 * @var array(ListeProducteurCommandeViewVO)
	 * @desc Les producteurs
	 */
	protected $mProducteurs;
	
	/**
	 * @var array(TypePaiementVO)
	 * @desc La liste des types de paiement
	 */
	protected $mTypePaiement;
	
	/**
	* @name AfficheBonDeLivraisonResponse()
	* @desc Le constructeur
	*/
	public function AfficheBonDeLivraisonResponse() {
		$this->mValid = true;
		$this->mProducteurs = array();
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
	* @name getComNumero()
	* @return int(11)
	* @desc Renvoie le ComNumero
	*/
	public function getComNumero() {
		return $this->mComNumero;
	}

	/**
	* @name setComNumero($pComNumero)
	* @param int(11)
	* @desc Remplace le ComNumero par $pComNumero
	*/
	public function setComNumero($pComNumero) {
		$this->mComNumero = $pComNumero;
	}
	
	/**
	* @name getProducteurs()
	* @return array(ListeProducteurCommandeViewVO)
	* @desc Renvoie les Producteurs
	*/
	public function getProducteurs() {
		return $this->mProducteurs;
	}

	/**
	* @name setProducteurs($pProducteurs)
	* @param array(ListeProducteurCommandeViewVO)
	* @desc Remplace le Producteurs par $pProducteurs
	*/
	public function setProducteurs($pProducteurs) {
		$this->mProducteurs = $pProducteurs;
	}
	
	/**
	* @name addProducteurs($pProducteurs)
	* @param ListeProducteurCommandeViewVO
	* @desc Ajoute $pProducteurs à Producteurs
	*/
	public function addProducteurs($pProducteurs){
		array_push($this->mProducteurs,$pProducteurs);
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