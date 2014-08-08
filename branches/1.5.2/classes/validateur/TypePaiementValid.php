<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : TypePaiementValid.php
//
// Description : Classe TypePaiementValid
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name TypePaiementValid
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe représentant une TypePaiementValid
 */
class TypePaiementValid
{
	/**
	* @name estTypePaiement($pTypePaiement)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function estTypePaiement($pTypePaiement) {
		if(is_object($pTypePaiement)) {
			return (get_class($pTypePaiement) == "TypePaiementVO");
		} else {
			return false;
		}
	}
	
	/**
	* @name id($pId)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function id($pId) {
		$lIdValid = new IdValid();
		return $lIdValid->estId($pId)
			&& (!empty($pId) || $pId == 0);
	}
}
?>