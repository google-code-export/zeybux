<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 15/02/2012
// Fichier : ListeAbonneValid.php
//
// Description : Classe ListeAbonneValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ABONNEMENT. "/ListeAbonneVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ABONNEMENT. "/ListeProduitVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ABONNEMENT. "/ListeProduitFermeVR.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AbonnementListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );

/**
 * @name ListeAbonneVR
 * @author Julien PIERRE
 * @since 15/02/2012
 * @desc Classe représentant une ListeAbonneValid
 */
class ListeAbonneValid
{
	/**
	* @name validAjout($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		if(!isset($pData['idProduitAbonnement'])) {
			$lVr->setValid(false);
			$lVr->getIdProduitAbonnement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
		}
		if(!isset($pData['idLotAbonnement'])) {
			$lVr->setValid(false);
			$lVr->getIdLotAbonnement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdLotAbonnement()->addErreur($lErreur);	
		}
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
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
			if(!TestFonction::checkLength($pData['idProduitAbonnement'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idProduitAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idLotAbonnement'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdLotAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idLotAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdLotAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['quantite'],0,12) || $pData['quantite'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(empty($pData['idProduitAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}
			if(empty($pData['idLotAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdLotAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);	
			}
			if(empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			
			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);
			}
			
			$lAbonnementService = new AbonnementService();
			if(!$lAbonnementService->produitExiste($pData['idProduitAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);
			}
			
			if(!$lAbonnementService->lotExiste($pData['idLotAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdLotAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);
			}
			
			if(!$lAbonnementService->lotAppartientProduit($pData['idProduitAbonnement'],$pData['idLotAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);
			}
		
			if($pData['quantite'] < 0) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}			
			
			$lDetailProduit = $lAbonnementService->getDetailProduit($pData['idProduitAbonnement']);
			$lDetailProduit = $lDetailProduit[0];
			if($lDetailProduit->getProAboStockInitial() - $lDetailProduit->getProAboReservation() < $pData['quantite']) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_249_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_249_MSG);
				$lVr->getQuantite()->addErreur($lErreur);				
			}
			
			if($lDetailProduit->getProAboMax() < $pData['quantite'] && $lDetailProduit->getProAboMax() != -1) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_250_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_250_MSG);
				$lVr->getQuantite()->addErreur($lErreur);				
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			$lAbonnementService = new AbonnementService();
			if(!$lAbonnementService->abonnementExiste($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = ListeAbonneValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ListeAbonneVR();
			//Tests inputs
			if(!isset($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(!isset($pData['idProduitAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}
			if(!isset($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!isset($pData['idLotAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getIdLotAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdLotAbonnement()->addErreur($lErreur);	
			}
	
			if($lVr->getValid()) {
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
				if(!TestFonction::checkLength($pData['idProduitAbonnement'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['idProduitAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['idLotAbonnement'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdLotAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdLotAbonnement()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['idLotAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdLotAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdLotAbonnement()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['quantite'],0,12) || $pData['quantite'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['quantite'])) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}
	
				//Tests Fonctionnels
				if(empty($pData['idCompte'])) {
					$lVr->setValid(false);
					$lVr->getIdCompte()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdCompte()->addErreur($lErreur);	
				}
				if(empty($pData['idProduitAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
				}
				if(empty($pData['idLotAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdLotAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdLotAbonnement()->addErreur($lErreur);	
				}
				if(empty($pData['quantite'])) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}
				
				$lCompteService = new CompteService();
				if(!$lCompteService->existe($pData['idCompte'])) {
					$lVr->setValid(false);
					$lVr->getIdCompte()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdCompte()->addErreur($lErreur);
				}
				
				$lAbonnementService = new AbonnementService();
				if(!$lAbonnementService->produitExiste($pData['idProduitAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);
				}
			
				if(!$lAbonnementService->lotExiste($pData['idLotAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdLotAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdLotAbonnement()->addErreur($lErreur);
				}
				
				if(!$lAbonnementService->lotAppartientProduit($pData['idProduitAbonnement'],$pData['idLotAbonnement'])) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);
					$lVr->getIdLotAbonnement()->addErreur($lErreur);
				}
			
				if($pData['quantite'] < 0) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}			
				
				$lAbonnement = $lAbonnementService->getAbonnement($pData['id']);
				$lDetailProduit = $lAbonnementService->getDetailProduit($pData['idProduitAbonnement']);
				$lDetailProduit = $lDetailProduit[0];
				if($lDetailProduit->getProAboStockInitial() - $lDetailProduit->getProAboReservation() + $lAbonnement->getCptAboQuantite() < $pData['quantite']) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_249_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_249_MSG);
					$lVr->getQuantite()->addErreur($lErreur);				
				}
			
				if($lDetailProduit->getProAboMax() < $pData['quantite'] && $lDetailProduit->getProAboMax() != -1) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_250_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_250_MSG);
					$lVr->getQuantite()->addErreur($lErreur);				
				}
			}
			return $lVr;
		}
		return $lTestId;
	}
	
	/**
	* @name validSuspendre($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validSuspendre($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		if(!isset($pData['dateDebutSuspension'])) {
			$lVr->setValid(false);
			$lVr->getDateDebutSuspension()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateDebutSuspension()->addErreur($lErreur);	
		}
		if(!isset($pData['dateFinSuspension'])) {
			$lVr->setValid(false);
			$lVr->getDateFinSuspension()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getDateFinSuspension()->addErreur($lErreur);	
		}			
		if($lVr->getValid()) {
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
			if(!TestFonction::checkDate($pData['dateDebutSuspension'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebutSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateDebutSuspension()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDateExist($pData['dateDebutSuspension'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebutSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateDebutSuspension()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDate($pData['dateFinSuspension'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFinSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_103_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_103_MSG);
				$lVr->getDateFinSuspension()->addErreur($lErreur);	
			}
			if(!TestFonction::checkDateExist($pData['dateFinSuspension'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateFinSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_105_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_105_MSG);
				$lVr->getDateFinSuspension()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(empty($pData['dateDebutSuspension'])) {
				$lVr->setValid(false);
				$lVr->getDateDebutSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateDebutSuspension()->addErreur($lErreur);	
			}
			if(empty($pData['dateFinSuspension'])) {
				$lVr->setValid(false);
				$lVr->getDateFinSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getDateFinSuspension()->addErreur($lErreur);	
			}

			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);
			}
			if(!TestFonction::dateEstPLusGrandeEgale($pData['dateFinSuspension'], $pData['dateDebutSuspension'],'db')) {
				$lVr->setValid(false);
				$lVr->getDateDebutSuspension()->setValid(false);
				$lVr->getDateFinSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_209_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_230_MSG);
				$lVr->getDateDebutSuspension()->addErreur($lErreur);
				$lVr->getDateFinSuspension()->addErreur($lErreur);
			}
			if(!TestFonction::dateEstPLusGrandeEgale($pData['dateFinSuspension'],StringUtils::dateAujourdhuiDb(),'db')) {
				$lVr->setValid(false);
				$lVr->getDateFinSuspension()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_209_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_209_MSG);
				$lVr->getDateFinSuspension()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
/**
	* @name validSupprimerSuspension($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validSupprimerSuspension($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}			
		if($lVr->getValid()) {
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
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}

			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
	
	/**
	* @name validGetDetailAbonne($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetDetailAbonne($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs		
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getIdAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdAdherent()->addErreur($lErreur);	
		}
		
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			if($pData['id']	!= '' && !is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			
			$lAdherent = AbonnementListeAdherentViewManager::select($pData['id']);
			if($lAdherent[0]->getAdhId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}	
		}
		return $lVr;		
	}
	
	/**
	* @name validGetListeProduit($pData)
	* @return ListeProduitFermeVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetListeProduit($pData) {
		$lVr = new ListeProduitFermeVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idFerme'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdFerme()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdFerme()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idFerme'])) {
				$lVr->setValid(false);
				$lVr->getIdFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdFerme()->addErreur($lErreur);	
			}
			
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(empty($pData['idFerme'])) {
				$lVr->setValid(false);
				$lVr->getIdFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdFerme()->addErreur($lErreur);	
			}
			
			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}		
			
			// La ferme doit exister
			$lFerme = FermeManager::select($pData['idFerme']);
			if($lFerme->getId() != $pData['idFerme']) {
				$lVr->setValid(false);
				$lVr->getIdFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdFerme()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validGetDetailAbonnement($pData)
	* @return ListeAbonneVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetDetailAbonnement($pData) {
		$lVr = new ListeAbonneVR();
		//Tests inputs
		if(!isset($pData['idCompteAbonnement'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);
		}
		if(!isset($pData['idProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdProduitAbonnement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdProduitAbonnement()->addErreur($lErreur);
		}
		
		if($lVr->getValid()) {
			if(!is_int((int)$pData['idCompteAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}

			if(empty($pData['idCompteAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(empty($pData['idProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdProduitAbonnement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdProduitAbonnement()->addErreur($lErreur);	
			}
			
			$lAbonnementService = new AbonnementService();
			if(!$lAbonnementService->abonnementExiste($pData['idCompteAbonnement'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
			
			if($lVr->getValid()) {
				if(!$lAbonnementService->produitExiste($pData['idProduit'])) {
					$lVr->setValid(false);
					$lVr->getIdProduitAbonnement()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdProduitAbonnement()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}
}
?>