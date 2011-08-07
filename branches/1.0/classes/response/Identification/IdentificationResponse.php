<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : IdentificationResponse.php
//
// Description : Classe IdentificationResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name IdentificationResponse
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe représentant une IdentificationResponse
 */
class IdentificationResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var integer
	 * @desc Le type de compte
	 */
	protected $mType;
	
	/**
	 * @var array()
	 * @desc Les modules du compte
	 */
	protected $mModules;
	
	/**
	 * @var integer
	 * @desc L'Id Connexion
	 */
	protected $mIdConnexion;
	
	/**
	* @name IdentificationResponse()
	* @desc Le constructeur
	*/
	public function IdentificationResponse() {
		$this->mValid = true;	
		$this->mModules = array();		
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
	* @name getType()
	* @return integer
	* @desc Renvoie le Type
	*/
	public function getType() {
		return $this->mType;
	}

	/**
	* @name setType($pType)
	* @param integer
	* @desc Remplace le Type par $pType
	*/
	public function setType($pType) {
		$this->mType = $pType;
	}
	
	/**
	* @name getModules()
	* @return array()
	* @desc Renvoie le Modules
	*/
	public function getModules() {
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param string
	* @desc Remplace le Modules par $pModules
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}
	
	/**
	* @name addModules($pModules)
	* @param string
	* @desc Ajoute le Modules par $pModules
	*/
	public function addModules($pModules) {
		array_push($this->mModules,$pModules);
	}
	
	/**
	* @name getIdConnexion()
	* @return integer
	* @desc Renvoie le IdConnexion
	*/
	public function getIdConnexion() {
		return $this->mIdConnexion;
	}

	/**
	* @name setIdConnexion($pIdConnexion)
	* @param integer
	* @desc Remplace le IdConnexion par $pIdConnexion
	*/
	public function setIdConnexion($pIdConnexion) {
		$this->mIdConnexion = $pIdConnexion;
	}
}
?>