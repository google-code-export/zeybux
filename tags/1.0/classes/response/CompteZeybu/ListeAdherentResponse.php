<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/07/2011
// Fichier : ListeAdherentResponse.php
//
// Description : Classe ListeAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentResponse
 * @author Julien PIERRE
 * @since 08/07/2011
 * @desc Classe représentant une ListeAdherentResponse
 */
class ListeAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeAdherentViewVO)
	* @desc ListeCommande de la ListeAdherentResponse
	*/
	protected $mListeAdherent;	
	
	/**
	* @var array(ProducteurViewVO)
	* @desc ListeProducteur de la ListeAdherentResponse
	*/
	protected $mListeProducteur;	
	
	/**
	* @name ListeAdherentResponse()
	* @desc Le constructeur de ListeAdherentResponse
	*/	
	public function ListeAdherentResponse() {
		$this->mValid = true;
		$this->mListeAdherent = array();
		$this->mListeProducteur = array();
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
	* @name getListeAdherent()
	* @return array(ListeAdherentViewVO)
	* @desc Renvoie le membre ListeAdherent de la ListeAdherentResponse
	*/
	public function getListeAdherent(){
		return $this->mListeAdherent;
	}

	/**
	* @name setListeAdherent($pListeAdherent)
	* @param array(ListeAdherentViewVO)
	* @desc Remplace le membre ListeAdherent de la ListeAdherentResponse par $pListeAdherent
	*/
	public function setListeAdherent($pListeAdherent) {
		$this->mListeAdherent = $pListeAdherent;
	}
	
	/**
	* @name addListeAdherent($pListeAdherent)
	* @param ListeAdherentViewVO
	* @desc Ajoute $pListeAdherent à ListeAdherent
	*/
	public function addListeAdherent($pListeAdherent){
		array_push($this->mListeAdherent,$pListeAdherent);
	}
	
	/**
	* @name getListeProducteur()
	* @return array(ProducteurViewVO)
	* @desc Renvoie le membre ListeProducteur de la ListeProducteurResponse
	*/
	public function getListeProducteur(){
		return $this->mListeProducteur;
	}

	/**
	* @name setListeProducteur($pListeProducteur)
	* @param array(ProducteurViewVO)
	* @desc Remplace le membre ListeProducteur de la ListeProducteurResponse par $pListeProducteur
	*/
	public function setListeProducteur($pListeProducteur) {
		$this->mListeProducteur = $pListeProducteur;
	}
	
	/**
	* @name addListeProducteur($pListeProducteur)
	* @param ProducteurViewVO
	* @desc Ajoute $pListeProducteur à ListeProducteur
	*/
	public function addListeProducteur($pListeProducteur){
		array_push($this->mListeProducteur,$pListeProducteur);
	}
}