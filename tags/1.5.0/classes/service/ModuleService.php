<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 05/01/2013
// Fichier : ModuleService.php
//
// Description : Classe ModuleService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");

/**
 * @name ModuleService
 * @author Julien PIERRE
 * @since 05/01/2013
 * @desc Classe Service d'un Module
 */
class ModuleService
{				
	/**
	* @name get($pId)
	* @param integer
	* @return array(ModuleVO) ou ModuleVO
	* @desc Retourne une liste de Module
	*/
	public function get($pId = null) {
		if($pId != null) {
			if(is_int((int)$pId)) {
				return $this->select($pId);
			} 
				return false;
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return ModuleVO
	* @desc Retourne un module
	*/
	private function select($pId) {
		return ModuleManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(ModuleVO)
	* @desc Retourne une liste de module
	*/
	private function selectAll() {
		return ModuleManager::selectAll();
	}
	
	/**
	 * @name selectAllVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules visible
	 */
	public function selectAllVisible() {
		return ModuleManager::selectAllVisible();
	}
	
	/**
	 * @name selectAllDefautVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules par defaut et visible
	 */
	public function selectAllDefautVisible() {
		return ModuleManager::selectAllDefautVisible();
	}
	
	/**
	 * @name selectAllNonDefautVisible()
	 * @return array(ModuleVO)
	 * @desc Retourne la liste des modules par defaut et visible
	 */
	public function selectAllNonDefautVisible() {
		return ModuleManager::selectAllNonDefautVisible();
	}
}
?>