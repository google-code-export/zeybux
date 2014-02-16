<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : FactureToVO.php
//
// Description : Classe FactureToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "FactureVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationDetailToVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "ProduitDetailFactureToVO.php" );

/**
 * @name FactureToVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une FactureToVO
 */
class FactureToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet FactureVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['id'])) {	$lId = OperationDetailToVO::convertFromArray($pArray['id']); } else { $lId = NULL; }
		if(isset($pArray['operationProducteur'])) {	$lOperationProducteur = OperationDetailToVO::convertFromArray($pArray['operationProducteur']); } else { $lOperationProducteur = NULL; }
		if(isset($pArray['operationZeybu'])) {	$lOperationZeybu = OperationDetailToVO::convertFromArray($pArray['operationZeybu']); } else { $lOperationZeybu = NULL; }
		if(isset($pArray['produits'])) { 
			$lProduits = array();
			foreach($pArray['produits'] as $lProduit) {
				if(!is_null($lProduit)) {
					array_push($lProduits, ProduitDetailFactureToVO::convertFromArray($lProduit));
				}
			}
		} else { $lProduits = NULL; }
		
		return new FactureVO($lId, $lOperationProducteur, $lOperationZeybu, $lProduits);
	}
}
?>