<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2013
// Fichier : EditerAchatControleur.php
//
// Description : Classe EditerAchatControleur
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/MarcheValid.php");

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

//include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_TOVO . "AchatToVO.php");*/


include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/AchatValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_SERVICE . "BanqueService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VO . "DetailMarcheVO.php");
include_once(CHEMIN_CLASSES_TOVO . "AchatToVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AchatConfirmResponse.php" );

/**
 * @name EditerAchatControleur
 * @author Julien PIERRE
 * @since 08/09/2013
 * @desc Classe controleur d'une EditerAchat
 */
class EditerAchatControleur
{	
	/**
	* @name getInfoAchatMarche($pParam)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoAchatMarche($pParam) {
		$lVr = AchatValid::validInfoAchatMarche($pParam);
		if($lVr->getValid()) {		
			$lResponse = new InfoAchatCommandeResponse();

			$lProduitsAchat = array();
			

			$lIdMarche = 0;
			$lIdCompte = 0;
			if(!empty($pParam["id_commande"])) {
				$lIdMarche = $pParam["id_commande"];
			}
			if(!empty($pParam["id"])) {
				$lAchatService = new AchatService();
				$lAchat = $lAchatService->get($pParam["id"]);
				$lProduitsAchat = $lAchat->getProduits();
				$lResponse->setAchats($lAchat); // L'achat
				
				
				if(!is_null($lAchat->getOperationAchat())) {
					$lIdCompte = $lAchat->getOperationAchat()->getIdCompte();
					$lChcp = $lAchat->getOperationAchat()->getChampComplementaire();
					if(isset($lChcp[1])) {
						$lIdMarche = $lChcp[1]->getValeur();
					}
				}
				if(!is_null($lAchat->getOperationAchatSolidaire())) {
					$lIdCompte = $lAchat->getOperationAchatSolidaire()->getIdCompte();
					$lChcp = $lAchat->getOperationAchatSolidaire()->getChampComplementaire();
					if(isset($lChcp[1])) {
						$lIdMarche = $lChcp[1]->getValeur();
					}
				}
			}
			if($pParam["id_adherent"] > 0) { // Si c'est un compte adhérent
				$lIdCompte = $lVr->getData()['adherent']->getAdhIdCompte();
				$lResponse->setAdherent($lVr->getData()['adherent']);
			}
			

			$lStockService = new StockService();
			$lStockProduitsDisponible = $lStockService->getProduitsDisponible();
			
			$lStock = array();	
			$lProduitsMarche = array();		
			if($lIdMarche != 0) { // Si ce n'est pas la caisse permanente
				$lMarcheService = new MarcheService();
				$lMarche = $lMarcheService->get($lIdMarche);
				$lProduitsMarche = $lMarche->getProduits();
				$lResponse->setMarche($lMarche); // Les informations du marché 
			}	

			// Fusion des stocks
			$lLotsProduits = array();
			foreach($lStockProduitsDisponible as $lProduitStock) {
				$lAjout = true;
				foreach($lProduitsMarche as $lProduitMarche) {
					if($lProduitStock->getIdNom() == $lProduitMarche->getIdNom() && $lProduitStock->getUnite() == $lProduitMarche->getUnite()) {
						$lAjout = false;
					}						
				}
				if($lAjout) {
					if(!isset($lStock[$lProduitStock->getCproNom()])) {
						$lStock[$lProduitStock->getCproNom()] = array("cproId" => $lProduitStock->getIdCategorie(), "cproNom" => $lProduitStock->getCproNom(), "produits" => array());
					}
					$lUnite = !is_null($lProduitStock->getUnite()) ? $lProduitStock->getUnite() : $lProduitStock->getUniteSolidaire();
					$lStock[$lProduitStock->getCproNom()]["produits"][$lProduitStock->getNom().$lProduitStock->getUnite()] = new ProduitDetailAchatAfficheVO(
							$lProduitStock->getIdNom(), 
							null, null, null, null, null, null, null, null, null, 
							$lUnite, 
							null, 
							$lUnite, 
							null, null, 
							$lProduitStock->getIdCategorie(), 
							$lProduitStock->getCproNom(), 
							null, 
							$lProduitStock->getNom());
					
					$lLotsProduits[$lProduitStock->getIdNom().$lProduitStock->getUnite()] = array("nom" => $lProduitStock->getNom(), "type" => "modele", "lots" => $lProduitStock->getLots());
				}
			}
			foreach($lProduitsMarche as $lProduitMarche) {
				if(!isset($lStock[$lProduitMarche->getCproNom()])) {
					$lStock[$lProduitMarche->getCproNom()] = array("cproId" => $lProduitMarche->getCproId(), "cproNom" => $lProduitMarche->getCproNom(), "produits" => array());
				}			
				$lUnite = !is_null($lProduitMarche->getUnite()) ? $lProduitMarche->getUnite() : $lProduitMarche->getUniteSolidaire();
				$lStock[$lProduitMarche->getCproNom()]["produits"][$lProduitMarche->getNom().$lProduitMarche->getUnite()] = new ProduitDetailAchatAfficheVO(
							$lProduitMarche->getIdNom(), 
							null, null, null, null, null, null, null, null, null, 
							$lUnite, 
							null, 
							$lUnite, 
							null, null, 
							$lProduitMarche->getIdCategorie(), 
							$lProduitMarche->getCproNom(), 
							null, 
							$lProduitMarche->getNom());
				
				$lLotsProduits[$lProduitMarche->getIdNom().$lProduitMarche->getUnite()] = array("nom" => $lProduitMarche->getNom(), "type" => "marche", "lots" => $lProduitMarche->getLots());
			}

			foreach($lProduitsAchat as $lProduitAchat) {
				$lUnite = !is_null($lProduitAchat->getUnite()) ? $lProduitAchat->getUnite() : $lProduitAchat->getUniteSolidaire();
				if(!is_null($lUnite)) {
					if(isset($lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite])) {
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdStock($lProduitAchat->getIdStock());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdStockSolidaire($lProduitAchat->getIdStockSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailCommande($lProduitAchat->getIdDetailCommande());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdModeleLot($lProduitAchat->getIdModeleLot());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailCommandeSolidaire($lProduitAchat->getIdDetailCommandeSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdModeleLotSolidaire($lProduitAchat->getIdModeleLotSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setQuantite($lProduitAchat->getQuantite());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setQuantiteSolidaire($lProduitAchat->getQuantiteSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setMontant($lProduitAchat->getMontant());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setMontantSolidaire($lProduitAchat->getMontantSolidaire());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailOperation($lProduitAchat->getIdDetailOperation());
						$lStock[$lProduitAchat->getCproNom()][$lProduitAchat->getNproNom()][$lUnite]->setIdDetailOperationSolidaire($lProduitAchat->getIdDetailOperationSolidaire());
					} else {
						if(!isset($lStock[$lProduitAchat->getCproNom()])) {
							$lStock[$lProduitAchat->getCproNom()] = array("cproId" => $lProduitAchat->getCproId(), "cproNom" => $lProduitAchat->getCproNom(), "produits" => array());
						}
						$lProduitAchat->setUnite($lUnite);
						$lProduitAchat->setUniteSolidaire($lUnite);
						$lStock[$lProduitAchat->getCproNom()]["produits"][$lProduitAchat->getNproNom().$lUnite] = $lProduitAchat;
						
						// Ajout des lots
						$lModelesLot = ModeleLotViewManager::selectByIdNomProduit($lProduitAchat->getIdNomProduit());
						$lLots = array();
						foreach($lModelesLot as $lModeleLot) {
							$lLot = new DetailMarcheVO();
							$lLot->setId($lModeleLot->getMLotId());
							$lLot->setTaille($lModeleLot->getMLotQuantite());
							$lLot->setPrix($lModeleLot->getMLotPrix());
							$lLots[$lModeleLot->getMLotId()] = $lLot;
						}
						$lLotsProduits[$lProduitAchat->getIdNomProduit().$lUnite] = array("nom" => $lProduitAchat->getNproNom(), "type" => "modele", "lots" => $lLots);
					}
				}
			}

			$lResponse->setStock($lStock);	// Stock de produit disponible
			$lResponse->setLots($lLotsProduits);	// Lots des produits
			
			$lBanqueService = new BanqueService();
			$lTypePaiementService = new TypePaiementService();	
					
			$lResponse->setTypePaiement($lTypePaiementService->selectVisible()); // Type de paiment
			$lResponse->setBanques($lBanqueService->getAllActif()); // Liste des banques
			$lResponse->setIdRequete(uniqid());
			
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerAchat($pParam)
	* @return AchatVR
	* @desc Enregistre l'achat d'un adhérent
	*/
	public function enregistrerAchat($pParam) {
		$lVr = AchatValid::validEnregistrer($pParam);
		if($lVr->getValid()) {
			$lAchatService = new AchatService();
			$lIdAchat = $lAchatService->set(AchatToVO::convertFromArray($pParam));
			return new AchatConfirmResponse($lIdAchat);
		}				
		return $lVr;
	}
}
?>