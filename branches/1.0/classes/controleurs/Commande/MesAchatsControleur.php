<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsControleur.php
//
// Description : Classe MesAchatsControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/MesAchatsResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MesAchatsViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/AchatAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");

/**
 * @name MesAchatsControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une MesAchats
 */
class MesAchatsControleur
{	
	/**
	* @name getListe()
	* @return MesAchatsResponse
	* @desc Retourne la liste des achats
	*/
	public function getListe() {		
		$lResponse = new MesAchatsResponse();
		$lResponse->setAchats( MesAchatsViewManager::select($_SESSION[ID_COMPTE]) );
		return $lResponse;
	}
	
	/**
	* @name getDetail($pParam)
	* @return AchatAdherentResponse
	* @desc Retourne les détails des achats du marché
	*/
	public function getDetail($pParam) {
		$lVr = AfficheAchatAdherentValid::validGetAchatEtReservation($pParam);
		if($lVr->getValid()) {
			//$lIdAdherent = $_SESSION[ID_COMPTE];
			$lIdCommande = $pParam["id_commande"];
			
			$lResponse = new AchatAdherentResponse();
			
			/*$lAdherent = AdherentViewManager::select($lIdAdherent);
			$lResponse->setAdherent($lAdherent);*/
			
			$lMarcheService = new MarcheService();
			$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));

			/*$lReservationService = new ReservationService();
			$lIdReservation = new IdReservationVO();
			$lIdReservation->setIdCompte($lAdherent->getAdhIdCompte());
			$lIdReservation->setIdCommande($pParam["id_commande"]);
			$lResponse->setReservation($lReservationService->get($lIdReservation));	*/

			$lAchatService = new AchatService();
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($_SESSION[ID_COMPTE]);
			$lIdAchat->setIdCommande($pParam["id_commande"]);
			$lResponse->setAchats($lAchatService->getAll($lIdAchat));	
			
			$lStockSolidaire = StockSolidaireViewManager::selectLivraisonSolidaire($pParam["id_commande"]);
			$lResponse->setStockSolidaire($lStockSolidaire);	
			return $lResponse;
		}
		return $lVr;
	}
}
?>