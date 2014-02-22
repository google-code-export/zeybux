<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ListeProduitValid.php
//
// Description : Classe ListeProduitValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ABONNEMENT. "/ListeProduitVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_ABONNEMENT. "/NomProduitVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ABONNEMENT. "/DetailCommandeValid.php" );
/*
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AbonnementListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );*/

/**
 * @name ListeProduitValid
 * @author Julien PIERRE
 * @since 26/02/2012
 * @desc Classe représentant une ListeProduitValid
 */
class ListeProduitValid
{
	/**
	* @name validAjout($pData)
	* @return ListeProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ListeProduitVR();
		//Tests inputs
		if(!isset($pData['idNomProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdNomProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdNomProduit()->addErreur($lErreur);	
		}
		if(!isset($pData['unite'])) {
			$lVr->setValid(false);
			$lVr->getUnite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getUnite()->addErreur($lErreur);	
		}
		if(!isset($pData['stockInitial'])) {
			$lVr->setValid(false);
			$lVr->getStockInitial()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStockInitial()->addErreur($lErreur);	
		}
		if(!isset($pData['max'])) {
			$lVr->setValid(false);
			$lVr->getMax()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMax()->addErreur($lErreur);	
		}
		if(!isset($pData['frequence'])) {
			$lVr->setValid(false);
			$lVr->getFrequence()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getFrequence()->addErreur($lErreur);	
		}
		if(!isset($pData['lots'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			if(!TestFonction::checkLength($pData['idNomProduit'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['unite'],0,20)) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['stockInitial'],0,12) || $pData['stockInitial'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStockInitial()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['stockInitial'])) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getStockInitial()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['max'],0,12) || $pData['max'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['max'])) {
				$lVr->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['frequence'],0,200)) {
				$lVr->setValid(false);
				$lVr->getFrequence()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getFrequence()->addErreur($lErreur);	
			}
			if(!is_array($pData['lots'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}	

			//Tests Fonctionnels
			if(empty($pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(empty($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(empty($pData['stockInitial'])) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStockInitial()->addErreur($lErreur);	
			}
			if(empty($pData['max'])) {
				$lVr->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if(empty($pData['lots'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			
			// Test de l'existance du produit
			if($lVr->getIdNomProduit()->getValid()) {
				$lNomProduit = NomProduitManager::select($pData['idNomProduit']);
				$lId = $lNomProduit->getId();
				if(empty($lId)) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_210_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_210_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
				
				$lProAbo = ProduitAbonnementManager::selectByIdNomProduit($pData['idNomProduit']);
				$lProAbo = $lProAbo[0];
				if($lProAbo->getId() != NULL && $lProAbo->getEtat() == 0) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_251_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_251_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
			}			
			if($pData['stockInitial'] <= 0) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_CODE);
				$lVr->getStockInitial()->addErreur($lErreur);	
			}
			if($pData['max'] <= 0 && $pData['max'] != -1) {
				$lVr->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_CODE);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if($pData['max'] != -1 && $pData['max'] > $pData['stockInitial']) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_205_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_205_MSG);
				$lVr->getStockInitial()->addErreur($lErreur);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if(is_array($pData['lots'])) {
				$lValidLot = new DetailCommandeValid();
				$i = 0;
				while(isset($pData['lots'][$i])) {
					$lVrLot = $lValidLot->validAjout($pData['lots'][$i]);					
					if(!$lVrLot->getValid()){
						$lVr->setValid(false);
					}
					$lVr->addLots($lVrLot);			
					$i++;
				}			
			}
			
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ListeProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ListeProduitVR();
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
		
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				$lAbonnementService = new AbonnementService();
				if(!$lAbonnementService->produitExiste($pData['id'])) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getId()->addErreur($lErreur);
				}
			}
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return ListeProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = ListeProduitValid::validDelete($pData);
		if($lVr->getValid()) {
			//Tests inputs
			if(!isset($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(!isset($pData['stockInitial'])) {
				$lVr->setValid(false);
				$lVr->getStockInitial()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStockInitial()->addErreur($lErreur);	
			}
			if(!isset($pData['max'])) {
				$lVr->setValid(false);
				$lVr->getMax()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMax()->addErreur($lErreur);	
			}
			if(!isset($pData['frequence'])) {
				$lVr->setValid(false);
				$lVr->getFrequence()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getFrequence()->addErreur($lErreur);	
			}
			if(!isset($pData['lots'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			if(!isset($pData['lotRemplacement'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
	
			if($lVr->getValid()) {
				if(!TestFonction::checkLength($pData['unite'],0,20)) {
					$lVr->setValid(false);
					$lVr->getUnite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getUnite()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['stockInitial'],0,12) || $pData['stockInitial'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getStockInitial()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getStockInitial()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['stockInitial'])) {
					$lVr->setValid(false);
					$lVr->getStockInitial()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getStockInitial()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['max'],0,12) || $pData['max'] > 999999999.99) {
					$lVr->setValid(false);
					$lVr->getMax()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getMax()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['max'])) {
					$lVr->setValid(false);
					$lVr->getMax()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getMax()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['frequence'],0,200)) {
					$lVr->setValid(false);
					$lVr->getFrequence()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getFrequence()->addErreur($lErreur);	
				}
				if(!is_array($pData['lots'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
				if(!is_array($pData['lotRemplacement'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
	
				//Tests Fonctionnels
				if(empty($pData['unite'])) {
					$lVr->setValid(false);
					$lVr->getUnite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getUnite()->addErreur($lErreur);	
				}
				if(empty($pData['stockInitial'])) {
					$lVr->setValid(false);
					$lVr->getStockInitial()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getStockInitial()->addErreur($lErreur);	
				}
				if(empty($pData['max'])) {
					$lVr->setValid(false);
					$lVr->getMax()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getMax()->addErreur($lErreur);	
				}
				if(empty($pData['lots'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
				
				// Test de l'existance du produit		
				if($pData['stockInitial'] <= 0) {
					$lVr->setValid(false);
					$lVr->getStockInitial()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_CODE);
					$lVr->getStockInitial()->addErreur($lErreur);	
				}
				if($pData['max'] <= 0 && $pData['max'] != -1) {
					$lVr->setValid(false);
					$lVr->getMax()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_CODE);
					$lVr->getMax()->addErreur($lErreur);	
				}
				if($pData['max'] != -1 && $pData['max'] > $pData['stockInitial']) {
					$lVr->setValid(false);
					$lVr->getStockInitial()->setValid(false);
					$lVr->getMax()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_205_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_205_MSG);
					$lVr->getStockInitial()->addErreur($lErreur);
					$lVr->getMax()->addErreur($lErreur);	
				}
				if(is_array($pData['lots'])) {
					$lValidLot = new DetailCommandeValid();
					$i = 0;
					while(isset($pData['lots'][$i])) {
						$lVrLot = $lValidLot->validAjout($pData['lots'][$i]);					
						if(!$lVrLot->getValid()){
							$lVr->setValid(false);
						}
						$lVr->addLots($lVrLot);			
						$i++;
					}			
				}
			}
		}
		return $lVr;
	}
		
	/**
	* @name validGetDetailProduit($pData)
	* @return ListeProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetDetailProduit($pData) {
		return ListeProduitValid::validDelete($pData);	
	}
		
	/**
	* @name validIdNomProduit($pData)
	* @return NomProduitVR
	* @desc Test la validite de l'élément
	*/
	public static function validIdNomProduit($pData) {
		$lVr = new NomProduitVR();
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
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);
			}

			$lNomProduit = NomProduitManager::select($pData['id']);
			$lId = $lNomProduit->getId();
			if(empty($lId)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_210_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_210_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		
		}
		return $lVr;
	}

}
?>