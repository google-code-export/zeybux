<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : DetailCategorieResponse.php
//
// Description : Classe DetailCategorieResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DetailCategorieResponse
 * @author Julien PIERRE
 * @since 01/11/2011
 * @desc Classe représentant une DetailCategorieResponse
 */
class DetailCategorieResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var DetailCategorieViewVO
	* @desc DetailCategorie de la DetailCategorieResponse
	*/
	protected $mCategorie;
	
	/**
	* @name DetailCategorieResponse()
	* @desc Le constructeur
	*/
	public function DetailCategorieResponse() {
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
	* @name getCategorie()
	* @return DetailCategorieViewVO
	* @desc Renvoie le membre Categorie de la DetailCategorieResponse
	*/
	public function getCategorie(){
		return $this->mCategorie;
	}

	/**
	* @name setCategorie($pCategorie)
	* @param DetailCategorieViewVO
	* @desc Remplace le membre Categorie de la DetailCategorieResponse par $pCategorie
	*/
	public function setCategorie($pCategorie) {
		$this->mCategorie = $pCategorie;
	}
}
?>