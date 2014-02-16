<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/11/2013
// Fichier : AdhesionValid.php
//
// Description : Classe AdhesionValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name AdhesionValid
 * @author Julien PIERRE
 * @since 02/11/2013
 * @desc Classe représentant une AdhesionValid
 */
class AdhesionValid
{
	/**
	* @name estAdhesion($pAdhesion)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estAdhesion($pAdhesion) {
		if(is_object($pAdhesion)) {
			return (get_class($pAdhesion) == "AdhesionDetailVO");
		} else {
			return false;
		}
	}
			
	/**
	* @name insert($pAdhesion)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pAdhesion) {
		if($this->estAdhesion($pAdhesion)) {
			$lIdValid = new \IdValid();
			$lId = $pAdhesion->getId();
			
			return $lIdValid->estId($lId)
			&& empty($lId);
		} else {
			return false;
		}
	}
	
	/**
	 * @name update($pAdhesion)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pAdhesion) {
		if($this->estAdhesion($pAdhesion)) {
			$lIdValid = new \IdValid();
			$lId = $pAdhesion->getId();
	
			return $lIdValid->estId($lId)
			&& !empty($lId);
		} else {
			return false;
		}
	}
		
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {	
		$lIdValid = new \IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		}
		return false;
	}	
	
	/**
	 * @name deleteTypeAdhesion($pId)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function deleteTypeAdhesion($pId) {
		$lIdValid = new \IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		}
		return false;
	}
}
?>