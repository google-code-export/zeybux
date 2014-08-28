<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2011
// Fichier : DupliquerMarcheResponse.php
//
// Description : Classe DupliquerMarcheResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name DupliquerMarcheResponse
 * @author Julien PIERRE
 * @since 10/11/2011
 * @desc Classe représentant une DupliquerMarcheResponse
 */
class DupliquerMarcheResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var MarcheVO
	 * @desc Le Marché
	 */
	protected $mMarche;
		
	/**
	* @var array(FermeViewVO)
	* @desc ListeFerme de la DupliquerMarcheResponse
	*/
	protected $mListeFerme;
	
	/**
	* @name DupliquerMarcheResponse()
	* @desc Le constructeur
	*/
	public function DupliquerMarcheResponse() {
		$this->mValid = true;
		$this->mListeFerme = array();
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
	* @name getMarche()
	* @return MarcheVO
	* @desc Renvoie le Marche
	*/
	public function getMarche() {
		return $this->mMarche;
	}

	/**
	* @name setMarche($pMarche)
	* @param MarcheVO
	* @desc Remplace le Marche par $pMarche
	*/
	public function setMarche($pMarche) {
		$this->mMarche = $pMarche;
	}
		
	/**
	* @name getListeFerme()
	* @return array(FermeViewVO)
	* @desc Renvoie le membre ListeFerme de la DupliquerMarcheResponse
	*/
	public function getListeFerme(){
		return $this->mListeFerme;
	}

	/**
	* @name setListeFerme($pListeFerme)
	* @param array(FermeViewVO)
	* @desc Remplace le membre ListeFerme de la DupliquerMarcheResponse par $pListeFerme
	*/
	public function setListeFerme($pListeFerme) {
		$this->mListeFerme = $pListeFerme;
	}
	
	/**
	* @name addListeFerme($pListeFerme)
	* @param FermeViewVO
	* @desc Ajoute $pListeFerme à ListeFerme
	*/
	public function addListeFerme($pListeFerme){
		array_push($this->mListeFerme,$pListeFerme);
	}
		
}
?>