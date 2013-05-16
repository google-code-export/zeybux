<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/01/2011
// Fichier : BonDeCommandeControleur.php
//
// Description : Classe BonDeCommandeControleur
//
//****************************************************************

// Inclusion des classes
//include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
require_once(CHEMIN_CLASSES_PDF . 'html2pdf.class.php');

include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurMarcheViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheBonDeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheListeProduitBonDeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/BonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitsBonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportBonCommandeValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name BonDeCommandeControleur
 * @author Julien PIERRE
 * @since 03/01/2011
 * @desc Classe controleur d'une BonDeCommande
 */
class BonDeCommandeControleur
{
	/**
	* @name getInfoCommande($pParam)
	* @return AfficheBonDeCommandeResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getInfoCommande($pParam) {
		$lVr = BonDeCommandeValid::validGetInfoCommande($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];		
	
			$lMarcheService = new MarcheService();
			$lMarche = $lMarcheService->get($lIdMarche);
			
			$lResponse = new AfficheBonDeCommandeResponse();	
			$lProducteurs = ListeProducteurMarcheViewManager::select($lIdMarche);
			
			$lResponse->setComNumero($lMarche->getNumero());
			$lResponse->setArchive($lMarche->getArchive());
			$lResponse->setProducteurs($lProducteurs);
			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name getListeProduitCommande($pParam)
	* @return AfficheListeProduitBonDeCommandeResponse
	* @desc Retourne la liste des produits de cette commande.
	*/
	public function getListeProduitCommande($pParam) {
		$lVr = BonDeCommandeValid::validGetListeProduitCommande($pParam);
		if($lVr->getValid()) {
			$lIdCommande = $pParam["id_commande"];
			$lIdCompteFerme = $pParam["id_compte_ferme"];
			
			$lStockService = new StockService();
						
			$lResponse = new AfficheListeProduitBonDeCommandeResponse();
			$lResponse->setProduits($lStockService->selectInfoBonCommandeStockProduitReservation($lIdCommande,$lIdCompteFerme));
			$lResponse->setProduitsCommande(InfoBonCommandeViewManager::selectInfoBonCommande($lIdCommande,$lIdCompteFerme));
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name enregistrerBonDeCommande($pParam)
	* @return AfficheListeProduitBonDeCommandeResponse
	* @desc Enregistre le bon de commande.
	*/
	public function enregistrerBonDeCommande($pParam) {
		$lVr = ProduitsBonDeCommandeValid::validAjout($pParam);
		if($lVr->getValid()) {
			$lIdMarche = $pParam["id_commande"];
			$lIdCompteFerme = $pParam["id_compte_ferme"];
			$lProduits = $pParam["produits"];
		
			// On enregistre uniquement les produits avec à minima quantité (même si prix à 0)
			// Calcul du total
			$lTotal = 0;
			$lProduitsValide = array();
			foreach($lProduits as $lProduit) {
				if($lProduit["quantite"] > 0) {
					array_push($lProduitsValide,$lProduit);
				}
				$lTotal += $lProduit["prix"];
			}
			
			// Récupère l'opération Bon de commande si elle existe
			$lOperationService = new OperationService();
			$lOperations = $lOperationService->getBonCommande($lIdMarche,$lIdCompteFerme);
			$lIdOperation = $lOperations[0]->getId();

			if(is_null($lIdOperation)) { // Si il n'y a pas d'opération de Bon de commande
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompteFerme);
				$lOperation->setLibelle('Bon de Commande');
				$lOperation->setTypePaiement(5);
				$lOperation->setIdCommande($lIdMarche);
			} else {
				$lOperation = $lOperations[0];
			}
			$lOperation->setMontant($lTotal);
			$lIdOperation = $lOperationService->set($lOperation); // Ajout ou mise à jour de l'operation

			$lBonCommande = InfoBonCommandeViewManager::selectInfoBonCommande($lIdMarche,$lIdCompteFerme);

			$lDetailOperationService = new DetailOperationService();
			$lStockService = new StockService();
			foreach($lProduitsValide as $lProduit) {
				$lMaj = false;
				foreach($lBonCommande as $lBon) {
					if($lProduit["dcomId"] == $lBon->getDcomId()) {
						$lMaj = true;
						
						//$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setQuantite($lProduit["quantite"]);
						$lStock->setType(3);
						$lStock->setIdCompte($lIdCompteFerme);
						$lStock->setIdDetailCommande($lProduit["dcomId"]);
						$lStock->setIdOperation($lIdOperation);
						$lStockService->set($lStock);
						
						$lDetailOperation = $lDetailOperationService->get($lBon->getDopeId());
						$lDetailOperation->setIdOperation($lIdOperation);
						$lDetailOperation->setIdCompte($lIdCompteFerme);
						$lDetailOperation->setMontant($lProduit["prix"]);
						$lDetailOperation->setLibelle('Bon de Commande');
						$lDetailOperation->setTypePaiement(5);
						$lDetailOperationService->set($lDetailOperation);
					}
				}
				if(!$lMaj) {
					//$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					
					$lStock = new StockVO();
					$lStock->setQuantite($lProduit["quantite"]);
					$lStock->setType(3);
					$lStock->setIdCompte($lIdCompteFerme);
					$lStock->setIdDetailCommande($lProduit["dcomId"]);
					$lStock->setIdOperation($lIdOperation);
					$lStockService->set($lStock);
					
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setIdOperation($lIdOperation);
					$lDetailOperation->setIdCompte($lIdCompteFerme);
					$lDetailOperation->setMontant($lProduit["prix"]);
					$lDetailOperation->setLibelle('Bon de Commande');
					$lDetailOperation->setTypePaiement(5);
					$lDetailOperation->setTypePaiementChampComplementaire($lProduit["id"]);
					$lDetailOperation->setIdDetailCommande($lProduit["dcomId"]);
					$lDetailOperationService->set($lDetailOperation);
				}			
			}
			foreach($lBonCommande as $lBon) {
				$lDelete = true;
				foreach($lProduitsValide as $lProduit) {
					if($lProduit["dcomId"] == $lBon->getDcomId()) {
						$lDelete = false;
					}
				}
				if($lDelete) {
					$lStockService->delete($lBon->getStoId());
					$lDetailOperationService->delete($lBon->getDopeId());
				}
			}
		}
		return $lVr;
	}
	/**
	* @name getBonCommandeExport($pParam)
	* @return array()
	* @desc Retourne les infos pour l'export du bon ce commande
	*/
	private function getBonCommandeExport($pParam) {
		$lIdCommande = $pParam["id_commande"];
		$lIdCompteFerme =  $pParam["idCompteFerme"];
	//	return InfoBonCommandeViewManager::selectByIdCommande($lIdCommande);
		return InfoBonCommandeViewManager::selectInfoBonCommande($lIdCommande,$lIdCompteFerme);
	}
	
	/**
	* @name getBComPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne le bon de commande en pdf
	*/
	public function getBComPdf($pParam) {

		$lVr = ExportBonCommandeValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			// Récupération es informations
			$lLignesBonCommande = $this->getBonCommandeExport($pParam);
			$lFerme = FermeManager::selectByIdCompte($pParam['idCompteFerme']);
			$lFerme = $lFerme[0];
			$lMarche = CommandeManager::select($pParam['id_commande']);
			
			$lProduit = array();
			foreach($lLignesBonCommande as $lLigne) {
				if(isset($lProduit[$lLigne->getProId()])) {
					$lProduit[$lLigne->getProId()] = 2;
				} else {
					$lProduit[$lLigne->getProId()] = 1;
				}
			}
			
			
			// get the HTML
			ob_start();
			include(CHEMIN_TEMPLATE . MOD_GESTION_COMMANDE .'/PDF/BonDeCommande.php');
			$content = ob_get_clean();
			
			// convert to PDF
			try
			{
				$html2pdf = new HTML2PDF('P', 'A4', 'fr');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->writeHTML($content, 0);
				$html2pdf->Output('Bon de Commande.pdf','D');
			}
			catch(HTML2PDF_exception $e) {
				// Initialisation du Logger
				$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
				$lLogger->setMask(Log::MAX(LOG_LEVEL));
				$lLogger->log("Erreur de génération du PDF bon de Commande : " .  $e,PEAR_LOG_DEBUG); // Maj des logs
			}
		} else {
			return $lVr->exportToJson();
		}
	}	
	
	/**
	* @name getBComCSV($pParam)
	* @return Un Fichier CSV
	* @desc Retourne le bon de commande en format CSV
	*/
	public function getBComCSV($pParam) {
		$lVr = ExportBonCommandeValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lLignesBonCommande = $this->getBonCommandeExport($pParam);
	
			$lCSV = new CSV();
			$lCSV->setNom('Bon_de_Commande.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Ferme",$lLignesBonCommande[0]->getFerNom());
			$lCSV->setEntete($lEntete);
			
			// Préparation pour afficher le lot sir 2 fois le produit
			$lProduit = array();
			foreach($lLignesBonCommande as $lLigne) {
				if(isset($lProduit[$lLigne->getProId()])) {
					$lProduit[$lLigne->getProId()] = 2;
				} else {
					$lProduit[$lLigne->getProId()] = 1;
				}
			}
			
			// Les données
			$lContenuTableau = array();
			array_push($lContenuTableau,array("Ref.","Produit","Commande","","Prix",""));
			$lIdPrdt = 0;
			foreach($lLignesBonCommande as $lLigne) {
			//	if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					
					if($lLigne->getProType() == 1) {
						$lNomProduit = $lLigne->getNproNom() . " (Solidaire)";
					} else if($lLigne->getProType() == 2) {
						$lNomProduit = $lLigne->getNproNom() . " (Abonnement)";
					} else {
						$lNomProduit = $lLigne->getNproNom();
					}
					
					if(isset($lProduit[$lLigne->getProId()]) && $lProduit[$lLigne->getProId()] == 2) {
						$lNomProduit .= " (" . number_format($lLigne->getDcomTaille(), 2, ',', ' ') . " " . $lLigne->getProUniteMesure() .")";
					}
					
					$lLignecontenu = array(	$lLigne->getNproNumero(),
											$lNomProduit,
											$lLigne->getStoQuantite(),
											$lLigne->getProUniteMesure(),
											$lLigne->getDopeMontant(),
											SIGLE_MONETAIRE
											);
					
					array_push($lContenuTableau,$lLignecontenu);
					$lIdPrdt = $lLigne->getProIdCompteFerme();
			//	}
			} 
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}	
	}
}
?>