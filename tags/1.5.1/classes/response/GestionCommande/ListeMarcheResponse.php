<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/08/2013
// Fichier : ListeMarcheResponse.php
//
// Description : Classe ListeMarcheResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeMarcheResponse
 * @author Julien PIERRE
 * @since 23/08/2013
 * @desc Classe représentant une ListeMarcheResponse
 */
class ListeMarcheResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(CommandeVO)
	* @desc ListeMarche de la ListeMarcheResponse
	*/
	protected $mListeMarche;
	
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
	* @name ListeMarcheResponse()
	* @desc Le constructeur
	*/
	public function ListeMarcheResponse($pListeMarche = null) {
		$this->mValid = true;
		if(!is_null($pListeMarche)) { $this->mListeMarche = $pListeMarche;} else { $this->mListeMarche = array(); }
	}
	
	/**
	* @name getListeMarche()
	* @return array(CommandeVO)
	* @desc Renvoie le membre ListeMarche de la ListeMarcheResponse
	*/
	public function getListeMarche(){
		return $this->mListeMarche;
	}

	/**
	* @name setListeMarche($pListeMarche)
	* @param array(CommandeVO)
	* @desc Remplace le membre ListeMarche de la ListeMarcheResponse par $pListeMarche
	*/
	public function setListeMarche($pListeMarche) {
		$this->mListeMarche = $pListeMarche;
	}
	
	/**
	* @name addListeMarche($pListeMarche)
	* @param CommandeVO
	* @desc Ajoute $pListeMarche à ListeMarche
	*/
	public function addListeMarche($pListeMarche){
		array_push($this->mListeMarche,$pListeMarche);
	}
}
?>