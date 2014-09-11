<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : ListeRemiseChequeResponse.php
//
// Description : Classe ListeRemiseChequeResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name ListeRemiseChequeResponse
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une ListeRemiseChequeResponse
 */
class ListeRemiseChequeResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	 * @var array()
	 * @desc La Liste
	 */
	protected $mListe;
	
	/**
	 * @name ListeRemiseChequeResponse()
	 * @return bool
	 * @desc Constructeur
	 */
	function ListeRemiseChequeResponse($pListe = null) {
		$this->mValid = true;
		if(!is_null($pListe)) { $this->mListe = $pListe;}
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
	* @desc Renvoie le Liste
	*/
	public function getListe() {
		return $this->mListe;
	}

	/**
	* @name setListe($pListe)
	* @param array()
	* @desc Remplace le Liste par $pListe
	*/
	public function setListe($pListe) {
		$this->mListe = $pListe;
	}
}
?>