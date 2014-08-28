<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/09/2013
// Fichier : AchatToVO.php
//
// Description : Classe AchatToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AchatVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationDetailToVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "ProduitDetailAchatToVO.php" );

/**
 * @name AchatToVO
 * @author Julien PIERRE
 * @since 01/09/2013
 * @desc Classe représentant une AchatToVO
 */
class AchatToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AchatVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['operationAchat'])) {	$lOperationAchat = OperationDetailToVO::convertFromArray($pArray['operationAchat']); } else { $lOperationAchat = NULL; }
		if(isset($pArray['operationAchatSolidaire'])) {	$lOperationAchatSolidaire = OperationDetailToVO::convertFromArray($pArray['operationAchatSolidaire']); } else { $lOperationAchatSolidaire = NULL; }
		if(isset($pArray['produits'])) { 
			$lProduits = array();
			foreach($pArray['produits'] as $lProduit) {
				if(!is_null($lProduit)) {
					array_push($lProduits, ProduitDetailAchatToVO::convertFromArray($lProduit));
				}
			}
		} else { $lProduits = NULL; }
		if(isset($pArray['rechargement'])) { $lRechargement = OperationDetailToVO::convertFromArray($pArray['rechargement']); } else { $lRechargement = NULL; }
		
		return new AchatVO($lOperationAchat, $lOperationAchatSolidaire, $lProduits, $lRechargement);
	}
}
?>