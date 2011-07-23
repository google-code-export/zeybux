<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeAdherentCommandeResponse.php
//
// Description : Classe ListeAdherentCommandeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentCommandeResponse
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe représentant une ListeAdherentCommandeResponse
 */
class ListeAdherentCommandeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid;
	
	/**
	* @var array(ListeAdherentCommandeViewVO)
	* @desc ListeAdherentCommande de la ListeAdherentCommandeResponse
	*/
	protected $mListeAdherentCommande;
	
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
	* @name ListeAdherentCommandeResponse()
	* @desc Le constructeur
	*/
	public function ListeAdherentCommandeResponse() {
		$this->mValid = true;
		$this->mListeAdherentCommande = array();
	}
	
	/**
	* @name getListeAdherentCommande()
	* @return array(ListeAdherentCommandeViewVO)
	* @desc Renvoie le membre ListeAdherentCommande de la ListeAdherentCommandeResponse
	*/
	public function getListeAdherentCommande(){
		return $this->mListeAdherentCommande;
	}

	/**
	* @name setListeAdherentCommande($pListeAdherentCommande)
	* @param array(ListeAdherentCommandeViewVO)
	* @desc Remplace le membre ListeAdherentCommande de la ListeAdherentCommandeResponse par $pListeAdherentCommande
	*/
	public function setListeAdherentCommande($pListeAdherentCommande) {
		$this->mListeAdherentCommande = $pListeAdherentCommande;
	}
	
	/**
	* @name addListeAdherentCommande($pListeAdherentCommande)
	* @param ListeAdherentCommandeViewVO
	* @desc Ajoute $pListeAdherentCommande à ListeAdherentCommande
	*/
	public function addListeAdherentCommande($pListeAdherentCommande){
		array_push($this->mListeAdherentCommande,$pListeAdherentCommande);
	}
}