<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/01/2011
// Fichier : ProduitsBonDeCommandeValid.php
//
// Description : Classe ProduitsBonDeCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ProduitsBonDeCommandeVR.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitBonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name ProduitsBonDeCommandeVR
 * @author Julien PIERRE
 * @since 18/01/2011
 * @desc Classe représentant une ProduitsBonDeCommandeValid
 */
class ProduitsBonDeCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ProduitsBonDeCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ProduitsBonDeCommandeVR();

		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getId_commande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_commande()->addErreur($lErreur);	
		}
		if(!isset($pData['id_compte_producteur'])) {
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
			if(!TestFonction::checkLength($pData['id_compte_producteur'],0,11)) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_compte_producteur'])) {
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
			if(empty($pData['id_compte_producteur'])) {
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
			
			$lCommande = CommandeManager::select($pData['id_commande']);
			if($lCommande->getId() != $pData['id_commande']) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
			}
			
			$lProducteur = ProducteurManager::selectByIdCompte($pData['id_compte_producteur']);
			if($lProducteur[0]->getIdCompte() != $pData['id_compte_producteur']) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId_producteur()->addErreur($lErreur);	
			}
			
			if(is_array($pData['produits'])) {
				$lValidProduit = new ProduitBonDeCommandeValid();
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
}