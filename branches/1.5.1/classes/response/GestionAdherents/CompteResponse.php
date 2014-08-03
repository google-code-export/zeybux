<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/10/2013
// Fichier : CompteResponse.php
//
// Description : Classe CompteResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name CompteResponse
 * @author Julien PIERRE
 * @since 17/10/2013
 * @desc Classe représentant une CompteResponse
 */
class CompteResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;
	
	/**
	* @var CompteVO
	* @desc Le compte de l'adherent de la CompteResponse
	*/
	protected $mCompte;
	
	/**
	* @var array(AdherentVO)
	* @desc Les adhérent sur le compte de la CompteResponse
	*/
	protected $mAdherentCompte;
		
	/**
	* @name CompteResponse()
	* @desc Le constructeur de CompteResponse
	*/	
	public function CompteResponse() {
		$this->mValid = true;
		$this->mAdherentCompte = array();
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
	* @name getCompte()
	* @return CompteVO
	* @desc Renvoie le Compte de l'élément
	*/
	public function getCompte() {
		return $this->mCompte;
	}

	/**
	* @name setCompte($pCompte)
	* @param CompteVO
	* @desc Remplace le Compte de l'élément par $pCompte
	*/
	public function setCompte($pCompte) {
		$this->mCompte = $pCompte;
	}
		
	/**
	* @name getAdherentCompte()
	* @return array(AdherentVO)
	* @desc Renvoie le membre AdherentCompte de la CompteResponse
	*/
	public function getAdherentCompte(){
		return $this->mAdherentCompte;
	}

	/**
	* @name setAdherentCompte($pAdherentCompte)
	* @param array(AdherentVO)
	* @desc Remplace le membre AdherentCompte de la CompteResponse par $pAdherentCompte
	*/
	public function setAdherentCompte($pAdherentCompte) {
		$this->mAdherentCompte = $pAdherentCompte;
	}
	
	/**
	* @name addAdherentCompte($pAdherentCompte)
	* @param AdherentVO
	* @desc Ajoute $pAdherentCompte à AdherentCompte
	*/
	public function addAdherentCompte($pAdherentCompte){
		array_push($this->mAdherentCompte,$pAdherentCompte);
	}
}
?>