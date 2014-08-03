<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : ProduitDetailFactureToVO.php
//
// Description : Classe ProduitDetailFactureToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitDetailFactureVO.php" );

/**
 * @name ProduitDetailFactureToVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une ProduitDetailFactureToVO
 */
class ProduitDetailFactureToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitDetailFactureVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['idNomProduit'])) { $lIdNomProduit = $pArray['idNomProduit']; } else { $lIdNomProduit = NULL; }
		if(isset($pArray['idStock'])) { $lIdStock = $pArray['idStock']; } else { $lIdStock = NULL; }
		if(isset($pArray['idDetailOperation'])) { $lIdDetailOperation = $pArray['idDetailOperation']; } else { $lIdDetailOperation = NULL; }
		if(isset($pArray['idStockSolidaire'])) { $lStockSolidaire = $pArray['idStockSolidaire']; } else { $lStockSolidaire = NULL; }
		if(isset($pArray['quantite'])) { $lQuantite = $pArray['quantite']; } else { $lQuantite = NULL; }
		if(isset($pArray['unite'])) { $lUnite = $pArray['unite']; } else { $lUnite = NULL; }
		if(isset($pArray['quantiteSolidaire'])) { $lQuantiteSolidaire = $pArray['quantiteSolidaire']; } else { $lQuantiteSolidaire = NULL; }
		if(isset($pArray['uniteSolidaire'])) { $lUniteSolidaire = $pArray['uniteSolidaire']; } else { $lUniteSolidaire = NULL; }
		if(isset($pArray['montant'])) { $lMontant = $pArray['montant']; } else { $lMontant = NULL; }	
		
		return new ProduitDetailFactureVO($lIdNomProduit, $lIdStock, $lIdDetailOperation, $lStockSolidaire, $lQuantite, $lUnite, $lQuantiteSolidaire, $lUniteSolidaire, $lMontant);
	}
}
?>