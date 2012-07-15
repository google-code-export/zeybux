<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : IdValid.php
//
// Description : Classe IdValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );

/**
 * @name IdValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une IdValid
 */
class IdValid 
{
	/**
	* @name estId($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estId($pId) {
		if(is_int($pId)) { // Si entier il doit être inférieur
			return $pId <= 99999999999;
		} else if(is_string($pId)) {
			return TestFonction::checkLength($pId,0,11); // si string ne doit pas dépasser 11 de long. Peut être vide
		} else if(empty($pId)) {
			return true;
		} else {
			return false;
		}
	}
}
?>