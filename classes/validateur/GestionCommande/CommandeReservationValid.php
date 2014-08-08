<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : CommandeReservationValid.php
//
// Description : Classe CommandeReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/CommandeReservationVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeDetailReservationValid.php" );

/**
 * @name CommandeReservationVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une CommandeReservationValid
 */
class CommandeReservationValid
{
	/**
	* @name validAjout($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CommandeReservationVR();
		//Tests inputs
		if(!isset($pData['detailReservation'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['id_compte'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {		
			//Tests Techniques
			if(!is_array($pData['detailReservation'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}		
			if(!is_int((int)$pData['id_compte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['detailReservation'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(empty($pData['id_compte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			if(isset($pData["detailReservation"][0]["stoIdDetailCommande"])) {
				$lIdLot = $pData["detailReservation"][0]["stoIdDetailCommande"];
				$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);

				// Marché : réservation non terminée
				$lIdReservation = new IdReservationVO();
				$lIdReservation->setIdCompte($pData['id_compte']);
				$lIdReservation->setIdCommande($lDetailMarche[0]->getComId());
				
				$lReservationService = new ReservationService();
				$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
				$lOperation = $lOperations[0];

				if($lReservationService->enCours($lIdReservation)) {					
					$lIdOperation = $lOperation->getId();			
				} else {
					$lIdOperation = -1;
				}
									
				if($lVr->getValid()) {
					foreach($pData['detailReservation'] as $lReservation) {
						$lDetailMarche = DetailMarcheViewManager::selectByLot($lReservation["stoIdDetailCommande"]);
						$lIdProduit = $lDetailMarche[0]->getProId();
						$lReservation["idOperation"] = $lIdOperation;
						$lVrReservation = CommandeDetailReservationValid::validAjout($lReservation);
						if(!$lVrReservation->getValid()){$lVr->setValid(false);}
						if(isset($lIdProduit)) {
							$lCommandes = $lVr->getCommandes();
							$lCommandes[$lIdProduit] = $lVrReservation;
							$lVr->setCommandes($lCommandes);
						}
					}
				}
			} else {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_117_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_117_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new CommandeReservationVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['id_compte'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_compte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(empty($pData['id_compte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pData['id_compte']);
			$lIdReservation->setIdCommande($pData['id_commande']);
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();			

			// Si il y a bien une réservation existante
			if(is_null($lIdOperation) || ($lOperation->getTypePaiement() != 0 && $lOperation->getTypePaiement() != 22)) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_238_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_238_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
			
			// Si la réservation n'est pas déjà achetée
			if(!is_null($lIdOperation) && $lOperation->getTypePaiement() == 22) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_274_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_274_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = CommandeReservationValid::validAjout($pData);
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pData['id_compte']);
			$lIdReservation->setIdCommande($pData['id_commande']);
				
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();
			
			// Si la réservation n'est pas déjà achetée
			if(!is_null($lIdOperation) && $lOperation->getTypePaiement() == 22) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_274_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_274_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>