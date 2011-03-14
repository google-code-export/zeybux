<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2010
// Fichier : AfficheAjoutAdherentResponse.php
//
// Description : Classe AfficheAjoutAdherentResponse
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name AfficheAjoutAdherentResponse
 * @author Julien PIERRE
 * @since 08/11/2010
 * @desc Classe représentant une AfficheAjoutAdherentResponse
 */
class AfficheAjoutAdherentResponse extends DataTemplate
{
	/**
	 * @var bool
	 * @desc Donne la validité de l'objet
	 */
	protected $mValid = true;

	/**
	 * @var array(ModuleVO)
	 * @desc Les modules
	 */
	protected $mModules;
	
	/**
	* @name AfficheAjoutAdherentResponse()
	* @desc Le constructeur
	*/
	public function AfficheAjoutAdherentResponse() {
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
	* @name getModules()
	* @return array(ModuleVO)
	* @desc Renvoie le Modules
	*/
	public function getModules() {
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param array(ModuleVO)
	* @desc Remplace le Modules par $pModules
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}
	
	/**
	* @name addModules($pModules)
	* @param ModuleVO
	* @desc Ajoute $pModules à Modules
	*/
	public function addModules($pModules){
		array_push($this->mModules,$pModules);
	}
}
?>