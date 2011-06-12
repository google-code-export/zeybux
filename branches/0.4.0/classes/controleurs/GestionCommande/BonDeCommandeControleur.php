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
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitReservationViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "InfoBonCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "OperationProduitBonCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ListeProducteurCommandeViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "CommandeCompleteEnCoursViewManager.php");
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "ProducteurViewManager.php");

include_once(CHEMIN_CLASSES_RESPONSE . "AfficheBonDeCommandeResponse.php" );
include_once(CHEMIN_CLASSES_RESPONSE . "AfficheListeProduitBonDeCommandeResponse.php" );

include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

include_once(CHEMIN_CLASSES_VR . "TemplateVR.php" );
include_once(CHEMIN_CLASSES_VR . "VRerreur.php" );

include_once(CHEMIN_CLASSES_VALIDATEUR . "ProduitsBonDeCommandeValid.php" );
include_once(CHEMIN_CLASSES_VALIDATEUR . "ExportBonCommandeValid.php" );

include_once(CHEMIN_CLASSES_UTILS . "phpToPDF.php");
include_once(CHEMIN_CLASSES_UTILS . "CSV.php");

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
		$lIdCommande = $pParam["id_commande"];		

		if(is_int((int)$lIdCommande)) {			
			$lCommande = CommandeCompleteEnCoursViewManager::select($lIdCommande);

			if($lCommande[0]->getComId() == $lIdCommande) {			
				$lResponse = new AfficheBonDeCommandeResponse();
				
				$lProducteurs = ListeProducteurCommandeViewManager::select($lIdCommande);
				
				$lResponse->setComNumero($lCommande[0]->getComNumero());
				$lResponse->setProducteurs($lProducteurs);
				
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
	* @name getListeProduitCommande($pParam)
	* @return AfficheListeProduitBonDeCommandeResponse
	* @desc Retourne la liste des producteurs de cette commande.
	*/
	public function getListeProduitCommande($pParam) {
		$lIdCommande = $pParam["id_commande"];
		$lIdProducteur = $pParam["id_producteur"];
		// TODO réaliser des test pour vérifier la validité des inputs
		
		$lResponse = new AfficheListeProduitBonDeCommandeResponse();
		
		$lResponse->setProduits(StockProduitReservationViewManager::selectInfoBonCommande($lIdCommande,$lIdProducteur));
		$lResponse->setProduitsCommande(InfoBonCommandeViewManager::selectInfoBonCommande($lIdCommande,$lIdProducteur));
				
		return $lResponse;
	}
	
	/**
	* @name enregistrerBonDeCommande($pParam)
	* @return AfficheListeProduitBonDeCommandeResponse
	* @desc Enregistre le bon de commande.
	*/
	public function enregistrerBonDeCommande($pParam) {
		$lIdCommande = $pParam["id_commande"];
		$lIdProducteur = $pParam["id_producteur"];
		$lProduits = $pParam["produits"];
		
		$lVr = ProduitsBonDeCommandeValid::validAjout($pParam);
		
		if($lVr->getValid()) {
			$lProducteur = ProducteurViewManager::select($lIdProducteur);			
			$lBonsCommandeActuel = StockCommandeViewManager::selectByIdProducteur($lIdProducteur);

			foreach($lProduits as $lProduit) {
				$lMaj = false;
				foreach($lBonsCommandeActuel as $lBon) {
					if($lProduit["id"] == $lBon->getProId()) {
						$lMaj = true;
						
						$lStock = new StockVO();
						$lStock->setId($lBon->getStoId());
						$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lStock->setQuantite($lProduit["quantite"]);
						$lStock->setType(3);
						$lStock->setIdCompte(0);
						$lStock->setIdDetailCommande($lBon->getDcomId());
						$lStock->setIdCommande(0);
	
						StockManager::update($lStock);
						
						$lOpeActuel = OperationProduitBonCommandeViewManager::selectInfoBonCommandeProduit($lIdCommande,$lIdProducteur,$lBon->getProId());
						$lOperation = new OperationVO();
						$lOperation->setId($lOpeActuel[0]->getOpeId());
						$lOperation->setIdCompte($lProducteur[0]->getPrdtIdCompte());
						$lOperation->setMontant($lProduit["prix"]);
						$lOperation->setLibelle('Bon de Commande');
						$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
						$lOperation->setTypePaiement(5);		
						$lOperation->setTypePaiementChampComplementaire($lBon->getProId());
						$lOperation->setType(3);
						$lOperation->setIdCommande($lIdCommande);
						
						OperationManager::update($lOperation);
					}
				}
				if(!$lMaj) {
					$lDcom = DetailCommandeManager::selectByIdProduit($lProduit["id"]);
					
					$lStock = new StockVO();
					$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lStock->setQuantite($lProduit["quantite"]);
					$lStock->setType(3);
					$lStock->setIdCompte(0);				
					$lStock->setIdDetailCommande($lDcom[0]->getId());
					$lStock->setIdCommande(0);
					StockManager::insert($lStock);
					
					$lOperation = new OperationVO();
					$lOperation->setIdCompte($lProducteur[0]->getPrdtIdCompte());
					$lOperation->setMontant($lProduit["prix"]);
					$lOperation->setLibelle('Bon de Commande');
					$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lOperation->setTypePaiement(5);		
					$lOperation->setTypePaiementChampComplementaire($lProduit["id"]);
					$lOperation->setType(3);
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
				if($lLigne->getProIdProducteur() != NULL) { // évite les lignes vides
					if($lLigne->getProIdProducteur() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						$lNomPrdt = utf8_decode($lLigne->getPrdtPrenom()) . " " . utf8_decode($lLigne->getPrdtNom());
					}					
					array_push($lContenuTableau,
											$lNomPrdt,
											utf8_decode($lLigne->getNproNom()),
											$lLigne->getStoQuantite(),
											utf8_decode($lLigne->getProUniteMesure()),
											$lLigne->getOpeMontant(),
											SIGLE_MONETAIRE_PDF);
											
					$lIdPrdt = $lLigne->getProIdProducteur();
				}
			}
					
			// Contenu du header du tableau.	
			$lContenuHeader = array(30, 30, 30, 10, 30, 10, "Producteur","Produit","Commande","","Prix","");
			
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
			$lEntete = array("Producteur","Produit","Commande","","Prix","");
			$lCSV->setEntete($lEntete);
			
			// Les données
			$lContenuTableau = array();
			$lIdPrdt = 0;
			foreach($lLignesBonCommande as $lLigne) {
				if($lLigne->getProIdProducteur() != NULL) { // évite les lignes vides
					if($lLigne->getProIdProducteur() == $lIdPrdt) {
						$lNomPrdt = "";
					} else {
						$lNomPrdt = $lLigne->getPrdtPrenom() . " " . $lLigne->getPrdtNom();
					}
					
					$lLignecontenu = array(	$lNomPrdt,
											$lLigne->getNproNom(),
											$lLigne->getStoQuantite(),
											$lLigne->getProUniteMesure(),
											$lLigne->getOpeMontant(),
											SIGLE_MONETAIRE
											);
					
					array_push($lContenuTableau,$lLignecontenu);
					$lIdPrdt = $lLigne->getProIdProducteur();
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