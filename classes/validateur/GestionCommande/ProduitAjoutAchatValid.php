<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/04/2013
// Fichier : ProduitAjoutAchatValid.php
//
// Description : Classe ProduitAjoutAchatValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ProduitAjoutAchatVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");

/**
 * @name ProduitAjoutAchatVR
 * @author Julien PIERRE
 * @since 14/04/2013
 * @desc Classe représentant une ProduitAjoutAchatValid
 */
class ProduitAjoutAchatValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitAjoutAchatVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitAjoutAchatVR();
		//Tests inputs
		if(!isset($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		if(!isset($pData['idMarche'])) {
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
		if(!isset($pData['idNomProduit'])) {
			$lVr->setValid(false);
			$lVr->getIdNomProduit()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdNomProduit()->addErreur($lErreur);	
		}
		if(!isset($pData['quantite'])) {
			$lVr->setValid(false);
			$lVr->getQuantite()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getQuantite()->addErreur($lErreur);	
		}
		if(!isset($pData['prix'])) {
			$lVr->setValid(false);
			$lVr->getPrix()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getPrix()->addErreur($lErreur);	
		}
		if(!isset($pData['solidaire'])) {
			$lVr->setValid(false);
			$lVr->getSolidaire()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getSolidaire()->addErreur($lErreur);	
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
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['idMarche'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			if($pData['idMarche'] != '' && !is_int((int)$pData['idMarche'])) {
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
			if(!TestFonction::checkLength($pData['quantite'],0,12)) {
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
			if(!TestFonction::checkLength($pData['prix'],0,12)) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['solidaire'],0,1)) {
				$lVr->setValid(false);
				$lVr->getSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getSolidaire()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['solidaire'])) {
				$lVr->setValid(false);
				$lVr->getSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getSolidaire()->addErreur($lErreur);	
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
			if(empty($pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(empty($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(empty($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if(empty($pData['solidaire'])) {
				$lVr->setValid(false);
				$lVr->getSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getSolidaire()->addErreur($lErreur);	
			}
			
			// Si c'est sur un marché il doit exister est être ouvert
			if(!empty($pData['idMarche'])) {
				$lCommande = CommandeManager::select($pData['idMarche']);
				if($lCommande->getId() != $pData['idMarche']) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);
				}
				// Le marche doit être ouvert
				if($lCommande->getArchive() != 0) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_239_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_239_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);
				}
			}
			
			// Si c'est sur un opération elle doit exister
			if(!empty($pData['idOperation'])) {
				$lOperationService = new OperationService();
				if(!$lOperationService->existe($pData['idOperation'])) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);
				}
			}
			
			// Le compte existe
			$lCompteService = new CompteService();
			if(!$lCompteService->existe($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);
			}
			
			// Le produit existe
			$lNomProduit = NomProduitManager::select($pData['idNomProduit']);
			if($lNomProduit->getId() == null) {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);
			}
			
			// Les quantité sont négatives
			if($pData['quantite'] >= 0) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);
			}
			// Le prix est négatif
			if($pData['prix'] >= 0) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);
			}
		}
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ProduitAjoutAchatVR
	* @desc Test la validite de l'élément
	*/
/*	public static function validDelete($pData) {
		$lVr = new ProduitAjoutAchatVR();
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
	}*/

	/**
	* @name validUpdate($pData)
	* @return ProduitAjoutAchatVR
	* @desc Test la validite de l'élément
	*/
/*	public static function validUpdate($pData) {
		$lTestId = ProduitAjoutAchatValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ProduitAjoutAchatVR();
			//Tests inputs
			if(!isset($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			if(!isset($pData['idMarche'])) {
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
			if(!isset($pData['idNomProduit'])) {
				$lVr->setValid(false);
				$lVr->getIdNomProduit()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdNomProduit()->addErreur($lErreur);	
			}
			if(!isset($pData['quantite'])) {
				$lVr->setValid(false);
				$lVr->getQuantite()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getQuantite()->addErreur($lErreur);	
			}
			if(!isset($pData['prix'])) {
				$lVr->setValid(false);
				$lVr->getPrix()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getPrix()->addErreur($lErreur);	
			}
			if(!isset($pData['solidaire'])) {
				$lVr->setValid(false);
				$lVr->getSolidaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getSolidaire()->addErreur($lErreur);	
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
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdCompte()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['idMarche'],0,11)) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['idMarche'])) {
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
				if(!is_int((int)$pData['idOperation'])) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);	
				}
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
				if(!TestFonction::checkLength($pData['quantite'],0,12)) {
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
				if(!TestFonction::checkLength($pData['prix'],0,12)) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
				if(!is_float((float)$pData['prix'])) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
				if(!TestFonction::checkLength($pData['solidaire'],0,1)) {
					$lVr->setValid(false);
					$lVr->getSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
					$lVr->getSolidaire()->addErreur($lErreur);	
				}
				if(!is_int((int)$pData['solidaire'])) {
					$lVr->setValid(false);
					$lVr->getSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
					$lVr->getSolidaire()->addErreur($lErreur);	
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
				if(empty($pData['idMarche'])) {
					$lVr->setValid(false);
					$lVr->getIdMarche()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdMarche()->addErreur($lErreur);	
				}
				if(empty($pData['idOperation'])) {
					$lVr->setValid(false);
					$lVr->getIdOperation()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdOperation()->addErreur($lErreur);	
				}
				if(empty($pData['idNomProduit'])) {
					$lVr->setValid(false);
					$lVr->getIdNomProduit()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getIdNomProduit()->addErreur($lErreur);	
				}
				if(empty($pData['quantite'])) {
					$lVr->setValid(false);
					$lVr->getQuantite()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getQuantite()->addErreur($lErreur);	
				}
				if(empty($pData['prix'])) {
					$lVr->setValid(false);
					$lVr->getPrix()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getPrix()->addErreur($lErreur);	
				}
				if(empty($pData['solidaire'])) {
					$lVr->setValid(false);
					$lVr->getSolidaire()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
					$lVr->getSolidaire()->addErreur($lErreur);	
				}
			}
			return $lVr;
		}
		return $lTestId;
	}*/

}?>