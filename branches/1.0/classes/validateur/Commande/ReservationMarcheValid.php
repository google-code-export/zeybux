<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : ReservationMarcheValid.php
//
// Description : Classe ReservationMarcheValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMMANDE . "/ReservationMarcheVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/DetailReservationMarcheValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php" );

/**
 * @name ReservationMarcheVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une ReservationMarcheValid
 */
class ReservationMarcheValid
{
	/**
	* @name validAjout($pData)
	* @return ReservationMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ReservationMarcheVR();
		//Tests inputs
		if(!isset($pData['detailReservation'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
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
			if(!is_int((int)$pData['idCompte'])) {
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
			if(empty($pData['idCompte'])) {
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
				if(!TestFonction::dateTimeEstPLusGrandeEgale($lDetailMarche[0]->getComDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
					$lVr->getLog()->addErreur($lErreur);
				} else {
					$lIdReservation = new IdReservationVO();
					$lIdReservation->setIdCompte($pData['idCompte']);
					$lIdReservation->setIdCommande($lDetailMarche[0]->getComId());
					
					$lReservationService = new ReservationService();
					$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
					$lOperation = $lOperations[0];
					
					if($lReservationService->enCours($lIdReservation)) {					
						$lIdOperation = $lOperation->getId();			
					} else {
						$lIdOperation = -1;
					}
	
					// Si il y a une réservation existante
					/*$lTypeResa = array(0,7,15);
					if(!is_null($lIdOperation) && in_array($lOperation->getTypePaiement(), $lTypeResa)) {
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_220_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_220_MSG);
						$lVr->getLog()->addErreur($lErreur);
					}*/

					if($lVr->getValid()) {
						foreach($pData['detailReservation'] as $lReservation) {
							$lDetailMarche = DetailMarcheViewManager::selectByLot($lReservation["stoIdDetailCommande"]);
							$lIdProduit = $lDetailMarche[0]->getProId();
							$lReservation["idOperation"] = $lIdOperation;
							$lVrReservation = DetailReservationMarcheValid::validAjout($lReservation);
							if(!$lVrReservation->getValid()){$lVr->setValid(false);}
							if(isset($lIdProduit)) {
								$lCommandes = $lVr->getCommandes();
								$lCommandes[$lIdProduit] = $lVrReservation;
								$lVr->setCommandes($lCommandes);
							}
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
	* @return ReservationMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ReservationMarcheVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
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
			if(!is_int((int)$pData['idCompte'])) {
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
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			$lCommande = CommandeManager::select($pData['id_commande']);
			// Marché : réservation non terminée
			if(!TestFonction::dateTimeEstPLusGrandeEgale($lCommande->getDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
				$lVr->getLog()->addErreur($lErreur);
			} else {
				$lIdReservation = new IdReservationVO();
				$lIdReservation->setIdCompte($pData['idCompte']);
				$lIdReservation->setIdCommande($pData['id_commande']);
				
				$lReservationService = new ReservationService();
				$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
				$lOperation = $lOperations[0];
				$lIdOperation = $lOperation->getId();			
	
				// Si il y a bien une réservation existante
				if(is_null($lIdOperation) || $lOperation->getTypePaiement() != 0) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_238_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_238_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return ReservationMarcheVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
		$lVr = new ReservationMarcheVR();
		//Tests inputs
		if(!isset($pData['detailReservation'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
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
			if(!is_int((int)$pData['idCompte'])) {
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
			if(empty($pData['idCompte'])) {
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
				if(!TestFonction::dateTimeEstPLusGrandeEgale($lDetailMarche[0]->getComDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
					$lVr->getLog()->addErreur($lErreur);
				} else {
					$lIdReservation = new IdReservationVO();
					$lIdReservation->setIdCompte($pData['idCompte']);
					$lIdReservation->setIdCommande($lDetailMarche[0]->getComId());
					
					$lReservationService = new ReservationService();
					$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
					$lOperation = $lOperations[0];
					$lIdOperation = $lOperation->getId();			
	
					// Si il y a bien une réservation existante
					if(is_null($lIdOperation) || $lOperation->getTypePaiement() != 0) {
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_238_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_238_MSG);
						$lVr->getLog()->addErreur($lErreur);
					}
					if($lVr->getValid()) {
						foreach($pData['detailReservation'] as $lReservation) {
							$lDetailMarche = DetailMarcheViewManager::selectByLot($lReservation["stoIdDetailCommande"]);
							$lIdProduit = $lDetailMarche[0]->getProId();		
							
							$lReservation["idOperation"] = $lIdOperation;
							$lVrReservation = DetailReservationMarcheValid::validUpdate($lReservation);
							if(!$lVrReservation->getValid()){$lVr->setValid(false);}
							//$lVr->addCommandes($lVrReservation);
							if(isset($lIdProduit)) {
								$lCommandes = $lVr->getCommandes();
								$lCommandes[$lIdProduit] = $lVrReservation;
								$lVr->setCommandes($lCommandes);
							}
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
	}*/
	
	/**
	* @name validGetReservation($pData)
	* @return ReservationMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetReservation($pData) {
		$lVr = new ReservationMarcheVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
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
			if(!is_int((int)$pData['idCompte'])) {
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
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			/*$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pData['idCompte']);
			$lIdReservation->setIdCommande($pData['id_commande']);
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();			

			// Si il y a bien une réservation existante
			if(is_null($lIdOperation) || $lOperation->getTypePaiement() != 0) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_238_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_238_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}*/
		}
		return $lVr;
	}
	
	/**
	* @name validGetMarche($pData)
	* @return ReservationMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetMarche($pData) {
		$lVr = new ReservationMarcheVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
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
			if(!is_int((int)$pData['idCompte'])) {
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
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($pData['idCompte']);
			$lIdReservation->setIdCommande($pData['id_commande']);
			
			$lReservationService = new ReservationService();
			$lOperations = $lReservationService->selectOperationReservation($lIdReservation);
			$lOperation = $lOperations[0];
			$lIdOperation = $lOperation->getId();			

			// Si il y a déjà une réservation existante
			$lTypeResa = array(0,7,15);
			if(!is_null($lIdOperation) && in_array($lOperation->getTypePaiement(), $lTypeResa)) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_220_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_220_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>