<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : BonDeLivraisonControleur.php
//
// Description : Classe BonDeLivraisonControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonLivraisonViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockLivraisonViewManager.php");

include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );



include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");




include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurMarcheViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheBonDeLivraisonResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheListeProduitBonDeLivraisonResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/BonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonCommandeViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportBonLivraisonValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitsBonDeLivraisonValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "InfoOperationLivraisonManager.php");




/**
 * @name BonDeLivraisonControleur
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe controleur d'une BonDeLivraison
 */
class BonDeLivraisonControleur
{
	/**
	* @name getInfoLivraison($pParam)
	* @return AfficheBonDeLivraisonResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getInfoLivraison($pParam) {
		$lVr = BonDeCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];		
		
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
	
			$lResponse = new AfficheBonDeLivraisonResponse();
	
			$lProducteurs = ListeProducteurMarcheViewManager::select($lIdMarche);
			$lTypePaiement = TypePaiementVisibleViewManager::selectAll();
			
			$lResponse->setComNumero($lMarche->getNumero());
			$lResponse->setArchive($lMarche->getArchive());
			$lResponse->setProducteurs($lProducteurs);
			$lResponse->setTypePaiement($lTypePaiement);
			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name getListeProduitLivraison($pParam)
	* @return AfficheListeProduitBonDeLivraisonResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getListeProduitLivraison($pParam) {
		$lVr = BonDeCommandeValid::validGetListeProduitCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];
			$lIdCompteFerme = $pParam["id_compte_ferme"];
			$lOperationService = new OperationService();
			$lStockService = new StockService();
			
			$lResponse = new AfficheListeProduitBonDeLivraisonResponse();
			
			$lResponse->setProduits($lStockService->selectInfoBonCommandeStockProduitReservation($lIdMarche,$lIdCompteFerme));
			$lResponse->setProduitsCommande(InfoBonCommandeViewManager::selectInfoBonCommande($lIdMarche,$lIdCompteFerme));
			$lResponse->setProduitsLivraison(InfoBonLivraisonViewManager::selectInfoBonLivraison($lIdMarche,$lIdCompteFerme));
			$lResponse->setProduitsSolidaire(StockSolidaireViewManager::selectSolidaire($lIdMarche,$lIdCompteFerme));
			
			$lOperations = $lOperationService->getBonLivraison($lIdMarche,$lIdCompteFerme);
			$lOperation = $lOperations[0];			
			$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());

			if(!is_null($lOperation->getId())) {
				$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
			}
			$lResponse->setOperationProducteur($lOperation);
	
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name enregistrerBonDeLivraison($pParam)
	* @return AfficheListeProduitBonDeLivraisonResponse
	* @desc Enregistre le bon de commande.
	*/
	public function enregistrerBonDeLivraison($pParam) {
		$lVr = ProduitsBonDeLivraisonValid::validAjout($pParam);	
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];
			$lIdCompteFerme = $pParam["id_compte_ferme"];
			$lProduits = $pParam["produits"];

			
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			
			// Récupère l'opération Bon de livraison si elle existe
			$lOperationService = new OperationService();
			$lOperations = $lOperationService->getBonLivraison($lIdMarche,$lIdCompteFerme);
			$lIdOperation = $lOperations[0]->getId();

			if(is_null($lIdOperation)) { // Si il n'y a pas d'opération de Bon de Livraison				
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompteFerme);
				$lOperation->setLibelle('Bon de Livraison marché n°' . $lMarche->getNumero());
				$lOperation->setTypePaiement(6);
				$lOperation->setIdCommande($lIdMarche);				
			} else {
				$lOperation = $lOperations[0];
				
				$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
				
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeZeybu());
				$lOperationService->delete($lInfoOperationLivraison->getIdOpeProducteur());
			}
			
			// Ajout Opération de débit sur le compte du zeybu
			$lOperationZeybu = new OperationVO();
			$lOperationZeybu->setIdCompte(-1);
			$lOperationZeybu->setLibelle('Livraison Marché n°' . $lMarche->getNumero());
			$lOperationZeybu->setTypePaiement($pParam["typePaiement"]);
			$lOperationZeybu->setTypePaiementChampComplementaire($pParam["typePaiementChampComplementaire"]);
			$lOperationZeybu->setIdCommande($lIdMarche);
			$lOperationZeybu->setMontant($pParam["total"] * -1);
			$lIdOperationZeybu = $lOperationService->set($lOperationZeybu);
			
			// Ajout opération de crédit sur le compte du producteur
			$lOperationPrdt = new OperationVO();
			$lOperationPrdt->setIdCompte($lIdCompteFerme);
			$lOperationPrdt->setLibelle('Livraison Marché n°' . $lMarche->getNumero());
			$lOperationPrdt->setTypePaiement($pParam["typePaiement"]);
			$lOperationPrdt->setTypePaiementChampComplementaire($pParam["typePaiementChampComplementaire"]);
			$lOperationPrdt->setIdCommande($lIdMarche);
			$lOperationPrdt->setMontant($pParam["total"]);
			$lIdOperationPrdt = $lOperationService->set($lOperationPrdt);
			
			
			$lInfoOperationLivraison = new InfoOperationLivraisonVO();
			$lInfoOperationLivraison->setIdOpeZeybu($lIdOperationZeybu);
			$lInfoOperationLivraison->setIdOpeProducteur($lIdOperationPrdt);
			$lIdInfoOpeLivr = InfoOperationLivraisonManager::insert($lInfoOperationLivraison);
			
			
			$lOperation->setTypePaiementChampComplementaire($lIdInfoOpeLivr);
			$lOperation->setMontant($pParam["total"]);
			$lIdOperation = $lOperationService->set($lOperation); // Ajout ou mise à jour de l'operation de bon de livraison
			
			
			// Maj des infos du stock
			$lBonLivraison = InfoBonLivraisonViewManager::selectInfoBonLivraison($lIdMarche,$lIdCompteFerme);


			$lProduitMarche = $lMarche->getProduits();
			
			$lDetailOperationService = new DetailOperationService();
			$lStockService = new StockService();
			foreach($lProduits as $lProduit) {
				$lMaj = false;
				foreach($lBonLivraison as $lBon) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lMaj = true;
						
						$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setQuantite($lProduit["quantite"]);
						$lStock->setType(4);
						$lStock->setIdCompte($lIdCompteFerme);
						$lStock->setIdDetailCommande($lDcom[0]->getId());
						$lStock->setIdOperation($lIdOperation);
						$lStockService->set($lStock);
						
						$lDetailOperation = $lDetailOperationService->get($lBon->getDopeId());
						$lDetailOperation->setIdOperation($lIdOperation);
						$lDetailOperation->setIdCompte($lIdCompteFerme);
						$lDetailOperation->setMontant($lProduit["prix"]);
						$lDetailOperation->setLibelle('Bon de Livraison');
						$lDetailOperation->setTypePaiement(6);
						$lDetailOperationService->set($lDetailOperation);
						
						// Ajout ou Maj de la qté produit dans le stock
						$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockQuantiteActuel = $lStockQuantiteActuel[0];
						
						$lStockQuantite = new StockQuantiteVO();
						if(!is_null($lStockQuantiteActuel->getId())) {
							$lStockQuantite->setId($lStockQuantiteActuel->getId());
							$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
						}
						$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lProduit["quantite"] - $lBon->getStoQuantite());
						$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
						$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
						
						$lStockService->setStockQuantite($lStockQuantite);
					}
				}
				if(!$lMaj) {
					$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					
					$lStock = new StockVO();
					$lStock->setQuantite($lProduit["quantite"]);
					$lStock->setType(4);
					$lStock->setIdCompte($lIdCompteFerme);
					$lStock->setIdDetailCommande($lDcom[0]->getId());
					$lStock->setIdOperation($lIdOperation);
					$lStockService->set($lStock);
					
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setIdOperation($lIdOperation);
					$lDetailOperation->setIdCompte($lIdCompteFerme);
					$lDetailOperation->setMontant($lProduit["prix"]);
					$lDetailOperation->setLibelle('Bon de Livraison');
					$lDetailOperation->setTypePaiement(6);
					$lDetailOperation->setTypePaiementChampComplementaire($lProduit["id"]);
					$lDetailOperation->setIdDetailCommande($lDcom[0]->getId());
					$lDetailOperationService->set($lDetailOperation);
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
					}
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() + $lProduit["quantite"]);
					$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
					$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
				}			
			}
			foreach($lBonLivraison as $lBon) {
				$lDelete = true;
				foreach($lProduits as $lProduit) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lDelete = false;
					}
				}
				if($lDelete) {
					$lStockService->delete($lBon->getStoId());
					$lDetailOperationService->delete($lBon->getDopeId());
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
					
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire());
					}
					$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite() - $lBon->getStoQuantite());
					$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
					$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
				}
			}
			
			// Maj des infos du stock Solidaire
			$lStockSolidaire = StockSolidaireViewManager::selectSolidaire($lIdMarche,$lIdCompteFerme);
			foreach($lProduits as $lProduit) {
				$lMaj = false;
				foreach($lStockSolidaire as $lBon) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lMaj = true;
						
						$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setQuantite($lProduit["quantiteSolidaire"]);
						$lStock->setType(2);
						$lStock->setIdCompte($lIdCompteFerme);
						$lStock->setIdDetailCommande($lDcom[0]->getId());
						$lStock->setIdOperation($lIdOperation);
						$lStockService->set($lStock);
						
						// Ajout du produit dans le stock solidaire
						/*$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockSolidaireActuel = $lStockSolidaireActuel[0];					
						$lStockSolidaire = new StockSolidaireVO();
						$lQuantite = $lProduit["quantiteSolidaire"];
						if(!is_null($lStockSolidaireActuel->getId())) {
							$lStockSolidaire->setId($lStockSolidaireActuel->getId());
							$lQuantite = $lStockSolidaireActuel->getQuantite() + $lProduit["quantiteSolidaire"] - $lBon->getStoQuantite();
						}					
						$lStockSolidaire->setQuantite($lQuantite);
						$lStockSolidaire->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
						$lStockSolidaire->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockService->setSolidaire($lStockSolidaire);*/
						
						// Ajout ou Maj de la qté produit dans le stock
						$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockQuantiteActuel = $lStockQuantiteActuel[0];
							
						$lStockQuantite = new StockQuantiteVO();
						if(!is_null($lStockQuantiteActuel->getId())) {
							$lStockQuantite->setId($lStockQuantiteActuel->getId());
							$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
						}
						$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() + $lProduit["quantiteSolidaire"] - $lBon->getStoQuantite());
						$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
						$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockService->setStockQuantite($lStockQuantite);
					}
				}
				if(!$lMaj) {
					$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					
					$lStock = new StockVO();
					$lStock->setQuantite($lProduit["quantiteSolidaire"]);
					$lStock->setType(2);
					$lStock->setIdCompte($lIdCompteFerme);
					$lStock->setIdDetailCommande($lDcom[0]->getId());
					$lStock->setIdOperation($lIdOperation);
					$lStockService->set($lStock);

					// Ajout du produit dans le stock solidaire
				/*	$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockSolidaireActuel = $lStockSolidaireActuel[0];					
					$lStockSolidaire = new StockSolidaireVO();
					$lQuantite = $lProduit["quantiteSolidaire"];
					if(!is_null($lStockSolidaireActuel->getId())) {
						$lStockSolidaire->setId($lStockSolidaireActuel->getId());
						$lQuantite += $lStockSolidaireActuel->getQuantite();
					}					
					$lStockSolidaire->setQuantite($lQuantite);
					$lStockSolidaire->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
					$lStockSolidaire->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockService->setSolidaire($lStockSolidaire);*/
					
					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
						
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
					}
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() + $lProduit["quantiteSolidaire"]);
					$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
					$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
					
				}			
			}
			foreach($lStockSolidaire as $lBon) {
				$lDelete = true;
				foreach($lProduits as $lProduit) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lDelete = false;
					}
				}
				if($lDelete) {
					$lStockService->delete($lBon->getStoId());
					
					// Si le produit est dans le stck solidaire on le supprime
					/*$lStockSolidaireActuel = $lStockService->selectSolidaireByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockSolidaireActuel = $lStockSolidaireActuel[0];	
					if(!is_null($lStockSolidaireActuel->getId())) {
						$lStockSolidaire = new StockSolidaireVO();
						$lStockSolidaire->setId($lStockSolidaireActuel->getId());
						$lStockSolidaire->setQuantite($lStockSolidaireActuel->getQuantite() - $lProduit["quantiteSolidaire"] );
						$lStockSolidaire->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
						$lStockSolidaire->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
						$lStockService->setSolidaire($lStockSolidaire);
					}		*/	

					// Ajout ou Maj de la qté produit dans le stock
					$lStockQuantiteActuel = $lStockService->selectQuantiteByIdNomProduitUnite($lProduitMarche[$lProduit["id"]]->getIdNom(),$lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockQuantiteActuel = $lStockQuantiteActuel[0];
						
					$lStockQuantite = new StockQuantiteVO();
					if(!is_null($lStockQuantiteActuel->getId())) {
						$lStockQuantite->setId($lStockQuantiteActuel->getId());
						$lStockQuantite->setQuantite($lStockQuantiteActuel->getQuantite());
					}
					$lStockQuantite->setQuantiteSolidaire($lStockQuantiteActuel->getQuantiteSolidaire() - $lBon->getStoQuantite());
					$lStockQuantite->setIdNomProduit($lProduitMarche[$lProduit["id"]]->getIdNom());
					$lStockQuantite->setUnite($lProduitMarche[$lProduit["id"]]->getUnite());
					$lStockService->setStockQuantite($lStockQuantite);
				}
			}
		}
		return $lVr;
	}
	
	/**
	* @name getBComPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne le bon de livraison en pdf
	*/
	public function getBComPdf($pParam) {

		$lVr = ExportBonLivraisonValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			
			// Préparation du Tableau pour l'export PDF
			$lIdCommande = $pParam["id_commande"];
			$lOperationService = new OperationService();
			$lLignesBonLivraison = InfoBonLivraisonViewManager::selectByIdCommande($lIdCommande);
			$lLignesSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($lIdCommande);
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonLivraison as $lLigne) {
				if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					if($lLigne->getProIdCompteFerme() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						if($lIdPrdt != 0) {							
							$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdPrdt);
							$lOperation = $lOperations[0];
							
							$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
							if(!is_null($lOperation->getId())) {
								$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
							} else {
								$lOperation->setMontant("");
							}
							array_push($lContenuTableau,"","","","","Total : ",utf8_decode($lOperation->getMontant() ),SIGLE_MONETAIRE_PDF,"","");
							array_push($lContenuTableau,"","","","","","","","","");
						}
						$lNomPrdt = $lLigne->getFerNom();
					}

					$lQuantite = '';
					$lUniteQuantite = '';
					$lMontant = '';
					$lSigleMontant = '';
					
					if( $lLigne->getStoQuantite() == '' || $lLigne->getStoQuantite() == NULL) {
						$lQuantiteLivraison = '';
						$lUniteQuantiteLivraison = '';
					} else {
						$lQuantiteLivraison = $lLigne->getStoQuantite();
						$lUniteQuantiteLivraison = $lLigne->getProUniteMesure();
					}
				
					if( $lLigne->getDopeMontant() == '' || $lLigne->getDopeMontant() == NULL) {
						$lMontantLivraison = '';
						$lSigleMontantLivraison = '';
					} else {
						$lMontantLivraison = $lLigne->getDopeMontant();
						$lSigleMontantLivraison = SIGLE_MONETAIRE_PDF;
					}

					$lQuantiteSolidaire = '';
					$lUniteQuantiteSolidaire = '';
					
					foreach($lLignesSolidaire as $lLigneSolidaire) {
						if($lLigneSolidaire->getProId() == $lLigne->getProId())	{
							if( $lLigneSolidaire->getStoQuantite() == '' || $lLigneSolidaire->getStoQuantite() == NULL) {
								$lQuantiteSolidaire = '';
								$lUniteQuantiteSolidaire = '';
							} else {
								$lQuantiteSolidaire = $lLigneSolidaire->getStoQuantite();
								$lUniteQuantiteSolidaire = $lLigne->getProUniteMesure();
							}
						}						
					}
					
					array_push($lContenuTableau,	
											utf8_decode($lNomPrdt),
											utf8_decode($lLigne->getNproNumero()),
											utf8_decode($lLigne->getNproNom()),
											utf8_decode($lQuantiteLivraison),
											utf8_decode($lUniteQuantiteLivraison),
											utf8_decode($lMontantLivraison),
											$lSigleMontantLivraison,
											utf8_decode($lQuantiteSolidaire),
											utf8_decode($lUniteQuantiteSolidaire)
											);
											
					$lIdPrdt = $lLigne->getProIdCompteFerme();
				}
			}
			
			// Pour la dernière ligne			
			$lIdCompteFerme = $lLigne->getProIdCompteFerme();			
			$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdCompteFerme);
			$lOperation = $lOperations[0];		
			$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
			if(!is_null($lOperation->getId())) {
				$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
			} else {
				$lOperation->setMontant("");
			}
			
			array_push($lContenuTableau,"","","","","Total : ",utf8_decode($lOperation->getMontant()),SIGLE_MONETAIRE_PDF,"","");
								
			// Contenu du header du tableau.	
			$lContenuHeader = array(30, 30, 30, 20, 15, 20, 7, 20, 10, "Producteur","Ref.", "Produit", utf8_decode("Qté"),"","Prix","","Solidaire","");
			
			// Préparation du PDF
			$PDF=new phpToPDF();
			$PDF->AddPage();
			$PDF->SetFont('Arial','B',16);
			
			// Définition des propriétés du tableau.
			$lProprietesTableau = array(
				'TB_ALIGN' => 'L',
				'L_MARGIN' => 5,
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => '0.3',
				);
			
			// Définition des propriétés du header du tableau.	
			$lProprieteHeader = array(
				'T_COLOR' => array(255,255,255),
				'T_SIZE' => 12,
				'T_FONT' => 'Arial',
				'T_ALIGN' => 'C',
				'V_ALIGN' => 'T',
				'T_TYPE' => 'B',
				'LN_SIZE' => 7,
				'BG_COLOR_COL0' => array(58,129,4),
				'BG_COLOR' => array(58,129,4),
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => 0.2,
				'BRD_TYPE' => '1',
				'BRD_TYPE_NEW_PAGE' => '',
				);
			
			// Définition des propriétés du reste du contenu du tableau.	
			$lProprieteContenu = array(
				'T_COLOR' => array(0,0,0),
				'T_SIZE' => 10,
				'T_FONT' => 'Arial',
				'T_ALIGN_COL0' => 'L',
				'T_ALIGN' => 'R',
				'V_ALIGN' => 'M',
				'T_TYPE' => '',
				'LN_SIZE' => 6,
				'BG_COLOR_COL0' => array(220, 220, 220),
				'BG_COLOR' => array(255,255,255),
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => 0.2,
				'BRD_TYPE' => '1',
				'BRD_TYPE_NEW_PAGE' => '',
				);
			
			// Ajout du Tableau au PDF
			$PDF->drawTableau($PDF, $lProprietesTableau, $lProprieteHeader, $lContenuHeader, $lProprieteContenu, $lContenuTableau);
			
			// Export du PDF
			$PDF->Output('Bon de Livraison.pdf','D');
		} else {
			return $lVr;
		}
	}	
	
	/**
	* @name getBComCSV($pParam)
	* @return Un Fichier CSV
	* @desc Retourne le bon de livraison en format CSV
	*/
	public function getBComCSV($pParam) {
		$lVr = ExportBonLivraisonValid::validAjout($pParam);
		
		if($lVr->getValid()) {			
			$lCSV = new CSV();
			$lCSV->setNom('Bon_de_Livraison.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Ferme","Ref.", "Produit","Commande","","Prix","","Livraison","","Prix","","Solidaire","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lIdCommande = $pParam["id_commande"];
			$lOperationService = new OperationService();
			$lLignesBonLivraison = InfoBonLivraisonViewManager::selectByIdCommande($lIdCommande);
			$lLignesSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($lIdCommande);
			$lLignesBonCommande = InfoBonCommandeViewManager::selectByIdCommande($lIdCommande);
			
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonLivraison as $lLigne) {
				if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					if($lLigne->getProIdCompteFerme() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						if($lIdPrdt != 0) {
							/*$lIdCompteFerme = $lLigne->getProIdCompteFerme();			
							$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdCompteFerme);
							$lOperation = $lOperations[0];
							$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
							if(!is_null($lOperation->getId())) {
								$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
							} else {
								$lOperation->setMontant("");
							}*/					
							$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdPrdt);
							$lOperation = $lOperations[0];
							$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
							
							if(!is_null($lOperation->getId())) {
							/*	$lIds = explode(";",$lOperation->getTypePaiementChampComplementaire());
								$lOperation = $lOperationService->get($lIds[0]);*/
								
								$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
							} else {
								$lOperation->setMontant("");
							}
							
							
							$lLignecontenu = array("","","","","","","","","Total : ",$lOperation->getMontant(),SIGLE_MONETAIRE,"","");
							array_push($lContenuTableau,$lLignecontenu);
							$lLignecontenu = array("","","","","","","","","","","","","");
							array_push($lContenuTableau,$lLignecontenu);
						}
						$lNomPrdt = $lLigne->getFerNom();
					}

					$lQuantite = '';
					$lUniteQuantite = '';
					$lMontant = '';
					$lSigleMontant = '';
					
					foreach($lLignesBonCommande as $lLigneBonCommande) {
						if($lLigneBonCommande->getProId() == $lLigne->getProId())	{
							if( $lLigneBonCommande->getStoQuantite() == '' || $lLigneBonCommande->getStoQuantite() == NULL) {
								$lQuantite = '';
								$lUniteQuantite = '';
							} else {
								$lQuantite = $lLigneBonCommande->getStoQuantite();
								$lUniteQuantite = $lLigne->getProUniteMesure();
							}
							
							if( $lLigneBonCommande->getDopeMontant() == '' || $lLigneBonCommande->getDopeMontant() == NULL) {
								$lMontant = '';
								$lSigleMontant = '';
							} else {
								$lMontant = $lLigneBonCommande->getDopeMontant();
								$lSigleMontant = SIGLE_MONETAIRE;
							}
						}
					}
					
					if( $lLigne->getStoQuantite() == '' || $lLigne->getStoQuantite() == NULL) {
						$lQuantiteLivraison = '';
						$lUniteQuantiteLivraison = '';
					} else {
						$lQuantiteLivraison = $lLigne->getStoQuantite();
						$lUniteQuantiteLivraison = $lLigne->getProUniteMesure();
					}
					
					if( $lLigne->getDopeMontant() == '' || $lLigne->getDopeMontant() == NULL) {
						$lMontantLivraison = '';
						$lSigleMontantLivraison = '';
					} else {
						$lMontantLivraison = $lLigne->getDopeMontant();
						$lSigleMontantLivraison = SIGLE_MONETAIRE;
					}
										
					$lQuantiteSolidaire = '';
					$lUniteQuantiteSolidaire = '';
					
					foreach($lLignesSolidaire as $lLigneSolidaire) {
						if($lLigneSolidaire->getProId() == $lLigne->getProId())	{							
							if( $lLigneSolidaire->getStoQuantite() == '' || $lLigneSolidaire->getStoQuantite() == NULL) {
								$lQuantiteSolidaire = '';
								$lUniteQuantiteSolidaire = '';
							} else {
								$lQuantiteSolidaire = $lLigneSolidaire->getStoQuantite();
								$lUniteQuantiteSolidaire = $lLigne->getProUniteMesure();
							}
						}
					}

					$lLignecontenu = array(	$lNomPrdt,
											$lLigne->getNproNumero(),
											$lLigne->getNproNom(),
											$lQuantite,
											$lUniteQuantite,
											$lMontant,
											$lSigleMontant,
											$lQuantiteLivraison,
											$lUniteQuantiteLivraison,
											$lMontantLivraison,
											$lSigleMontantLivraison,
											$lQuantiteSolidaire,
											$lUniteQuantiteSolidaire
											);
					
					array_push($lContenuTableau,$lLignecontenu);
					$lIdPrdt = $lLigne->getProIdCompteFerme();
				}
			}

			$lIdCompteFerme = $lLigne->getProIdCompteFerme();			
			$lOperations = $lOperationService->getBonLivraison($lIdCommande,$lIdCompteFerme);
			$lOperation = $lOperations[0];
			$lInfoOperationLivraison = InfoOperationLivraisonManager::select($lOperation->getTypePaiementChampComplementaire());
			if(!is_null($lOperation->getId())) {
				$lOperation = $lOperationService->get($lInfoOperationLivraison->getIdOpeProducteur());
			} else {
				$lOperation->setMontant("");
			}
			
			
			$lLignecontenu = array("","","","","","","","","Total : ",$lOperation->getMontant(),SIGLE_MONETAIRE,"","");
			array_push($lContenuTableau,$lLignecontenu);
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}	
	}
}
?>