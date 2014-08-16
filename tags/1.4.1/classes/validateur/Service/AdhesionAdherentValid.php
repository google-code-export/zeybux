<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : AdhesionAdherentValid.php
//
// Description : Classe AdhesionAdherentValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name AdhesionAdherentValid
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une AdhesionAdherentValid
 */
class AdhesionAdherentValid
{
	/**
	* @name estAdhesionAdherent($pAdhesionAdherent)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estAdhesionAdherent($pAdhesionAdherent) {
		if(is_object($pAdhesionAdherent)) {
			return (get_class($pAdhesionAdherent) == "AdhesionAdherentDetailVO");
		} else {
			return false;
		}
	}
			
	/**
	* @name insert($pAdhesionAdherent)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pAdhesionAdherent) {
		if($this->estAdhesionAdherent($pAdhesionAdherent)) {
			$lIdValid = new \IdValid();
			$lId = $pAdhesionAdherent->getAdhesionAdherent()->getId();
			
			return $lIdValid->estId($lId)
			&& empty($lId);
		} else {
			return false;
		}
	}
	
	/**
	 * @name update($pAdhesionAdherent)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pAdhesionAdherent) {
		if($this->estAdhesionAdherent($pAdhesionAdherent)) {
			$lIdValid = new \IdValid();
			$lId = $pAdhesionAdherent->getAdhesionAdherent()->getId();
	
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
}
?>