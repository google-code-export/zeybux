<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2013
// Fichier : FermeService.php
//
// Description : Classe FermeService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name FermeService
 * @author Julien PIERRE
 * @since 11/08/2013
 * @desc Classe Service de Ferme
 */
class FermeService
{
	/**
	 * @name get($pId)
	 * @param integer id de la ferme
	 * @return array(ListeFermeVO) ou ListeFermeVO
	 * @desc Retourne une liste de Ferme
	 */
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	 * @name selectAll()
	 * @return array(ListeFermeVO)
	 * @desc Retourne les Fermes
	 */
	private function selectAll() {
		return FermeManager::listeFerme();
		
	}
	
	/**
	 * @name getByIdCompte($pId)
	 * @param integer id du compte de la ferme
	 * @return FermeVO
	 * @desc Retourne une Ferme
	 */
	public function getByIdCompte($pId = null) {
		return FermeManager::selectByIdCompte($pId);
	}
}
?>