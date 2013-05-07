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
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_VO . "IdAchatVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "ProduitService.php");

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
			$lIdCompteAdherent = $_SESSION[ID_COMPTE];
			$lIdMarche = $pParam["id_commande"];
			
			$lResponse = new AchatAdherentResponse();

			// Récupère les achats
			$lAchatService = new AchatService();
			$lIdAchat = new IdAchatVO();
			$lIdAchat->setIdCompte($lIdCompteAdherent);
			$lIdAchat->setIdCommande($lIdMarche);
			$lAchats = $lAchatService->getAll($lIdAchat);
			$lResponse->setAchats($lAchats);	
			
			// Récupère les informations sur les produits achetés
			$lIdProduits = array();
			
			foreach( $lAchats as $lAchat) {
				foreach($lAchat->getDetailAchat() as $lDetailAchat) {
					array_push($lIdProduits, $lDetailAchat->getIdProduit());
				}
				foreach($lAchat->getDetailAchatSolidaire() as $lDetailAchat) {
					array_push($lIdProduits, $lDetailAchat->getIdProduit());
				}
			}
			
			$lProduitService = new ProduitService();
			$lResponse->setDetailProduit($lProduitService->selectDetailProduits($lIdProduits));
			return $lResponse;
		}
		return $lVr;
	}
}
?>