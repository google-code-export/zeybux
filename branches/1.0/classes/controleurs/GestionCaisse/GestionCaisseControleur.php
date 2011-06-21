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
}
?>
