<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : AutorisationSupprimerTypeAdhesionResponse.php
//
// Description : Classe AutorisationSupprimerTypeAdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AutorisationSupprimerTypeAdhesionResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une AutorisationSupprimerTypeAdhesionResponse
 */
class AutorisationSupprimerTypeAdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var Autorisation
	 * @desc bool
	 */
	protected $mAutorise = false;
		
	/**
	* @name AutorisationSupprimerTypeAdhesionResponse($pAutorise)
	* @desc Le constructeur de AutorisationSupprimerTypeAdhesionResponse
	*/	
	public function AutorisationSupprimerTypeAdhesionResponse($pAutorise = null) {
		$this->mValid = true;
		if(!is_null($pAutorise)) {$this->mAutorise = $pAutorise; } else { $this->mAutorise = true; }
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