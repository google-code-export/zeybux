<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/03/2012
// Fichier : ListeReservationMarcheControleur.php
//
// Description : Classe ListeReservationMarcheControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAdherentResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportListeReservationValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
require_once(CHEMIN_CLASSES_PDF . 'html2pdf.class.php');
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_SERVICE . "AdherentService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");

/**
 * @name ListeReservationMarcheControleur
 * @author Julien PIERRE
 * @since 26/03/2012
 * @desc Classe controleur d'une ListeReservationMarche
 */
class ListeReservationMarcheControleur
{		
	/**
	* @name getListeAdherent()
	* @return ListeAdherentResponse
	* @desc Recherche la liste des adherents
	*/
	public function getListeAdherent() {
		$lResponse = new ListeAdherentResponse();
		$lAdherentService = new AdherentService();
		$lResponse->setListeAdherent($lAdherentService->getAllResumeSansSolde());
		return $lResponse;
	}

	/**
	* @name getListeReservationExport($pParam)
	* @return array()
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	private function getListeReservationExport($pParam) {
		$lIdMarche = $pParam['id_commande'];
		$lIdProduits = $pParam['id_produits'];
		
		$lReservationService = new ReservationService();
		$lReservations = $lReservationService->getReservationProduit($lIdMarche, $lIdProduits);

		// Mise en forme des données par produit
		$lTableauReservation = array();
		$lQuantiteReservation = array();
		
		foreach($lReservations as $lReservation) {			
			$lLigne = array();
			
			$lLigne['compte'] = $lReservation->getCptLabel();
			$lLigne['prenom'] = $lReservation->getAdhPrenom();
			$lLigne['nom'] = $lReservation->getAdhNom();
			$lLigne['telephonePrincipal'] = $lReservation->getAdhTelephonePrincipal();
			
			if(isset($lTableauReservation[$lReservation->getCptLabel()])) {
					$lTableauReservation[$lLigne['compte']][$lReservation->getProId()] = $lReservation->getStoQuantite() * -1 . " " . $lReservation->getProUniteMesure();
			} else {
				foreach($lIdProduits as $lIdProduit) {
					if($lReservation->getProId() == $lIdProduit) {
						$lLigne[$lIdProduit] = $lReservation->getStoQuantite() * -1 . " " . $lReservation->getProUniteMesure();
					} else {
						$lLigne[$lIdProduit] = '';
					}
				}
				$lTableauReservation[$lLigne['compte']] = $lLigne;
			}
			
			if(isset($lQuantiteReservation[$lReservation->getProId()])) {
				$lQuantiteReservation[$lReservation->getProId()] += ($lReservation->getStoQuantite() * -1);
			} else {
				$lQuantiteReservation[$lReservation->getProId()] = $lReservation->getStoQuantite() * -1;
			}
		}
		return array('quantite' => $lQuantiteReservation, 'detail' => $lTableauReservation );
	}

	/**
	* @name getListeReservationPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	public function getListeReservationPdf($pParam) {

		$lVr = ExportListeReservationValid::validAjout($pParam);
		
		if($lVr->getValid()) {			
			$lInfoReservation = $this->getListeReservationExport($pParam);
			$lQuantiteReservation = $lInfoReservation['quantite'];
			$lTableauReservation = $lInfoReservation['detail'];
			$lIdProduits = $pParam['id_produits'];
			$lNbProduit = count($lIdProduits);
			
			$lNbPage = (int)($lNbProduit / 8);
			
			
			// Les pages
			// get the HTML
			ob_start();
			
			$i = 0;
			$lOrientation = 'paysage';
			$lNbProduitPage = 8;
			while($i < $lNbPage) {
				include(CHEMIN_TEMPLATE . MOD_GESTION_COMMANDE .'/PDF/Reservation.php');
				$i++;
			}
			
			// La Dernière page
			$lNbProduitPage = $lNbProduit % 8;
			if($lNbProduitPage != 0) {
				if($lNbProduitPage > 4) { // Choix de l'orientation
					$lOrientation = 'paysage';
				} else {
					$lOrientation = 'portrait';
				}
				include(CHEMIN_TEMPLATE . MOD_GESTION_COMMANDE .'/PDF/Reservation.php');
			}
			$content = ob_get_clean();
			
			// convert to PDF
			try {
				$html2pdf = new HTML2PDF('P', 'A4', 'fr');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->writeHTML($content, 0);
				$html2pdf->Output('Reservation.pdf','D');
			}
			catch(HTML2PDF_exception $e) {
				// Initialisation du Logger
				$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
				$lLogger->setMask(Log::MAX(LOG_LEVEL));
				$lLogger->log("Erreur de génération du PDF de Réservation : " . $e,PEAR_LOG_DEBUG); // Maj des logs
			}
			
			
		} else {
			return $lVr;
		}		
	}
	
	/**
	* @name getListeReservationCSV($pParam)
	* @return Un Fichier CSV
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	public function getListeReservationCSV($pParam) {
		$lVr = ExportListeReservationValid::validAjout($pParam);
		
		if($lVr->getValid()) {	
			$lIdProduits = $pParam['id_produits'];
			
			$lInfoReservation = $this->getListeReservationExport($pParam);
			$lQuantiteReservation = $lInfoReservation['quantite'];
			$lTableauReservation = $lInfoReservation['detail'];
	
			$lCSV = new CSV();
			$lCSV->setNom('Réservations.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Compte","Nom","Prénom","Tel.");		
			$lLigne2 = array("","","","");
			$lLigne3 = array("","","","");
			
			foreach($lIdProduits as $lIdProduit) {
				$lProduit = ProduitManager::select($lIdProduit);	
				$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
				$lLabelNomProduit = utf8_decode(htmlspecialchars_decode($lNomProduit->getNom(), ENT_QUOTES));
				if($lProduit->getType() == 2) {
					$lLabelNomProduit .= " (Abonnement)";
				}
				array_push($lEntete,$lLabelNomProduit,"");
				array_push($lLigne2,"Prévu","Réel");
				
				$lQuantite = '';
				if(isset($lQuantiteReservation[$lIdProduit])) {
					$lQuantite = $lQuantiteReservation[$lIdProduit];
				}				
				array_push($lLigne3,$lQuantite,"");
			}
			$lCSV->setEntete($lEntete);
			
			// Les données
			$contenuTableau = array();
			array_push($contenuTableau,$lLigne2);
			array_push($contenuTableau,$lLigne3);
			foreach($lTableauReservation as $lVal) {
				$lLigne = array();

				array_push($lLigne,$lVal['compte']);
				array_push($lLigne,$lVal['nom']);
				array_push($lLigne,$lVal['prenom']);
				array_push($lLigne,$lVal['telephonePrincipal']);

				foreach($lIdProduits as $lIdProduit) {
					array_push($lLigne,$lVal[$lIdProduit],"");
				}
				array_push($contenuTableau,$lLigne);
			} 
			$lCSV->setData($contenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}	
	}	
}
?>