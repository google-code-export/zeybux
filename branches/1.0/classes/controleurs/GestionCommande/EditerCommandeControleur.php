<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/10/2010
// Fichier : EditerCommandeControleur.php
//
// Description : Classe EditerCommandeControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeAdherentCommandeReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitInitiauxViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ReservationViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . "EditerCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "ExportListeReservationValid.php" );

/**
 * @name EditerCommandeControleur
 * @author Julien PIERRE
 * @since 27/10/2010
 * @desc Classe controleur d'une EditerCommande
 */
class EditerCommandeControleur
{
	/**
	* @name getInfoCommande($pParam)
	* @return EditerCommandeResponse
	* @desc Retourne la liste des adhérents qui ont réservé sur cette commande et les infos sur la commande.
	*/
	public function getInfoCommande($pParam) {
		$lIdCommande = $pParam["id_commande"];		

		if(is_int((int)$lIdCommande)) {			
			$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);
			
			if($lCommande[0]->getComId() == $lIdCommande) {			
				$lResponse = new EditerCommandeResponse();
				
				$lStock = StockProduitViewManager::selectByIdCommande($lIdCommande);
				$lStockInitiaux = StockProduitInitiauxViewManager::selectByIdCommande($lIdCommande);
				$lListeAdherent = ListeAdherentCommandeReservationViewManager::select($lIdCommande);
				
				$lResponse->setCommande($lCommande);
				$lResponse->setStock($lStock);
				$lResponse->setStockInitiaux($lStockInitiaux);
				$lResponse->setListeAdherentCommande($lListeAdherent);
				
				return $lResponse;
			} else {
				$lVr = new TemplateVR();
				$lVr->setValid(false);
				$lVr->getLog()->setValid(false);
				$lErreur = new VRerreur();
				$lErreur->setCode(MessagesErreurs::ERR_216_CODE);
				$lErreur->setMessage(MessagesErreurs::ERR_216_MSG);
				$lVr->getLog()->addErreur($lErreur);	
				return $lVr;
			}				
		} else {
			$lVr = new TemplateVR();
			$lVr->setValid(false);
			$lVr->getLog()->setValid(false);
			$lErreur = new VRerreur();
			$lErreur->setCode(MessagesErreurs::ERR_108_CODE);
			$lErreur->setMessage(MessagesErreurs::ERR_108_MSG);
			$lVr->getLog()->addErreur($lErreur);	
			return $lVr;
		}	
	}
	
	/**
	* @name getListeReservation($pParam)
	* @return array()
	* @desc Retourne la liste des réservations pour une commande et la liste de produits demandés
	*/
	private function getListeReservation($pParam) {
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
			
			$lTableauReservation = $this->getListeReservation($pParam);
			
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
					array_push($contenuTableau,utf8_decode($lAdh['prenom']));
					array_push($contenuTableau,utf8_decode($lAdh['nom']));
					
					$j = 3;
					foreach($lIdProduits as $lIdProduit) {
						if($i == 0) {
							array_push($contenuTableau,utf8_decode($lVal[$lIdProduit]));
						} else {
							array_push($contenuTableau,'');
						}
						$j++;
					}
					$i++;
				}
			}
					
			// Contenu du header du tableau.	
			$contenuHeader = array(18, 30, 30);
			foreach($lIdProduits as $lIdProduit) {
				array_push($contenuHeader,20);
			}
			array_push($contenuHeader,"Compte", utf8_decode("Prénom"), "Nom");
			foreach($lIdProduits as $lIdProduit) {
				$lProduit = ProduitManager::select($lIdProduit);	
				$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
				array_push($contenuHeader,utf8_decode($lNomProduit->getNom()));
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
				'T_COLOR' => array(255,255,255),
				'T_SIZE' => 12,
				'T_FONT' => 'Arial',
				'T_ALIGN' => 'C',
				'V_ALIGN' => 'T',
				'T_TYPE' => 'B',
				'LN_SIZE' => 7,
				'BG_COLOR_COL0' => array(58,129,4),
				'BG_COLOR' => array(58,129,4),
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
				'BG_COLOR_COL0' => array(220, 220, 220),
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
			
			$lTableauReservation = $this->getListeReservation($pParam);
	
			$lCSV = new CSV();
			$lCSV->setNom('Réservations.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Compte","Prénom","Nom");		
			foreach($lIdProduits as $lIdProduit) {
				$lProduit = ProduitManager::select($lIdProduit);	
				$lNomProduit = NomProduitManager::select($lProduit->getIdNomProduit());
				array_push($lEntete,$lNomProduit->getNom());
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
					array_push($lLigne,$lAdh['prenom']);
					array_push($lLigne,$lAdh['nom']);
					
					$j = 3;
					foreach($lIdProduits as $lIdProduit) {
						if($i == 0) {
							array_push($lLigne,$lVal[$lIdProduit]);
						} else {
							array_push($lLigne,'');
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