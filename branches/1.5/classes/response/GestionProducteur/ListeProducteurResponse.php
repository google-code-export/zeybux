<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : ListeProducteurResponse.php
//
// Description : Classe ListeProducteurResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeProducteurResponse
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe représentant une ListeProducteurResponse
 */
class ListeProducteurResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ProducteurViewVO)
	* @desc ListeProducteur de la ListeProducteurResponse
	*/
	protected $mListeProducteur;
	
	/**
	* @name ListeProducteurResponse()
	* @desc Le constructeur de ListeProducteurResponse
	*/	
	public function ListeProducteurResponse() {
		$this->mValid = true;
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
?>