<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/03/2012
// Fichier : AutorisationSupprimerLotResponse.php
//
// Description : Classe AutorisationSupprimerLotResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AutorisationSupprimerLotResponse
 * @author Julien PIERRE
 * @since 18/03/2012
 * @desc Classe représentant une AutorisationSupprimerLotResponse
 */
class AutorisationSupprimerLotResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var AdherentViewVO
	 * @desc bool
	 */
	protected $mAutorise = false;
		
	/**
	* @name AutorisationSupprimerLotResponse()
	* @desc Le constructeur de AutorisationSupprimerLotResponse
	*/	
	public function AutorisationSupprimerLotResponse() {
		$this->mValid = true;
		$this->mAutorise = true;
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
	* @name getAutorise()
	* @return bool
	* @desc Renvoie mAutorise
	*/
	public function getAutorise() {
		return $this->mAutorise;
	}

	/**
	* @name setAutorise($pAutorise)
	* @param bool
	* @desc Remplace mAutorise de l'élément par $pAutorise
	*/
	public function setAutorise($pAutorise) {
		$this->mAutorise = $pAutorise;
	}
}
?>