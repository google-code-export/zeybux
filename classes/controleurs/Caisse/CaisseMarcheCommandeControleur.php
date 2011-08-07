<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 20/06/2011
// Fichier : CaisseMarcheCommandeControleur.php
//
// Description : Classe CaisseMarcheCommandeControleur
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentCommandeReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AchatCommandeValid.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );*/
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionCommandeListeReservationViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/ListeAdherentCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/MarcheValid.php");

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_CAISSE . "/InfoAchatCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VO . "AchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name CaisseMarcheCommandeControleur
 * @author Julien PIERRE
 * @since 20/06/2011
 * @desc Classe controleur d'une CaisseMarcheCommande
 */
class CaisseMarcheCommandeControleur
{
	/**
	* @name getListeAdherentCommande($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur cette commande.
	*/
	/*public function getListeAdherentCommande($pIdCommande) {
		if(is_int((int)$pIdCommande)) {
			$lListeAdherent = new ListeAdherentCommandeResponse();
			$lListe = ListeAdherentCommandeReservationViewManager::select($pIdCommande);
			if(count($lListe) > 0) {
				$lListeAdherent->setListeAdherentCommande($lListe);
				return $lListeAdherent;
			} else {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_212_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_212_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			}	
		} else {
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
			return $lVr;
		}	
	}*/
	
	/**
	* @name getListeAdherentMarche($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur ce Marche.
	*/
	public function getMarcheListeReservation($pParam) {		
		$lVr = MarcheValid::validGetMarcheListeReservation($pParam);
		if($lVr->getValid()) {
			$lResponse = new ListeAdherentCommandeResponse();
			$lListe = AdherentViewManager::selectAll();
			$lResponse->setListeAdherentCommande($lListe);
			
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->getInfoMarche($pParam['id_commande']);
			$lResponse->setNumeroMarche($lMarche->getNumero());
			
			return $lResponse;		
		}				
		return $lVr;
	}
	
	/**
	* @name getInfoAchatCommande($pIdCommande,$pIdAdherent)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	/*public function getInfoAchatCommande($pIdCommande,$pIdAdherent) {
		$lVr = new TemplateVR();
		
		if(!is_int((int)$pIdCommande) || !is_int((int)$pIdAdherent)) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(empty($pIdCommande) || empty($pIdAdherent)) {			
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}		
		if(!$lVr->getvalid()) {return $lVr;}
		
		$lResponse = new InfoAchatCommandeResponse();
		
		$lAdherent = AdherentViewManager::select($pIdAdherent);
		if($lAdherent->getAdhId() == $pIdAdherent) {
			$lReservation = ReservationViewManager::selectAchat($pIdCommande,$lAdherent->getAdhIdCompte());
			$lCommande = CommandeCompleteEnCoursViewManager::select($pIdCommande);
			$lStock = StockProduitViewManager::selectByIdCommande($pIdCommande);
			$lStockSolidaire = StockSolidaireViewManager::select($pIdCommande);
			
			$lTypePaiement = TypePaiementVisibleViewManager::selectAll();

			$lResponse->setCommande($lCommande);
			$lResponse->setStock($lStock);
			$lResponse->setStockSolidaire($lStockSolidaire);
			$lResponse->setAdherent($lAdherent);
			$lResponse->setReservation($lReservation);
			$lResponse->setTypePaiement($lTypePaiement);
			
			return $lResponse;
		} else {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getLog()->addErreur($lErreur);
			return $lVr;
		}
	}*/
	
	/**
	* @name getInfoAchatMarche($pParam)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoAchatMarche($pParam) {
		$lVr = MarcheValid::validGetInfoAchatMarche($pParam);
		if($lVr->getValid()) {		
			$lAdherent = AdherentViewManager::select($pParam["id_adherent"]);
			
			$lResponse = new InfoAchatCommandeResponse();
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
			
			$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lResponse->setReservation($lReservationService->get($lIdReservation)->getDetailReservation());
			
			//	$lStock = StockProduitViewManager::selectByIdCommande($pIdCommande);
			//	$lResponse->setStock($lStock);
			
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lResponse->setStockSolidaire($lStockSolidaire);	
			$lResponse->setTypePaiement(TypePaiementVisibleViewManager::selectAll());
			
			$lResponse->setAdherent($lAdherent);				
			return $lResponse;
		}				
		return $lVr;
	}
	
	/**
	* @name enregistrerAchat($pAchat)
	* @return VR
	* @desc Enregistre la commande d'un adhérent
	*/
	/*public function enregistrerAchat($pAchat) {		
		$lVr = AchatCommandeValid::validAjout($pAchat);
		if($lVr->getValid()) {
			$lIdCommande = $pAchat['id'];
			$lIdCompte = $pAchat['idCompte'];
					
			$lReservations = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
			/* Tri des infos sur la commande
			 * Ajout/Modification/Suppression de ligne de stock en fonction des achats
			 */
			/*if(is_array($lReservations) && is_array($pAchat['produits']) && is_array($pAchat['produitsSolidaire'])) {
				//$lTotal = 0;
				$lProduitMaj = array();
				$lProduitSupprime = array();
				$lProduitAjout = array();
				
				$lCommande = CommandeManager::select($lIdCommande);
				foreach($lReservations as $lReservation) {
					$lMaj = true;
			//		echo "Resa Pro ID : " .$lReservation->getProId(). "\n";
					foreach($pAchat['produits'] as $lProduit) {
						if($lProduit['id'] == $lReservation->getProId() && !empty($lProduit['quantite'])) {							
							//$lTotal += $lProduit['prix'];	
							$lOperation = new OperationVO();
							$lOperation->setIdCompte($lIdCompte);
							$lOperation->setMontant($lProduit['prix'] * -1);
							$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
							$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lOperation->setTypePaiement(7);
							$lOperation->setTypePaiementChampComplementaire($lProduit['id']);
							$lOperation->setType(1);
							$lOperation->setIdCommande($lIdCommande);				
							OperationManager::insert($lOperation);							
							
							$lStock = new StockVO();
							$lStock->setId($lReservation->getStoId());
							$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lStock->setQuantite($lProduit['quantite'] * -1);
							$lStock->setType(1);
							$lStock->setIdCompte($lIdCompte);
							$lStock->setIdDetailCommande($lReservation->getDcomId());						
							array_push($lProduitMaj,$lStock);
							$lMaj = false;
						}
			//			echo "Achat Pro ID : " .$lProduit['id'] . " // Quantite : " . $lProduit['quantite'] . " // Maj : " . $lMaj . "\n";
					}
					if($lMaj) {
						array_push($lProduitSupprime,$lReservation->getStoId());					
					}
				}
			//	echo "\n\n";
				foreach($pAchat['produits'] as $lProduit) {
					$lAjout = true;
					foreach($lReservations as $lReservation) {
			//			echo "Achat Pro ID : " .$lProduit['id'] . " // Quantite : " . $lProduit['quantite'] . "\n";
						if($lProduit['id'] == $lReservation->getProId()) {
							$lAjout = false;
						}				
			//			echo "Resa Pro ID : " .$lReservation->getProId(). " // Ajout : ".$lAjout."\n";		
					}
					if($lAjout && !empty($lProduit['quantite'])) {
						//$lTotal += $lProduit['prix'];
						$lOperation = new OperationVO();
						$lOperation->setIdCompte($lIdCompte);
						$lOperation->setMontant($lProduit['prix'] * -1);
						$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setTypePaiement(7);
						$lOperation->setTypePaiementChampComplementaire($lProduit['id']);
						$lOperation->setType(1);
						$lOperation->setIdCommande($lIdCommande);				
						OperationManager::insert($lOperation);

						$lDcom = DetailCommandeManager::selectByIdProduit($lProduit['id']);
						$lStock = new StockVO();
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit['quantite'] * -1);
						$lStock->setType(1);
						$lStock->setIdCompte($lIdCompte);
						$lStock->setIdDetailCommande($lDcom[0]->getId());
						array_push($lProduitAjout,$lStock);
					}
				}
				
				$lOperations = OperationManager::selectOpeReservation($lIdCompte,$lIdCommande);
				if(count($lOperations) == 1) { 
					// Si il existe une operation de reservation on la met à jour				
					if(isset($lOperations[0]) && $lOperations[0]->getId() != '') {						
						$lOperation = $lOperations[0];
				/*		$lOperation->setMontant($lTotal * -1);
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setType(1);
						OperationManager::update($lOperation);*/
					/*	OperationManager::delete($lOperation->getId());
					} /*else {						
						$lCommande = CommandeManager::select($lIdCommande);
						$lOperation = new OperationVO();
						$lOperation->setIdCompte($lIdCompte);
						$lOperation->setMontant($lTotal * -1);
						$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setTypePaiement(0);
						$lOperation->setType(1);
						$lOperation->setIdCommande($lIdCommande);				
						OperationManager::insert($lOperation);
					}*/
					
					// Les achats solidaire
			/*		foreach($pAchat['produitsSolidaire'] as $lProduitSolidaire) {
						if( !empty($lProduitSolidaire['quantite'])	) {			
							$lOperation = new OperationVO();
							$lOperation->setIdCompte($lIdCompte);
							$lOperation->setMontant($lProduitSolidaire['prix'] * -1);
							$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
							$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lOperation->setTypePaiement(8);
							$lOperation->setTypePaiementChampComplementaire($lProduitSolidaire['id']);
							$lOperation->setType(1);
							$lOperation->setIdCommande($lIdCommande);				
							OperationManager::insert($lOperation);
	
							$lDcom = DetailCommandeManager::selectByIdProduit($lProduitSolidaire['id']);
							$lStock = new StockVO();
							$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lStock->setQuantite($lProduitSolidaire['quantite'] * -1);
							$lStock->setType(5);
							$lStock->setIdCompte($lIdCompte);
							$lStock->setIdDetailCommande($lDcom[0]->getId());
							array_push($lProduitAjout,$lStock);
						}
					}
					
					//Maj des stocks
					foreach($lProduitMaj as $lPdt) {
						StockManager::update($lPdt);
					}
					
					//Suppression des stocks
					foreach($lProduitSupprime as $lPdt) {
						StockManager::delete($lPdt);
					}
					
					//Ajout des stocks
					foreach($lProduitAjout as $lPdt) {
						StockManager::insert($lPdt);
					}		

					// Maj de la commande dans groupe commande
					$lGpc = GroupeCommandeManager::selectAchat($lIdCommande,$lIdCompte);
					$lGpc = $lGpc[0];
					$lGpc->setEtat(1);
					GroupeCommandeManager::update($lGpc);
				
					// Si il y a aussi un rechargement on l'exécute
					$lRechargement = $pAchat['rechargement'];
					if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
						$lOperation = new OperationVO();
						$lOperation->setIdCompte($lIdCompte);
						$lOperation->setMontant($lRechargement['montant']);
						$lOperation->setLibelle("Rechargement");
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setTypePaiement($lRechargement['typePaiement']);		
						$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
						$lOperation->setType(1);
						$lOperation->setIdCommande(0);
						OperationManager::insert($lOperation);
					}				
				} else {
					$lVr = new TemplateVR();
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_114_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_114_MSG);
					$lVr->getLog()->addErreur($lErreur);	
					return $lVr;
				}				
			} else {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_111_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_111_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			}			
		}				
		return $lVr;
	}*/
	
	/**
	* @name enregistrerAchat($pParam)
	* @return VR
	* @desc Enregistre la commande d'un adhérent
	*/
	public function enregistrerAchat($pParam) {	

		$lVr = MarcheValid::validAjout($pParam);
		if($lVr->getValid()) {			
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pParam['idCompte']);
			$lIdReservation->setIdCommande($pParam['id']);
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);

			$lAchat = new AchatVO();
			$lAchat->getId()->setIdCompte($pParam["idCompte"]);
			$lAchat->getId()->setIdCommande($pParam["id"]);
			if($lOperations[0]->getTypePaiement() == 0) {
				$lAchat->getId()->setIdReservation($lOperations[0]->getId());
			}
			
			foreach($pParam["produits"] as $lDetail){
				$lDetailAchat = new DetailReservationVO();	
				$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
				$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
				
				$lAchat->addDetailAchat($lDetailAchat);
			}
			
			foreach($pParam["produitsSolidaire"] as $lDetail){
				$lDetailAchat = new DetailReservationVO();
				$lDcom = DetailCommandeManager::selectByIdProduit($lDetail["id"]);		
				$lDetailAchat->setIdDetailCommande($lDcom[0]->getId());
				$lDetailAchat->setQuantite($lDetail["quantite"]);
				$lDetailAchat->setMontant($lDetail["prix"]);
				
				$lAchat->addDetailAchatSolidaire($lDetailAchat);
			}
						
			$lAchatService = new AchatService();
			$lIdOperation = $lAchatService->set($lAchat); // Achat des produits
			
			// Si il y a aussi un rechargement du compte
			$lRechargement = $pParam['rechargement'];
			if(!empty($lRechargement['montant']) && $lRechargement['montant'] != 0) {
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($pParam['idCompte']);
				$lOperation->setMontant($lRechargement['montant']);
				$lOperation->setLibelle("Rechargement");
				$lOperation->setTypePaiement($lRechargement['typePaiement']);		
				$lOperation->setTypePaiementChampComplementaire($lRechargement['champComplementaire']);
				$lOperation->setIdCommande(0);
				
				$lOperationService = new OperationService();
				$lOperationService->set($lOperation);
			}
		}				
		return $lVr;
	}
}
?>
