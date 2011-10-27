<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/10/2011
// Fichier : InformationFermeResponse.php
//
// Description : Classe InformationFermeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InformationFermeResponse
 * @author Julien PIERRE
 * @since 26/10/2011
 * @desc Classe représentant une InformationFermeResponse
 */
class InformationFermeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(FermeViewVO)
	* @desc Ferme de la InformationFermeResponse
	*/
	protected $mFerme;
	
	/**
	* @var array(OperationPasseeViewVO)
	* @desc ListeCommande de la InformationFermeResponse
	*/
	protected $mOperationPassee;
	/**
	* @var array(TypePaiementVO)
	* @desc Les TypePaiement de la InformationFermeResponse
	*/
	protected $mTypePaiement;
	
	/**
	* @name InformationFermeResponse()
	* @desc Le constructeur de InformationFermeResponse
	*/	
	public function InformationFermeResponse() {
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
	* @name getFerme()
	* @return array(FermeViewVO)
	* @desc Renvoie le membre Ferme de la InformationFermeResponse
	*/
	public function getFerme(){
		return $this->mFerme;
	}

	/**
	* @name setFerme($pFerme)
	* @param array(FermeViewVO)
	* @desc Remplace le membre Ferme de la InformationFermeResponse par $pFerme
	*/
	public function setFerme($pFerme) {
		$this->mFerme = $pFerme;
	}
	
	/**
	* @name getOperationPassee()
	* @return array(OperationPasseeViewVO)
	* @desc Renvoie le membre OperationPassee de la InformationFermeResponse
	*/
	public function getOperationPassee(){
		return $this->mOperationPassee;
	}

	/**
	* @name setOperationPassee($pOperationPassee)
	* @param array(OperationPasseeViewVO)
	* @desc Remplace le membre OperationPassee de la InformationFermeResponse par $pOperationPassee
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
	* @desc Renvoie le membre TypePaiement de la InformationFermeResponse
	*/
	public function getTypePaiement(){
		return $this->mTypePaiement;
	}

	/**
	* @name setTypePaiement($pTypePaiement)
	* @param array(TypePaiementVO)
	* @desc Remplace le membre TypePaiement de la InformationFermeResponse par $pTypePaiement
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