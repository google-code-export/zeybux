<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : MarcheCommandeControleur.php
//
// Description : Classe MarcheCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentCommandeReservationViewManager.php");
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
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

/**
 * @name MarcheCommandeControleur
 * @author Julien PIERRE
 * @since 12/09/2010
 * @desc Classe controleur d'une MarcheCommande
 */
class MarcheCommandeControleur
{
	/**
	* @name getListeAdherentCommande($pIdCommande)
	* @return ListeAdherentCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur cette commande.
	*/
	public function getListeAdherentCommande($pIdCommande) {
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
	}
	
	/**
	* @name getInfoAchatCommande($pIdCommande,$pIdAdherent)
	* @return InfoAchatCommandeResponse
	* @desc Retourne les infos de réservation d'un adhérent
	*/
	public function getInfoAchatCommande($pIdCommande,$pIdAdherent) {
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
	}
	
	/**
	* @name enregistrerAchat($pAchat)
	* @return VR
	* @desc Enregistre la commande d'un adhérent
	*/
	public function enregistrerAchat($pAchat) {		
		$lVr = AchatCommandeValid::validAjout($pAchat);
		if($lVr->getValid()) {
			$lIdCommande = $pAchat['id'];
			$lIdCompte = $pAchat['idCompte'];
					
			$lReservations = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
			/* Tri des infos sur la commande
			 * Ajout/Modification/Suppression de ligne de stock en fonction des achats
			 */
			if(is_array($lReservations) && is_array($pAchat['produits']) && is_array($pAchat['produitsSolidaire'])) {
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
						OperationManager::delete($lOperation->getId());
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
					foreach($pAchat['produitsSolidaire'] as $lProduitSolidaire) {
						if( !empty($lProduitSolidaire['quantite'])	) {			
							$lOperation = new OperationVO();
							$lOperation->setIdCompte($lIdCompte);
							$lOperation->setMontant($lProduitSolidaire['prix'] * -1);
							$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
							$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lOperation->setTypePaiement(7);
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
	}
}
?>
