<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueValid.php
//
// Description : Classe BanqueValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name BanqueValid
 * @author Julien PIERRE
 * @since 12/01/2013
 * @desc Classe représentant une BanqueValid
 */
class BanqueValid
{
	/**
	* @name estBanque($pBanque)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estBanque($pBanque) {
		if(is_object($pBanque)) {
			return (get_class($pBanque) == "BanqueVO");
		} else {
			return false;
		}
	}
			
	/**
	* @name insert($pBanque)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pBanque) {
		if($this->estBanque($pBanque)) {
			$lIdValid = new \IdValid();
			$lId = $pBanque->getId();
			
			return $lIdValid->estId($lId)
			&& empty($lId)
			&& $pBanque->getNom() != '';
		} else {
			return false;
		}
	}
	
	/**
	 * @name update($pBanque)
	 * @return bool
	 * @desc Test la validite de l'élément
	 */
	public function update($pBanque) {
		if($this->estBanque($pBanque)) {
			$lIdValid = new \IdValid();
			$lId = $pBanque->getId();
	
			return $lIdValid->estId($lId)
			&& !empty($lId)
			&& $pBanque->getNom() != '';
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