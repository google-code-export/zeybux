<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/07/2011
// Fichier : EditerCommandeValid.php
//
// Description : Classe EditerCommandeValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/InfoCommandeVR.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name EditerCommandeValid
 * @author Julien PIERRE
 * @since 24/07/2011
 * @desc Classe représentant une EditerCommandeValid
 */
class EditerCommandeValid
{
	/**
	* @name validGetReservation($pData)
	* @return CommandeReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validGetInfoCommande($pData) {
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
			if(!is_int((int)$pData['id_marche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdMarche()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_marche'])) {
				$lVr->setValid(false);
				$lVr->getIdMarche()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
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