<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/08/2013
// Fichier : NomProduitService.php
//
// Description : Classe NomProduitService
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_MANAGERS . "ReservationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueReservationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ReservationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_VO . "NomProduitVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitDetailSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "NomProduitDetailViewManager.php");*/
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

/**
 * @name NomProduitService
 * @author Julien PIERRE
 * @since 13/08/2013
 * @desc Classe Service d'un NomProduit
 */
class NomProduitService
{
	/**
	* @name selectUniteNomProduit($pIdNomProduit)
	 * @param integer idNomProduit
	 * @return UniteNomProduitVO
	 * @desc Retourne le NomProduit avec sa liste d'unite
	*/
	public static function selectUniteNomProduit($pIdNomProduit) {
		return NomProduitManager::selectUniteNomProduit($pIdNomProduit);
	}
	
	/**
	 * @name get($pIdNomProduit)
	 * @param integer
	 * @return array(NomProduitVO) ou NomProduitVO
	 * @desc Retourne une liste de virement
	 */
	public function get($pIdNomProduit = null) {
		if(!is_null($pIdNomProduit)) {
			return $this->select($pIdNomProduit);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	 * @name select($pIdNomProduit)
	 * @param integer
	 * @return NomProduitVO
	 * @desc Retourne une Operation
	 */
	private function select($pIdNomProduit) {
		return NomProduitManager::select($pIdNomProduit);
	}
	
	/**
	 * @name selectAll()
	 * @return array(NomProduitVO)
	 * @desc Retourne une liste d'Operation
	 */
	private function selectAll() {
		return NomProduitManager::selectAll();
	}
}