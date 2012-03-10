<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/10/2011
// Fichier : ListeCategorieResponse.php
//
// Description : Classe ListeCategorieResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCategorieResponse
 * @author Julien PIERRE
 * @since 09/10/2011
 * @desc Classe représentant une ListeCategorieResponse
 */
class ListeCategorieResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(CategorieProduitActiveViewVO)
	* @desc ListeCategorie de la ListeCategorieResponse
	*/
	protected $mListeCategorie;
	
	/**
	* @name ListeCategorieResponse()
	* @desc Le constructeur
	*/
	public function ListeCategorieResponse() {
		$this->mValid = true;
		$this->mListeCategorie = array();
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
	* @name getListeCategorie()
	* @return array(CategorieProduitActiveViewVO)
	* @desc Renvoie le membre ListeCategorie de la ListeCategorieResponse
	*/
	public function getListeCategorie(){
		return $this->mListeCategorie;
	}

	/**
	* @name setListeCategorie($pListeCategorie)
	* @param array(CategorieProduitActiveViewVO)
	* @desc Remplace le membre ListeCategorie de la ListeCategorieResponse par $pListeCategorie
	*/
	public function setListeCategorie($pListeCategorie) {
		$this->mListeCategorie = $pListeCategorie;
	}
	
	/**
	* @name addListeCategorie($pListeCategorie)
	* @param CategorieProduitActiveViewVO
	* @desc Ajoute $pListeCategorie à ListeCategorie
	*/
	public function addListeCategorie($pListeCategorie){
		array_push($this->mListeCategorie,$pListeCategorie);
	}
}
?>