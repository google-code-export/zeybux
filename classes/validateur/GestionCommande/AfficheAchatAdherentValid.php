<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2011
// Fichier : AfficheAchatAdherentValid.php
//
// Description : Classe AfficheAchatAdherentValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/AfficheAchatAdherentVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/SupprimerAchatAdherentVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ModifierAchatAdherentVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/MarcheDetailAchatValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");

/**
 * @name AfficheReservationAdherentVR
 * @author Julien PIERRE
 * @since 06/02/2011
 * @desc Classe représentant une AfficheAchatAdherentValid
 */
class AfficheAchatAdherentValid
{
	/**
	* @name validAjout($pData)
	* @return AfficheAchatAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetAchatEtReservation($pData) {
		$lVr = new AfficheAchatAdherentVR();
		//Tests inputs
		if(!isset($pData['id_adherent'])) {
			$lVr->setValid(false);
			$lVr->getId_adherent()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_adherent()->addErreur($lErreur);	
		}
		if(!isset($pData['id_marche'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);	
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
			if(!TestFonction::checkLength($pData['id_adherent'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['id_marche'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			if($pData['id_marche'] != '' && !is_int((int)$pData['id_marche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idOperation'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);	
			}
			if($pData['idOperation'] != '' && !is_int((int)$pData['idOperation'])) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_adherent'])) {
				$lVr->setValid(false);
				$lVr->getId_adherent()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_adherent()->addErreur($lErreur);	
			}
			
			// Si ce n'est pas le compte invite : vérification que l'achérent existe
			if($pData['id_adherent'] != -3) {
				$lAdherent = AdherentManager::select($pData['id_adherent']);
				if($lAdherent->getId() != $pData['id_adherent']) {
					$lVr->setValid(false);
					$lVr->getId_adherent()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getId_adherent()->addErreur($lErreur);	
				}
			}
			
			if($pData['id_marche'] != '') {
				$lCommande = CommandeManager::select($pData['id_marche']);
				if($lCommande->getId() != $pData['id_marche']) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);
				}
			}
			
			$lOperationService = new OperationService();
			if($pData['idOperation'] != '' && !$lOperationService->existe($pData['idOperation'])) {
				$lVr->setValid(false);
				$lVr->getIdOperation()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdOperation()->addErreur($lErreur);				
			}
		}
		return $lVr;
	}
	
	/**
	* @name validAjoutAchat($pData)
	* @return AfficheAchatAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjoutAchat($pData) {
		$lVr = new ModifierAchatAdherentVR();
		//Tests inputs
		if(!isset($pData['idMarche'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_int((int)$pData['idMarche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
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
			$lCommande = CommandeManager::select($pData['idMarche']);
			if($lCommande->getId() != $pData['idMarche']) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			if(empty($pData['idMarche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
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

			if($lVr->getValid()) {
				foreach($pData['produits'] as $lProduit) {
					$lProduit['idCommande'] = $pData['idMarche'];
					$lVrDetail = MarcheDetailAchatValid::validAjout($lProduit);
					if(!$lVrDetail->getValid()){$lVr->setValid(false);}
					$lVr->addProduits($lVrDetail);
				}
			}
		}
		return $lVr;
	}
	
	/**
	* @name validModifierAchat($pData)
	* @return ModifierAchatAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validModifierAchat($pData) {
		$lVr = new ModifierAchatAdherentVR();
		//Tests inputs
		if(!isset($pData["achat"])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			$pData = $pData["achat"];
			if(!isset($pData['idAchat'])) {
				$lVr->setValid(false);
				$lVr->getIdAchat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdAchat()->addErreur($lErreur);	
			}
		/*	if(!isset($pData['total'])) {
				$lVr->setValid(false);
				$lVr->getTotal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTotal()->addErreur($lErreur);	
			}*/
			if(!isset($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getLog()->addErreur($lErreur);	
			}
	
			if($lVr->getValid()) {
				//Tests Techniques
				if(!TestFonction::checkLength($pData['idAchat'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdAchat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdAchat()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['idAchat'])) {
					$lVr->setValid(false);
					$lVr->getIdAchat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdAchat()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['idAchat'],0,12)) {
					$lVr->setValid(false);
					$lVr->getTotal()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getTotal()->addErreur($lErreur);	
				}
			/*	if(!is_float((float)$pData['total'])) {
					$lVr->setValid(false);
					$lVr->getTotal()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getTotal()->addErreur($lErreur);	
				}*/
				if(!is_array($pData['produits'])) {
					$lVr->setValid(false);
					$lVr->getProduits()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
					$lVr->getProduits()->addErreur($lErreur);	
				}
			
				//Tests Fonctionnels
				if(empty($pData['idAchat'])) {
					$lVr->setValid(false);
					$lVr->getIdAchat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdAchat()->addErreur($lErreur);	
				}
		/*		if(empty($pData['total'])) {
					$lVr->setValid(false);
					$lVr->getTotal()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getTotal()->addErreur($lErreur);	
				}*/
				if(empty($pData['produits'])) {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getLog()->addErreur($lErreur);	
				}
				
				if($lVr->getValid()) {
				/*	if($pData['total'] > 0) {
						$lVr->setValid(false);
						$lVr->getTotal()->setValid(false);
						$lErreur = new VRerreur();
						$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
						$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
						$lVr->getTotal()->addErreur($lErreur);
					}*/

					$lOperationService = new OperationService();
					$lOperation = $lOperationService->get($pData['idAchat']);
					
					if(!is_null($lOperation->getId())) {
						foreach($pData['produits'] as $lProduit) {
							$lProduit['idCommande'] = $lOperation->getIdCommande();
							$lVrDetail = MarcheDetailAchatValid::validAjout($lProduit);
							if(!$lVrDetail->getValid()){$lVr->setValid(false);}
							$lVr->addProduits($lVrDetail);
						}
					}
				}			
			}
		}
		return $lVr;
	}

	/**
	* @name validSupprimerAchat($pData)
	* @return SupprimerAchatAdherentVR
	* @desc Test la validite de l'élément
	*/
	public static function validSupprimerAchat($pData) {
		$lVr = new SupprimerAchatAdherentVR();
		//Tests inputs
		if(!isset($pData['idAchat'])) {
			$lVr->setValid(false);
			$lVr->getIdAchat()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdAchat()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['idAchat'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdAchat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdAchat()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idAchat'])) {
				$lVr->setValid(false);
				$lVr->getIdAchat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdAchat()->addErreur($lErreur);	
			}
		
			//Tests Fonctionnels
			if(empty($pData['idAchat'])) {
				$lVr->setValid(false);
				$lVr->getIdAchat()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdAchat()->addErreur($lErreur);	
			}
			
			if($lVr->getValid()) {
				$lOperationService = new OperationService();
				$lOperation = $lOperationService->get($pData['idAchat']);
				if(is_null($lOperation->getId()) || ($lOperation->getTypePaiement() != 7 && $lOperation->getTypePaiement() != 8)) {
					$lVr->setValid(false);
					$lVr->getIdAchat()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdAchat()->addErreur($lErreur);	
				}
			}			
		}
		return $lVr;
	}

}
?>