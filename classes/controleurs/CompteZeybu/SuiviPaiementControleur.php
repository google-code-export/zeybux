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
			$lOperationMaj = $lOperationService->get($pParam["id"]);

			$lOperations = $lOperationService->getBonLivraison($lOperationMaj->getIdCommande(),$lOperationMaj->getIdCompte());
			$lOperation = $lOperations[0];
			if(!is_null($lOperation->getId())) { // Pour un producteur avec un bon de livraison
				$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeZeybu());
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeProducteur());
				$lOperationService->delete($lOperation->getId()); // Ajout ou mise à jour de l'operation de bon de livraison
			} else { // Pour Un adhérent ou producteur sans bon de livraison
				$lOperationService->delete($lOperationMaj->getId());
			}
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
/*			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pParam["id"]);
			$lOperation->setTypePaiementChampComplementaire($pParam["champComplementaire"]);
			$lOperation->setMontant($pParam["montant"]);
			$lOperationService->set($lOperation);
*/
			$lOperationService = new OperationService();
			$lOperationMaj = $lOperationService->get($pParam["id"]);
			
			$lOperations = $lOperationService->getBonLivraison($lOperationMaj->getIdCommande(),$lOperationMaj->getIdCompte());
			$lOperation = $lOperations[0];
			if(!is_null($lOperation->getId())) { // Pour un producteur avec un bon de livraison
				$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());								
				
				// Ajout Opération de débit sur le compte du zeybu
				$lOperationZeybu = $lOperationService->get($lInfoOperationLivraison->getIdOpeZeybu());
				$lOperationZeybu->setId("");
				//$lOperationZeybu->setIdCompte(-1);
				//$lOperationZeybu->setLibelle('Livraison Marché n°' . $lMarche->getNumero());
				//$lOperationZeybu->setTypePaiement($pParam["typePaiement"]);
				$lOperationZeybu->setTypePaiementChampComplementaire($pParam["champComplementaire"]);
				//$lOperationZeybu->setIdCommande($lIdMarche);
				$lOperationZeybu->setMontant($pParam["montant"]);
				$lIdOperationZeybu = $lOperationService->set($lOperationZeybu);
				
				// Suppression de l'ancienne opération
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeZeybu());
				
				// Ajout opération de crédit sur le compte du producteur
				$lOperationPrdt = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
				$lOperationPrdt->setId("");
				//$lOperationPrdt->setIdCompte($lIdCompteFerme);
				//$lOperationPrdt->setLibelle('Livraison Marché n°' . $lMarche->getNumero());
				//$lOperationPrdt->setTypePaiement($pParam["typePaiement"]);
				$lOperationPrdt->setTypePaiementChampComplementaire($pParam["champComplementaire"]);
				//$lOperationPrdt->setIdCommande($lIdMarche);
				$lOperationPrdt->setMontant($pParam["montant"]);
				$lIdOperationPrdt = $lOperationService->set($lOperationPrdt);
				
				// Suppression de l'ancienne opération
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeProducteur());
				
				$lInfoOperationLivraison = new InfoOperationLivraisonVO();
				$lInfoOperationLivraison->setIdOpeZeybu($lIdOperationZeybu);
				$lInfoOperationLivraison->setIdOpeProducteur($lIdOperationPrdt);
				$lIdInfoOpeLivr = InfoOperationLivraisonManager::insert($lInfoOperationLivraison);
				
				
				$lOperation->setTypePaiementChampComplementaire($lIdInfoOpeLivr);
				$lOperation->setMontant($pParam["montant"]);
				$lOperationService->set($lOperation); // Ajout ou mise à jour de l'operation de bon de livraison

			} else { // Pour Un adhérent ou producteur sans bon de livraison
				$lOperationMaj->setTypePaiementChampComplementaire($pParam["champComplementaire"]);
				$lOperationMaj->setMontant($pParam["montant"]);
				$lOperationService->set($lOperationMaj);
			}
			
		}		
		return $lVr;	
	}
}
?>