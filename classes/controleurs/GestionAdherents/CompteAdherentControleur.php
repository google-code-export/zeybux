<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : CompteAdherentControleur.php
//
// Description : Classe CompteAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/InfoCompteAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "ModuleService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");

/**
 * @name CompteAdherentControleur
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe controleur d'un compte
 */
class CompteAdherentControleur
{
	/**
	* @name afficher($pParam)
	* @return InfoCompteAdherentResponse
	* @desc Renvoie le Compte du controleur après avoir récupérer les informations dans la BDD en fonction de l'ID.
	*/
	public function afficher($pParam) {
		$lVr = AdherentValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam['id'];
			$lAdherentService = new AdherentService();				
			$lResponse = new InfoCompteAdherentResponse();
			
			$lResponse->setAdherent($lAdherentService->get($lIdAdherent));			
			$lResponse->setAutorisations( $lAdherentService->getAutorisation($lIdAdherent) );
			$lResponse->setOperationAvenir( $lAdherentService->getOperationAvenir($lIdAdherent));
			$lResponse->setOperationPassee( $lAdherentService->getOperationPassee($lIdAdherent));
			
			$lModuleService = new ModuleService();
			$lResponse->setModules( $lModuleService->selectAllNonDefautVisible());
			
			$lTypePaiementService = new TypePaiementService();
			$lResponse->setTypePaiement( $lTypePaiementService->get() );
			
			return $lResponse;
		}
		return $lVr;
	}
}
?>
