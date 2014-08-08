<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2013
// Fichier : ListeFactureResponse.php
//
// Description : Classe ListeFactureResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFactureResponse
 * @author Julien PIERRE
 * @since 10/08/2013
 * @desc Classe représentant une ListeFactureResponse
 */
class ListeFactureResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeFactureVO)
	* @desc ListeFacture de la ListeFactureResponse
	*/
	protected $mListeFacture;
	
	/**
	* @name ListeFactureResponse()
	* @desc Le constructeur de ListeFactureResponse
	*/	
	public function ListeFactureResponse() {
		$this->mValid = true;
		$this->mListeFacture = array();
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
	* @name getListeFacture()
	* @return array(ListeFactureVO)
	* @desc Renvoie le membre ListeFacture de la ListeFactureResponse
	*/
	public function getListeFacture(){
		return $this->mListeFacture;
	}

	/**
	* @name setListeFacture($pListeFacture)
	* @param array(ListeFactureVO)
	* @desc Remplace le membre ListeFacture de la ListeFactureResponse par $pListeFacture
	*/
	public function setListeFacture($pListeFacture) {
		$this->mListeFacture = $pListeFacture;
	}
	
	/**
	* @name addListeFacture($pListeFacture)
	* @param ListeFactureVO
	* @desc Ajoute $pListeFacture à ListeFacture
	*/
	public function addListeFacture($pListeFacture){
		array_push($this->mListeFacture,$pListeFacture);
	}
}
?>