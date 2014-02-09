<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/11/2013
// Fichier : AdhesionAdherentValid.php
//
// Description : Classe AdhesionAdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
//include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_ADHESION . "/AdhesionAdherentVR.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdhesionService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
/*include_once(CHEMIN_CLASSES_MANAGERS . "AdhesionManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_ADHESION . "/TypeAdhesionValid.php");*/


/**
 * @name AdhesionAdherentValid
 * @author Julien PIERRE
 * @since 12/11/2013
 * @desc Classe représentant une AdhesionAdherentValid
 */
class AdhesionAdherentValid
{
	/**
	* @name validAjout($pData)
	* @return AdhesionAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new AdhesionAdherentVR();
		//Tests inputs
		if(!isset($pData['idAdherent'])) {
			$lVr->setValid(false);
			$lVr->getIdAdherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdAdherent()->addErreur($lErreur);
		}
		if(!isset($pData['idTypeAdhesion'])) {
			$lVr->setValid(false);
			$lVr->getIdTypeAdhesion()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdTypeAdhesion()->addErreur($lErreur);
		}
		if(!isset($pData['statutFormulaire'])) {
			$lVr->setValid(false);
			$lVr->getStatutFormulaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getStatutFormulaire()->addErreur($lErreur);
		}	
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['idAdherent'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idAdherent'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idTypeAdhesion'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);
			}
			if(!is_int((int)$pData['idTypeAdhesion'])) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);
			}
			if(!TestFonction::checkLength($pData['statutFormulaire'],0,1)) {
				$lVr->setValid(false);
				$lVr->getStatutFormulaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getStatutFormulaire()->addErreur($lErreur);
			}
	
			//Tests Fonctionnels
			if(empty($pData['idAdherent'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);	
			}
			if(empty($pData['idTypeAdhesion'])) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);	
			}		
			
			// Vérifie si l'adhérent existe
			$lAdherentService = new AdherentService();
			if(!$lAdherentService->estActif($pData['idAdherent'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);
			}
			
			// Le type adhésion doit exister et être actif
			$lAdhesionService = new AdhesionService();
			$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($pData['idTypeAdhesion']);
			if($lTypeAdhesion->getEtat() != 0) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);
			}
			
			$lAdherent = $lAdherentService->get($pData['idAdherent']);
			$lCompteService = new CompteService();
			$lNbAdherentSurCompte = $lCompteService->getNombreAdherentSurCompte($lAdherent->getAdhIdCompte());
			$lPerimetreOK = false;
			if($lNbAdherentSurCompte == 1) { // Si seul adhérent sur le compte adhésions sur périmètre adhérent
				$lPerimetreOK = $lTypeAdhesion->getIdPerimetre() == 1;
			} else { // Si plusieurs adhérents uniquement les types adhésion compte
				$lPerimetreOK = $lTypeAdhesion->getIdPerimetre() == 2;
			}
			if(!$lPerimetreOK) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_272_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_272_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);
			}
			
			// Pas de doublon d'adhésion
			if($lAdhesionService->typeAdhesionAdherentExiste($pData['idAdherent'],$pData['idTypeAdhesion'])) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_270_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_270_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);				
			}			
		}
		return $lVr;
	}
	/**
	 * @name validUpdate($pData)
	 * @return AdhesionVR
	 * @desc Test la validite de l'élément
	 */
	public static function validUpdate($pData) {
		$lVr = AdhesionAdherentValid::validDelete($pData);
		if($lVr->getValid()) {
			//Tests inputs
			if(!isset($pData['idAdherent'])) {
				$lVr->setValid(false);
				$lVr->getIdAdherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdAdherent()->addErreur($lErreur);
			}
			if(!isset($pData['idTypeAdhesion'])) {
				$lVr->setValid(false);
				$lVr->getIdTypeAdhesion()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdTypeAdhesion()->addErreur($lErreur);
			}
			if(!isset($pData['statutFormulaire'])) {
				$lVr->setValid(false);
				$lVr->getStatutFormulaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getStatutFormulaire()->addErreur($lErreur);
			}
			if(!isset($pData['idOperation'])) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);
			}
			if($lVr->getValid()) {
				//Tests Techniques
				if(!TestFonction::checkLength($pData['idAdherent'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdAdherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdAdherent()->addErreur($lErreur);
				}
				if(!is_int((int)$pData['idAdherent'])) {
					$lVr->setValid(false);
					$lVr->getIdAdherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
					$lVr->getIdAdherent()->addErreur($lErreur);
				}
				if(!TestFonction::checkLength($pData['idTypeAdhesion'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdTypeAdhesion()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdTypeAdhesion()->addErreur($lErreur);
				}
				if(!is_int((int)$pData['idTypeAdhesion'])) {
					$lVr->setValid(false);
					$lVr->getIdTypeAdhesion()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
					$lVr->getIdTypeAdhesion()->addErreur($lErreur);
				}
				if(!TestFonction::checkLength($pData['statutFormulaire'],0,1)) {
					$lVr->setValid(false);
					$lVr->getStatutFormulaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getStatutFormulaire()->addErreur($lErreur);
				}
				if(!is_int((int)$pData['idOperation'])) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);
				}
				if(!TestFonction::checkLength($pData['idOperation'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);
				}
			
				//Tests Fonctionnels
				if(empty($pData['idAdherent'])) {
					$lVr->setValid(false);
					$lVr->getIdAdherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdAdherent()->addErreur($lErreur);
				}
				if(empty($pData['idTypeAdhesion'])) {
					$lVr->setValid(false);
					$lVr->getIdTypeAdhesion()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdTypeAdhesion()->addErreur($lErreur);
				}
				if(empty($pData['idOperation'])) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);
				}
					
				// Vérifie si l'adhérent existe
				$lAdherentService = new AdherentService();
				if(!$lAdherentService->estActif($pData['idAdherent'])) {
					$lVr->setValid(false);
					$lVr->getIdAdherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdAdherent()->addErreur($lErreur);
				}
					
				// Le type adhésion doit exister et être actif
				$lAdhesionService = new AdhesionService();
				$lTypeAdhesion = $lAdhesionService->getTypeAdhesion($pData['idTypeAdhesion']);
				if($lTypeAdhesion->getEtat() != 0) {
					$lVr->setValid(false);
					$lVr->getIdTypeAdhesion()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdTypeAdhesion()->addErreur($lErreur);
				}	
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return AdhesionAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new AdhesionAdherentVR();
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
			
			// Vérifie si l'adhésion adhérent existe
			$lAdhesionService = new AdhesionService();
			$lAdhesionAdherent = $lAdhesionService->getAdhesionAdherent($pData['id']);
			if($lAdhesionAdherent->getAdhesionAdherent()->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);
			}
		}
		return $lVr;
	}
}
?>