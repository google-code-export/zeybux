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
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_ADHERENTS . "/ModifierAdherentResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MarcheListeReservationViewManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VO . "IdReservationVO.php");
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
		$lId = $pParam['id_adherent'];		
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
		
		return $lResponse;
	}
}
?>
