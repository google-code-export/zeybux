<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/06/2011
// Fichier : GestionCaisseControleur.php
//
// Description : Classe GestionCaisseControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "EtatCaisseResponse.php" );
//include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );

/**
 * @name GestionCaisseControleur
 * @author Julien PIERRE
 * @since 21/06/2011
 * @desc Classe controleur d'une GestionCaisseControleur
 */
class GestionCaisseControleur
{		
	/**
	* @name getEtatCaisse()
	* @return CaisseListeCommandeResponse
	* @desc Retourne la liste des commandes en cours
	*/
	public function getEtatCaisse() {
		$lResponse = new EtatCaisseResponse();
		$lIde = IdentificationManager::selectByType(3);
		$lResponse->setEtat($lIde[0]->getAutorise());
		return $lResponse;
	}
	
	/**
	* @name fermerCaisse()
	* @return VR
	* @desc Ferme les caisses
	*/
	public function fermerCaisse() {
		$lIde = IdentificationManager::selectByType(3);
		
		if(is_array($lIde)) {
			foreach($lIde as $lCaisse) {
				$lCaisse->setAutorise(0);
				IdentificationManager::update($lCaisse);
			}
			
			$lVr = new TemplateVR();
			$lVr->setValid(true);	
			return $lVr;
		}
		
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
		$lVr->getLog()->addErreur($lErreur);	
		return $lVr;
	}
	
	/**
	* @name ouvrirCaisse()
	* @return VR
	* @desc Ouvre les caisses
	*/
	public function ouvrirCaisse() {
		$lIde = IdentificationManager::selectByType(3);
		
		if(is_array($lIde)) {
			foreach($lIde as $lCaisse) {
				$lCaisse->setAutorise(1);
				IdentificationManager::update($lCaisse);
			}
			
			$lVr = new TemplateVR();
			$lVr->setValid(true);	
			return $lVr;
		}
		
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_115_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_115_MSG);
		$lVr->getLog()->addErreur($lErreur);	
		return $lVr;
	}
}
?>
