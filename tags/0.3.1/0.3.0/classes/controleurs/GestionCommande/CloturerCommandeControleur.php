<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/11/2010
// Fichier : CloturerCommandeControleur.php
//
// Description : Classe CloturerCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . "CloturerCommandeResponse.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "GroupeCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");

include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

/**
 * @name CloturerCommandeControleur
 * @author Julien PIERRE
 * @since 11/11/2010
 * @desc Classe controleur d'une ModifierCommande
 */
class CloturerCommandeControleur
{	
	/**
	* @name cloturerCommande($pParam)
	* @return Response
	* @desc Cloture la commande
	*/
	public function cloturerCommande($pParam) {
		$lIdCommande = $pParam["id_commande"];		

		// La commande est cloturée
		$lCommande = CommandeManager::select($lIdCommande);
		if($lCommande->getId() == $lIdCommande) {
			$lCommande->setArchive(1);
			CommandeManager::update($lCommande);
					
			// Les Stocks non acheté passent en statut 2
			$lListePdt = ReservationViewManager::select( $lIdCommande );
			foreach($lListePdt as $lPdt) {
				if($lPdt->getStoId() != null) {
					$lStock = StockManager::select( $lPdt->getStoId() );
					$lStock->setType(2);
					StockManager::update( $lStock );
				}
			}
			
			// Les Gpc non acheté passent en statut 2
			$lListeGpc = GroupeCommandeManager::selectReservationCommande( $lIdCommande );
			foreach ( $lListeGpc as $lGpc ) {
				if($lGpc->getId() != null) {
					$lGpc->setEtat(2);
					GroupeCommandeManager::update( $lGpc );
				}
			}
			
			// On Passe les opérations réservées non récupérées en statut cloturé
			$lListeOperation = OperationManager::selectReservationCommande( $lIdCommande );
			foreach ( $lListeOperation as $lOperation ) {
				if($lOperation->getId() != null) {
					$lOperation->setType(2);
					OperationManager::update( $lOperation );
				}
			}
			
			$lResponse = new CloturerCommandeResponse();
			$lResponse->setId($lCommande->getId());
			$lResponse->setNumero($lCommande->getNumero());
			return $lResponse;
		}
		
		$lVr = new TemplateVR();
		$lVr->setValid(false);
		$lVr->getLog()->setValid(false);
		$lErreur = new VRerreur();
		$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
		$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
		$lVr->getLog()->addErreur($lErreur);
		$lVr->setValid(false);
		return $lVr;		
	}
}
?>