<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : ListeAchatResponse.php
//
// Description : Classe ListeAchatResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAchatResponse
 * @author Julien PIERRE
 * @since 08/09/2013
 * @desc Classe représentant une ListeAchatResponse
 */
class ListeAchatResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeAchatVO)
	* @desc ListeAchat de la ListeAchatResponse
	*/
	protected $mListeAchat;
	
	/**
	* @name ListeAchatResponse()
	* @desc Le constructeur de ListeAchatResponse
	*/	
	public function ListeAchatResponse() {
		$this->mValid = true;
		$this->mListeAchat = array();
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
	* @name getListeAchat()
	* @return array(ListeAchatVO)
	* @desc Renvoie le membre ListeAchat de la ListeAchatResponse
	*/
	public function getListeAchat(){
		return $this->mListeAchat;
	}

	/**
	* @name setListeAchat($pListeAchat)
	* @param array(ListeAchatVO)
	* @desc Remplace le membre ListeAchat de la ListeAchatResponse par $pListeAchat
	*/
	public function setListeAchat($pListeAchat) {
		$this->mListeAchat = $pListeAchat;
	}
	
	/**
	* @name addListeAchat($pListeAchat)
	* @param ListeAchatVO
	* @desc Ajoute $pListeAchat à ListeAchat
	*/
	public function addListeAchat($pListeAchat){
		array_push($this->mListeAchat,$pListeAchat);
	}
}
?>