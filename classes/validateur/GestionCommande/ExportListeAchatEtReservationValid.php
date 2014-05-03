<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/05/2014
// Fichier : ExportListeAchatEtReservationValid.php
//
// Description : Classe ExportListeAchatEtReservationValid
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . MOD_GESTION_COMMANDE . "/ExportListeAchatEtReservationVR.php" );

/**
 * @name ExportListeReservationVR
 * @author Julien PIERRE
 * @since 02/05/2014
 * @desc Classe représentant une ExportListeAchatEtReservationValid
 */
class ExportListeAchatEtReservationValid
{
	/**
	* @name validAjout($pData)
	* @return ExportListeAchatEtReservationVR
	* @desc Test la validite de l'élément
	*/
	public static function validAjout($pData) {
		$lVr = new ExportListeAchatEtReservationVR();
		//Tests inputs
		if(!isset($pData['id_produits'])) {
			$lVr->getId_produits(false);
			$lVr->getId()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getId_produits()->addErreur($lErreur);	
		}
		if($lVr->getValid()) {
			//Tests Techniques
			if(!is_array($pData['id_produits'])) {
				$lVr->setValid(false);
				$lVr->getId_produits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_110_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_110_MSG);
				$lVr->getId_produits()->addErreur($lErreur);	
			}
	
			//Tests Fonctionnels
			if(empty($pData['id_produits'])) {
				$lVr->setValid(false);
				$lVr->getId_produits()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_233_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_233_MSG);
				$lVr->getId_produits()->addErreur($lErreur);	
			}
		}
		return $lVr;
	}
}
?>