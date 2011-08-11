<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : VirementsControleur.php
//
// Description : Classe VirementsControleur
//
//****************************************************************
// Inclusion des classesgetListeAdherent
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/ListeAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMPTE_ZEYBU . "/ListeVirementResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CompteZeybuListeVirementViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "VirementService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMPTE_ZEYBU . "/CompteZeybuVirementValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdVirementValid.php");

/**
 * @name VirementsControleur
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe controleur du compte zeybu
 */
class VirementsControleur
{
	/**
	* @name getInfoCompte()
	* @desc Donne les infos sur le compte du zeybu
	*/
	public function getListeAdherent() {		
		// Lancement de la recherche
		$lResponse = new ListeAdherentResponse();
		$lResponse->setListeAdherent(AdherentViewManager::selectAll());
		$lResponse->setListeProducteur(ProducteurViewManager::selectAll());
		return $lResponse;		
	}
	
	/**
	* @name getListeVirement()
	* @return ListeVirementResponse
	* @desc Renvoie le solde du compte solidaire et le détail des opérations
	*/
	public function getListeVirement() {
		$lResponse = new ListeVirementResponse();		
		$lResponse->setOperation( CompteZeybuListeVirementViewManager::selectAll());
		return $lResponse;
	}
	
	/**
	* @name ajoutVirement($pParam)
	* @return CompteZeybuAjoutVirementVR
	* @desc Ajoute un virement
	*/
	public function ajoutVirement($pParam) {
		$lVr = CompteZeybuVirementValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lVirement->setId($lIdVirement);
			$lVirement->setCptDebit($pParam['idCptDebit']);
			$lVirement->setCptCredit($pParam['idCptCredit']);			
			$lVirement->setMontant($pParam['montant']); 
			$lVirement->setType($pParam['type']); // Virement classique ou solidaire
			
			$lVirementService = new VirementService();
			$lVirementService->set($lVirement); // Enregistre le virement
		}		
		return $lVr;
	}
	
	/**
	* @name modifierVirement($pParam)
	* @return CompteZeybuModifierVirementVR
	* @desc Modifie un virement
	*/
	public function modifierVirement($pParam) {
		$lVr = CompteZeybuVirementValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lIdVirementValid = new IdVirementValid();
			if(	$lIdVirementValid->estDebit($pParam['id']) ) {
				$lIdVirement->setIdDebit($pParam['id']);
			} else {
				$lIdVirement->setIdCredit($pParam['id']);
			}
			$lVirement->setId($lIdVirement);			
			$lVirement->setMontant($pParam['montant']);
			
			$lVirementService = new VirementService();
			$lVirementService->set($lVirement); // Enregistre le virement
		}		
		return $lVr;
	}
	
	/**
	* @name supprimerVirement($pParam)
	* @return CompteZeybuSupprimerVirementVR
	* @desc Supprime un virement
	*/
	public function supprimerVirement($pParam) {
		$lVr = CompteZeybuVirementValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lVirementService = new VirementService();			
			
			$lVirement = new VirementVO(); // Le virement
			$lIdVirement = new IdVirementVO(); // Id du virement
			$lIdVirementValid = new IdVirementValid();
			if(	$lIdVirementValid->estDebit($pParam['id']) ) {
				$lIdVirement->setIdDebit($pParam['id']);
			} else {
				$lIdVirement->setIdCredit($pParam['id']);
			}
			$lVirement->setId($lIdVirement);
			$lVirementService->delete($lVirementService->getIdVirement($lVirement)->getId()); // Supprime le virement
		}		
		return $lVr;
	}
}
?>