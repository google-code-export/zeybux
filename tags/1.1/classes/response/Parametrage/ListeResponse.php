<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : ListeResponse.php
//
// Description : Classe ListeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeResponse
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une ListeResponse
 */
class ListeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(ListeViewVO)
	* @desc ListeCommande de la ListeResponse
	*/
	protected $mListe;
	
	/**
	* @name ListeResponse()
	* @desc Le constructeur de ListeResponse
	*/	
	public function ListeResponse() {
		$this->mValid = true;
		$this->mListe = array();
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
	* @name getListe()
	* @return array()
	* @desc Renvoie le membre Liste de la ListeResponse
	*/
	public function getListe(){
		return $this->mListe;
	}

	/**
	* @name setListe($pListe)
	* @param array()
	* @desc Remplace le membre Liste de la ListeResponse par $pListe
	*/
	public function setListe($pListe) {
		$this->mListe = $pListe;
	}
	
	/**
	* @name addListe($pListe)
	* @param Object
	* @desc Ajoute $pListe à Liste
	*/
	public function addListe($pListe){
		array_push($this->mListe,$pListe);
	}
}
?>