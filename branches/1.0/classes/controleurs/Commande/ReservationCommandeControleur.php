<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/03/2010
// Fichier : ReservationCommandeControleur.php
//
// Description : Classe ReservationCommandeControleur
//
//****************************************************************

// Inclusion des classes
/*include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
//include_once(CHEMIN_CLASSES_RESPONSE . "AfficherReservationCommandeResponse.php" );

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");


include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );
include_once(CHEMIN_CLASSES_UTILS . "TestFonction.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ListeReservationCommandeValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");*/
//include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");



include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_COMMANDE . "/DetailMarcheResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_COMMANDE . "/CommandeReservationValid.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");

include_once(CHEMIN_CLASSES_VO . "ReservationVO.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");


/**
 * @name ReservationCommandeControleur
 * @author Julien PIERRE
 * @since 31/03/2010
 * @desc Classe controleur d'une ReservationCommande
 */
class ReservationCommandeControleur
{
	
	/**
	* @name getReservation($pParam)
	* @return AfficherReservationResponse
	* @desc Retourne les détails d'une réservation et de la commande
	*/
	public function getReservation($pParam) {
		$lResponse = new DetailMarcheResponse();
		$lMarcheService = new MarcheService();
		$lResponse->setMarche($lMarcheService->get($pParam["id_commande"]));
		$lResponse->setAdherent(AdherentViewManager::select($_SESSION[DROIT_ID]));
		return $lResponse;
		
		/* TODO
		 * 1 : Test si le compte n'a pas déjà une réservation
		 * 2 : MarcheService -> get(id_commande) 
		 * */
		
		
		
		
		/*$lIdCompte = $pParam["id_compte"];
		$lIdCommande = $pParam["id_commande"];
		$lIdAdherent = $pParam["id_adherent"];		
				
		$lVr = new TemplateVR();
		
		if(!is_int((int)$lIdCommande)) {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
		}
		if(empty($lIdCommande)) {			
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_201_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_201_MSG);
			$lVr->getLog()->addErreur($lErreur);
		}		
		if(!$lVr->getvalid()) {return $lVr;}
		
		$lResponse = new AfficherReservationCommandeResponse();
		$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);
		if($lCommande[0]->getComId() == $lIdCommande) {
			if(TestFonction::dateTimeEstPLusGrandeEgale($lCommande[0]->getComDateFinReservation(),StringUtils::dateTimeAujourdhuiDb())) {
				$lReservation = ReservationViewManager::selectAchat($lIdCommande,$lIdCompte);
				if($lReservation[0]->getComId() == NULL) {					
					$lAdherent = AdherentViewManager::select($lIdAdherent);
					$lStock = StockProduitViewManager::selectByIdCommande($lIdCommande);
							
					$lResponse->setCommande($lCommande);
					$lResponse->setStock($lStock);
					$lResponse->setAdherent($lAdherent);
					
					return $lResponse;
				} else {
					$lVr->setValid(false);
					$lVr->getLog()->setValid(false);
					$lErreur = new VRerreur();
					$lErreur->setCode(MessagesErreurs::ERR_220_CODE);
					$lErreur->setMessage(MessagesErreurs::ERR_220_MSG);
					$lVr->getLog()->addErreur($lErreur);
					return $lVr;
				}
			} else {
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_221_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_221_MSG);
				$lVr->getLog()->addErreur($lErreur);
				return $lVr;
			}
		} else {
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
			$lVr->getLog()->addErreur($lErreur);
			return $lVr;
		}*/
	}
	
	/**
	* @name enregistrerReservation($pParam)
	* @return ListeReservationCommandeVR
	* @desc Met à jour une réservation
	*/
	public function enregistrerReservation($pParam) {		
		$lVr = CommandeReservationValid::validAjout($pParam); // TODO tester pas déjà une réservation

		if($lVr->getValid()) {
			$lIdLot = $pParam["detailReservation"][0]["stoIdDetailCommande"];
			$lDetailMarche = DetailMarcheViewManager::selectByLot($lIdLot);
			
			//$lMarcheService = new MarcheService();
			//$lMarche = $lMarcheService->get($lDetailMarche[0]->getComId());
			
			$lReservation = new ReservationVO();
			$lReservation->getId()->setIdCompte($_SESSION[ID_COMPTE]);
			$lReservation->getId()->setIdCommande($lDetailMarche[0]->getComId());
			
			foreach($pParam["detailReservation"] as $lDetail){
				$lDetailCommande = DetailCommandeManager::select($lDetail["stoIdDetailCommande"]);				
				$lPrix = $lDetail["stoQuantite"] / $lDetailCommande->getTaille() * $lDetailCommande->getPrix();
				
				
				$lDetailReservation = new DetailReservationVO();
				
				$lDetailReservation->setIdDetailCommande($lDetail["stoIdDetailCommande"]);
				$lDetailReservation->setQuantite($lDetail["stoQuantite"]);
				$lDetailReservation->setMontant($lPrix);
				
				$lReservation->addDetailReservation($lDetailReservation);
			}
						
			$lReservationService = new ReservationService();
			$lIdOperation = $lReservationService->set($lReservation);
			
			// TODO si $lIdOperation est null -> afficher l'erreur.
		}				
		return $lVr;
	}
}
?>