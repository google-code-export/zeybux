<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : OperationDetailValid.php
//
// Description : Classe OperationDetailValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_CAISSE . "/OperationDetailVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "TypePaiementService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ChampComplementaireValid.php");

/**
 * @name OperationDetailVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une OperationDetailValid
 */
class OperationDetailValid
{
	/**
	* @name validAjout($pData)
	* @return OperationDetailVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData, $pParam = array("negatif" => false)) {
		$lVr = new OperationDetailVR();
		//Tests inputs
		if(!isset($pData['id'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);
		}		
		if(!isset($pData['montant'])) {
			$lVr->setValid(false);
			$lVr->getMontant()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getMontant()->addErreur($lErreur);
		}
		if(!isset($pData['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);
		}
		if(!isset($pData['champComplementaire'])) {
			$lVr->setValid(false);
			$lVr->getChampComplementaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getChampComplementaire()->addErreur($lErreur);
		}
		if($lVr->getValid()) {
			//Tests Techniques
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
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
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
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
			// Le compte doit exister
			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}	
			
			if(empty($pData['montant'])) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if($pParam["negatif"] && $pData['montant'] > 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_267_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_267_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(!$pParam["negatif"] && $pData['montant'] < 0) {
				$lVr->setValid(false);
				$lVr->getMontant()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getMontant()->addErreur($lErreur);	
			}
			if(empty($pData['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			
			$lTypePaiementService = new TypePaiementService();
			$lTypePaiement = $lTypePaiementService->selectDetail($pData['typePaiement']);
			
			if($lTypePaiement->getId() != $pData['typePaiement']) {
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

	/**
	* @name validDelete($pData)
	* @return OperationDetailVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new OperationDetailVR();
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
	* @return OperationDetailVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lVr = OperationDetailValid::validDelete($pData);
		if($lVr->getValid()) {
			return OperationDetailValid::validAjout($pData);
		}
		return $lVr;
	}

}
?>