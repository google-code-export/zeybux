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
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");



include_once(CHEMIN_CLASSES_SERVICE . "MarcheService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "DetailOperationService.php");
include_once(CHEMIN_CLASSES_SERVICE . "StockService.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurMarcheViewManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheBonDeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . MOD_GESTION_COMMANDE . "/AfficheListeProduitBonDeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/BonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ProduitsBonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMMANDE . "/ExportBonCommandeValid.php" );
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

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
			$lResponse->setProducteurs($lProducteurs);
			
			return $lResponse;
		}
		return $lVr;
	}
	
	/**
	* @name getListeProduitCommande($pParam)
	* @return AfficheListeProduitBonDeCommandeResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getListeProduitCommande($pParam) {
		$lVr = BonDeCommandeValid::validGetListeProduitCommande($pParam);
		if($lVr->getValid()) {
			$lIdCommande = $pParam["id_commande"];
			$lIdCompteFerme = $pParam["id_compte_ferme"];
						
			$lResponse = new AfficheListeProduitBonDeCommandeResponse();
			$lResponse->setProduits(StockProduitReservationViewManager::selectInfoBonCommande($lIdCommande,$lIdCompteFerme));
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
		
			// Calcul du total
			$lTotal = 0;
			foreach($lProduits as $lProduit) {
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
			foreach($lProduits as $lProduit) {
				$lMaj = false;
				foreach($lBonCommande as $lBon) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lMaj = true;
						
						$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setQuantite($lProduit["quantite"]);
						$lStock->setType(3);
						$lStock->setIdCompte($lIdCompteFerme);
						$lStock->setIdDetailCommande($lDcom[0]->getId());
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
					$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					
					$lStock = new StockVO();
					$lStock->setQuantite($lProduit["quantite"]);
					$lStock->setType(3);
					$lStock->setIdCompte($lIdCompteFerme);
					$lStock->setIdDetailCommande($lDcom[0]->getId());
					$lStock->setIdOperation($lIdOperation);
					$lStockService->set($lStock);
					
					$lDetailOperation = new DetailOperationVO();
					$lDetailOperation->setIdOperation($lIdOperation);
					$lDetailOperation->setIdCompte($lIdCompteFerme);
					$lDetailOperation->setMontant($lProduit["prix"]);
					$lDetailOperation->setLibelle('Bon de Commande');
					$lDetailOperation->setTypePaiement(5);
					$lDetailOperation->setTypePaiementChampComplementaire($lProduit["id"]);
					$lDetailOperation->setIdDetailCommande($lDcom[0]->getId());
					$lDetailOperationService->set($lDetailOperation);
				}			
			}
			foreach($lBonCommande as $lBon) {
				$lDelete = true;
				foreach($lProduits as $lProduit) {
					if($lProduit["id"] == $lBon->getProId()) {
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
		return InfoBonCommandeViewManager::selectByIdCommande($lIdCommande);
	}
	
	/**
	* @name getBComPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne le bon de commande en pdf
	*/
	public function getBComPdf($pParam) {

		$lVr = ExportBonCommandeValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			
			$lLignesBonCommande = $this->getBonCommandeExport($pParam);
			
			// Préparation du Tableau pour l'export PDF		
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonCommande as $lLigne) {
				if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					if($lLigne->getProIdCompteFerme() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						$lNomPrdt = utf8_decode($lLigne->getFerNom());
					}				
					
					array_push($lContenuTableau,
											$lNomPrdt,
											utf8_decode($lLigne->getNproNumero()),
											utf8_decode($lLigne->getNproNom()),
											$lLigne->getStoQuantite(),
											utf8_decode($lLigne->getProUniteMesure()),
											$lLigne->getDopeMontant(),
											SIGLE_MONETAIRE_PDF);
											
					$lIdPrdt = $lLigne->getProIdCompteFerme();
				}
			}
					
			// Contenu du header du tableau.	
			$lContenuHeader = array(30, 30, 30, 30, 10, 30, 10, "Producteur","Ref.", "Produit","Commande","","Prix","");
			
			// Préparation du PDF
			$PDF=new phpToPDF();
			$PDF->AddPage();
			$PDF->SetFont('Arial','B',16);
			
			// Définition des propriétés du tableau.
			$lProprietesTableau = array(
				'TB_ALIGN' => 'L',
				'L_MARGIN' => 5,
				'BRD_COLOR' => array(0,0,0),
				'BRD_SIZE' => '0.3',
				);
			
			// Définition des propriétés du header du tableau.	
			$lProprieteHeader = array(
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
			$lProprieteContenu = array(
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
			$PDF->drawTableau($PDF, $lProprietesTableau, $lProprieteHeader, $lContenuHeader, $lProprieteContenu, $lContenuTableau);
			
			// Export du PDF
			$PDF->Output('Bon de Commande.pdf','D');
		} else {
			return $lVr;
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
			$lEntete = array("Ferme","Ref.","Produit","Commande","","Prix","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonCommande as $lLigne) {
				if($lLigne->getProIdCompteFerme() != NULL) { // évite les lignes vides
					if($lLigne->getProIdCompteFerme() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						$lNomPrdt = $lLigne->getFerNom();
					}
					
					if($lLigne->getProType() == 1) {
						$lNomProduit = $lLigne->getNproNom() . " (Solidaire)";
					} else if($lLigne->getProType() == 2) {
						$lNomProduit = $lLigne->getNproNom() . " (Abonnement)";
					} else {
						$lNomProduit = $lLigne->getNproNom();
					}
					
					$lLignecontenu = array(	$lNomPrdt,
											$lLigne->getNproNumero(),
											$lNomProduit,
											$lLigne->getStoQuantite(),
											$lLigne->getProUniteMesure(),
											$lLigne->getDopeMontant(),
											SIGLE_MONETAIRE
											);
					
					array_push($lContenuTableau,$lLignecontenu);
					$lIdPrdt = $lLigne->getProIdCompteFerme();
				}
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