<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/02/2011
// Fichier : InfoCommandeValid.php
//
// Description : Classe InfoCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR  . MOD_GESTION_COMMANDE . "/InfoCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php" );

/**
 * @name InfoCommandeVR
 * @author Julien PIERRE
 * @since 27/02/2011
 * @desc Classe représentant une InfoCommandeValid
 */
class InfoCommandeValid
{
	/**
	* @name validAjout($pData)
	* @return InfoCommandeVR
	* @desc Test la validite de l'élément
	*/
	public static function get($pData) {
		$lVr = new InfoCommandeVR();
		//Tests inputs
		if(!isset($pData['id_marche'])) {
			$lVr->setValid(false);
			$lVr->getIdMarche()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getIdMarche()->addErreur($lErreur);	
		}

		if($lVr->getValid()) {
			//Tests Techniques
			if(!TestFonction::checkLength($pData['id_marche'],0,11)) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_101_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_101_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			if(!is_int((int)$pData['id_marche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['id_marche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}
			
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
		return $lVr;
	}
}
?>