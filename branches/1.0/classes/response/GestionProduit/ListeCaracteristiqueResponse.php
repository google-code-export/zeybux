<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : ListeCaracteristiqueResponse.php
//
// Description : Classe ListeCaracteristiqueResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCaracteristiqueResponse
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une ListeCaracteristiqueResponse
 */
class ListeCaracteristiqueResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeCaracteristiqueViewVO)
	* @desc ListeCaracteristique de la ListeCaracteristiqueResponse
	*/
	protected $mListeCaracteristique;
	
	/**
	* @name ListeCaracteristiqueResponse()
	* @desc Le constructeur
	*/
	public function ListeCaracteristiqueResponse() {
		$this->mValid = true;
		$this->mListeCaracteristique = array();
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
	* @name getListeCaracteristique()
	* @return array(ListeCaracteristiqueViewVO)
	* @desc Renvoie le membre ListeCaracteristique de la ListeCaracteristiqueResponse
	*/
	public function getListeCaracteristique(){
		return $this->mListeCaracteristique;
	}

	/**
	* @name setListeCaracteristique($pListeCaracteristique)
	* @param array(ListeCaracteristiqueViewVO)
	* @desc Remplace le membre ListeCaracteristique de la ListeCaracteristiqueResponse par $pListeCaracteristique
	*/
	public function setListeCaracteristique($pListeCaracteristique) {
		$this->mListeCaracteristique = $pListeCaracteristique;
	}
	
	/**
	* @name addListeCaracteristique($pListeCaracteristique)
	* @param ListeCaracteristiqueViewVO
	* @desc Ajoute $pListeCaracteristique à ListeCaracteristique
	*/
	public function addListeCaracteristique($pListeCaracteristique){
		array_push($this->mListeCaracteristique,$pListeCaracteristique);
	}
}