<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/01/2011
// Fichier : ExportBonLivraisonValid.php
//
// Description : Classe ExportBonLivraisonValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ExportBonLivraisonVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name ExportBonLivraisonVR
 * @author Julien PIERRE
 * @since 26/01/2011
 * @desc Classe représentant une ExportBonLivraisonValid
 */
class ExportBonLivraisonValid
{
	/**
	* @name validAjout($pData)
	* @return ExportBonLivraisonVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ExportBonLivraisonVR();
		if(!isset($pData['id_commande'])) {
			$lVr->setValid(false);
			$lVr->getId_commande()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_commande()->addErreur($lErreur);	
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
	
			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getId_commande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getId_commande()->addErreur($lErreur);	
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
		}
		return $lVr;
	}
}