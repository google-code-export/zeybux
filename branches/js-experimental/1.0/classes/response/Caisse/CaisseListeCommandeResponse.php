<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseListeCommandeResponse.php
//
// Description : Classe CaisseListeCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CaisseListeCommandeResponse
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe représentant une CaisseListeCommandeResponse
 */
class CaisseListeCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeCommandeViewVO)
	* @desc ListeCommande de la CaisseListeCommandeResponse
	*/
	protected $mListeCommande;
	
	/**
	* @name CaisseListeCommandeResponse()
	* @desc Le constructeur
	*/
	public function CaisseListeCommandeResponse() {
		$this->mValid = true;
		$this->mListeCommande = array();
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