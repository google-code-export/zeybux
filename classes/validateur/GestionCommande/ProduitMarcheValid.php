<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : ProduitMarcheValid.php
//
// Description : Classe ProduitMarcheValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_UTILS . "MessagesErreurs.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ProduitMarcheVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/DetailCommandeValid.php" );

/**
 * @name ProduitMarcheVR
 * @author Julien PIERRE
 * @since 08/11/2011
 * @desc Classe représentant une ProduitMarcheValid
 */
class ProduitMarcheValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitMarcheVR();
		//Tests Techniques
		if(!isset($pData['idNom'])) {
			$lVr->setValid(false);
			$lVr->getIdNom()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdNom()->addErreur($lErreur);	
		}
		if(!isset($pData['unite'])) {
			$lVr->setValid(false);
			$lVr->getUnite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getUnite()->addErreur($lErreur);	
		}
		if(!isset($pData['qteMaxCommande'])) {
			$lVr->setValid(false);
			$lVr->getQteMaxCommande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQteMaxCommande()->addErreur($lErreur);	
		}
		if(!isset($pData['qteRestante'])) {
			$lVr->setValid(false);
			$lVr->getQteRestante()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQteRestante()->addErreur($lErreur);	
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
			if(!TestFonction::checkLength($pData['idNom'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdNom()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idNom'])) {
				$lVr->setValid(false);
				$lVr->getIdNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdNom()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['unite'],0,20)) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['qteMaxCommande'],0,12)) {
				$lVr->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['qteMaxCommande'])) {
				$lVr->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['qteRestante'],0,12)) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['qteRestante'])) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);	
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
			if(empty($pData['idNom'])) {
				$lVr->setValid(false);
				$lVr->getIdNom()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNom()->addErreur($lErreur);	
			}
			if(empty($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
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
			if($lVr->getIdNom()->getValid()) {
				$lNomProduit = NomProduitManager::select($pData['idNom']);
				$lId = $lNomProduit->getId();
				if(empty($lId)) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_210_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_210_MSG);
					$lVr->getLog()->addErreur($lErreur);
				}
			}
							
			// Les quantités sont positives
			if($pData['qteMaxCommande'] < 0) {
				$lVr->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			if($pData['qteRestante'] < 0) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);	
			}
						
			if($pData['qteMaxCommande'] > $pData['qteRestante']) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_205_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_205_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			
			if(is_array($pData['lots'])) {
				$lValidLot = new DetailCommandeValid();
				$i = 0;
				while(isset($pData['lots'][$i])) {
					$lVrLot = $lValidLot->validAjout($pData['lots'][$i]);
					
					if(!$lVrLot->getValid()){
						$lVr->setValid(false);
					}
					if(!empty($pData['qteMaxCommande'])) {
						if(floatval($pData['lots'][$i]['taille']) > floatval($pData['qteMaxCommande'])) {
							$lVr->setValid(false);
							$lVrLot->setValid(false);
							$lVrLot->getTaille()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_206_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_206_MSG);
							$lVrLot->getTaille()->addErreur($lErreur);
						}
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
	* @return ProduitMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new ProduitMarcheVR();
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			if(!TestFonction::checkLength($pData['id'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
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
			// Le produit doit exister
			$lProduit = ProduitManager::select($pData['id']);
			if($lProduit->getId() != $pData['id']) {
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

	/**
	* @name validUpdate($pData)
	* @return ProduitMarcheVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = ProduitMarcheValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ProduitMarcheVR();
			//Tests Techniques
			if(!isset($pData['unite'])) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if(!isset($pData['qteMaxCommande'])) {
				$lVr->setValid(false);
				$lVr->getQteMaxCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQteMaxCommande()->addErreur($lErreur);	
			}
			if(!isset($pData['qteRestante'])) {
				$lVr->setValid(false);
				$lVr->getQteRestante()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQteRestante()->addErreur($lErreur);	
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
				if(!TestFonction::checkLength($pData['unite'],0,20)) {
					$lVr->setValid(false);
					$lVr->getUnite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getUnite()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['qteMaxCommande'],0,12)) {
					$lVr->setValid(false);
					$lVr->getQteMaxCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQteMaxCommande()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['qteMaxCommande'])) {
					$lVr->setValid(false);
					$lVr->getQteMaxCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getQteMaxCommande()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['qteRestante'],0,12)) {
					$lVr->setValid(false);
					$lVr->getQteRestante()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getQteRestante()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['qteRestante'])) {
					$lVr->setValid(false);
					$lVr->getQteRestante()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getQteRestante()->addErreur($lErreur);	
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
				if(empty($pData['unite'])) {
					$lVr->setValid(false);
					$lVr->getUnite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getUnite()->addErreur($lErreur);	
				}
				if(empty($pData['lots'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
								
				// Les quantités sont positives
				if($pData['qteMaxCommande'] < 0) {
					$lVr->setValid(false);
					$lVr->getQteMaxCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getQteMaxCommande()->addErreur($lErreur);	
				}
				if($pData['qteRestante'] < 0) {
					$lVr->setValid(false);
					$lVr->getQteRestante()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
					$lVr->getQteRestante()->addErreur($lErreur);	
				}
							
				if($pData['qteMaxCommande'] > $pData['qteRestante']) {
					$lVr->setValid(false);
					$lVr->getQteRestante()->setValid(false);
					$lVr->getQteMaxCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_205_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_205_MSG);
					$lVr->getQteRestante()->addErreur($lErreur);
					$lVr->getQteMaxCommande()->addErreur($lErreur);	
				}
				
				if(is_array($pData['lots'])) {
					$lValidLot = new DetailCommandeValid();
					$i = 0;
					while(isset($pData['lots'][$i])) {
						$lVrLot = $lValidLot->validAjout($pData['lots'][$i]);
						
						if(!$lVrLot->getValid()){
							$lVr->setValid(false);
						}
						if(!empty($pData['qteMaxCommande'])) {
							if(floatval($pData['lots'][$i]['taille']) > floatval($pData['qteMaxCommande'])) {
								$lVr->setValid(false);
								$lVrLot->setValid(false);
								$lVrLot->getTaille()->setValid(false);
								$lErreur = new VRerreur();
								$lErreur->setCode(MessagesErreurs::ERR_206_CODE);
								$lErreur->setMessage(MessagesErreurs::ERR_206_MSG);
								$lVrLot->getTaille()->addErreur($lErreur);
							}
						}
						$lVr->addLots($lVrLot);			
						$i++;
					}			
				}
			}
			return $lVr;
		}
		return $lTestId;
	}

}