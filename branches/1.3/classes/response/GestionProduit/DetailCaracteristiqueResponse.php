<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : DetailCaracteristiqueResponse.php
//
// Description : Classe DetailCaracteristiqueResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailCaracteristiqueResponse
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une DetailCaracteristiqueResponse
 */
class DetailCaracteristiqueResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var DetailCaracteristiqueViewVO
	* @desc DetailCaracteristique de la DetailCaracteristiqueResponse
	*/
	protected $mCaracteristique;
	
	/**
	* @name DetailCaracteristiqueResponse()
	* @desc Le constructeur
	*/
	public function DetailCaracteristiqueResponse() {
		$this->mValid = true;
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
	* @name getCaracteristique()
	* @return DetailCaracteristiqueViewVO
	* @desc Renvoie le membre Caracteristique de la DetailCaracteristiqueResponse
	*/
	public function getCaracteristique(){
		return $this->mCaracteristique;
	}

	/**
	* @name setCaracteristique($pCaracteristique)
	* @param DetailCaracteristiqueViewVO
	* @desc Remplace le membre Caracteristique de la DetailCaracteristiqueResponse par $pCaracteristique
	*/
	public function setCaracteristique($pCaracteristique) {
		$this->mCaracteristique = $pCaracteristique;
	}
}
?>