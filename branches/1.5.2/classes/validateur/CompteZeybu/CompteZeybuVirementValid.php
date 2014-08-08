<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2011
// Fichier : CompteZeybuVirementValid.php
//
// Description : Classe CompteZeybuVirementValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/CompteZeybuAjoutVirementVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/CompteZeybuModifierVirementVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ZEYBU . "/CompteZeybuSupprimerVirementVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );

/**
 * @name CompteZeybuVirementValid
 * @author Julien PIERRE
 * @since 11/08/2011
 * @desc Classe représentant une CompteZeybuVirementValid
 */
class CompteZeybuVirementValid
{
	/**
	* @name validAjout($pData)
	* @return CompteZeybuAjoutVirementVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new CompteZeybuAjoutVirementVR();
		//Tests inputs
		if(!isset($pData['idCptDebit'])) {
			$lVr->setValid(false);
			$lVr->getIdCptDebit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCptDebit()->addErreur($lErreur);	
		}
		if(!isset($pData['idCptCredit'])) {
			$lVr->setValid(false);
			$lVr->getIdCptCredit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCptCredit()->addErreur($lErreur);	
		}
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);	
		}
		if(!isset($pData['type'])) {
			$lVr->setValid(false);
			$lVr->getType()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getType()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['idCptDebit'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCptDebit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCptDebit()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idCptDebit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptDebit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCptDebit()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idCptCredit'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCptCredit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCptCredit()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idCptCredit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptCredit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCptCredit()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['montant'],0,12) || $pData['montant'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['type'],0,1)) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['type'])) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['idCptDebit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptDebit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCptDebit()->addErreur($lErreur);	
			}
			if(empty($pData['idCptCredit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptCredit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCptCredit()->addErreur($lErreur);	
			}
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(empty($pData['type'])) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}
			
			$lCompteService = new CompteService(); // Les comtpes doivent exister
			if(!$lCompteService->existe($pData['idCptDebit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptDebit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
				$lVr->getIdCptDebit()->addErreur($lErreur);	
			}
			if(!$lCompteService->existe($pData['idCptCredit'])) {
				$lVr->setValid(false);
				$lVr->getIdCptCredit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
				$lVr->getIdCptCredit()->addErreur($lErreur);	
			}
			
			// Montant positif
			if($pData['montant'] <= 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			
			// Le type de virement doit être valide
			if($pData['type'] != 1 && $pData['type'] != 2) {
				$lVr->setValid(false);
				$lVr->getType()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_240_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_240_MSG);
				$lVr->getType()->addErreur($lErreur);	
			}
			
		}
		return $lVr;
	}
	
	/**
	* @name validUpdate($pData)
	* @return CompteZeybuModifierVirementVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = new CompteZeybuModifierVirementVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
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
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['montant'],0,12) || $pData['montant'] > 999999999.99) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if($pData['montant'] <= 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				$lCompteService = new CompteService();
				/*if(!$lCompteService->existe($pData['id'])) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}*/
				
				$lOperationService = new OperationService();			
				$lOperation = $lOperationService->getDetail($pData['id']);
				
				$lOpeChampComp = $lOperation->getChampComplementaire();
				if($lOperation->getTypePaiement() == 3 || $lOperation->getTypePaiement() == 9) {
					$lOperationSoeur = $lOperationService->getDetail($lOpeChampComp[4]->getValeur());
				} else if($lOperation->getTypePaiement() == 4 || $lOperation->getTypePaiement() == 10) {
					$lOperationSoeur = $lOperationService->getDetail($lOpeChampComp[5]->getValeur());
				}
				
				//$lOperationSoeur = $lOperationService->get($lOperation->getTypePaiementChampComplementaire());
				if(!$lCompteService->existe($lOperationSoeur->getIdCompte())
						|| !$lCompteService->existe($lOperation->getIdCompte())) {
					$lVr->setValid(false);
					$lVr->getId()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
					$lVr->getId()->addErreur($lErreur);	
				}
			}
		}
		return $lVr;
	}
	
	/**
	* @name validDelete($pData)
	* @return CompteZeybuSupprimerVirementVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new CompteZeybuSupprimerVirementVR();
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
			//Tests Techniques
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
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			//Tests Fonctionnels
			if(empty($pData['id'])) {
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
}
?>