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
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/GetMarcheListeReservationVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/AchatCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/RechargementCompteValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/MarcheDetailAchatValid.php" );

/**
 * @name MarcheValid
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une MarcheValid
 */
class MarcheValid
{	
	/**
	* @name validAjout($pData)
	* @return AchatCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new AchatCommandeVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		if(!isset($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}
		if(!isset($pData['produitsSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getProduitsSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduitsSolidaire()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idCompte'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			$lCommande = CommandeManager::select($pData['id']);
			if($lCommande->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			// Le marche doit être ouvert
			if($lCommande->getArchive() != 0) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			$lNbProduit = 0;
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			} else {
				foreach($pData['produits'] as $lProduit) {
					if($lProduit['quantite'] != 0 && !empty($lProduit['quantite'])) {
						$lProduit['idCommande'] = $pData['id'];
						$lVrDetail = MarcheDetailAchatValid::validAjout($lProduit);
						if(!$lVrDetail->getValid()){$lVr->setValid(false);}
						$lVr->addProduits($lVrDetail);
						$lNbProduit++;
					}
				}
			}
			if(!is_array($pData['produitsSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			} else {
				foreach($pData['produitsSolidaire'] as $lProduit) {									
					if($lProduit['quantite'] != 0 && !empty($lProduit['quantite'])) {
						$lProduit['idCommande'] = $pData['id'];
						$lVrDetail = MarcheDetailAchatValid::validAjout($lProduit);
						if(!$lVrDetail->getValid()){$lVr->setValid(false);}
						$lVr->addProduitsSolidaire($lVrDetail);
						$lNbProduit++;
					}
				}
			}
		
			if($lNbProduit == 0) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
						
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}		
						
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			// Les compte existe
			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}	
			
			if(!isset($pData['rechargement']['montant'])) {
				$lVr->setValid(false);
				$lVr->getRechargement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getRechargement()->addErreur($lErreur);	
			}
					
			if(!empty($pData['rechargement']['montant']) && $pData['rechargement']['montant'] != 0) {
				$lValidRechargement = new RechargementCompteValid();
				$lVr->setRechargement($lValidRechargement->validAjout($pData['rechargement']));
				if(!$lVr->getRechargement()->getValid()) {$lVr->setValid(false);}
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
		//Tests inputs
		if(!isset($pData['idAchat'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_array($pData['idAchat'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['idAchat'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			if($lVr->getValid(false)) {
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
				$lVr = MarcheValid::validAjout($pData);
			}
		}
		return $lVr;
	}

	/**
	* @name validGetMarcheListeReservation($pData)
	* @return GetMarcheListeReservationVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validGetMarcheListeReservation($pData) {
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
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(empty($pData['id_adherent'])) {
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
			
			$lAdherent = AdherentViewManager::select($pData["id_adherent"]);
			if($lAdherent->getAdhId() != $pData["id_adherent"]) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);	
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
	public static function validGetInfoMarche($pData) {
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
}
?>