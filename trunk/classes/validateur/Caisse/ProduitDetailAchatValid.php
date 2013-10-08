<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2011
// Fichier : ProduitDetailAchatValid.php
//
// Description : ProduitDetailAchatValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_CAISSE . "/ProduitDetailAchatVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "NomProduitService.php");

/**
 * @name ProduitDetailAchatValid
 * @author Julien PIERRE
 * @since 22/07/2011
 * @desc Classe représentant une ProduitDetailAchatValid
 */
class ProduitDetailAchatValid
{
	/**
	* @name validAjout($pData)
	* @returnCommandeDetailReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitDetailAchatVR();
		//Tests inputs
		if(!isset($pData['idNomProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdNomProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdNomProduit()->addErreur($lErreur);	
		}
		if(!isset($pData['idStock'])) {
			$lVr->setValid(false);
			$lVr->getIdStock()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdStock()->addErreur($lErreur);	
		}
		if(!isset($pData['idDetailOperation'])) {
			$lVr->setValid(false);
			$lVr->getIdDetailOperation()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdDetailOperation()->addErreur($lErreur);	
		}
		if(!isset($pData['idStockSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getIdStockSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdStockSolidaire()->addErreur($lErreur);	
		}
		if(!isset($pData['idDetailOperationSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getIdDetailOperationSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdDetailOperationSolidaire()->addErreur($lErreur);	
		}
		if(!isset($pData['idDetailCommande'])) {
			$lVr->setValid(false);
			$lVr->getIdDetailCommande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdDetailCommande()->addErreur($lErreur);
		}
		if(!isset($pData['idModeleLot'])) {
			$lVr->setValid(false);
			$lVr->getIdModeleLot()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdModeleLot()->addErreur($lErreur);
		}
		if(!isset($pData['idDetailCommandeSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getIdDetailCommandeSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdDetailCommandeSolidaire()->addErreur($lErreur);
		}
		if(!isset($pData['idModeleLotSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getIdModeleLotSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdModeleLotSolidaire()->addErreur($lErreur);
		}
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['unite'])) {
			$lVr->setValid(false);
			$lVr->getUnite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getUnite()->addErreur($lErreur);	
		}
		if(!isset($pData['quantiteSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getQuantiteSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
		}
		if(!isset($pData['uniteSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getUniteSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getUniteSolidaire()->addErreur($lErreur);	
		}
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);	
		}
		if(!isset($pData['montantSolidaire'])) {
			$lVr->setValid(false);
			$lVr->getMontantSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontantSolidaire()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && !TestFonction::checkLength($pData['quantite'],0,12)) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && !is_float((float)$pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['unite'] != '' && !TestFonction::checkLength($pData['unite'],0,20)) {
				$lVr->setValid(false);
				$lVr->getUnite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getUnite()->addErreur($lErreur);	
			}
			if($pData['quantiteSolidaire'] != '' && !TestFonction::checkLength($pData['quantiteSolidaire'],0,12)) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}
			if($pData['quantiteSolidaire'] != '' && !is_float((float)$pData['quantiteSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}
			if($pData['uniteSolidaire'] != '' && !TestFonction::checkLength($pData['uniteSolidaire'],0,20)) {
				$lVr->setValid(false);
				$lVr->getUniteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getUniteSolidaire()->addErreur($lErreur);	
			}
			if($pData['montant'] != '' && !TestFonction::checkLength($pData['montant'],0,12)) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if($pData['montant'] != '' && !is_float((float)$pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if($pData['montantSolidaire'] != '' && !TestFonction::checkLength($pData['montantSolidaire'],0,12)) {
				$lVr->setValid(false);
				$lVr->getMontantSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontantSolidaire()->addErreur($lErreur);
			}
			if($pData['montantSolidaire'] != '' && !is_float((float)$pData['montantSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getMontantSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontantSolidaire()->addErreur($lErreur);
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
			if($pData['montant'] != '' && empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if($pData['quantite'] != '' && empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if($pData['montantSolidaire'] != '' && empty($pData['quantiteSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);	
			}
			if($pData['quantiteSolidaire'] != '' && empty($pData['montantSolidaire'])) {
				$lVr->setValid(false);
				$lVr->getMontantSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontantSolidaire()->addErreur($lErreur);	
			}
			
			
			if($pData['quantite'] != '' && $pData['quantite'] >= 0) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQuantite()->addErreur($lErreur);
			}
			if($pData['quantiteSolidaire'] != '' && $pData['quantiteSolidaire'] >= 0) {
				$lVr->setValid(false);
				$lVr->getQuantiteSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getQuantiteSolidaire()->addErreur($lErreur);
			}
			if($pData['montant'] != '' && $pData['montant'] >= 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);
			}
			if($pData['montantSolidaire'] != '' && $pData['montantSolidaire'] >= 0) {
				$lVr->setValid(false);
				$lVr->getMontantSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontantSolidaire()->addErreur($lErreur);
			}
			
			$lNomProduitService = new NomProduitService();
			$lNomProduit = $lNomProduitService->get($pData["idNomProduit"]);
			if($lNomProduit->getId() != $pData["idNomProduit"]) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>