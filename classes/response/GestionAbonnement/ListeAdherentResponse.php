<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeAdherentResponse.php
//
// Description : Classe ListeAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeAdherentResponse
 * @author Julien PIERRE
 * @since 15/02/2012
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
	* @name ListeAdherentResponse()
	* @desc Le constructeur de ListeAdherentResponse
	*/	
	public function ListeAdherentResponse() {
		$this->mValid = true;
		$this->mListeAdherent = array();
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
}
?>