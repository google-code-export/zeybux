<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/03/2013
// Fichier : ProduitValid.php
//
// Description : Classe ProduitValid
//
//****************************************************************

namespace NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE;

// Inclusion des classes
//include_once(CHEMIN_CLASSES_VALIDATEUR . "IdValid.php");

/**
 * @name ProduitValid
 * @author Julien PIERRE
 * @since 24/03/2013
 * @desc Classe représentant un ProduitValid
 */
class ProduitValid
{
	/**
	* @name selectDetailProduits($pIdProduits)
	* @return bool
	* @desc Test la validite de l'élément
	*/
	public function selectDetailProduits($pIdProduits) {
		return is_array($pIdProduits);
	}
}
?>