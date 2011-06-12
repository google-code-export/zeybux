<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : ReservationCommandeControleur.php
//
// Description : Classe ReservationCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AfficherReservationCommandeResponse.php" );

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");


include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ListeReservationCommandeValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");

/**
 * @name ReservationCommandeControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une ReservationCommande
 */
class ReservationCommandeControleur
{
	
	/**
	* @name getReservation($pParam)
	* @return AfficherReservationResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$lIdCompte = $pParam["id_compte"];
		$lIdCommande = $pParam["id_commande"];
		$lIdAdherent = $pParam["id_adherent"];		
				
		$lVr = new TemplateVR();
		
		if(!is_int((int)$lIdCommande)) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(empty($lIdCommande)) {			
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}		
		if(!$lVr->getvalid()) {return $lVr;}
		
		$lResponse = new AfficherReservationCommandeResponse();
		$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);
		if($lCommande[0]->getComId() == $lIdCommande) {
			if(TestFonction::dateTimeEstPLusGrandeEgale($lCommande[0]->getComDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {
				$lReservation = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
				if($lReservation[0]->getComId() == NULL) {					
					$lAdherent = AdherentViewManager::select($lIdAdherent);
					$lStock = StockProduitViewManager::selectByIdCommande($lIdCommande);
							
					$lResponse->setCommande($lCommande);
					$lResponse->setStock($lStock);
					$lResponse->setAdherent($lAdherent);
					
					return $lResponse;
				} else {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_220_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_220_MSG);
					$lVr->getLog()->addErreur($lErreur);
					return $lVr;
				}
			} else {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
				$lVr->getLog()->addErreur($lErreur);
				return $lVr;
			}
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
	* @name enregistrerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function enregistrerReservation($pParam) {		
		$lVr = ListeReservationCommandeValid::validAjout($pParam["reservation"]);
		
		if($lVr->getValid()) {
			$lDcom = DetailCommandeManager::select($pParam["reservation"]["commandes"][0]['stoIdDetailCommande']);
			$lPdt = ProduitManager::select($lDcom->getIdProduit());
			$lIdCommande = $lPdt->getIdcommande();
			$lIdCompte = $pParam["id_compte"];
						
			/* Tri des infos sur la commande
			 * Ajout de ligne de stock en fonction des achats
			 */
			if(is_array($pParam["reservation"])) {
				$lCommande = CommandeManager::select($lIdCommande);
				if($lCommande->getId() == $lIdCommande) {
					$lTotal = 0;
					$lProduitAjout = array();
				
					foreach($pParam["reservation"]["commandes"] as $lProduit) {
						$lLot = DetailCommandeManager::select($lProduit['stoIdDetailCommande']);
						$lTotal += ($lProduit['stoQuantite'] / $lLot->getTaille()) * $lLot->getPrix();	
						
						$lStock = new StockVO();
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit['stoQuantite']);
						$lStock->setType(0);
						$lStock->setIdCompte($lIdCompte);
						$lStock->setIdDetailCommande($lProduit['stoIdDetailCommande']);
						$lStock->setIdCommande($lIdCommande);
						array_push($lProduitAjout,$lStock);
					}
					
					if($lTotal != 0) {
						$lOperations = OperationManager::selectOpeReservation($lIdCompte,$lIdCommande);
						
						if(count($lOperations) == 1 && isset($lOperations[0]) && $lOperations[0]->getId() == '') {
							//Ajout des stocks
							foreach($lProduitAjout as $lPdt) {
								StockManager::insert($lPdt);
							}
							$lOperation = new OperationVO();
					
							$lOperation->setIdCompte($lIdCompte);
							$lOperation->setMontant($lTotal);
							$lOperation->setLibelle("Marché N°" . $lCommande->getNumero());
							$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
							$lOperation->setTypePaiement(0);
							$lOperation->setType(0);
							$lOperation->setIdCommande($lIdCommande);
							OperationManager::insert( $lOperation );
			
							// Ajout compte et commande au groupe commande
							$lGroupeCommande = new GroupeCommandeVO();
							$lGroupeCommande->setIdCompte($lIdCompte);
							$lGroupeCommande->setIdCommande($lIdCommande);
							$lGroupeCommande->setEtat(0);
							GroupeCommandeManager::insert($lGroupeCommande);
						} else {
							$lVr = new TemplateVR();
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_220_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_220_MSG);
							$lVr->getLog()->addErreur($lErreur);	
							return $lVr;
						}
					} else {
						$lVr = new TemplateVR();
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
						$lVr->getLog()->addErreur($lErreur);	
						return $lVr;
					}
				} else {
					$lVr = new TemplateVR();
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
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