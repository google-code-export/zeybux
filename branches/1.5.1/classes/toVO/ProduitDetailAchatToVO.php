<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/09/2013
// Fichier : ProduitDetailAchatToVO.php
//
// Description : Classe ProduitDetailAchatToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitDetailAchatVO.php" );

/**
 * @name ProduitDetailAchatToVO
 * @author Julien PIERRE
 * @since 01/09/2013
 * @desc Classe représentant une ProduitDetailAchatToVO
 */
class ProduitDetailAchatToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitDetailAchatVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['idNomProduit'])) { $lIdNomProduit = $pArray['idNomProduit']; } else { $lIdNomProduit = NULL; }
		if(isset($pArray['idStock'])) { $lIdStock = $pArray['idStock']; } else { $lIdStock = NULL; }
		if(isset($pArray['idDetailOperation'])) { $lIdDetailOperation = $pArray['idDetailOperation']; } else { $lIdDetailOperation = NULL; }
		if(isset($pArray['idStockSolidaire'])) { $lStockSolidaire = $pArray['idStockSolidaire']; } else { $lStockSolidaire = NULL; }
		if(isset($pArray['idDetailOperationSolidaire'])) { $lIdDetailOperationSolidaire = $pArray['idDetailOperationSolidaire']; } else { $lIdDetailOperationSolidaire = NULL; }
		if(isset($pArray['idDetailCommande'])) { $lIdDetailCommande = $pArray['idDetailCommande']; } else { $lIdDetailCommande = NULL; }
		if(isset($pArray['idModeleLot'])) { $lIdModeleLot = $pArray['idModeleLot']; } else { $lIdModeleLot = NULL; }
		if(isset($pArray['idDetailCommandeSolidaire'])) { $lIdDetailCommandeSolidaire = $pArray['idDetailCommandeSolidaire']; } else { $lIdDetailCommandeSolidaire = NULL; }
		if(isset($pArray['idModeleLotSolidaire'])) { $lIdModeleLotSolidaire = $pArray['idModeleLotSolidaire']; } else { $lIdModeleLotSolidaire = NULL; }
		if(isset($pArray['quantite'])) { $lQuantite = $pArray['quantite']; } else { $lQuantite = NULL; }
		if(isset($pArray['unite'])) { $lUnite = $pArray['unite']; } else { $lUnite = NULL; }
		if(isset($pArray['quantiteSolidaire'])) { $lQuantiteSolidaire = $pArray['quantiteSolidaire']; } else { $lQuantiteSolidaire = NULL; }
		if(isset($pArray['uniteSolidaire'])) { $lUniteSolidaire = $pArray['uniteSolidaire']; } else { $lUniteSolidaire = NULL; }
		if(isset($pArray['montant'])) { $lMontant = $pArray['montant']; } else { $lMontant = NULL; }
		if(isset($pArray['montantSolidaire'])) { $lMontantSolidaire = $pArray['montantSolidaire']; } else { $lMontantSolidaire = NULL; }		
		
		return new ProduitDetailAchatVO($lIdNomProduit, $lIdStock, $lIdDetailOperation, $lStockSolidaire, $lIdDetailOperationSolidaire, $lIdDetailCommande, $lIdModeleLot, $lIdDetailCommandeSolidaire, $lIdModeleLotSolidaire, $lQuantite, $lUnite, $lQuantiteSolidaire, $lUniteSolidaire, $lMontant, $lMontantSolidaire);
	}
}
?>