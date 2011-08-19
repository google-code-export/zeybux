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
			if(!is_int((int)$pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_104_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_104_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}

			//Tests Fonctionnels
			if(empty($pData['id_commande'])) {
				$lVr->setValid(false);
				$lVr->getIdCommande()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_207_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_207_MSG);
				$lVr->getIdCommande()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
}