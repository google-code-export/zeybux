<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/03/2012
// Fichier :UniteResponse.php
//
// Description : Classe UniteResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name UniteResponse
 * @author Julien PIERRE
 * @since 03/03/2012
 * @desc Classe représentant une UniteResponse
 */
class UniteResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var array(NomProduitViewVO)
	* @desc Liste des produits de la UniteResponse
	*/
	protected $mUnite;
	
	/**
	* @name UniteResponse()
	* @desc Le constructeur
	*/
	public function UniteResponse() {
		$this->mValid = true;
		$this->mUnite = array();
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
	* @name getUnite()
	* @return array(NomProduitViewVO)
	* @desc Renvoie le membre Unite de la UniteResponse
	*/
	public function getUnite(){
		return $this->mUnite;
	}

	/**
	* @name setUnite($pUnite)
	* @param array(NomProduitViewVO)
	* @desc Remplace le membre Unite de la UniteResponse par $pUnite
	*/
	public function setUnite($pUnite) {
		$this->mUnite = $pUnite;
	}
	
	/**
	* @name addUnite($pUnite)
	* @param NomProduitViewVO
	* @desc Ajoute $pUnite à Unite
	*/
	public function addUnite($pUnite){
		array_push($this->mUnite,$pUnite);
	}
}
?>