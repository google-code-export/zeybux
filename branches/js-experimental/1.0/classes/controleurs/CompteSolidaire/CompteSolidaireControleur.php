<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireControleur.php
//
// Description : Classe CompteSolidaireControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_SOLIDAIRE . "/CompteSolidaireResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteSolidaireOperationViewManager.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteSolidaireListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_SOLIDAIRE . "/ListeAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "VirementService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_SOLIDAIRE . "/CompteSolidaireVirementValid.php" );

/**
 * @name CompteSolidaireControleur
 * @author Julien PIERRE
 * @since 02/07/2011
 * @desc Classe controleur du compte CompteSolidaireControleur
 */
class CompteSolidaireControleur
{	
	/**
	* @name getCompte()
	* @return CompteSolidaireResponse
	* @desc Renvoie le solde du compte solidaire et le détail des opérations
	*/
	public function getCompte() {
		$lResponse = new CompteSolidaireResponse();		
		$lResponse->setOperation( CompteSolidaireOperationViewManager::selectAll());
		$lCompteService = new CompteService();
		$lResponse->setSolde( $lCompteService->get(-2)->getSolde());
		return $lResponse;
	}
	
	/**
	* @name getAdherent()
	* @return ListeAdherentResponse
	* @desc Recherche la liste des adherents
	*/
	public function getAdherent() {		
		// Lancement de la recherche
		$lResponse = new ListeAdherentResponse();
		$lResponse->setListeAdherent(CompteSolidaireListeAdherentViewManager::selectAll());
		$lCompteService = new CompteService();
		$lResponse->setSolde( $lCompteService->get(-2)->getSolde());
		return $lResponse;
	}
	
	/**
	* @name ajoutVirement($pParam)
	* @return CompteSolidaireAjoutVirementVR
	* @desc Ajoute un virement solidaire vers un compte
	*/
	public function ajoutVirement($pParam) {
		$lVr = CompteSolidaireVirementValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lVirement->setId($lIdVirement);
			$lVirement->setCptDebit(-2); // Le Compte solidaire
			$lAdherent = AdherentViewManager::select($pParam['id']); // Dans le valid ajouter un test pour vérifier qu'il existe
			$lVirement->setCptCredit($lAdherent->getAdhIdCompte());
			
			$lVirement->setMontant($pParam['montant']); 
			$lVirement->setType(2); // Virement solidaire
			
			$lVirementService = new VirementService();
			$lVirementService->set($lVirement); // Enregistre le virement
		}		
		return $lVr;
	}
	
	/**
	* @name modifierVirement($pParam)
	* @return CompteSolidaireModifierVirementVR
	* @desc Modifie un virement
	*/
	public function modifierVirement($pParam) {
		$lVr = CompteSolidaireVirementValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lIdVirement->setIdDebit($pParam['id']);
			
			$lVirement->setId($lIdVirement);			
			$lVirement->setMontant($pParam['montant']); 
			$lVirement->setType(2); // Virement solidaire
			
			$lVirementService = new VirementService();
			$lVirementService->set($lVirement); // Enregistre le virement
		}		
		return $lVr;
	}
	
	/**
	* @name supprimerVirement($pParam)
	* @return CompteSolidaireSupprimerVirementVR
	* @desc Supprime un virement
	*/
	public function supprimerVirement($pParam) {
		$lVr = CompteSolidaireVirementValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lVirementService = new VirementService();			
			
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lIdVirement->setIdDebit($pParam['id']);
			$lVirement->setId($lIdVirement);
			
			$lVirementService->delete($lVirementService->getIdVirement($lVirement)->getId()); // Supprime le virement
		}		
		return $lVr;
	}
}
?>