<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : MontantValid.php
//
// Description : Classe MontantValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );

/**
 * @name MontantValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une MontantValid
 */
class MontantValid 
{
	/**
	* @name valeur($pMontant)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function valeur($pMontant) {
		if(is_int($pMontant)) { // Si entier il doit être inférieur
			return $pMontant <= 9999999999;
		} else if(is_float($pMontant)) { // Si float il doit être inférieur
			return $pMontant <= 9999999999.99;
		} else if(is_string($pMontant)) {
			return TestFonction::checkLength($pMontant,0,12); // si string ne doit pas dépasser 11 de long. Peut être vide
		} else {
			return false;
		}
	}
}