<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : ListePerimetreAdhesionResponse.php
//
// Description : Classe ListePerimetreAdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListePerimetreAdhesionResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une ListePerimetreAdhesionResponse
 */
class ListePerimetreAdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(PerimetreAdhesionVO)
	* @desc ListePerimetre de la ListePerimetreAdhesionResponse
	*/
	protected $mListePerimetre;
	
	/**
	* @name ListePerimetreAdhesionResponse()
	* @desc Le constructeur de ListePerimetreAdhesionResponse
	*/	
	public function ListePerimetreAdhesionResponse($pPerimetres = null) {
		$this->mValid = true;
		if(!is_null($pPerimetres)) {$this->mListePerimetre = $pPerimetres; } else {$this->mListePerimetre = array();}
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
	* @name getListePerimetre()
	* @return array(PerimetreAdhesionVO)
	* @desc Renvoie le membre ListePerimetre de la ListePerimetreAdhesionResponse
	*/
	public function getListePerimetre(){
		return $this->mListePerimetre;
	}

	/**
	* @name setListePerimetre($pListePerimetre)
	* @param array(PerimetreAdhesionVO)
	* @desc Remplace le membre ListePerimetre de la ListePerimetreAdhesionResponse par $pListePerimetre
	*/
	public function setListePerimetre($pListePerimetre) {
		$this->mListePerimetre = $pListePerimetre;
	}
	
	/**
	* @name addListePerimetre($pListePerimetre)
	* @param PerimetreAdhesionVO
	* @desc Ajoute $pListePerimetre à ListePerimetre
	*/
	public function addListePerimetre($pListePerimetre){
		array_push($this->mListePerimetre,$pListePerimetre);
	}
}
?>