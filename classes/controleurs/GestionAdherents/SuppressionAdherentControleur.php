<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/02/2010
// Fichier : SuppressionAdherentControleur.php
//
// Description : Classe SuppressionAdherentControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_ADHERENTS . "/AdherentValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/AjoutAdherentResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MailingListeService.php");

/**
 * @name SuppressionAdherentControleur
 * @author Julien PIERRE
 * @since 02/02/2010
 * @desc Classe controleur d'une Suppression d'adherent
 */
class SuppressionAdherentControleur
{
	/**
	* @name supprimerAdherent($pParam)
	* @desc Passe l'adhérent en état supprimé
	*/
	public function supprimerAdherent($pParam) {				
		$lVr = AdherentValid::validDelete($pParam);
		if($lVr->getValid()) {
			$lIdAdherent = $pParam['id'];
			$lAdherentService = new AdherentService();
			$lAdherentService->delete($lIdAdherent);
			
			$lResponse = new AjoutAdherentResponse();
			$lResponse->setId($lIdAdherent);
			return $lResponse;						
		}	
		return $lVr;
		
		/*$lId = $pParam['id_adherent'];		
		$lAdherent = AdherentManager::select( $lId );
			
		// Change l'état
		$lAdherent->setEtat(2);
		AdherentManager::update( $lAdherent );
		
		$lIdentification = IdentificationManager::selectByIdType($lAdherent->getId(),1);
		$lIdentification = $lIdentification[0];
		$lIdentification->setAutorise( 0 );
		IdentificationManager::update( $lIdentification );
		
		// Suppression des réservations en cours
		$lReservationService = new ReservationService();
		$lReservations = MarcheListeReservationViewManager::select($lAdherent->getIdCompte());
		if(!is_null($lReservations[0]->getComId())) {
			foreach($lReservations as $lReservation) {
				$lIdReservation = new IdReservationVO();
				$lIdReservation->setIdCompte($lAdherent->getIdCompte());
				$lIdReservation->setIdCommande($lReservation->getComId());
				$lReservationService->delete($lIdReservation);
			}
		}
		
		//Désinscription de la mailing liste
		$lMailingListeService = new MailingListeService();
		if($lAdherent->getCourrielPrincipal() != "") {
			$lMailingListeService->delete($lAdherent->getCourrielPrincipal());	
		}
		if($lAdherent->getCourrielSecondaire() != "") {
			$lMailingListeService->delete($lAdherent->getCourrielSecondaire());			
		}	
		
		
		$lResponse = new ModifierAdherentResponse();
		$lResponse->setNumero($lAdherent->getNumero());
		
		return $lResponse;*/
	}
}
?>
