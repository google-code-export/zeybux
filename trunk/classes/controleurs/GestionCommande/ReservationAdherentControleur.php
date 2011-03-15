<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : ReservationAdherentControleur.php
//
// Description : Classe ReservationAdherentControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "ReservationAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");

include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ListeReservationCommandeValid.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "SupprimerReservationAdherentValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "AfficheReservationAdherentValid.php");


/**
 * @name ReservationAdherentControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une ReservationAdherent
 */
class ReservationAdherentControleur
{
	/**
	* @name getReservation($pParam)
	* @return ReservationAdherentResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$lVr = AfficheReservationAdherentValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam["id_adherent"];
			$lIdCommande = $pParam["id_commande"];		
					
		/*	$lVr = new TemplateVR();
			
			if(!is_int((int)$lIdCommande) || !is_int((int)$lIdAdherent)) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(empty($lIdCommande) || empty($lIdAdherent)) {			
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}		
			if(!$lVr->getvalid()) {return $lVr;}*/
			
			$lResponse = new ReservationAdherentResponse();
			
			$lAdherent = AdherentViewManager::select($lIdAdherent);
			/*if($lAdherent->getAdhId() == $lIdAdherent) {*/
				$lReservation = ReservationViewManager::selectAchat($lIdCommande,$lAdherent->getAdhIdCompte());
				$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);
				$lStock = StockProduitViewManager::selectByIdCommande($lIdCommande);
	
				$lResponse->setAdherent($lAdherent);
				$lResponse->setCommande($lCommande);
				$lResponse->setStock($lStock);
				$lResponse->setReservation($lReservation);
				
				return $lResponse;
			/*} else {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
				return $lVr;
			}*/
		}
		return $lVr;
	}
	
	/**
	* @name modifierReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function modifierReservation($pParam) {
		// TODO faire les tests correctements
		$lVr = ListeReservationCommandeValid::validAjout($pParam["reservation"]);
		if($lVr->getValid()) {
			$lDcom = DetailCommandeManager::select($pParam["reservation"]["commandes"][0]['stoIdDetailCommande']);
			$lPdt = ProduitManager::select($lDcom->getIdProduit());
			$lIdCommande = $lPdt->getIdcommande();
			$lIdCompte = $pParam["id_compte"];
			
			$lReservations = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
			
			/* Tri des infos sur la commande
			 * Ajout/Modification/Suppression de ligne de stock en fonction des achats
			 */
			if(is_array($lReservations)) {
				$lTotal = 0;
				$lProduitMaj = array();
				$lProduitSupprime = array();
				$lProduitAjout = array();
			
				foreach($lReservations as $lReservation) {
					$lMaj = true;
					foreach($pParam["reservation"]["commandes"] as $lProduit) {
						if($lProduit['stoIdDetailCommande'] == $lReservation->getDcomId() && !empty($lProduit['stoQuantite'])) {	

							$lLot = DetailCommandeManager::select($lProduit['stoIdDetailCommande']);
							$lTotal += ($lProduit['stoQuantite'] / $lLot->getTaille()) * $lLot->getPrix();
							$lStock = new StockVO();
							$lStock->setId($lReservation->getStoId());
							$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lStock->setQuantite($lProduit['stoQuantite']);
							$lStock->setType(0);
							$lStock->setIdCompte($lIdCompte);
							$lStock->setIdDetailCommande($lProduit['stoIdDetailCommande']);						
							array_push($lProduitMaj,$lStock);
							$lMaj = false;
						}
					}
					if($lMaj) {
						array_push($lProduitSupprime,$lReservation->getStoId());					
					}
				}
				foreach($pParam["reservation"]["commandes"] as $lProduit) {
					$lAjout = true;
					foreach($lReservations as $lReservation) {
						if($lProduit['stoIdDetailCommande'] == $lReservation->getDcomId()) {
							$lAjout = false;
						}						
					}
					if($lAjout) {
						$lLot = DetailCommandeManager::select($lProduit['stoIdDetailCommande']);
						$lTotal += ($lProduit['stoQuantite'] / $lLot->getTaille()) * $lLot->getPrix();
						$lStock = new StockVO();
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit['stoQuantite']);
						$lStock->setType(0);
						$lStock->setIdCompte($lIdCompte);
						$lStock->setIdDetailCommande($lProduit['stoIdDetailCommande']);
						array_push($lProduitAjout,$lStock);
					}
				}
				
				$lOperations = OperationManager::selectOpeReservation($lIdCompte,$lIdCommande);
				if(count($lOperations) == 1) { 
					// Si il existe une operation de reservation on la met à jour				
					if(isset($lOperations[0]) && $lOperations[0]->getId() != '') {	 					
						$lOperation = $lOperations[0];
						$lOperation->setMontant($lTotal);
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setType(0);
						OperationManager::update($lOperation);
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
	
	/**
	* @name supprimerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function supprimerReservation($pParam) {
		
		$lVr = SupprimerReservationAdherentValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdCommande = $pParam['id_commande'];
			$lAdherent = AdherentViewManager::select($pParam['id_adherent']);
			$lIdCompte = $lAdherent->getAdhIdCompte();
			
			// Suppression des stocks
			$lReservations = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
			foreach($lReservations as $lPdt) {
				StockManager::delete($lPdt->getStoId());
			}
			
			// Suppression des operations
			$lOperations = OperationManager::selectOpeReservation($lIdCompte,$lIdCommande);
			foreach($lOperations as $lOpe) {
				OperationManager::delete($lOpe->getId());
			}
			
			// Suppression du groupe commande
			$lGpc = GroupeCommandeManager::selectAchat($lIdCommande, $lIdCompte);
			foreach($lGpc as $lGroupe) {
				GroupeCommandeManager::delete($lGroupe->getId());
			}
		}
		return $lVr;
	}
}
?>