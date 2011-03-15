<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : BonDeLivraisonControleur.php
//
// Description : Classe BonDeLivraisonControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonLivraisonViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "TypePaiementVisibleViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitInitiauxViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockSolidaireViewManager.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockLivraisonViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationBonLivraisonViewManager.php");

include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

include_once(CHEMIN_CLASSES_RESPONSE . "AfficheBonDeLivraisonResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AfficheListeProduitBonDeLivraisonResponse.php" );

include_once(CHEMIN_CLASSES_VALIDATEUR . "ProduitsBonDeLivraisonValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ExportBonLivraisonValid.php" );

include_once(CHEMIN_CLASSES_UTILS . "CSV.php");
include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
/**
 * @name BonDeLivraisonControleur
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe controleur d'une BonDeLivraison
 */
class BonDeLivraisonControleur
{
	/**
	* @name getInfoLivraison($pParam)
	* @return AfficheBonDeLivraisonResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getInfoLivraison($pParam) {
		$lIdCommande = $pParam["id_commande"];		

		if(is_int((int)$lIdCommande)) {			
			$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);

			if($lCommande[0]->getComId() == $lIdCommande) {			
				$lResponse = new AfficheBonDeLivraisonResponse();
				
				$lProducteurs = ListeProducteurCommandeViewManager::select($lIdCommande);
				$lTypePaiement = TypePaiementVisibleViewManager::selectAll();
				
				$lResponse->setComNumero($lCommande[0]->getComNumero());
				$lResponse->setProducteurs($lProducteurs);
				$lResponse->setTypePaiement($lTypePaiement);
				
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
	* @name getListeProduitLivraison($pParam)
	* @return AfficheListeProduitBonDeLivraisonResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getListeProduitLivraison($pParam) {
		$lIdCommande = $pParam["id_commande"];
		$lIdProducteur = $pParam["id_producteur"];
		// TODO réaliser des test pour vérifier la validité des inputs
		$lProducteur = ProducteurViewManager::select($lIdProducteur);
		$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
			
		$lResponse = new AfficheListeProduitBonDeLivraisonResponse();
		
		$lResponse->setProduits(StockProduitReservationViewManager::selectInfoBonCommande($lIdCommande,$lIdProducteur));
		$lResponse->setProduitsCommande(InfoBonLivraisonViewManager::selectInfoBonLivraison($lIdCommande,$lIdProducteur));
		$lResponse->setOperationProducteur(OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande));

		return $lResponse;
	}
	
	/**
	* @name enregistrerBonDeLivraison($pParam)
	* @return AfficheListeProduitBonDeLivraisonResponse
	* @desc Enregistre le bon de commande.
	*/
	public function enregistrerBonDeLivraison($pParam) {
		$lIdCommande = $pParam["id_commande"];
		$lIdProducteur = $pParam["id_producteur"];
		$lProduits = $pParam["produits"];
		
		$lVr = ProduitsBonDeLivraisonValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lProducteur = ProducteurViewManager::select($lIdProducteur);
			$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
			$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);

			// Le paiement au producteur
			$lOperationActuelle = OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande);
			if($lOperationActuelle[0]->getIdCompte() == $lIdCompte) {
				$lOperation = $lOperationActuelle[0];
				$lOperation->setMontant($pParam["total"] * -1);
				$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
				$lOperation->setTypePaiement($pParam["typePaiement"]);		
				$lOperation->setTypePaiementChampComplementaire($pParam["typePaiementChampComplementaire"]);
				$lOperation->setType(1);				
				OperationManager::update($lOperation);
			} else {
				$lOperation = new OperationVO();
				$lOperation->setIdCompte($lIdCompte);
				$lOperation->setMontant($pParam["total"] * -1);
				$lOperation->setLibelle('Marché n°' . $lCommande[0]->getComNumero());
				$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
				$lOperation->setTypePaiement($pParam["typePaiement"]);		
				$lOperation->setTypePaiementChampComplementaire($pParam["typePaiementChampComplementaire"]);
				$lOperation->setType(1);
				$lOperation->setIdCommande($lIdCommande);
				
				OperationManager::insert($lOperation);
			}
			
			$lBonsLivraisonActuel = StockLivraisonViewManager::selectByIdProducteur($lIdProducteur);

			foreach($lProduits as $lProduit) {
				
				$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
						
				// Maj du stock réel pour la gestion des commandes
				$lStockInit = StockProduitInitiauxViewManager::selectByIdCommandeIdProduit($lIdCommande,$lProduit["id"]);
				$lStockInit = $lStockInit[0];
				$lStock = new StockVO();
				$lStock->setId($lStockInit->getId());
				$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
				$lStock->setQuantite($lProduit["quantite"]);
				$lStock->setType(1);
				$lStock->setIdCompte(0);				
				$lStock->setIdDetailCommande($lDcom[0]->getId());
				$lStock->setIdCommande($lIdCommande); // TODO Obligé de le laisser sinon il faut modifier edition commande
				StockManager::update($lStock);
				
				// Maj du stock solidaire
				if(!empty($lProduit["quantiteSolidaire"])) {
					$lStocksSolidaire = StockSolidaireViewManager::selectByIdProduit($lProduit["id"]);
					if($lStocksSolidaire[0]->getProId() == $lProduit["id"]) {
						$lStockSolidaire = $lStocksSolidaire[0];
						$lStock = new StockVO();
						$lStock->setId($lStockSolidaire->getStoId());
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit["quantiteSolidaire"]);
						$lStock->setType(5);
						$lStock->setIdCompte(0);				
						$lStock->setIdDetailCommande($lDcom[0]->getId());
						$lStock->setIdCommande(0);
						StockManager::update($lStock);
					} else {
						$lStock = new StockVO();
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit["quantiteSolidaire"]);
						$lStock->setType(5);
						$lStock->setIdCompte(0);				
						$lStock->setIdDetailCommande($lDcom[0]->getId());
						$lStock->setIdCommande(0);
						StockManager::insert($lStock);
					}
				}
				
				// Maj du bon de livraison
				$lMaj = false;
				foreach($lBonsLivraisonActuel as $lBon) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lMaj = true;
						
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit["quantite"]);
						$lStock->setType(4);
						$lStock->setIdCompte(0);
						$lStock->setIdDetailCommande($lBon->getDcomId());
						$lStock->setIdCommande(0);
	
						StockManager::update($lStock);
						
						$lOpeActuel = OperationBonLivraisonViewManager::selectInfoBonLivraisonProduit($lIdCommande,$lIdProducteur,$lBon->getProId());
						$lOperation = new OperationVO();
						$lOperation->setId($lOpeActuel[0]->getOpeId());
						$lOperation->setIdCompte($lIdCompte);
						$lOperation->setMontant($lProduit["prix"]);
						$lOperation->setLibelle('Bon de Livraison');
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setTypePaiement(6);		
						$lOperation->setTypePaiementChampComplementaire($lBon->getProId());
						$lOperation->setType(4);
						$lOperation->setIdCommande($lIdCommande);
						
						OperationManager::update($lOperation);
					}
				}
				if(!$lMaj) {
					$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					$lStock = new StockVO();
					$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lStock->setQuantite($lProduit["quantite"]);
					$lStock->setType(4);
					$lStock->setIdCompte(0);				
					$lStock->setIdDetailCommande($lDcom[0]->getId());
					$lStock->setIdCommande(0);
					StockManager::insert($lStock);
					
					$lOperation = new OperationVO();
					$lOperation->setIdCompte($lIdCompte);
					$lOperation->setMontant($lProduit["prix"]);
					$lOperation->setLibelle('Bon de Livraison');
					$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lOperation->setTypePaiement(6);		
					$lOperation->setTypePaiementChampComplementaire($lProduit["id"]);
					$lOperation->setType(4);
					$lOperation->setIdCommande($lIdCommande);						
					OperationManager::insert($lOperation);
				}
			}
			
			$lVr = new TemplateVR();	
			return $lVr;
		}
		return $lVr;
	}
	
	/**
	* @name getBComPdf($pParam)
	* @return Un Fichier Pdf
	* @desc Retourne le bon de livraison en pdf
	*/
	public function getBComPdf($pParam) {

		$lVr = ExportBonLivraisonValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			
			// Préparation du Tableau pour l'export PDF
			$lIdCommande = $pParam["id_commande"];
			$lLignesBonLivraison = InfoBonLivraisonViewManager::selectByIdCommande($lIdCommande);
			
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonLivraison as $lLigne) {
				if($lLigne->getProIdProducteur() != NULL) { // évite les lignes vides
					if($lLigne->getProIdProducteur() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						if($lIdPrdt != 0) {
							$lProducteur = ProducteurViewManager::select($lIdPrdt);
							$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
							$lOperation = OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande);
							
							array_push($lContenuTableau,"","","","Total : ",utf8_decode($lOperation[0]->getMontant() * -1),SIGLE_MONETAIRE_PDF,"","");
							array_push($lContenuTableau,"","","","","","","","");
						}
						$lNomPrdt = $lLigne->getPrdtPrenom() . " " . $lLigne->getPrdtNom();
					}
									
					if( $lLigne->getStoQuantiteLivraison() == '' || $lLigne->getStoQuantiteLivraison() == NULL) {
						$lQuantiteLivraison = '';
						$lUniteQuantiteLivraison = '';
					} else {
						$lQuantiteLivraison = $lLigne->getStoQuantiteLivraison();
						$lUniteQuantiteLivraison = $lLigne->getProUniteMesure();
					}
				
					if( $lLigne->getOpeMontantLivraison() == '' || $lLigne->getOpeMontantLivraison() == NULL) {
						$lMontantLivraison = '';
						$lSigleMontantLivraison = '';
					} else {
						$lMontantLivraison = $lLigne->getOpeMontantLivraison();
						$lSigleMontantLivraison = SIGLE_MONETAIRE_PDF;
					}
				
					if( $lLigne->getStoQuantiteSolidaire() == '' || $lLigne->getStoQuantiteSolidaire() == NULL) {
						$lQuantiteSolidaire = '';
						$lUniteQuantiteSolidaire = '';
					} else {
						$lQuantiteSolidaire = $lLigne->getStoQuantiteSolidaire();
						$lUniteQuantiteSolidaire = $lLigne->getProUniteMesure();
					}
					
					array_push($lContenuTableau,	
											utf8_decode($lNomPrdt),
											utf8_decode($lLigne->getNproNom()),
											utf8_decode($lQuantiteLivraison),
											utf8_decode($lUniteQuantiteLivraison),
											utf8_decode($lMontantLivraison),
											$lSigleMontantLivraison,
											utf8_decode($lQuantiteSolidaire),
											utf8_decode($lUniteQuantiteSolidaire)
											);
											
					$lIdPrdt = $lLigne->getProIdProducteur();
				}
			}
			
			// Pour la dernière ligne
			$lProducteur = ProducteurViewManager::select($lIdPrdt);
			$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
			$lOperation = OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande);
			
			array_push($lContenuTableau,"","","","Total : ",utf8_decode($lOperation[0]->getMontant() * -1),SIGLE_MONETAIRE_PDF,"","");
								
			// Contenu du header du tableau.	
			$lContenuHeader = array(30, 30, 20, 15, 20, 7, 20, 10, "Producteur","Produit",utf8_decode("Qté"),"","Prix","","Solidaire","");
			
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
			$PDF->Output('Bon de Livraison.pdf','D');
		} else {
			return $lVr;
		}
	}	
	
	/**
	* @name getBComCSV($pParam)
	* @return Un Fichier CSV
	* @desc Retourne le bon de livraison en format CSV
	*/
	public function getBComCSV($pParam) {
		$lVr = ExportBonLivraisonValid::validAjout($pParam);
		
		if($lVr->getValid()) {			
			$lCSV = new CSV();
			$lCSV->setNom('Bon_de_Livraison.csv'); // Le Nom
	
			// L'entete
			$lEntete = array("Producteur","Produit","Commande","","Prix","","Livraison","","Prix","","Solidaire","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lIdCommande = $pParam["id_commande"];
			$lLignesBonLivraison = InfoBonLivraisonViewManager::selectByIdCommande($lIdCommande);
			
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonLivraison as $lLigne) {
				if($lLigne->getProIdProducteur() != NULL) { // évite les lignes vides
					if($lLigne->getProIdProducteur() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						if($lIdPrdt != 0) {
							$lProducteur = ProducteurViewManager::select($lIdPrdt);
							$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
							$lOperation = OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande);
							
							$lLignecontenu = array("","","","","","","","Total : ",$lOperation[0]->getMontant() * -1,SIGLE_MONETAIRE,"","");
							array_push($lContenuTableau,$lLignecontenu);
							$lLignecontenu = array("","","","","","","","","","","","");
							array_push($lContenuTableau,$lLignecontenu);
						}
						$lNomPrdt = $lLigne->getPrdtPrenom() . " " . $lLigne->getPrdtNom();
					}
					
					if( $lLigne->getStoQuantite() == '' || $lLigne->getStoQuantite() == NULL) {
						$lQuantite = '';
						$lUniteQuantite = '';
					} else {
						$lQuantite = $lLigne->getStoQuantite();
						$lUniteQuantite = $lLigne->getProUniteMesure();
					}
					
					if( $lLigne->getOpeMontant() == '' || $lLigne->getOpeMontant() == NULL) {
						$lMontant = '';
						$lSigleMontant = '';
					} else {
						$lMontant = $lLigne->getOpeMontant();
						$lSigleMontant = SIGLE_MONETAIRE;
					}
				
					if( $lLigne->getStoQuantiteLivraison() == '' || $lLigne->getStoQuantiteLivraison() == NULL) {
						$lQuantiteLivraison = '';
						$lUniteQuantiteLivraison = '';
					} else {
						$lQuantiteLivraison = $lLigne->getStoQuantiteLivraison();
						$lUniteQuantiteLivraison = $lLigne->getProUniteMesure();
					}
				
					if( $lLigne->getOpeMontantLivraison() == '' || $lLigne->getOpeMontantLivraison() == NULL) {
						$lMontantLivraison = '';
						$lSigleMontantLivraison = '';
					} else {
						$lMontantLivraison = $lLigne->getOpeMontantLivraison();
						$lSigleMontantLivraison = SIGLE_MONETAIRE;
					}
				
					if( $lLigne->getStoQuantiteSolidaire() == '' || $lLigne->getStoQuantiteSolidaire() == NULL) {
						$lQuantiteSolidaire = '';
						$lUniteQuantiteSolidaire = '';
					} else {
						$lQuantiteSolidaire = $lLigne->getStoQuantiteSolidaire();
						$lUniteQuantiteSolidaire = $lLigne->getProUniteMesure();
					}
					
					$lLignecontenu = array(	$lNomPrdt,
											$lLigne->getNproNom(),
											$lQuantite,
											$lUniteQuantite,
											$lMontant,
											$lSigleMontant,
											$lQuantiteLivraison,
											$lUniteQuantiteLivraison,
											$lMontantLivraison,
											$lSigleMontantLivraison,
											$lQuantiteSolidaire,
											$lUniteQuantiteSolidaire
											);
					
					array_push($lContenuTableau,$lLignecontenu);
					$lIdPrdt = $lLigne->getProIdProducteur();
				}
			}
			
			// Pour la dernière ligne
			$lProducteur = ProducteurViewManager::select($lIdPrdt);
			$lIdCompte = $lProducteur[0]->getPrdtIdCompte();
			$lOperation = OperationManager::selectOpeLivraison($lIdCompte,$lIdCommande);
			
			$lLignecontenu = array("","","","","","","","Total : ",$lOperation[0]->getMontant() * -1,SIGLE_MONETAIRE,"","");
			array_push($lContenuTableau,$lLignecontenu);
			
			$lCSV->setData($lContenuTableau);
			
			// Export en CSV
			$lCSV->output();
		} else {
			return $lVr;
		}	
	}
}
?>