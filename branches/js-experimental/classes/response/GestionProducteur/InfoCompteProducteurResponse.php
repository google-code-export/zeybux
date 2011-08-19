<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : InfoCompteProducteurResponse.php
//
// Description : Classe InfoCompteProducteurResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCompteProducteurResponse
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une InfoCompteProducteurResponse
 */
class InfoCompteProducteurResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var ProducteurViewVO
	* @desc Le compte du producteur de la InfoCompteProducteurResponse
	*/
	protected $mProducteur;
	/**
	* @var array(OperationPasseeViewVO)
	* @desc ListeCommande de la InfoCompteProducteurResponse
	*/
	protected $mOperationPassee;
	/**
	* @var array(TypePaiementVO)
	* @desc Les TypePaiement de la InfoCompteProducteurResponse
	*/
	protected $mTypePaiement;
	
	/**
	* @name InfoCompteProducteurResponse()
	* @desc Le constructeur de InfoCompteProducteurResponse
	*/	
	public function InfoCompteProducteurResponse() {
		$this->mValid = true;
		$this->mOperationPassee = array();
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
	* @name getProducteur()
	* @return ProducteurViewVO
	* @desc Renvoie l'Adherent de l'élément
	*/
	public function getProducteur() {
		return $this->mProducteur;
	}

	/**
	* @name setProducteur($pProducteur)
	* @param ProducteurViewVO
	* @desc Remplace le Producteur de l'élément par $pProducteur
	*/
	public function setProducteur($pProducteur) {
		$this->mProducteur = $pProducteur;
	}
		
	/**
	* @name getOperationPassee()
	* @return array(OperationPasseeViewVO)
	* @desc Renvoie le membre OperationPassee de la InfoCompteProducteurResponse
	*/
	public function getOperationPassee(){
		return $this->mOperationPassee;
	}

	/**
	* @name setOperationPassee($pOperationPassee)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre OperationPassee de la InfoCompteProducteurResponse par $pOperationPassee
	*/
	public function setOperationPassee($pOperationPassee) {
		$this->mOperationPassee = $pOperationPassee;
	}
	
	/**
	* @name addOperationPassee($pOperationPassee)
	* @param OperationPasseeViewVO
	* @desc Ajoute $pOperationPassee à OperationPassee
	*/
	public function addOperationPassee($pOperationPassee){
		array_push($this->mOperationPassee,$pOperationPassee);
	}
		
	/**
	* @name getTypePaiement()
	* @return array(TypePaiementVO)
	* @desc Renvoie le membre TypePaiement de la InfoCompteProducteurResponse
	*/
	public function getTypePaiement(){
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le membre TypePaiement de la InfoCompteProducteurResponse par $pTypePaiement
	*/
	public function setTypePaiement($pTypePaiement) {
		$this->mTypePaiement = $pTypePaiement;
	}
	
	/**
	* @name addTypePaiement($pTypePaiement)
	* @param TypePaiementVO
	* @desc Ajoute $pTypePaiement à TypePaiement
	*/
	public function addTypePaiement($pTypePaiement){
		array_push($this->mTypePaiement,$pTypePaiement);
	}
}