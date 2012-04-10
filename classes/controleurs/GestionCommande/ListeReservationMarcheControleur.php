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
/*include_once(CHEMIN_CLASSES_VIEW_MANAGER . "GestionCommandeListeReservationViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/EditerCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAchatEtReservationResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/DetailProduitResponse.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "AchatService.php");
include_once(CHEMIN_CLASSES_SERVICE . "ReservationService.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/EditerCommandeValid.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "AdherentViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportListeReservationValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ModifierMarcheValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitMarcheValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/CommandeCompleteValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_TOVO . "ProduitCommandeToVO.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeFermeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeNomProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ModeleLotViewManager.php");  
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeFermeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ListeProduitResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE ."/ModelesLotResponse.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/FermeValid.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/NomProduitCatalogueValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "AbonnementService.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AutorisationSupprimerLotResponse.php" );
*/


include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/ListeAdherentResponse.php" );
/*include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/EditerCommandeValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/EditerCommandeResponse.php" );*/


include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportListeReservationValid.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

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
		$lResponse->setListeAdherent(ListeAdherentViewManager::selectAll());
		return $lResponse;
	}
	
	/**
	* @name getDetailMarche($pParam)
	* @return ListeReservationMarcheResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur cette commande et les infos sur la commande.
	*/
	/*public function getDetailMarche($pParam) {
		$lVr = EditerCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];

			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			//$lListeAdherent = GestionCommandeListeReservationViewManager::select($lIdMarche);

			$lResponse = new EditerCommandeResponse();
			$lResponse->setMarche($lMarche);
			//$lResponse->setListeAdherentCommande($lListeAdherent);

			return $lResponse;
		}				
		return $lVr;
	}*/

	/**
	* @name getListeReservationExport($pParam)
	* @return array()
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	private function getListeReservationExport($pParam) {
		$lIdCommande = $pParam['id_commande'];
		$lIdProduits = $pParam['id_produits'];
		
		$lReservations = ReservationViewManager::selectReservationProduit($lIdCommande, $lIdProduits);		
		
		// Mise en forme des données par produit
		$lTableauReservation = array();
		foreach($lReservations as $lReservation) {			
			$lLigne = array();
			
			$lLigne['compte'] = $lReservation->getCptLabel();
			$lLigne['Adherent'] = array();
			
			$lAdh = array();
			$lAdh['prenom'] = $lReservation->getAdhPrenom();
			$lAdh['nom'] = $lReservation->getAdhNom();
			
			if(isset($lTableauReservation[$lLigne['compte']])) {				
				//$lTableauReservation[$lLigne['compte']]['Adherent'][$lReservation->getAdhId()] = $lAdh;
				
				foreach($lIdProduits as $lIdProduit) {
					if($lReservation->getProId() == $lIdProduit) {
						$lTableauReservation[$lLigne['compte']][$lIdProduit] = $lReservation->getStoQuantite() * -1 . " " . $lReservation->getProUniteMesure();
					}
				}				
			} else {				
				$lLigne['Adherent'][$lReservation->getAdhId()] = $lAdh;
				
				foreach($lIdProduits as $lIdProduit) {
					if($lReservation->getProId() == $lIdProduit) {
						$lLigne[$lIdProduit] = $lReservation->getStoQuantite() * -1 . " " . $lReservation->getProUniteMesure();
					} else $lLigne[$lIdProduit] = '';
				}
				$lTableauReservation[$lLigne['compte']] = $lLigne;
			}			
		}
		
		return $lTableauReservation;
	}

	/**
	* @name getListeReservationPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	public function getListeReservationPdf($pParam) {

		$lVr = ExportListeReservationValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lIdProduits = $pParam['id_produits'];
			
			$lTableauReservation = $this->getListeReservationExport($pParam);
			
			// Préparation du Tableau pour l'export PDF		
			$contenuTableau = array();
			foreach($lTableauReservation as $lVal) {
				$i = 0;
				foreach($lVal['Adherent'] as $lAdh) {
					$lLigne = array();
					if($i == 0) {
						array_push($contenuTableau,utf8_decode($lVal['compte']));
					} else {
						array_push($contenuTableau,'');
					}
					array_push($contenuTableau,utf8_decode($lAdh['nom']));
					array_push($contenuTableau,utf8_decode($lAdh['prenom']));
					
					$j = 3;
					foreach($lIdProduits as $lIdProduit) {
						if($i == 0) {
							array_push($contenuTableau,utf8_decode($lVal[$lIdProduit]),"");
						} else {
							array_push($contenuTableau,'',"");
						}
						$j++;
					}
					$i++;
				}
			}
					
			// Contenu du header du tableau.	
			$contenuHeader = array(18, 30, 30);
			foreach($lIdProduits as $lIdProduit) {
				array_push($contenuHeader,20,20);
			}
			array_push($contenuHeader,"Compte", "Nom", utf8_decode("Prénom"));
			foreach($lIdProduits as $lIdProduit) {
				$lProduit = ProduitManager::select($lIdProduit);	
				$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
				$lLabelNomProduit = utf8_decode($lNomProduit->getNom());
				if($lProduit->getType() == 2) {
					$lLabelNomProduit .= " (Abonnement)";
				}
				array_push($contenuHeader,$lLabelNomProduit,"");
			}
			
			// Préparation du PDF
			$PDF=new phpToPDF();
			$PDF->AddPage();
			$PDF->SetFont('Arial','B',16);
			
			// Définition des propriétés du tableau.
			$proprietesTableau = array(
				'TB_ALIGN' => 'L',
				'L_MARGIN' => 5,
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => '0.3',
				);
			
			// Définition des propriétés du header du tableau.	
			$proprieteHeader = array(
				'T_COLOR' => array(0,0,0),
				'T_SIZE' => 12,
				'T_FONT' => 'Arial',
				'T_ALIGN' => 'C',
				'V_ALIGN' => 'T',
				'T_TYPE' => 'B',
				'LN_SIZE' => 7,
				'BG_COLOR_COL0' => array(255,255,255),
				'BG_COLOR' => array(255,255,255),
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => 0.2,
				'BRD_TYPE' => '1',
				'BRD_TYPE_NEW_PAGE' => '',
				);
			
			// Définition des propriétés du reste du contenu du tableau.	
			$proprieteContenu = array(
				'T_COLOR' => array(0,0,0),
				'T_SIZE' => 10,
				'T_FONT' => 'Arial',
				'T_ALIGN_COL0' => 'L',
				'T_ALIGN' => 'R',
				'V_ALIGN' => 'M',
				'T_TYPE' => '',
				'LN_SIZE' => 6,
				'BG_COLOR_COL0' => array(255,255,255),
				'BG_COLOR' => array(255,255,255),
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => 0.2,
				'BRD_TYPE' => '1',
				'BRD_TYPE_NEW_PAGE' => '',
				);
			
			// Ajout du Tableau au PDF
			$PDF->drawTableau($PDF, $proprietesTableau, $proprieteHeader, $contenuHeader, $proprieteContenu, $contenuTableau);
			
			// Export du PDF
			$PDF->Output('Réservations.pdf','D');
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
			
			$lTableauReservation = $this->getListeReservationExport($pParam);
	
			$lCSV = new CSV();
			$lCSV->setNom('Réservations.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Compte","Nom","Prénom");		
			foreach($lIdProduits as $lIdProduit) {
				$lProduit = ProduitManager::select($lIdProduit);	
				$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
				$lLabelNomProduit = utf8_decode($lNomProduit->getNom());
				if($lProduit->getType() == 2) {
					$lLabelNomProduit .= " (Abonnement)";
				}
				array_push($lEntete,$lLabelNomProduit,"");
			}
			$lCSV->setEntete($lEntete);
			
			// Les données
			$contenuTableau = array();
			foreach($lTableauReservation as $lVal) {
				$i = 0;
				$lLigne = array();
				foreach($lVal['Adherent'] as $lAdh) {
					$lLigne = array();
					if($i == 0) {
						array_push($lLigne,$lVal['compte']);
					} else {
						array_push($lLigne,'');
					}
					array_push($lLigne,$lAdh['nom']);
					array_push($lLigne,$lAdh['prenom']);
					
					$j = 3;
					foreach($lIdProduits as $lIdProduit) {
						if($i == 0) {
							array_push($lLigne,$lVal[$lIdProduit],"");
						} else {
							array_push($lLigne,'',"");
						}
						$j++;
					}
					$i++;
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