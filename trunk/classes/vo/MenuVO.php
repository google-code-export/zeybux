<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuVO.php
//
// Description : Classe MenuVO
//
//****************************************************************
include_once(CHEMIN_CLASSES . "DataTemplate.php");

/**
 * @name MenuVO
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe représentant une MenuVO
 */
class MenuVO extends DataTemplate
{	
	/**
	* @var array(MenuModuleVO)
	* @desc Les modules de la MenuVO
	*/
	protected $mModules;
	
	/**
	* @name MenuVO()
	* @desc Le constructeur
	*/
	public function MenuVO() {
		$this->mModules = array();
	}
			
	/**
	* @name getModules()
	* @return array(MenuModuleVO)
	* @desc Renvoie les Modules de la MenuVO
	*/
	public function getModules(){
		return $this->mModules;
	}

	/**
	* @name setModules($pModules)
	* @param array(MenuModuleVO)
	* @desc Remplace le membre Modules de la MenuVO par $pVues
	*/
	public function setModules($pModules) {
		$this->mModules = $pModules;
	}
	
	/**
	* @name addModules($pModules)
	* @param MenuModuleVO
	* @desc Ajoute le $pModules à Modules
	*/
	public function addModules($pModules) {
		array_push($this->mModules, $pModules);
	}
}