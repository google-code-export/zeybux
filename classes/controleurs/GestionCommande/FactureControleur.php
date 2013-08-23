<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/08/2013
// Fichier : FactureControleur.php
//
// Description : Classe FactureControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "FactureService.php");
include_once(CHEMIN_CLASSES_SERVICE . "FermeService.php");
include_once(CHEMIN_CLASSES_SERVICE . "NomProduitService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/UniteNomProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/EnregistrerFactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/FactureResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ListeMarcheResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FactureValid.php");
include_once(CHEMIN_CLASSES_TOVO . "FactureToVO.php");

/**
 * @name FactureControleur
 * @author Julien PIERRE
 * @since 10/08/2013
 * @desc Classe controleur d'une FactureControleur
 */
class FactureControleur
{
	/**
	 * @name getListeMarche()
	 * @return ListeMarcheResponse
	 * @desc Retourne la liste des marchés.
	 */
	public function getListeMarche() {
		$lMarcheService = new MarcheService();		
		return new ListeMarcheResponse($lMarcheService->get());
	}
	
	/**
	 * @name getListeFacture($pParam)
	 * @return ListeFactureResponse
	 * @desc Retourne la liste des factures.
	 */
	public function getListeFacture($pParam) {
		$lVr = FactureValid::validRechercheListeFacture($pParam);
		if($lVr->getValid()) {

			$lDateDebut = NULL;
			if(!empty($pParam['dateDebut'])) {
				$lDateDebut = $pParam['dateDebut'];
			}
			$lDateFin = NULL;
			if(!empty($pParam['dateFin'])) {
				$lDateFin = $pParam['dateFin'];
			}
			$lIdMarche = NULL;
			if(!empty($pParam['idMarche'])) {
				$lIdMarche = $pParam['idMarche'];
			}
			
			$lListeFactureResponse = new ListeFactureResponse();
			$lFactureService = new FactureService();
			$lListeFactureResponse->setListeFacture($lFactureService->rechercheListeFacture($lDateDebut, $lDateFin, $lIdMarche));
			
			return $lListeFactureResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getListeFerme()
	 * @return ListeFermeResponse
	 * @desc Retourne la liste des Fermes.
	 */
	public function getListeFerme() {
		$lFermeService = new FermeService();
		$lFactureService = new FactureService();
		$lBanqueService = new BanqueService();		
		$lTypePaiementService = new TypePaiementService();
		
		return new ListeFermeResponse($lFermeService->get(),
				$lFactureService->getNouveauNumeroFacture(),
				$lBanqueService->getAllActif(),
				$lTypePaiementService->selectVisible());
	}
	
	/**
	 * @name getListeProduitFerme($pParam)
	 * @return ListeProduitResponse
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function getListeProduitFerme($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	 * @name getUniteProduit($pParam)
	 * @return UniteNomProduitResponse
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function getUniteProduit($pParam) {
		$lVr = NomProduitValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lNomProduitService = new NomProduitService();
			return new UniteNomProduitResponse($lNomProduitService->selectUniteNomProduit( $pParam['id'] ));
		}
		return $lVr;
	}
	
	/**
	 * @name enregistrerFacture($pParam)
	 * @return FacctureVR
	 * @desc Retourne la liste des produits d'une ferme
	 */
	public function enregistrerFacture($pParam) {
		$lVr = FactureValid::validEnregistrer($pParam);
		if($lVr->getValid()) {
			$lFacture = FactureToVO::convertFromArray($pParam);
			$lFactureService = new FactureService();
			return new EnregistrerFactureResponse($lFactureService->set($lFacture));
		}
		return $lVr;
	}
	
	/**
	 * @name getFacture($pParam)
	 * @return FactureResponse
	 * @desc Retourne la facture
	 */
	public function getFacture($pParam) {
		$lVr = FactureValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lBanqueService = new BanqueService();		
			$lTypePaiementService = new TypePaiementService();
			$lFermeService = new FermeService();
			$lFerme = $lFermeService->getByIdCompte($lVr->getData()['facture']->getId()->getIdCompte())[0];
			
			return new FactureResponse($lVr->getData()['facture'],
					$lBanqueService->getAllActif(),
					$lTypePaiementService->selectVisible(),
					$lFerme,
					ListeNomProduitViewManager::select( $lFerme->getId() ));
			
		}
		return $lVr;
	}
	
	/**
	 * @name deleteFacture($pParam)
	 * @return FactureVR
	 * @desc Supprime la facture
	 */
	public function deleteFacture($pParam) {
		$lVr = FactureValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lFactureService = new FactureService();
			$lFactureService->delete($pParam['id']);
		}
		return $lVr;
	}
}
?>