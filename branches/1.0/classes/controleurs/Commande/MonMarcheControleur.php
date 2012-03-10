<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MonMarcheControleur.php
//
// Description : Classe MonMarcheControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/MonMarcheResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
//include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MarcheListeReservationViewManager.php");

/**
 * @name MonMarcheControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une MonMarche
 */
class MonMarcheControleur
{	
	/**
	* @name getListe()
	* @return MonMarcheResponse
	* @desc Retourne la liste des Marchés et réservations en cours
	*/
	public function getListe() {		
		$lResponse = new MonMarcheResponse();		
		//$lResponse->setReservations(MarcheListeReservationViewManager::select($_SESSION[ID_COMPTE]));
		$lMarcheService = new MarcheService();
		$lResponse->setMarches( $lMarcheService->getNonAchatParCompte($_SESSION[ID_COMPTE]) );
		
		
		
		return $lResponse;
	}
}
?>