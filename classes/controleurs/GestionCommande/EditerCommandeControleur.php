<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : EditerCommandeControleur.php
//
// Description : Classe EditerCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/EditerCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAchatEtReservationResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/EditerCommandeValid.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportListeReservationValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ModifierMarcheValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitMarcheValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeCompleteValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_TOVO . "ProduitCommandeToVO.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ModelesLotResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitCatalogueValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "FermeService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AutorisationSupprimerLotResponse.php" );
include_once(CHEMIN_CLASSES_VO . "LotAbonnementMarcheVO.php" );
include_once(CHEMIN_CLASSES_VO . "DetailMarcheReservationVO.php" );


/**
 * @name EditerCommandeControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une EditerCommande
 */
class EditerCommandeControleur
{
	/**
	* @name getInfoCommande($pParam)
	* @return EditerCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur cette commande et les infos sur la commande.
	*/
	public function getInfoCommande($pParam) {
		$lVr = EditerCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_marche"];

			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);

			$lResponse = new EditerCommandeResponse();
			$lResponse->setMarche($lMarche);

			return $lResponse;
		}				
		return $lVr;
	}

	/**
	* @name setPause($pParam)
	* @param Id du marché
	* @desc Met en pause le marché
	*/
	public function setPause($pParam) {
		$lVr = EditerCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lMarcheService = new MarcheService();
			$lMarcheService->setPause($pParam["id_marche"]);
		}
		return $lVr;
	}
	
	/**
	* @name setPlay($pParam)
	* @param Id du marché
	* @desc Met en play le marché
	*/
	public function setPlay($pParam) {		
		$lVr = EditerCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lMarcheService = new MarcheService();
			$lMarcheService->setPlay($pParam["id_marche"]);
		}
		return $lVr;
	}
	
	/**
	* @name setCloturer($pParam)
	* @param Id du marché
	* @desc Cloture le marché
	*/
	public function setCloturer($pParam) {		
		$lVr = EditerCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lMarcheService = new MarcheService();
			$lMarcheService->setCloturer($pParam["id_marche"]);			
		}
		return $lVr;
	}
	
	/**
	* @name modifierInformationMarche($pParam)
	* @param MarcheVO
	* @desc Modifie les informations du marché
	*/
	public function modifierInformationMarche($pParam) {		
		$lVr = ModifierMarcheValid::validUpdateInformation($pParam);
		if($lVr->getValid()) {
			$lMarche = new MarcheVO();			
			$lMarche->setId($pParam['id']);
			$lMarche->setNom($pParam['nom']);
			$lMarche->setDescription($pParam['description']);
			$lMarche->setDateMarcheDebut($pParam['dateMarcheDebut'] . " " . $pParam['timeMarcheDebut']);
			$lMarche->setDateMarcheFin($pParam['dateMarcheFin'] . " " . $pParam['timeMarcheFin']);
			$lMarche->setDateDebutReservation($pParam['dateDebutReservation'] . " " . $pParam['timeDebutReservation']);
			$lMarche->setDateFinReservation($pParam['dateFinReservation'] . " " . $pParam['timeFinReservation']);
			
			$lMarcheService = new MarcheService();
			$lMarcheService->updateInformation($lMarche);
		}
		return $lVr;
	}
	
	/**
	* @name supprimerProduitMarche($pParam)
	* @param IdProduit
	* @desc Supprime un produit du marché
	*/
	public function supprimerProduitMarche($pParam) {		
		$lVr = ProduitMarcheValid::validDelete($pParam);
		if($lVr->getValid()) {			
			$lMarcheService = new MarcheService();
			$lMarcheService->supprimerProduit($pParam["id"]);
		}
		return $lVr;
	}
	
	/**
	* @name detailProduitMarche($pParam)
	* @param IdProduit
	* @desc Retourne le détail d'un produit
	*/
	public function detailProduitMarche($pParam) {		
		$lVr = ProduitMarcheValid::validDelete($pParam);
		if($lVr->getValid()) {			
			$lMarcheService = new MarcheService();
			$lReservationService = new ReservationService();
			$lProduit = $lMarcheService->selectProduit($pParam["id"]);

			$lId = $lProduit->getIdNom();			
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			
			$lResponse = new DetailProduitResponse();
			$lResponse->setModelesLot( $lModelesLot );
			
			$lNvLots = array();
			foreach($lProduit->getLots() as $lLot) {
				$lReservation = $lReservationService->getReservationSurLot($lLot->getId());
				
				$lNvLot = new DetailMarcheReservationVO();
				$lNvLot->setId($lLot->getId());
				$lNvLot->setTaille($lLot->getTaille());
				$lNvLot->setPrix($lLot->getPrix());
				if(!is_null($lReservation[0]->getStoId())) {
					$lNvLot->setReservation(true);
				}
				array_push($lNvLots,$lNvLot);
			}
			$lProduit->setLots($lNvLots);
			$lResponse->setProduit( $lProduit );
			
			return $lResponse;
		}
		return $lVr;
	}

	/**
	* @name modifierProduitMarche($pParam)
	* @param ProduitVO
	* @desc Met à jour un produit du marché
	*/
	public function modifierProduitMarche($pParam) {		
		$lVr = ProduitMarcheValid::validUpdate($pParam);
		if($lVr->getValid()) {			
			$lMarcheService = new MarcheService();
			$lProduit = ProduitCommandeToVO::convertFromArray($pParam);
			$lMarcheService->updateProduit($lProduit,$pParam["lotRemplacement"]);
		}
		return $lVr;
	}
	
	/**
	* @name ajouterProduitMarche($pParam)
	* @param ProduitVO
	* @desc Met à jour un produit du marché
	*/
	public function ajouterProduitMarche($pParam) {		
		$lVr = CommandeCompleteValid::validAjoutProduit($pParam);
		if($lVr->getValid()) {			
			$lMarcheService = new MarcheService();
			$lProduit = ProduitCommandeToVO::convertFromArray($pParam);			
			$lMarcheService->ajoutProduit($lProduit);
		}
		return $lVr;
	}
	
	/**
	* @name getListeFerme()
	* @return ListeFermeResponse
	* @desc Recherche la liste des Fermes
	*/
	public function getListeFerme() {		
		// Lancement de la recherche
		$lResponse = new ListeFermeResponse();
		$lFermeService = new FermeService();
		$lResponse->setListeFerme($lFermeService->get());
		return $lResponse;
	}
	
	/**
	* @name getListeProduit($pParam)
	* @return ListeProduitResponse
	* @desc Retourne la liste des produits
	*/
	public function getListeProduit($pParam) {
		$lVr = FermeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeProduitResponse();
			$lResponse->setListeProduit( ListeNomProduitViewManager::select( $pParam['id'] ) );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name getModeleLot($pParam)
	* @return DetailProduitResponse
	* @desc Retourne les Modèles de lot d'un produit
	*/
	public function getModeleLot($pParam) {
		$lVr = NomProduitCatalogueValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['idNomProduit'];			
			$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lId);
			$lAbonnementService = new AbonnementService();
			
			$lResponse = new ModelesLotResponse();
			$lResponse->setModelesLot( $lModelesLot );
			$lDetailAbonnement = $lAbonnementService->getProduitByIdNom($lId);
			$lNvLots = array();
			foreach($lDetailAbonnement->getLots() as $lLot) {
				$lAbonnement = $lAbonnementService->getAbonnementSurLot($lLot->getId());
				
				$lLotAbonnementMarcheVO = new LotAbonnementMarcheVO();
				$lLotAbonnementMarcheVO->setId($lLot->getId());
				$lLotAbonnementMarcheVO->setIdProduitAbonnement($lLot->getIdProduitAbonnement());
				$lLotAbonnementMarcheVO->setTaille($lLot->getTaille());
				$lLotAbonnementMarcheVO->setPrix($lLot->getPrix());
				if(!is_null($lAbonnement[0]->getCptAboId())) {
					$lLotAbonnementMarcheVO->setReservation(true);
				}
				array_push($lNvLots,$lLotAbonnementMarcheVO);
			}
			$lDetailAbonnement->setLots($lNvLots);
			$lResponse->setDetailAbonnement( $lDetailAbonnement );
			return $lResponse;
		}		
		return $lVr;
	}
	
	/**
	* @name autorisationSupprimerLot($pParam)
	* @return DetailProduitResponse
	* @desc Retourne les Modèles de lot d'un produit
	*/
	public function autorisationSupprimerLot($pParam) {
		$lVr = DetailCommandeValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lId = $pParam['id'];
			$lReservationService = new ReservationService();
			
			$lResponse = new AutorisationSupprimerLotResponse();
			$lResponse->setAutorise( !$lReservationService->reservationSurLot($lId));
			return $lResponse;
		}		
		return $lVr;
	}
	
}
?>