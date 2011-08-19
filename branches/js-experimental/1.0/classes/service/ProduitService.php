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

/**
 * @name ProduitService
 * @author Julien PIERRE
 * @since 26/07/2011
 * @desc Classe Service d'un Produit
 */
class ProduitService
{
	/**
	* @name selectInfoBonCommande($pIdCommande,$pIdProducteur)
	* @param integer
	* @return array(ProduitVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProduit $pIdProduit. Puis les renvoie sous forme d'une collection de DetailCommandeVO
	*/
	public static function selectInfoBonCommande($pIdCommande,$pIdProducteur) {
		/*return DetailCommandeManager::recherche(
			array(DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT),
			array('='),
			array($pIdProduit),
			array(DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT),
			array('ASC'));*/
	}
}