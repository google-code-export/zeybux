<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : SuiviPaiementControleur.php
//
// Description : Classe SuiviPaiementControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/ListePaiementResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ZEYBU . "/SuiviPaiementValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationChampComplementaireToVO.php" );

/**
 * @name SuiviPaiementControleur
 * @author Julien PIERRE
 * @since 12/05/2012
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
		$lResponse->setListeChequeAdherent($lOperationService->getListeChequeAdherentNonEnregistre());
		$lResponse->setListeEspeceAdherent($lOperationService->getListeEspeceAdherentNonEnregistre());
		$lResponse->setListeChequeFerme($lOperationService->getListeChequeFermeNonEnregistre());
		$lResponse->setListeEspeceFerme($lOperationService->getListeEspeceFermeNonEnregistre());
		$lResponse->setListeChequeInvite($lOperationService->getListeChequeInviteNonEnregistre());
		$lResponse->setListeEspeceInvite($lOperationService->getListeEspeceInviteNonEnregistre());
		
		
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
			
			// Si l'opération originale est de type débit : elle doit le rester
			if($lOperationInitiale->getMontant() < 0) {
				$pParam["montant"] = -1 * $pParam["montant"];
			}
			
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