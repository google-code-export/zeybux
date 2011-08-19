<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/12/2010
// Fichier : CompteProducteurControleur.php
//
// Description : Classe CompteProducteurControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationPasseeViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_PRODUCTEUR . "/InfoCompteProducteurResponse.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

/**
 * @name CompteProducteurControleur
 * @author Julien PIERRE
 * @since 23/12/2010
 * @desc Classe controleur d'un compte
 */
class CompteProducteurControleur
{
	/**
	* @name afficher($pParam)
	* @return InfoCompteProducteurResponse
	* @desc Renvoie le Compte du controleur après avoir récupérer les informations dans la BDD en fonction de l'ID.
	*/
	public function afficher($pParam) {
		
		$lResponse = new InfoCompteProducteurResponse();
		$lIdProducteur = $pParam['id_producteur'];
		$lProducteur = ProducteurViewManager::select( $lIdProducteur );
		$lResponse->setProducteur( $lProducteur[0] );
		
		// Vérifie si l'adhérent existe
		if($lResponse->getProducteur()->getPrdtId() == $lIdProducteur) {
			$lResponse->setOperationPassee( OperationPasseeViewManager::select( $lResponse->getProducteur()->getPrdtIdCompte() ));
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