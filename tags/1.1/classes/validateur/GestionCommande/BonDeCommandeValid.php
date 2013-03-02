<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 30/07/2011
// Fichier : BonDeCommandeValid.php
//
// Description : Classe BonDeCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/InfoCommandeVR.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/GetListeProduitCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name ProduitsBonDeCommandeVR
 * @author Julien PIERRE
 * @since 30/07/2011
 * @desc Classe représentant une BonDeCommandeValid
 */
class BonDeCommandeValid
{
	/**
	* @name validGetInfoCommande($pData)
	* @return InfoCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetInfoCommande($pData) {
		$lVr = new InfoCommandeVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getIdCommande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCommande()->addErreur($lErreur);	
		}
			
		if($lVr->getValid()) {	
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id_commande'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}
			
			$lCommande = CommandeManager::select($pData['id_commande']);
			if($lCommande->getId() != $pData['id_commande']) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}
		}		
		return $lVr;
	}
	
	/**
	* @name validGetListeProduitCommande($pData)
	* @return GetListeProduitCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetListeProduitCommande($pData) {
		$lVr = new GetListeProduitCommandeVR();
		//Tests inputs
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
			$lVr->getId_CompteProducteur()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_CompteProducteur()->addErreur($lErreur);	
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
				$lVr->getId_CompteProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getId_CompteProducteur()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_compte_ferme'])) {
				$lVr->setValid(false);
				$lVr->getId_CompteProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getId_CompteProducteur()->addErreur($lErreur);	
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
				$lVr->getId_CompteProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_CompteProducteur()->addErreur($lErreur);	
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
				$lVr->getId_CompteProducteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getId_CompteProducteur()->addErreur($lErreur);	
			}
		}		
		return $lVr;
	}
}
?>