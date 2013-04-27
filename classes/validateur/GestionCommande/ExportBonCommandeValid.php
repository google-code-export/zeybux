<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : ExportBonCommandeValid.php
//
// Description : Classe ExportBonCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ExportBonCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

/**
 * @name ExportBonCommandeVR
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe représentant une ExportBonCommandeValid
 */
class ExportBonCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return ExportBonCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ExportBonCommandeVR();
		//Tests inputs
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getId_commande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_commande()->addErreur($lErreur);	
		}
		if(!isset($pData['idCompteFerme'])) {
			$lVr->setValid(false);
			$lVr->getIdCompteFerme()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdCompteFerme()->addErreur($lErreur);	
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
			if(!TestFonction::checkLength($pData['idCompteFerme'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdCompteFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdCompteFerme()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['idCompteFerme'])) {
				$lVr->setValid(false);
				$lVr->getId_producteur()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdCompteFerme()->addErreur($lErreur);	
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
			if(empty($pData['idCompteFerme'])) {
				$lVr->setValid(false);
				$lVr->getIdCompteFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdCompteFerme()->addErreur($lErreur);	
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
			
			$lFerme = FermeManager::selectByIdCompte($pData['idCompteFerme']);
			if($lFerme[0]->getIdCompte() != $pData['idCompteFerme']) {
				$lVr->setValid(false);
				$lVr->getIdCompteFerme()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getIdCompteFerme()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
}
?>