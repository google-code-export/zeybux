<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/02/2014
// Fichier : InfoCompteResponse.php
//
// Description : Classe InfoCompteResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InfoCompteResponse
 * @author Julien PIERRE
 * @since 09/02/2014
 * @desc Classe représentant une InfoCompteResponse
 */
class InfoCompteResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var decimal(33,2)
	 * @desc Le Solde Total
	 */
	protected $mSoldeTotal;
	
	/**
	* @name InfoCompteResponse()
	* @desc Le constructeur de InfoCompteResponse
	*/	
	public function InfoCompteResponse($pSoldeTotal = null) {
		$this->mValid = true;		
		if(!is_null($pSoldeTotal)) { $this->mSoldeTotal = $pSoldeTotal;}
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
	* @name getSoldeTotal()
	* @return decimal(33,2)
	* @desc Renvoie le SoldeTotal
	*/
	public function getSoldeTotal() {
		return $this->mSoldeTotal;
	}
}
?>