<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : ListeFermeResponse.php
//
// Description : Classe ListeFermeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeFermeResponse
 * @author Julien PIERRE
 * @since 23/10/2011
 * @desc Classe représentant une ListeFermeResponse
 */
class ListeFermeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(FermeViewVO)
	* @desc ListeFerme de la ListeFermeResponse
	*/
	protected $mListeFerme;
	
	/**
	* @name ListeFermeResponse()
	* @desc Le constructeur de ListeFermeResponse
	*/	
	public function ListeFermeResponse() {
		$this->mValid = true;
		$this->mListeFerme = array();
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
	* @name getListeFerme()
	* @return array(FermeViewVO)
	* @desc Renvoie le membre ListeFerme de la ListeFermeResponse
	*/
	public function getListeFerme(){
		return $this->mListeFerme;
	}

	/**
	* @name setListeFerme($pListeFerme)
	* @param array(FermeViewVO)
	* @desc Remplace le membre ListeFerme de la ListeFermeResponse par $pListeFerme
	*/
	public function setListeFerme($pListeFerme) {
		$this->mListeFerme = $pListeFerme;
	}
	
	/**
	* @name addListeFerme($pListeFerme)
	* @param FermeViewVO
	* @desc Ajoute $pListeFerme à ListeFerme
	*/
	public function addListeFerme($pListeFerme){
		array_push($this->mListeFerme,$pListeFerme);
	}
}