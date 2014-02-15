<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : MarcheValid.php
//
// Description : Classe MarcheValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . MOD_CAISSE . "/GetMarcheListeReservationVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_CAISSE . "/AchatVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_CAISSE . "/InfoMarcheVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/OperationDetailValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_CAISSE . "/ProduitDetailAchatValid.php" );

/**
 * @name MarcheValid
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une MarcheValid
 */
class MarcheValid
{	
	/**
	 * @name validGetMarche($pData)
	 * @return InfoMarcheVR
	 * @desc Test la validite de l'élément
	 */
	public static function validGetMarche($pData) {
		$lVr = new InfoMarcheVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);
		}
	
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
				
			$lCommande = CommandeManager::select($pData['id']);
			if($lCommande->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
	/**
	* @name validEnregistrer($pData)
	* @return AchatVR
	* @desc Test la validite de l'élément
	*/
	public static function validEnregistrer($pData) {
		$lVr = new AchatVR();
		//Tests inputs
		if(!isset($pData['operationAchat'])) {
			$lVr->setValid(false);
			$lVr->getOperationAchat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationAchat()->addErreur($lErreur);
		}
		if(!isset($pData['operationAchatSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getOperationAchatSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getOperationAchatSolidaire()->addErreur($lErreur);	
		}
		if(!isset($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}
		if(!isset($pData['rechargement'])) {
			$lVr->setValid(false);
			$lVr->getRechargement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getRechargement()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques			
			$lIdCompte = 0;
			if(!is_null($pData['operationAchat']) && !empty($pData['operationAchat'])) {
				
				if($pData['operationAchat']['montant'] == 0) {
					$lVr->setOperationAchat(OperationDetailValid::validDelete($pData['operationAchat']));
				} else {
					$lVr->setOperationAchat(OperationDetailValid::validAjout($pData['operationAchat'], array("negatif" => true)));
				
					if(!$lVr->getOperationAchat()->getValid()) {
						$lVr->setValid(false);
					} else if(isset($pData['operationAchat']['champComplementaire'][1]['valeur'])) {
						$lIdCompte = $pData['operationAchat']['idCompte'];
						// Le marche doit être ouvert
						$lOpeAchatChampComp = $lVr->getOperationAchat()->getChampComplementaire();
						$lInfoMarche = $lOpeAchatChampComp[1]->getData();
						if($lInfoMarche['marche']->getArchive() != 0) {
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
							$lVr->getLog()->addErreur($lErreur);
						}
					}
				}
				
			}
			if(!is_null($pData['operationAchatSolidaire']) && !empty($pData['operationAchatSolidaire'])) {
				if($pData['operationAchatSolidaire']['montant'] == 0) {
					$lVr->setOperationAchat(OperationDetailValid::validDelete($pData['operationAchatSolidaire']));
				} else {
					$lVr->setOperationAchatSolidaire(OperationDetailValid::validAjout($pData['operationAchatSolidaire'], array("negatif" => true)));
				
					if(!$lVr->getOperationAchatSolidaire()->getValid()) {
						$lVr->setValid(false);
					} else if(isset($pData['operationAchatSolidaire']['champComplementaire'][1]['valeur'])) { 
						$lIdCompte = $pData['operationAchatSolidaire']['idCompte'];
						// Le marche doit être ouvert
						$lOpeAchatChampComp = $lVr->getOperationAchatSolidaire()->getChampComplementaire();
						$lInfoMarche = $lOpeAchatChampComp[1]->getData();
						if($lInfoMarche['marche']->getArchive() != 0) {
							$lVr->setValid(false);
							$lVr->getLog()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
							$lVr->getLog()->addErreur($lErreur);
						}
					}
				}
			}

			$lTotal = 0;
			$lTotalSolidaire = 0;
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			} else {
				foreach($pData['produits'] as $lIndice => $lProduit) {
					if(!is_null($pData['produits'][$lIndice])) {
						$lVrDetail = ProduitDetailAchatValid::validAjout($lProduit);
						if(!$lVrDetail->getValid()){
							$lVr->setValid(false);
						} else {
							if(is_float((float)$lProduit['montant']) && !empty($lProduit['montant'])) {
								$lTotal += $lProduit['montant'];
							}
							if(is_float((float)$lProduit['montantSolidaire']) && !empty($lProduit['montantSolidaire'])) {
								$lTotalSolidaire += $lProduit['montantSolidaire'];
							}
						}
						$lVr->addProduits($lVrDetail);
					}
				}
			}
									
			// L'opération doit exister si il y a un total (Normal ou Solidaire)
			if(	//($lTotal == 0 && (!is_null($pData['operationAchat']) && !empty($pData['operationAchat']))) 
					//||
			 ($lTotal != 0 && (is_null($pData['operationAchat']) || empty($pData['operationAchat']) || bccomp($lTotal, (float)$pData['operationAchat']["montant"]) != 0))
			//		|| ($lTotalSolidaire == 0 && (!is_null($pData['operationAchatSolidaire']) && !empty($pData['operationAchatSolidaire'])     ))
					|| ($lTotalSolidaire != 0 && (is_null($pData['operationAchatSolidaire']) || empty($pData['operationAchatSolidaire']) || bccomp($lTotalSolidaire, (float)$pData['operationAchatSolidaire']["montant"]) != 0))
				) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_266_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_266_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
	
			$lRechargement = 0;
			if(!empty($pData['rechargement']['montant']) && $pData['rechargement']['montant'] != 0) {
				$lVr->setRechargement(OperationDetailValid::validAjout($pData['rechargement']));
				if(!$lVr->getRechargement()->getValid()) {
					$lVr->setValid(false);
				} else {
					$lRechargement = $pData['rechargement']['montant'];
				}
			} else if($lIdCompte != -3 && ($lTotal + $lTotalSolidaire) == 0) { // Si compte adherent et pas de rechargement il faut un produit
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
			
			if($lIdCompte == -3 ) {
				if(($lTotal + $lTotalSolidaire) == 0) { // Si compte invité il faut un produit			
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
				if(($lTotal + $lTotalSolidaire + $lRechargement) != 0 ) { // Compte invite reste à 0
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_244_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_244_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}
	
	/**
	 * @name validAjout($pData)
	 * @return AchatCommandeVR
	 * @desc Test la validite de l'élément
	 */
	public static function validAjout($pData) {
		$lVr = new AchatCommandeVR();		
		// Pour les adhents non compte invité et achat marché on vérifie si il n'y a pas déjà un achat
		if($pData['idCompte'] != -3 && $pData['id'] != -1) {
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($pData['idCompte']);
			$lIdAchat->setIdCommande($pData['id']);
		
			$lAchatService = new AchatService();
			$lAchat = $lAchatService->getAll($lIdAchat);
		
			if(isset($lAchat[0]) && is_object($lAchat[0]) && !is_null($lAchat[0]->getId()->getIdCompte())) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_263_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_263_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
	/**
	* @name validUpdateMarche($pData)
	* @return AchatCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdateMarche($pData) {
		$lVr = new AchatCommandeVR();

		//Tests Fonctionnels
		
		// Adhérent doit avoir soit un achat soit un rechargement à minima
		if($pData['idCompte'] != -3 
				&& (empty($pData['rechargement']['montant']) || $pData['rechargement']['montant'] == 0)
				&& empty($pData['idAchat']) ) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}
		
		// Compte invité doit avoir un achat
		if($pData['idCompte'] == -3 && empty($pData['idAchat'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		
		// Si achat il faut le vérifier
		if($lVr->getValid(false) && !empty($pData['idAchat'])) {
			$lOperationService = new OperationService();
			$lValid = true;
			foreach($pData['idAchat'] as $lIdAchat) {
				$lValid &= $lOperationService->existe($lIdAchat);
			}
			if(!$lValid) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);					
			}
		}
		
		return $lVr;
	}
	
	/**
	* @name validGetMarcheListeReservation($pData)
	* @return GetMarcheListeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetMarcheListeReservation($pData) {
		$lVr = new GetMarcheListeReservationVR();
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
			
			// Si le marche n'est plus ouvert
			$lCommande = CommandeManager::select($pData['id_commande']);
			if($lCommande->getArchive() != 0) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
	
	/**
	* @name validGetInfoAchatMarche($pData)
	* @return GetInfoAchatMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetInfoAchatMarche($pData) {
		$lVr = new GetMarcheListeReservationVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(!isset($pData['id_adherent'])) {
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
			if(!is_int((int)$pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			/*if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}*/
			if($pData['id_adherent'] != 0 && empty($pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}

			
			if($pData['id_commande'] != -1) { // Si ce n'est pas la caisse permanente				
				// Si le marche n'est plus ouvert
				$lCommande = CommandeManager::select($pData['id_commande']);
				if($lCommande->getArchive() != 0) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
			}
			
			if($pData["id_adherent"] != 0 ) { // Si ce n'est pas le compte invité
				// Test si l'adhérent existe
				$lAdherent = AdherentViewManager::select($pData["id_adherent"]);
				if($lAdherent->getAdhId() != $pData["id_adherent"]) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
			}
			/*$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
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
	* @name validGetInfoMarche($pData)
	* @return GetMarcheListeReservationVR
	* @desc Test la validite de l'élément
	*/
/*	public static function validGetInfoMarche($pData) {
		$lVr = new GetMarcheListeReservationVR();
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

			// Si le marche n'est plus ouvert
			$lCommande = CommandeManager::select($pData['id_commande']);
			if($lCommande->getArchive() != 0) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}*/
}
?>