<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/02/2010
// Fichier : SuppressionAdherentControleur.php
//
// Description : Classe SuppressionAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AjoutAdherentResponse.php" );

/**
 * @name SuppressionAdherentControleur
 * @author Julien PIERRE
 * @since 02/02/2010
 * @desc Classe controleur d'une Suppression d'adherent
 */
class SuppressionAdherentControleur
{
	/**
	* @name supprimerAdherent($pParam)
	* @desc Passe l'adhérent en état supprimé
	*/
	public function supprimerAdherent($pParam) {				
		$lVr = AdherentValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam['id'];
			$lAdherentService = new AdherentService();
			$lAdherentService->delete($lIdAdherent);
			
			// Gestion du compte
			$lCompteService = new CompteService();
			$lIdAncienCompte = $lVr->getData()['adherent']->getAdhIdCompte();
			$lAdherentAncienCompte = $lCompteService->getAdherentCompte($lIdAncienCompte);
			
			// RAZ de l'adhérent principal
			$lIdAdherentPrincipalAncienCompte = 0;
			// Ou positionnement du nouvel
			if(!is_null($lAdherentAncienCompte[0]->getId()) && $pParam['idAdherentPrincipal'] != -1) {
				$lIdAdherentPrincipalAncienCompte = $pParam['idAdherentPrincipal'];
			}
			// Maj de l'ancien compte
			$lAncienCompte = $lCompteService->get($lIdAncienCompte);
			$lAncienCompte->setIdAdherentPrincipal($lIdAdherentPrincipalAncienCompte);			
			$lCompteService->set($lAncienCompte);

			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lIdAdherent);
			return $lResponse;						
		}	
		return $lVr;
	}
}
?>
