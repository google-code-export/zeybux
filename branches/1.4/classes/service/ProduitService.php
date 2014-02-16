<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/07/2011
// Fichier : ProduitService.php
//
// Description : Classe ProduitService
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_MANAGERS . "ReservationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueReservationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_VO . "ProduitVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ProduitValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProduitDetailSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProduitDetailViewManager.php");*/
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_SERVICE . "/ProduitValid.php");

/**
 * @name ProduitService
 * @author Julien PIERRE
 * @since 26/07/2011
 * @desc Classe Service d'un Produit
 */
class ProduitService
{
	/**
	* @name selectDetailProduits($pIdProduits)
	 * @param array(integer idProduit)
	 * @return array(DetailProduitVO)
	 * @desc Récupères le détail des produits et les renvoie sous forme d'une collection de DetailProduitVO
	*/
	public static function selectDetailProduits($pIdProduits) {
		$lProduitValid = new NAMESPACE_CLASSE\NAMESPACE_VALIDATEUR\MOD_SERVICE\ProduitValid();
		if($lProduitValid->selectDetailProduits($pIdProduits)) {
			return ProduitManager::selectDetailProduits($pIdProduits);
		} else {
			return false;
		}
	}
}