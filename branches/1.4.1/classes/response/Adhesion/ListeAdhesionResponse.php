<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : ListeAdhesionResponse.php
//
// Description : Classe ListeAdhesionResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdhesionResponse
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe représentant une ListeAdhesionResponse
 */
class ListeAdhesionResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(AdhesionVO)
	* @desc ListeAdhesion de la ListeAdhesionResponse
	*/
	protected $mListeAdhesion;
	
	/**
	* @name ListeAdhesionResponse()
	* @desc Le constructeur de ListeAdhesionResponse
	*/	
	public function ListeAdhesionResponse($pAdhesions = null) {
		$this->mValid = true;
		if(!is_null($pAdhesions)) {$this->mListeAdhesion = $pAdhesions; } else {$this->mListeAdhesion = array();}
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
	* @name getListeAdhesion()
	* @return array(AdhesionVO)
	* @desc Renvoie le membre ListeAdhesion de la ListeAdhesionResponse
	*/
	public function getListeAdhesion(){
		return $this->mListeAdhesion;
	}

	/**
	* @name setListeAdhesion($pListeAdhesion)
	* @param array(AdhesionVO)
	* @desc Remplace le membre ListeAdhesion de la ListeAdhesionResponse par $pListeAdhesion
	*/
	public function setListeAdhesion($pListeAdhesion) {
		$this->mListeAdhesion = $pListeAdhesion;
	}
	
	/**
	* @name addListeAdhesion($pListeAdhesion)
	* @param AdhesionVO
	* @desc Ajoute $pListeAdhesion à ListeAdhesion
	*/
	public function addListeAdhesion($pListeAdhesion){
		array_push($this->mListeAdhesion,$pListeAdhesion);
	}
}
?>