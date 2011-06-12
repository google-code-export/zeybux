<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : AjoutProducteurControleur.php
//
// Description : Classe AjoutProducteurControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ProducteurValid.php" );
include_once(CHEMIN_CLASSES_TOVO . "GestionProducteurToVO.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "AjoutProducteurResponse.php" );

/**
 * @name AjoutProducteurControleur
 * @author Julien PIERRE
 * @since 22/12/2010
 * @desc Classe controleur d'un Ajout d'un producteur
 */
class AjoutProducteurControleur
{	
	/**
	* @name ajoutProducteur($pParam)
	* @return string
	* @desc Controle et formatte les données avant de les insérer dans la BDD. Retourne l'Id en cas de succés ou une erreur.
	*/
	public function ajoutProducteur($pParam) {				
		$lVr = ProducteurValid::validAjout($pParam);
		if($lVr->getValid()) {			
			$lProducteur = GestionProducteurToVO::convertFromArray($pParam);
			
			$lProducteurCompte = $pParam['compte'];
			$lCompte = CompteManager::selectByLabel($lProducteurCompte);
			if(empty($lProducteurCompte) || is_null($lCompte[0]->getId())) {
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
			
			// Insertion de la date de création
			$lProducteur->setDateCreation( StringUtils::dateAujourdhuiDb() );
						
			// Insertion de la première mise à jour
			$lProducteur->setDateMaj( StringUtils::dateTimeAujourdhuiDb() );
			
			// Le producteur n'est pas supprimé
			$lProducteur->setEtat(1);
						
			// Enregistre le poducteur dans la BDD
			$lId = ProducteurManager::insert( $lProducteur );
						
			$lResponse = new AjoutProducteurResponse();
			$lResponse->setId($lId);
			$lProducteur = ProducteurManager::select($lId);
			$lResponse->setNumero($lProducteur->getNumero());
			
			return $lResponse;
		}	
		return $lVr;
	}
}
?>