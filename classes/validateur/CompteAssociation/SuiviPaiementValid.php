<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/02/2014
// Fichier : SuiviPaiementValid.php
//
// Description : Classe SuiviPaiementValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ASSOCIATION . "/validerPaiementVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_COMPTE_ASSOCIATION . "/RechargementCompteVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php" );
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ChampComplementaireValid.php");

/**
 * @name SuiviPaiementValid
 * @author Julien PIERRE
 * @since 13/02/2014
 * @desc Classe représentant une SuiviPaiementValid
 */
class SuiviPaiementValid
{
	/**
	* @name validValider($pData)
	* @return validerPaiementVR
	* @desc Test la validite de l'élément
	*/
	public static function validValider($pData) {
		$lVr = new validerPaiementVR();
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
			
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->getDetail($pData['id']);
			if($lOperation->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);					
			}
			if($lOperation->getType() != 0) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			if($lOperation->getIdCompte() != -4) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				$lVr->setData( array('operation' => $lOperation) );
			}
		}
		return $lVr;
	}
		
	/**
	* @name validModifierPaiement($pData)
	* @return RechargementCompteVR
	* @desc Test la validite de l'élément
	*/
	public static function validModifierPaiement($pData) {
		$lVr = new RechargementCompteVR();
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
		if(!isset($pData['champComplementaire'])) {
			$lVr->setValid(false);
			$lVr->getChampComplementaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getChampComplementaire()->addErreur($lErreur);	
		}
		if(!isset($pData['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id'],0, 11)) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_CODE);
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
			if(!TestFonction::checkLength($pData['typePaiement'],0,11)) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			}
			if(!is_array($pData['champComplementaire'])) {
				$lVr->setValid(false);
				$lVr->getChampComplementaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getChampComplementaire()->addErreur($lErreur);
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
			
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pData['id']);
			if($lOperation->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId()->addErreur($lErreur);					
			}
			if($lOperation->getType() != 0) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_227_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_227_MSG);
				$lVr->getId()->addErreur($lErreur);	
				
			}			
			
			$lTypePaiementService = new TypePaiementService();
			$lTypePaiement = $lTypePaiementService->selectVisible($pData['typePaiement']);
			// Il est autorisé d'enregistrer un facture (réception de produit) sans payer.
			if($lTypePaiement->getId() != $pData['typePaiement'] ) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);
			} else {
				$lChampComplementaire = array();
				foreach($pData['champComplementaire'] as $lChamp) {
					if(!is_null($lChamp)) {
						$lObligatoire = NULL;
						foreach($lTypePaiement->getChampComplementaire() as $lChampTypePaiement) {
							if($lChampTypePaiement->getId() == $lChamp['id']) {
								$lObligatoire = $lChampTypePaiement->getObligatoire();
							};
						}
						$lVrChampComplementaire = ChampComplementaireValid::validUpdate($lChamp, $lObligatoire);
						if(!$lVrChampComplementaire->getValid()) {
							$lVr->setValid(false);
						}
						$lChampComplementaire[$lChamp['id']] = $lVrChampComplementaire;
					}
				}
				$lVr->setChampComplementaire($lChampComplementaire);
			}
		}
		return $lVr;
	}
}
?>