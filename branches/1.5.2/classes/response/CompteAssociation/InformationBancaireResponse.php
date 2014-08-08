<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : InformationBancaireResponse.php
//
// Description : Classe InformationBancaireResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name InformationBancaireResponse
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une InformationBancaireResponse
 */
class InformationBancaireResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var InformationBancaireVO
	 * @desc La InformationBancaire
	 */
	protected $mInformationBancaire;
	
	/**
	 * @name InformationBancaireResponse()
	 * @return bool
	 * @desc Constructeur
	 */
	function InformationBancaireResponse($pInformationBancaire = null) {
		$this->mValid = true;
		if(!is_null($pInformationBancaire)) { $this->mInformationBancaire = $pInformationBancaire;}
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
	* @name getInformationBancaire()
	* @return InformationBancaireVO
	* @desc Renvoie le InformationBancaire
	*/
	public function getInformationBancaire() {
		return $this->mInformationBancaire;
	}

	/**
	* @name setInformationBancaire($pInformationBancaire)
	* @param InformationBancaireVO
	* @desc Remplace le InformationBancaire par $pInformationBancaire
	*/
	public function setInformationBancaire($pInformationBancaire) {
		$this->mInformationBancaire = $pInformationBancaire;
	}
}
?>