<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/02/2014
// Fichier : SuiviPaiementControleur.php
//
// Description : Classe SuiviPaiementControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ASSOCIATION . "/ListePaiementResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ASSOCIATION . "/SuiviPaiementValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationChampComplementaireToVO.php" );

/**
 * @name SuiviPaiementControleur
 * @author Julien PIERRE
 * @since 13/02/2014
 * @desc Classe controleur du suivi des paiements
 */
class SuiviPaiementControleur
{
	/**
	* @name getListePaiement()
	* @desc Donne liste des paiements non enregistrés
	*/
	public function getListePaiement() {
		$lOperationService = new OperationService();
		
		$lResponse = new ListePaiementResponse();
		$lResponse->setListeCheque($lOperationService->getListeChequeAssociationNonEnregistre());
		$lResponse->setListeEspece($lOperationService->getListeEspeceAssociationNonEnregistre());		
		
		$lBanqueService = new BanqueService();
		$lResponse->setBanques($lBanqueService->getAllActif());
		
		$lTypePaiementService = new TypePaiementService();
		$lResponse->setTypePaiement($lTypePaiementService->selectVisible());
		
		return $lResponse;		
	}
	
	/**
	* @name validerPaiement($pParam)
	* @desc valide un paiement
	*/
	public function validerPaiement($pParam) {
		$lVr = SuiviPaiementValid::validValider($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperationService->validerPaiement($pParam["id"]);
		}		
		return $lVr;	
	}
	
	/**
	* @name supprimerPaiement($pParam)
	* @desc supprime un paiement
	*/
	public function supprimerPaiement($pParam) {
		$lVr = SuiviPaiementValid::validValider($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperationService->delete($pParam["id"]);
		}		
		return $lVr;	
	}
		
	/**
	* @name modifierPaiement($pParam)
	* @desc modifie un paiement
	*/
	public function modifierPaiement($pParam) {
		$lVr = SuiviPaiementValid::validModifierPaiement($pParam);
		if($lVr->getValid()) {
			$lOperationService = new OperationService();
			$lOperationInitiale = $lOperationService->getDetail($pParam["id"]);			
			$lOperationInitiale->setTypePaiement($pParam["typePaiement"]);
			$lOperationInitiale->setMontant($pParam["montant"]);
			
			$lChampComplementaire = array();
			foreach($pParam['champComplementaire'] as $lChamp) {
				if(!is_null($lChamp)) {
					array_push($lChampComplementaire, OperationChampComplementaireToVO::convertFromArray($lChamp));
				}
			}
			$lOperationInitiale->setChampComplementaire($lChampComplementaire);
			$lOperationService->set($lOperationInitiale);
		}
		return $lVr;	
	}
}
?>