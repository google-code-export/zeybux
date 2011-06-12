<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/12/2010
// Fichier : ModificationProducteurControleur.php
//
// Description : Classe ModificationProducteurControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "AfficheModificationProducteurResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "ModifierProducteurResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ProducteurValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "GestionProducteurToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
/*
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_PO . MOD_GESTION_ADHERENTS . "/ModificationAdherentPO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "ModifierAdherentResponse.php" );*/

/**
 * @name ModificationProducteurControleur
 * @author Julien PIERRE
 * @since 24/12/2010
 * @desc Classe controleur d'une modification d'un producteur
 */
class ModificationProducteurControleur
{	
	/**
	* @name getProducteur($pParam)
	* return AfficheModificationProducteurResponse
	* @desc Retourne les informations pour le producteur.
	*/
	public function getProducteur($pParam) {
		$lIdProducteur = $pParam['id_producteur'];
		
		// Recherche et met à jour les information de l'adherent
		$lProducteur = ProducteurViewManager::select( $lIdProducteur );
		$lProducteur = $lProducteur[0];
		
		$lResponse = new AfficheModificationProducteurResponse();
		
		$lResponse->setId($lProducteur->getPrdtId());
		$lResponse->setNumero($lProducteur->getPrdtNumero());
		$lResponse->setCompte($lProducteur->getCptLabel());
		$lResponse->setNom($lProducteur->getPrdtNom());
		$lResponse->setPrenom($lProducteur->getPrdtPrenom());
		$lResponse->setCourrielPrincipal($lProducteur->getPrdtCourrielPrincipal());
		$lResponse->setCourrielSecondaire($lProducteur->getPrdtCourrielSecondaire());
		$lResponse->setTelephonePrincipal($lProducteur->getPrdtTelephonePrincipal());
		$lResponse->setTelephoneSecondaire($lProducteur->getPrdtTelephoneSecondaire());
		$lResponse->setAdresse($lProducteur->getPrdtAdresse());
		$lResponse->setCodePostal($lProducteur->getPrdtCodePostal());
		$lResponse->setVille($lProducteur->getPrdtVille());
		$lResponse->setDateNaissance($lProducteur->getPrdtDateNaissance());
		$lResponse->setCommentaire($lProducteur->getPrdtCommentaire());
		
		return $lResponse;
	}

	/**
	* @name modifierProducteur($pParam)
	* @desc Met à jour les informations du Producteur ainsi que ses autorisations
	*/
	public function modifierProducteur($pParam) {
		
		$lVr = ProducteurValid::validUpdate($pParam);
		if($lVr->getValid()) {		
			$lProducteur = GestionProducteurToVO::convertFromArray($pParam);
			
			// Chargement de l'adherent
			$lProducteurActuel = ProducteurManager::select( $lProducteur->getId() );
			$lProducteurCompte = $pParam['compte'];
			$lCompte = CompteManager::selectByLabel($lProducteurCompte);
			
			if(is_null($lCompte[0]->getId())) {
				// Création d'un nouveau compte
				$lCompte = new CompteVO();
				$lIdCompte = CompteManager::insert($lCompte);
				// Le label est l'id du compte par défaut
				$lCompte->setId($lIdCompte);
				$lCompte->setLabel('C' . $lIdCompte);
				CompteManager::update($lCompte);
				
				// Initialisation du compte
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompte);
				$lOperation->setMontant(0);
				$lOperation->setLibelle("Création du compte");
				$lOperation->setDate(StringUtils::dateAujourdhuiDb());
				$lOperation->setType(1);
				$lOperation->setIdCommande(0);
				$lOperation->setTypePaiement(-1);				
				OperationManager::insert($lOperation);
				
				$lProducteur->setIdCompte($lIdCompte);
			} else {									
				$lProducteur->setIdCompte($lCompte[0]->getId());
			}
						
			// Insertion de la date de mise à jour
			$lProducteur->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
						
			// On reporte le numero dans la maj
			$lProducteur->setNumero($lProducteurActuel->getNumero());
						
			// L'adherent n'est pas supprimé
			$lProducteur->setEtat(1);
						
			// Maj du producteur dans la BDD
			ProducteurManager::update( $lProducteur );
						
			$lResponse = new ModifierProducteurResponse();
			$lResponse->setNumero($lProducteur->getNumero());
			
			return $lResponse;
				
		}	
		return $lVr;										
	}
}
?>
