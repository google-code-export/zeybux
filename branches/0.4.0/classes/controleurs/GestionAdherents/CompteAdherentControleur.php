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
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationAvenirViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationPasseeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "InfoCompteAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

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
		
		$lResponse = new InfoCompteAdherentResponse();
		$lIdAdherent = $pParam['id_adherent'];
		$lAdherent = AdherentViewManager::select( $lIdAdherent );
		$lResponse->setAdherent( $lAdherent );
		
		// Vérifie si l'adhérent existe
		if($lResponse->getAdherent()->getAdhId() == $lIdAdherent) {
		
			$lResponse->setAutorisations( AutorisationManager::selectByIdAdherent( $lIdAdherent ) );
			$lResponse->setOperationAvenir( OperationAvenirViewManager::select( $lAdherent->getAdhIdCompte() ));
			$lResponse->setOperationPassee( OperationPasseeViewManager::select( $lAdherent->getAdhIdCompte() ));
			$lResponse->setModules( ModuleManager::selectAll() );
			$lResponse->setTypePaiement( TypePaiementManager::selectAll() );
		
			return $lResponse;
		} else {			
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getLog()->addErreur($lErreur);
			return $lVr;			
		}
	}
}
?>
