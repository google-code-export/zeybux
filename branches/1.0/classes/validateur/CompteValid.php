<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : CompteValid.php
//
// Description : Classe CompteValid
//
//****************************************************************

/**
 * @name CompteValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une CompteValid
 */
class CompteValid
{
	/**
	* @name estCompte($pCompte)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estCompte($pCompte) {
		if(is_object($pCompte)) {
			return (get_class($pCompte) == "CompteVO");
		} else {
			return false;
		}
	}
}
?>