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
//include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MesAchatsViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/AfficheAchatAdherentValid.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/AchatAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ProduitService.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailAchatManager.php");

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
		$lResponse->setAchats( DetailAchatManager::mesAchats($_SESSION[ID_COMPTE]) );
		return $lResponse;
	}
	
	/**
	* @name getDetail($pParam)
	* @return AchatAdherentResponse
	* @desc Retourne les détails des achats du marché
	*/
	public function getDetail($pParam) {
		$lVr = AfficheAchatAdherentValid::validGetAchat($pParam);
		if($lVr->getValid()) {			
			$lResponse = new AchatAdherentResponse();

			// Récupère les achats
			$lAchatService = new AchatService();
			$lAchat = $lAchatService->get($pParam["idAchat"]);
			$lResponse->setAchats($lAchat);
			
			return $lResponse;
		}
		return $lVr;
	}
}
?>