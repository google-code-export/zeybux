<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : IdentificationValid.php
//
// Description : Classe IdentificationValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name IdentificationValid
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe représentant une IdentificationValid
 */
class IdentificationValid
{
	/**
	* @name estIdentification($pIdentification)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function input($pIdentification) {
		if(is_object($pIdentification)) {
			$lInput = true;
			$lInput &= get_class($pIdentification) == "IdentificationVO";
			if($pIdentification->getId() != "") {
				$lIdValid = new IdValid();
				$lInput &= $lIdValid->estId($pIdentification->getId());
			}
			$lInput &= TestFonction::checkLength($pIdentification->getLogin(),0,20);
			$lInput &= TestFonction::checkLength($pIdentification->getPass(),0,100);
			$lInput &= $pIdentification->getType() >= 2 && $pIdentification->getType() <= 4;
			return $lInput;
		} else {
			return false;
		}
	}
		
	/**
	* @name insert($pIdentification)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function insert($pIdentification) {
		return $pIdentification->getId() == ""
		&& $pIdentification->getLogin() != ""
		&& $pIdentification->getPass() != ""
		&& $pIdentification->getType() != "";
	}
	
	/**
	* @name update($pIdentification)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function update($pIdentification) {
		return $pIdentification->getId() != ""
		&& $pIdentification->getLogin() != ""
		&& $pIdentification->getPass() != ""
		&& $pIdentification->getType() != "";
	}
	
	/**
	* @name delete($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function delete($pId) {
		$lIdValid = new IdValid();
		if(!empty($pId)){
			return $lIdValid->estId($pId);
		} else {
			return false;
		}
	}
}
?>