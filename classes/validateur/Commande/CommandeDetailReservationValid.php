<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/10/2010
// Fichier : CommandeDetailReservationValid.php
//
// Description : ClasseCommandeDetailReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMMANDE . "/CommandeDetailReservationVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
//include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name CommandeDetailReservationVR
 * @author Julien PIERRE
 * @since 14/10/2010
 * @desc Classe représentant une CommandeDetailReservationValid
 */
class CommandeDetailReservationValid
{
	/**
	* @name validAjout($pData)
	* @returnCommandeDetailReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CommandeDetailReservationVR();
		//Tests inputs
		if(!isset($pData['stoQuantite'])) {
			$lVr->setValid(false);
			$lVr->getStoQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStoQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['stoIdDetailCommande'])) {
			$lVr->setValid(false);
			$lVr->getStoIdDetailCommande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['stoQuantite'],0,12)) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['stoQuantite'])) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['stoIdDetailCommande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getStoIdDetailCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['stoIdDetailCommande'])) {
				$lVr->setValid(false);
				$lVr->getStoIdDetailCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['stoQuantite'])) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(empty($pData['stoIdDetailCommande'])) {
				$lVr->setValid(false);
				$lVr->getStoIdDetailCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
			}
			
			if($pData['stoQuantite'] >= 0) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}		
					
			$lDcom = DetailCommandeManager::select($pData['stoIdDetailCommande']);
			if($lDcom->getId() == null) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);		
			} else {
				$lPdt = ProduitManager::select($lDcom->getIdProduit());
				if($lPdt->getId() == null) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getLog()->addErreur($lErreur);
				} else {
					$lQte = $pData['stoQuantite'] * -1;
					if($lQte > $lPdt->getMaxProduitCommande()) {
						$lVr->setValid(false);
						$lVr->getStoIdProduit()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_217_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_217_MSG);
						$lVr->getStoIdProduit()->addErreur($lErreur);
					}				
					//$lStock = StockProduitViewManager::select($lPdt->getId());
					if($lQte > $lPdt->getStockReservation()) {
						$lVr->setValid(false);
						$lVr->getStoIdProduit()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_218_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_218_MSG);
						$lVr->getStoIdProduit()->addErreur($lErreur);
					}
				}
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @returnCommandeDetailReservationVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new CommandeDetailReservationVR();
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
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @returnCommandeDetailReservationVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new CommandeDetailReservationVR();
			
			//Tests inputs
			if(!isset($pData['stoQuantite'])) {
				$lVr->setValid(false);
				$lVr->getStoQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoQuantite()->addErreur($lErreur);	
			}
			if(!isset($pData['stoIdDetailCommande'])) {
				$lVr->setValid(false);
				$lVr->getStoIdDetailCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
			}
	
			if($lVr->getValid()) {
				//Tests Techniques
				if(!TestFonction::checkLength($pData['stoQuantite'],0,12)) {
					$lVr->setValid(false);
					$lVr->getStoQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getStoQuantite()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['stoQuantite'])) {
					$lVr->setValid(false);
					$lVr->getStoQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getStoQuantite()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['getStoIdDetailCommande'],0,11)) {
					$lVr->setValid(false);
					$lVr->getStoIdDetailCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['stoIdDetailCommande'])) {
					$lVr->setValid(false);
					$lVr->getStoIdDetailCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
				}
	
				//Tests Fonctionnels
				if(empty($pData['stoQuantite'])) {
					$lVr->setValid(false);
					$lVr->getStoQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getStoQuantite()->addErreur($lErreur);	
				}
				if(empty($pData['stoIdDetailCommande'])) {
					$lVr->setValid(false);
					$lVr->getStoIdDetailCommande()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getStoIdDetailCommande()->addErreur($lErreur);	
				}
				
				if($pData['stoQuantite'] >= 0) {
					$lVr->setValid(false);
					$lVr->getStoQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getStoQuantite()->addErreur($lErreur);	
				}		
								
				$lDcom = DetailCommandeManager::select($pData['stoIdDetailCommande']);
				if($lDcom->getId() == null) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getLog()->addErreur($lErreur);		
				} else {
					$lPdt = ProduitManager::select($lDcom->getIdProduit());			
					if($lPdt->getId() == null) {
						$lVr->setValid(false);
						$lVr->getLog()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
						$lVr->getLog()->addErreur($lErreur);
					} else {
						$lQte = $pData['stoQuantite'] * -1;
						if($lQte > $lPdt->getMaxProduitCommande()) {
							$lVr->setValid(false);
							$lVr->getStoIdProduit()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_217_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_217_MSG);
							$lVr->getStoIdProduit()->addErreur($lErreur);
						}
						
						$lStock = StockProduitViewManager::select($lPdt->getId());
						if($lQte > $lStock[0]->getStoQuantite()) {
							$lVr->setValid(false);
							$lVr->getStoIdProduit()->setValid(false);
							$lErreur = new VRerreur();
							$lErreur->setCode(MessagesErreurs::ERR_218_CODE);
							$lErreur->setMessage(MessagesErreurs::ERR_218_MSG);
							$lVr->getStoIdProduit()->addErreur($lErreur);
						}
					}
				}
			}
			return $lVr;
		}
		return $lTestId;
	}*/
}