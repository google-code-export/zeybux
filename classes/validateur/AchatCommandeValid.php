<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : AchatCommandeValid.php
//
// Description : Classe AchatCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "AchatCommandeVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ProduitAchatValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "RechargementCompteValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");

/**
 * @name AchatCommandeVR
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une AchatCommandeValid
 */
class AchatCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return AchatCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new AchatCommandeVR();
		//Tests Techniques
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
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
		if(!is_array($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		} else {
			$lNbProduit = 0;
			$lProduitValid = new ProduitAchatValid();
			foreach($pData['produits'] as $lProduit) {
				$lVrProduit = $lProduitValid->validAjout($lProduit);
				if(!$lVrProduit->getValid()) {$lVr->setValid(false);}
				$lVr->addProduits($lVrProduit);
								
				if($lProduit['quantite'] != 0 && !empty($lProduit['quantite'])) {$lNbProduit++;}
			}
			if($lNbProduit == 0) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getProduits()->addErreur($lErreur);
			}
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
		$lCommande = CommandeManager::select($pData['id']);
		if($lCommande->getId() != $pData['id']) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		
		if(empty($pData['idCompte'])) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}
		$lAdherent = AdherentViewManager::selectByIdCompte($pData['idCompte']);
		if($lAdherent[0]->getAdhIdCompte() != $pData['idCompte']) {
			$lVr->setValid(false);
			$lVr->getIdCompte()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getIdCompte()->addErreur($lErreur);	
		}		
		
		if(empty($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}		
		if(!empty($pData['rechargement']['montant']) && $pData['rechargement']['montant'] != 0) {
			$lValidRechargement = new RechargementCompteValid();
			$lVr->setRechargement($lValidRechargement->validAjout($pData['rechargement']));
			if(!$lVr->getRechargement()->getValid()) {$lVr->setValid(false);}
		}	
		
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return AchatCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validDelete($pData) {
		$lVr = new AchatCommandeVR();
		if(!is_int((int)$pData['id'])) {
			$lVr->setValid(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
			$lVr->getId()->addErreur($lErreur);	
		}
		return $lVr;
	}

	/**
	* @name validUpdate($pData)
	* @return AchatCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validUpdate($pData) {
		$lTestId = TestFonction::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new AchatCommandeVR();
			//Tests Techniques
			if(!is_int((int)$pData['id'])) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getId()->addErreur($lErreur);	
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
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			} else {
				$lNbProduit = 0;
				$lProduitValid = new ProduitAchatValid();
				foreach($pData['produits'] as $lProduit) {
					$lVrProduit = $lProduitValid->validAjout($lProduit);
					if(!$lVrProduit->getValid()) {$lVr->setValid(false);}
					$lVr->addProduits($lVrProduit);
									
					if($lProduit['quantite'] != 0 && !empty($lProduit['quantite'])) {$lNbProduit++;}
				}
				if($lNbProduit == 0) {
					$lVr->setValid(false);
					$lVr->getProduits()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
					$lVr->getProduits()->addErreur($lErreur);
				}
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
			$lCommande = CommandeManager::select($pData['id']);
			if($lCommande->getId() != $pData['id']) {
				$lVr->setValid(false);
				$lVr->getId()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId()->addErreur($lErreur);	
			}
			
			if(empty($pData['idCompte'])) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}
			$lAdherent = AdherentViewManager::selectByIdCompte($pData['idCompte']);
			if($lAdherent[0]->getAdhIdCompte() != $pData['idCompte']) {
				$lVr->setValid(false);
				$lVr->getIdCompte()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdCompte()->addErreur($lErreur);	
			}	
			if(empty($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}		
			if(!empty($pData['rechargement']['montant']) && $pData['rechargement']['montant'] != 0) {
				$lValidRechargement = new RechargementCompteValid();
				$lVr->setRechargement($lValidRechargement->validAjout($pData['rechargement']));
				if(!$lVr->getRechargement()->getValid()) {$lVr->setValid(false);}
			}	
			
			return $lVr;
		}
		return $lTestId;
	}

}