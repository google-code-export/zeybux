<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeCommandeResponse.php
//
// Description : Classe ListeCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeCommandeResponse
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeCommandeResponse
 */
class ListeCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeCommandeViewVO)
	* @desc ListeCommande de la ListeCommandeResponse
	*/
	protected $mListeCommande;
	
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
	* @name ListeCommandeResponse()
	* @desc Le constructeur
	*/
	public function ListeCommandeResponse() {
		$this->mValid = true;
		$this->mListeCommande = array();
	}
	
	/**
	* @name getListeCommande()
	* @return array(ListeCommandeViewVO)
	* @desc Renvoie le membre ListeCommande de la ListeCommandeResponse
	*/
	public function getListeCommande(){
		return $this->mListeCommande;
	}

	/**
	* @name setListeCommande($pListeCommande)
	* @param array(ListeCommandeViewVO)
	* @desc Remplace le membre ListeCommande de la ListeCommandeResponse par $pListeCommande
	*/
	public function setListeCommande($pListeCommande) {
		$this->mListeCommande = $pListeCommande;
	}
	
	/**
	* @name addListeCommande($pListeCommande)
	* @param ListeCommandeViewVO
	* @desc Ajoute $pListeCommande à ListeCommande
	*/
	public function addListeCommande($pListeCommande){
		array_push($this->mListeCommande,$pListeCommande);
	}
}