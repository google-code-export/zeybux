<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/01/2011
// Fichier : AfficheBonDeCommandeResponse.php
//
// Description : Classe AfficheBonDeCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheBonDeCommandeResponse
 * @author Julien PIERRE
 * @since 03/01/2011
 * @desc Classe représentant une AfficheBonDeCommandeResponse
 */
class AfficheBonDeCommandeResponse extends DataTemplate
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
	* @name AfficheBonDeCommandeResponse()
	* @desc Le constructeur
	*/
	public function AfficheBonDeCommandeResponse() {
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
}
?>