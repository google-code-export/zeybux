<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : AjoutAdherentControleur.php
//
// Description : Classe AjoutAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AutorisationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "AfficheAjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AdherentValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdherentToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");

/**
 * @name AjoutAdherentControleur
 * @author Julien PIERRE
 * @since 01/02/2010
 * @desc Classe controleur d'un Ajout d'adherent
 */
class AjoutAdherentControleur
{

	/**
	* @name getListeModule()
	* @desc Retourne l'ensemble des modules
	*/
	public function getListeModule() {
		$lResponse = new AfficheAjoutAdherentResponse();
		$lResponse->setModules(ModuleManager::selectAll());
		return $lResponse;
	}
	
	/**
	* @name ajoutAdherent($pParam)
	* @return string
	* @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	*/
	public function ajoutAdherent($pParam) {				
		$lVr = AdherentValid::validAjout($pParam);
		if($lVr->getValid()) {			
			$lAdherent = AdherentToVO::convertFromArray($pParam);
			
			$lAdherentCompte = $pParam['compte'];
			$lCompte = CompteManager::selectByLabel($lAdherentCompte);	
			if(empty($lAdherentCompte) || is_null($lCompte[0]->getId())) {
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
				
				$lAdherent->setIdCompte($lIdCompte);
			} else {									
				$lAdherent->setIdCompte($lCompte[0]->getId());
			}
						
			// Insertion de la première mise à jour
			$lAdherent->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
			
			// L'adherent n'est pas supprimé
			$lAdherent->setEtat(1);
			
			// Enregistre l'adherent dans la BDD
			$lId = AdherentManager::insert( $lAdherent );
			
			// Ajout des autorisations du compte
			foreach( $lAdherent->getListeModule() as $lIdModule) {
				$lAutorisation = new AutorisationVO();
				$lAutorisation->setIdAdherent($lId);
				$lAutorisation->setIdModule($lIdModule);
	
				AutorisationManager::insert($lAutorisation);
			}
			
			$lAdherent = AdherentManager::select($lId);
			
			// Insertion des informations de connexion
			$lIdentification = new IdentificationVO();
			$lIdentification->setIdLogin($lId);
			$lIdentification->setLogin($lAdherent->getNumero());
			$lIdentification->setPass( md5( $pParam['motPasse'] ) );
			$lIdentification->setType(1);
			$lIdentification->setAutorise(1);
			IdentificationManager::insert( $lIdentification );
			
			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lId);			
			$lResponse->setNumero($lAdherent->getNumero());
			return $lResponse;
						
		}	
		return $lVr;
	}
}
?>
