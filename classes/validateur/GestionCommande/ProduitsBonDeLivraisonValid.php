<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : ProduitsBonDeLivraisonValid.php
//
// Description : Classe ProduitsBonDeLivraisonValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ProduitsBonDeLivraisonVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitBonDeLivraisonValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");

/**
 * @name ProduitsBonDeLivraisonVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une ProduitsBonDeLivraisonValid
 */
class ProduitsBonDeLivraisonValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitsBonDeLivraisonVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitsBonDeLivraisonVR();
		
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getId_commande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_commande()->addErreur($lErreur);	
		}
		if(!isset($pData['id_compte_ferme'])) {
			$lVr->setValid(false);
			$lVr->getId_producteur()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_producteur()->addErreur($lErreur);	
		}
		if(!isset($pData['produits'])) {
			$lVr->setValid(false);
			$lVr->getProduits()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getProduits()->addErreur($lErreur);	
		}
		if(!isset($pData['typePaiement'])) {
			$lVr->setValid(false);
			$lVr->getTypePaiement()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTypePaiement()->addErreur($lErreur);	
		}
		if(!isset($pData['total'])) {
			$lVr->setValid(false);
			$lVr->getTotal()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getTotal()->addErreur($lErreur);	
		}
		
		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['id_compte_ferme'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_compte_ferme'])) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
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
			if(!TestFonction::checkLength($pData['total'],0,12)) {
				$lVr->setValid(false);
				$lVr->getTotal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTotal()->addErreur($lErreur);	
			}
			if(!is_float((float)$pData['total'])) {
				$lVr->setValid(false);
				$lVr->getTotal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_109_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_109_MSG);
				$lVr->getTotal()->addErreur($lErreur);	
			}
			if($pData['typePaiementChampComplementaire'] != '' && !TestFonction::checkLength($pData['typePaiementChampComplementaire'],0,50)) {
				$lVr->setValid(false);
				$lVr->getTypePaiementChampComplementaire()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getTypePaiementChampComplementaire()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(empty($pData['id_compte_ferme'])) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(empty($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}
			if(empty($pData['typePaiement'])) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			if(empty($pData['total'])) {
				$lVr->setValid(false);
				$lVr->getTotal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getTotal()->addErreur($lErreur);	
			}
			
			if($pData['typePaiement'] <= 0) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_236_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_236_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			if($pData['total'] <= 0) {
				$lVr->setValid(false);
				$lVr->getTotal()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_215_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_215_MSG);
				$lVr->getTotal()->addErreur($lErreur);	
			}
			
			$lCommande = CommandeManager::select($pData['id_commande']);
			if($lCommande->getId() != $pData['id_commande']) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId_commande()->addErreur($lErreur);
			}
			
			$lFerme = FermeManager::selectByIdCompte($pData['id_compte_ferme']);
			if($lFerme[0]->getIdCompte() != $pData['id_compte_ferme']) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			
			$lTypePaiement = TypePaiementVisibleViewManager::select($pData['typePaiement']);
			if($lTypePaiement[0]->getTppId() != $pData['typePaiement']) {
				$lVr->setValid(false);
				$lVr->getTypePaiement()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getTypePaiement()->addErreur($lErreur);	
			}
			
			if(is_array($pData['produits'])) {
				$lValidProduit = new ProduitBonDeLivraisonValid();
				$i = 0;
				while(isset($pData['produits'][$i])) {
					$lVrProduit = $lValidProduit->validAjout($pData['produits'][$i]);	
					if(!$lVrProduit->getValid()){$lVr->setValid(false);}
					$lVr->addProduits($lVrProduit);
					$i++;
				}	
			}
		}	
		return $lVr;
	}

	/**
	* @name validDelete($pData)
	* @return ProduitsBonDeLivraisonVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validDelete($pData) {
		$lVr = new ProduitsBonDeLivraisonVR();
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
	* @return ProduitsBonDeLivraisonVR
	* @desc Test la validite de l'élément
	*/
	/*public static function validUpdate($pData) {
		$lTestId = ProduitsBonDeLivraisonValid::validDelete($pData);
		if($lTestId->getValid()) {
			$lVr = new ProduitsBonDeLivraisonVR();
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(!TestFonction::checkLength($pData['id_producteur'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_producteur'])) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(!is_array($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			if(empty($pData['id_producteur'])) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(empty($pData['produits'])) {
				$lVr->setValid(false);
				$lVr->getProduits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getProduits()->addErreur($lErreur);	
			}
			return $lVr;
		}
		return $lTestId;
	}*/

}