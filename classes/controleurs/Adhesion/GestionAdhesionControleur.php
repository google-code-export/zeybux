<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2013
// Fichier : GestionAdhesionControleur.php
//
// Description : Classe GestionAdhesionControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/ListeAdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/ListePerimetreAdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/AdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/AjoutAdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/AutorisationSupprimerTypeAdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/ListeAdherentAdhesionResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/InfoAjoutAdhesionAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION . "/ListeAdherentResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_ADHESION ."/ListeAdhesionAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdhesionValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/TypeAdhesionValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdhesionAdherentDetailValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/AdherentValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdhesionService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdhesionToVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdhesionAdherentDetailToVO.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");

/**
 * @name GestionAdhesionControleur
 * @author Julien PIERRE
 * @since 03/11/2013
 * @desc Classe controleur d'une GestionAdhesionControleur
 */
class GestionAdhesionControleur
{		
	/**
	* @name getListeAdhesion()
	* @return ListeAdhesionResponse
	* @desc Retourne la liste des adhésions
	*/
	public function getListeAdhesion() {
		$lAdhesionService = new AdhesionService();
		return new ListeAdhesionResponse($lAdhesionService->get());
	}
	
	/**
	 * @name getListePerimetreAdhesion()
	 * @return ListePerimetreAdhesionResponse
	 * @desc Retourne la liste des périmètres des adhésions
	 */
	public function getListePerimetreAdhesion() {
		$lAdhesionService = new AdhesionService();
		return new ListePerimetreAdhesionResponse($lAdhesionService->getPerimetre());
	}
	
	/**
	 * @name getAdhesion($pParam)
	 * @return AdhesionResponse
	 * @desc Retourne une adhésion
	 */
	public function getAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			return new AdhesionResponse($lAdhesionService->get($pParam['id']));
		}
		return $lVr;
	}
	
	/**
	 * @name ajoutAdhesion($pParam)
	 * @return AdhesionResponse
	 * @desc Ajoute une adhésion
	 */
	public function ajoutAdhesion($pParam) {
		$lVr = AdhesionValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdhesion = AdhesionToVO::convertFromArray($pParam);
			return new AjoutAdhesionResponse($lAdhesionService->set($lAdhesion));
		}
		return $lVr;
	}
	
	/**
	 * @name updateAdhesion($pParam)
	 * @return AdhesionResponse
	 * @desc Modifie une adhésion
	 */
	public function updateAdhesion($pParam) {
		$lVr = AdhesionValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdhesion = AdhesionToVO::convertFromArray($pParam);
			return new AjoutAdhesionResponse($lAdhesionService->set($lAdhesion));
		}
		return $lVr;
	}

	/**
	 * @name autorisationSupprimerTypeAdhesion($pParam)
	 * @return AutorisationSupprimerTypeAdhesionResponse
	 * @desc Donne si il est possible de supprimer le type adhésion sans impact
	 */
	public function autorisationSupprimerTypeAdhesion($pParam) {
		$lVr = TypeAdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			return new AutorisationSupprimerTypeAdhesionResponse(!$lAdhesionService->existeAdherentSurTypeAdhesion($pParam['id']));
		}
		return $lVr;
	}
	
	/**
	 * @name listeAdherentSurTypeAdhesion($pParam)
	 * @return CSV
	 * @desc Retourne la liste des adhérents sur un type adhésion
	 */
	public function listeAdherentSurTypeAdhesion($pParam) {
		$lVr = TypeAdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lIdTypeAdhesion = $pParam['id'];
			$lAdhesionService = new AdhesionService();
			
			$lCSV = new CSV();
			$lCSV->setNom('Liste_Adherent.csv'); // Le Nom
			
			// L'entete
			$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($lIdTypeAdhesion);
			$lEntete = array($lTypeAdhesion->getLabel(),$lTypeAdhesion->getMontant() . SIGLE_MONETAIRE, "");
			$lCSV->setEntete($lEntete);
			
			$lListeAdherent = $lAdhesionService->getListeAdherentSurAdhesion($lIdTypeAdhesion);
			$lContenuTableau = array();
			foreach($lListeAdherent as $lAdherent) {
				array_push($lContenuTableau, array($lAdherent->getNumero(), $lAdherent->getNom(), $lAdherent->getPrenom()));
			}
			$lCSV->setData($lContenuTableau);
				
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}
	}
	
	/**
	 * @name autorisationSupprimerAdhesion($pParam)
	 * @return AutorisationSupprimerTypeAdhesionResponse
	 * @desc Donne si il est possible de supprimer l'adhésion sans impact
	 */
	public function autorisationSupprimerAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdhesion = $lAdhesionService->get($pParam['id']);
			$lAutorise = true;
			foreach($lAdhesion->getTypes() as $lType) {
				$lAutorise &= !$lAdhesionService->existeAdherentSurTypeAdhesion($lType->getId());
			}
			return new AutorisationSupprimerTypeAdhesionResponse($lAutorise);
		}
		return $lVr;
	}
	
	/**
	 * @name listeAdherentSurAdhesion($pParam)
	 * @return CSV
	 * @desc Retourne la liste des adhérents sur une adhésion
	 */
	public function listeAdherentSurAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lIdAdhesion = $pParam['id'];
			$lAdhesionService = new AdhesionService();
			$lAdhesion = $lAdhesionService->get($lIdAdhesion);

			$lCSV = new CSV();
			$lCSV->setNom('Liste_Adherent.csv'); // Le Nom
			
			// L'entete
			$lEntete = array("Attention : Cette liste se décompose en " . count($lAdhesion->getTypes()), "", "");
			$lCSV->setEntete($lEntete);
			
			$lContenuTableau = array();
			
			foreach($lAdhesion->getTypes() as $lType) {
				// Séparateur
				array_push($lContenuTableau, array("", "", ""));
				
				// Le Type d'adhésion
				$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($lType->getId());
				array_push($lContenuTableau, array($lTypeAdhesion->getLabel(),$lTypeAdhesion->getMontant() . SIGLE_MONETAIRE, ""));
				
				// Les adhérents
				$lListeAdherent = $lAdhesionService->getListeAdherentSurAdhesion($lType->getId());
				foreach($lListeAdherent as $lAdherent) {
					array_push($lContenuTableau, array($lAdherent->getNumero(), $lAdherent->getNom(), $lAdherent->getPrenom()));
				}
			}
			$lCSV->setData($lContenuTableau);
	
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}
	}
	
	/**
	 * @name supprimerAdhesion($pParam)
	 * @return AutorisationSupprimerTypeAdhesionResponse
	 * @desc Supprime une adhésion
	 */
	public function supprimerAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			return new AutorisationSupprimerTypeAdhesionResponse($lAdhesionService->delete($pParam['id']));
		}
		return $lVr;
	}
		
	/**
	 * @name getListeAdherentAdhesion($pParam)
	 * @return ListeAdherentAdhesionResponse
	 * @desc Détail des adhésion d'adhérent sur une adhésion
	 */
	public function getListeAdherentAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();

			return new ListeAdherentAdhesionResponse(
					$lAdhesionService->get($pParam['id']),
					$lAdhesionService->selectNbAdherentSurAdhesion($pParam['id']),
					$lAdhesionService->selectNbAdherentHorsAdhesion($pParam['id']),
					$lAdhesionService->selectListeAdherentAdhesion($pParam['id']));
		}
		return $lVr;
	}
	
	/**
	 * @name exportListeAdherentAdhesion($pParam)
	 * @return CSV
	 * @desc Retourne le statut des adhésion d'adhérent sur un adhésion en CSV
	 */
	public function exportListeAdherentAdhesion($pParam) {
		$lVr = AdhesionValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			
			
			$lCSV = new CSV();
			$lCSV->setNom('Liste_Adherent.csv'); // Le Nom
				
			// L'entete
			$lCSV->setEntete(array("N°","Compte", "Nom", "Prénom", "Adhésion"));
				
			$lListeAdherent = $lAdhesionService->selectListeAdherentAdhesion($pParam['id']);
			$lContenuTableau = array();
			foreach($lListeAdherent as $lAdherent) {
				$lStatut = 'NON';
				if(!is_null($lAdherent->getIdAdhesionAdherent())) {
					$lStatut = 'OUI';
				}
				array_push($lContenuTableau, array($lAdherent->getAdhNumero(), $lAdherent->getCptLabel(), $lAdherent->getAdhNom(), $lAdherent->getAdhPrenom(), $lStatut));
			}
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}
	}
	
	/**
	 * @name getInfoAjoutAdhesionAdherent($pParam)
	 * @return InfoAjoutAdhesionAdherentResponse
	 * @desc Retourne les informations pour le formulaire d'adhésion d'un adhérent à une adhésion
	 */
	public function getInfoAjoutAdhesionAdherent($pParam) {
		$lVr = AdhesionAdherentDetailValid::validInfoAjoutAdhesionAdherent($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lTypePaiementService = new TypePaiementService();
			$lBanqueService = new BanqueService();
			
			$lAdherentService = new AdherentService();
			$lAdherent = $lAdherentService->get($pParam['idAdherent']);
			
			$lCompteService = new CompteService();
			$lNbAdherentSurCompte = $lCompteService->getNombreAdherentSurCompte($lAdherent->getAdhIdCompte());
			
			$lAdhesion = $lAdhesionService->get($pParam['id']);
			
			if($lNbAdherentSurCompte == 1) { // Si seul adhérent sur le compte ne propose pas les adhésions sur périmètre adhérent
				$lFiltrePerimetre = 1;
			} else { // Si plusieurs adhérents uniquement les types adhésion compte
				$lFiltrePerimetre = 2;
			}
			
			$lTypes = array();
			foreach($lAdhesion->getTypes() as $i => $lType){
				if($lType->getPerId() == $lFiltrePerimetre) {
					array_push($lTypes, $lType);
				}
			}
			$lAdhesion->setTypes($lTypes);
			

			return new InfoAjoutAdhesionAdherentResponse(
					$lAdhesion,
					$lTypePaiementService->selectVisible(),
					$lBanqueService->getAllActif());
		}
		return $lVr;
	}
	
	/**
	 * @name getInfoModificationAdhesionAdherent($pParam)
	 * @return InfoModificationAdhesionAdherentResponse
	 * @desc Retourne les informations sur l'adhésion d'un adhérent à une adhésion
	 */
	public function getInfoModificationAdhesionAdherent($pParam) {
		$lVr = AdhesionAdherentValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lTypePaiementService = new TypePaiementService();
			$lBanqueService = new BanqueService();
				
			$lAdhesionAdherent = $lAdhesionService->getAdhesionAdherent($pParam['id']);
			
			$lAdhesion = $lAdhesionAdherent->getAdhesionDetail();
			
			
			$lPerimetre = $lAdhesionService->getTypeAdhesion($lAdhesionAdherent->getAdhesionAdherent()->getIdTypeAdhesion())->getIdPerimetre();
			
			
			if($lPerimetre == 1) { // Si seul adhérent sur le compte ne propose pas les adhésions sur périmètre adhérent
				$lFiltrePerimetre = 1;
			} else { // Si plusieurs adhérents uniquement les types adhésion compte
				$lFiltrePerimetre = 2;
			}
				
			$lTypes = array();
			foreach($lAdhesion->getTypes() as $i => $lType){
				if($lType->getPerId() == $lFiltrePerimetre) {
					array_push($lTypes, $lType);
				}
			}
			$lAdhesion->setTypes($lTypes);
				
	
			return new InfoAjoutAdhesionAdherentResponse(
					$lAdhesion,
					$lTypePaiementService->selectVisible(),
					$lBanqueService->getAllActif(),
					$lAdhesionAdherent);
		}
		return $lVr;
	}
	
	/**
	 * @name ajoutAdhesionAdherent($pParam)
	 * @return AjoutAdhesionResponse
	 * @desc Ajoute une adhésion d'adhérent
	 */
	public function ajoutAdhesionAdherent($pParam) {
		$lVr = AdhesionAdherentDetailValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdhesionAdherentDetail = AdhesionAdherentDetailToVO::convertFromArray($pParam);
			return new AjoutAdhesionResponse($lAdhesionService->setAdhesionAdherent($lAdhesionAdherentDetail));
		}
		return $lVr;
	}
	
	/**
	 * @name updateAdhesionAdherent($pParam)
	 * @return AjoutAdhesionResponse
	 * @desc Met à jour une adhésion d'adhérent
	 */
	public function updateAdhesionAdherent($pParam) {
		$lVr = AdhesionAdherentDetailValid::validUpdate($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdhesionAdherentDetail = AdhesionAdherentDetailToVO::convertFromArray($pParam);
			return new AjoutAdhesionResponse($lAdhesionService->setAdhesionAdherent($lAdhesionAdherentDetail));
		}
		return $lVr;
	}
	
	/**
	 * @name deleteAdhesionAdherent($pParam)
	 * @return AjoutAdhesionResponse
	 * @desc Supprime une adhésion d'adhérent
	 */
	public function deleteAdhesionAdherent($pParam) {
		$lVr = AdhesionAdherentDetailValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			return new AjoutAdhesionResponse($lAdhesionService->deleteAdhesionAdherent($pParam['adhesionAdherent']['id']));
		}
		return $lVr;
	}

	/**
	 * @name getListeAdherent()
	 * @return ListeAdherentResponse
	 * @desc Recherche la liste des adherents
	 */
	public function getListeAdherent() {
		// Lancement de la recherche
		$lResponse = new ListeAdherentResponse();
		$lAdherentService = new AdherentService();
		$lResponse->setListeAdherent($lAdherentService->getAllActif());
		return $lResponse;
	}

	/**
	 * @name getAdhesionSurAdherent($pParam)
	 * @return ListeAdherentResponse
	 * @desc Recherche la liste des adherents
	 */
	public function getAdhesionSurAdherent($pParam) {
		$lVr = AdherentValid::validAffiche($pParam);
		if($lVr->getValid()) {
			$lAdhesionService = new AdhesionService();
			$lAdherentService = new AdherentService();
			return new ListeAdhesionAdherentResponse(
					$lAdherentService->get($pParam['idAdherent']),
					$lAdhesionService->getAdhesionSurAdherent($pParam['idAdherent']));
		}
		return $lVr;
	}
}
?>
