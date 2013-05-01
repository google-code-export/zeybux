<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/07/2011
// Fichier : StockService.php
//
// Description : Classe StockService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VALIDATEUR . "StockValid.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_VO . "StockProduitReservationVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockQuantiteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockSolidaireManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueStockManager.php");

/**
 * @name StockService
 * @author Julien PIERRE
 * @since 10/07/2011
 * @desc Classe Service d'un Stock
 */
class StockService
{		
	/**
	* @name set($pStock)
	* @param StockVO
	* @return integer
	* @desc Ajoute ou modifie une opération
	*/
	public function set($pStock) {
		$lStockValid = new StockValid();
		if($lStockValid->insert($pStock)) {
			return $this->insert($pStock);			
		} else if($lStockValid->update($pStock)) {
			return $this->update($pStock);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pStock)
	* @param StockVO
	* @return integer
	* @desc Ajoute une opération
	*/
	private function insert($pStock) {

		// TODO les test : on insere que les types 0/1/2/3/4
		
		$pStock->setDate(StringUtils::dateTimeAujourdhuiDb());
		
		$lId = StockManager::insert($pStock); // Ajout de l'opération
		$pStock->setId($lId);
		$this->insertHistorique($pStock); // Ajout historique

		switch($pStock->getType()) {
			case 0 : // Reservation				
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				if($pStock->getQuantite() > 0) { // Reservation Producteur (commande)
					// Maj Stock Reservation et qté initiale dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					ProduitManager::update($lProduit);
				} else { // Reservation Adherent
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() + $pStock->getQuantite());
					ProduitManager::update($lProduit);
				}
				break;
				
			case 4 : // Livraison				
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				if($pStock->getQuantite() > 0) { // Livraison Producteur
					// Maj Stock Reservation et qté initiale dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					ProduitManager::update($lProduit);
				}
				break;
		}	
		return $lId;
	}
	
	/**
	* @name update($pStock)
	* @param StockVO
	* @return integer
	* @desc Met à jour une opération
	*/
	private function update($pStock) {
		// TODO les test : on update que les types 0/1/2/3/4/5/6
		
		
		//var_dump($pStock);
		$lStockActuel = $this->get($pStock->getId());
		$pStock->setDate(StringUtils::dateTimeAujourdhuiDb());
		$this->insertHistorique($pStock); // Ajout historique
		// TODO Mise à jour du stock selon le type
		switch($pStock->getType()) {
			case 0 : // Reservation
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				if($pStock->getQuantite() > 0) { // Reservation Producteur (commande)
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					ProduitManager::update($lProduit);
				} else { // Reservation Adherent
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() + $pStock->getQuantite() - $lStockActuel->getQuantite());
					ProduitManager::update($lProduit);
				}
				break;
			
			case 4 : // Livraison				
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				if($pStock->getQuantite() > 0) { // Livraison Producteur
					// Maj Stock Reservation et qté initiale dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					ProduitManager::update($lProduit);
				}
				break;
			
			case 6 : // Reservation annulée
				// Maj Stock Reservation dans le produit
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				$lProduit->setStockReservation($lProduit->getStockReservation() - $lStockActuel->getQuantite());
				ProduitManager::update($lProduit);
				break;
		}
		
		return StockManager::update($pStock); // update
	}
	
	/**
	* @name updateStockProduit($pStock)
	* @param StockVO
	* @return integer
	* @desc Met à jour une opération
	*/
	public function updateStockProduit($pStock) {
		// TODO les test : on update que les types 0/1/2/3/4/5/6
		
		
		//var_dump($pStock);
		$lStockActuel = $this->get($pStock->getId());
		$pStock->setDate(StringUtils::dateTimeAujourdhuiDb());
		// TODO Mise à jour du stock selon le type
		switch($pStock->getType()) {
			case 0 : // Reservation
				$lLot = DetailCommandeManager::select($pStock->getIdDetailCommande());
				$lProduit = ProduitManager::select($lLot->getIdProduit());
				
				
				if($pStock->getQuantite() != -1 && $lProduit->getStockInitial() == -1) {
					//var_dump($lProduit);
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					//var_dump($lProduit);
					ProduitManager::update($lProduit);
				} else if($pStock->getQuantite() == -1 && $lProduit->getStockInitial() != -1) {
					//echo 2;
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial());
					$lProduit->setStockInitial(-1);
					ProduitManager::update($lProduit);
					
				} else if($pStock->getQuantite() != -1 && $lProduit->getStockInitial() != -1) {
					//echo 3;
					// Maj Stock Reservation dans le produit
					$lProduit->setStockReservation($lProduit->getStockReservation() - $lProduit->getStockInitial() + $pStock->getQuantite());
					$lProduit->setStockInitial($pStock->getQuantite());
					ProduitManager::update($lProduit);
				}
				break;
		}
		$this->insertHistorique($pStock); // Ajout historique
		return StockManager::update($pStock); // update
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une opération
	*/
	public function delete($pId) {
		$lStockValid = new StockValid();
		if($lStockValid->delete($pId)){
			$lStock = $this->get($pId);
			switch($lStock->getType()) {
				case 0 : // Annulation de la reservation
					$lStock->setType(6);
					return $this->update($lStock);
					break;
					
				case 1 : // Annulation de l'achat
					$lStock->setType(8);
					return $this->update($lStock);
					break;
					
				case 2 : // Annulation de l'achat solidaire
					$lStock->setType(10);
					return $this->update($lStock);
					break;
					
				case 3 : // Annulation du Bon de commande
					$lStock->setType(7);
					return $this->update($lStock);
					break;
					
				case 4 : // Annulation du Bon de commande
					$lStock->setType(9);
					return $this->update($lStock);
					break;
					
				default:
					$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
					$this->insertHistorique($lStock); // Ajout historique
					return StockManager::delete($pId);
					break;
			}	
		} else {
			return false;
		}
	}
	
	/**
	* @name insertHistorique($pStock)
	* @param StockVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la StockVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	private function insertHistorique($pStock) {		
		$lHistoriqueStock = new HistoriqueStockVO();
		$lHistoriqueStock->setStoId($pStock->getId());
		$lHistoriqueStock->setDate($pStock->getDate());
		$lHistoriqueStock->setQuantite($pStock->getQuantite());
		$lHistoriqueStock->setType($pStock->getType());
		$lHistoriqueStock->setIdCompte($pStock->getIdCompte());
		$lHistoriqueStock->setIdDetailCommande($pStock->getIdDetailCommande());
		$lHistoriqueStock->setIdOperation($pStock->getIdOperation());
		$lHistoriqueStock->setIdConnexion($_SESSION[ID_CONNEXION]);
		return HistoriqueStockManager::insert($lHistoriqueStock);
	}
		
	/**
	* @name get($pId)
	* @param integer
	* @return array(StockVO) ou StockVO
	* @desc Retourne une liste de virement
	*/
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
		
	/**
	* @name select($pId)
	* @param integer
	* @return StockVO
	* @desc Retourne une Stock
	*/
	public function select($pId) {
		return StockManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(StockVO)
	* @desc Retourne une liste d'Stock
	*/
	public function selectAll() {
		return StockManager::selectAll();
	}
	
	/**
	* @name getDetailReservation($pIdOperation)
	* @return array(StockVO)
	* @desc Retourne une liste d'Stock
	*/
	public function getDetailReservation($pIdOperation) {	
		return StockManager::recherche(
			array(StockManager::CHAMP_STOCK_ID_OPERATION),
			array('='),
			array($pIdOperation),
			array(StockManager::CHAMP_STOCK_DATE,StockManager::CHAMP_STOCK_TYPE),
			array('DESC','ASC'));
	}
	
/** Solidaire **/
	
	/**
	* @name setSolidaire($pStock)
	* @param StockSolidaireVO
	* @return integer
	* @desc Ajoute ou modifie le stock solidaire
	*/
	public function setSolidaire($pStock) {
		$lStockValid = new StockValid();
		if($lStockValid->inputSolidaire($pStock)) {
			if($lStockValid->insertSolidaire($pStock)) {
				return $this->insertSolidaire($pStock);			
			} else if($lStockValid->updateSolidaire($pStock)) {
				return $this->updateSolidaire($pStock);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertSolidaire($pStock)
	* @param StockSolidaireVO
	* @return integer
	* @desc Ajoute un stock solidaire
	*/
	private function insertSolidaire($pStock) {
		$pStock->setDateCreation(StringUtils::dateTimeAujourdhuiDb());		
		$lId = StockSolidaireManager::insert($pStock); // Ajout du stock
		return $lId;
	}
	
	/**
	* @name updateSolidaire($pStock)
	* @param StockSolidaireVO
	* @return integer
	* @desc Met à jour un stock solidaire
	*/
	private function updateSolidaire($pStock) {
		$lStockActuel = $this->getSolidaire($pStock->getId());
		$pStock->setDateCreation($lStockActuel->getDateCreation());
		$pStock->setDateModification(StringUtils::dateTimeAujourdhuiDb());
		//$pStock->setEtat($lStockActuel->getEtat());
		return StockSolidaireManager::update($pStock); // update
	}
	
	/**
	* @name deleteSolidaire($pId)
	* @param integer
	* @desc Supprime le stock
	*/
	public function deleteSolidaire($pId) {
		$lStockValid = new StockValid();
		if($lStockValid->deleteSolidaire($pId)){
			$lStockSolidaire = $this->getSolidaire($pId);
			$lStockSolidaire->setEtat(1);
			return $this->updateSolidaire($lStockSolidaire);			
		} else {
			return false;
		}
	}
	
	/**
	* @name getSolidaire($pId)
	* @param integer
	* @return array(StockSolidaireVO) ou StockSolidaireVO
	* @desc Retourne une liste de virement
	*/
	public function getSolidaire($pId = null) {
		if($pId != null) {
			return $this->selectSolidaire($pId);
		} else {
			return $this->selectSolidaireAll();
		}
	}
	
	/**
	* @name selectSolidaire($pId)
	* @param integer
	* @return StockSolidaireVO
	* @desc Retourne une Stock
	*/
	public function selectSolidaire($pId) {
		return StockSolidaireManager::select($pId);
	}
	
	/**
	* @name selectSolidaireAll()
	* @return array(StockSolidaireVO)
	* @desc Retourne une liste de Stock
	*/
	public function selectSolidaireAll() {
		return StockSolidaireManager::selectAll();
	}
	
	/**
	* @name selectSolidaireAllActif()
	* @return array(StockSolidaireVO)
	* @desc Retourne une liste de Stock
	*/
/*	public function selectSolidaireAllActif() {
		return StockSolidaireManager::recherche(
			array(StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT),
			array('='),
			array(0),
			array(''),
			array(''));
	}*/
	
	/**
	* @name selectSolidaireByIdNomProduitUnite()
	* @return array(StockSolidaireVO)
	* @desc Retourne une liste de Stock
	*/
	/*public function selectSolidaireByIdNomProduitUnite($pIdNomProduit,$pUnite) {
		return StockSolidaireManager::recherche(
			array(StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT,StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT,StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE),
			array('=','=','='),
			array(0,$pIdNomProduit,$pUnite),
			array(''),
			array(''));
	}*/
		
	/**
	 * @name selectInfoBonCommandeStockProduitReservation($pIdCommande, $pIdCompteProducteur)
	 * @param integer
	 * @param integer
	 * @return array(StockProduitReservationVO)
	 * @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande et IdCompteProducteur $pIdCompteProducteur . Puis les renvoie sous forme d'une collection de StockProduitReservationVO
	 */
	public function selectInfoBonCommandeStockProduitReservation($pIdCommande, $pIdCompteProducteur) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
		"(SELECT "
				. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
				"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
				"," . ProduitManager::CHAMP_PRODUIT_ID .
				"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
				"," . ProduitManager::CHAMP_PRODUIT_TYPE .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
				//", (" . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " - " . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . ") AS " . StockManager::CHAMP_STOCK_QUANTITE .
				
				", (round(sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . " * " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . " / " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "),0) * -(1)) AS " . StockManager::CHAMP_STOCK_QUANTITE .
				
				
				", sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .") AS " . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
				"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
				"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE .
				"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX .
				" FROM ((("
						. ProduitManager::TABLE_PRODUIT	.
						" JOIN " . NomProduitManager::TABLE_NOMPRODUIT . " ON ((" . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .")))
				 LEFT JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " ON ((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID .")))
				 LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " ON (((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE .") and (" . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0))))
			WHERE "
					 		. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = " . $pIdCommande
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . " = " . $pIdCompteProducteur
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ETAT . " = 0 "
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " <> -(1) "
					 		. " AND " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = 0 "
					 		. " AND ( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0 "
					 		. " OR ISNULL( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . "))
			GROUP BY " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . ")
			UNION
			(SELECT "
						. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
						"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
						"," . ProduitManager::CHAMP_PRODUIT_ID .
						"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
						"," . ProduitManager::CHAMP_PRODUIT_TYPE .
						"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
						"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
						//", ((" . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " - " . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . ") + 1) AS " . StockManager::CHAMP_STOCK_QUANTITE .
						", (round(sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . " * " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . " / " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "),0) * -(1)) AS " . StockManager::CHAMP_STOCK_QUANTITE .
						
						", sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .") AS " . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .
						"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
						"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE .
						"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX .
						" FROM ((("
								. ProduitManager::TABLE_PRODUIT	.
								" JOIN " . NomProduitManager::TABLE_NOMPRODUIT . " ON ((" . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .")))
				 LEFT JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " ON ((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID .")))
				 LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " ON (((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE .") and (" . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0))))
			WHERE "
					 		. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = " . $pIdCommande
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . " = " . $pIdCompteProducteur
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ETAT . " = 0 "
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " = -(1) "
					 		. " AND " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = 0 "
					 		. " AND ( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0 "
					 		. " OR ISNULL( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . "))
			GROUP BY " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . ")
			ORDER BY " . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . ";";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lListeStockProduitReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitReservation,
				$this->remplirStockProduitReservation(
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
				$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
				$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE],
				$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]));
			}
		} else {
			$lListeStockProduitReservation[0] = new StockProduitReservationVO();
		}
		return $lListeStockProduitReservation;
	}
	
	/**
	 * @name selectByIdProduitStockProduitReservation($pIdProduit)
	 * @param integer
	 * @return array(StockProduitReservationVO)
	 * @desc Récupères toutes les lignes de la table ayant pour IdProduit $pIdProduit. Puis les renvoie sous forme d'une collection de StockProduitReservationVO
	 */
	public function selectByIdProduitStockProduitReservation($pIdProduit) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
		"(SELECT "
				. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
				"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
				"," . ProduitManager::CHAMP_PRODUIT_ID .
				"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
				"," . ProduitManager::CHAMP_PRODUIT_TYPE .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
				", (" . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " - " . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . ") AS " . StockManager::CHAMP_STOCK_QUANTITE .
				", sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .") AS " . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT
				. " FROM ((("
						. ProduitManager::TABLE_PRODUIT	.
						" JOIN " . NomProduitManager::TABLE_NOMPRODUIT . " ON ((" . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .")))
				 LEFT JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " ON ((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID .")))
				 LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " ON (((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE .") and (" . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0))))
			WHERE "
					 		. ProduitManager::CHAMP_PRODUIT_ID . " = " . $pIdProduit
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ETAT . " = 0 "
					 				. " AND " . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " <> -(1) "
					 						. " AND " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = 0 "
					 								. " AND ( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0 "
					 										. " OR ISNULL( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . "))
			GROUP BY " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . ")
			UNION
			(SELECT "
						. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
						"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
						"," . ProduitManager::CHAMP_PRODUIT_ID .
						"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
						"," . ProduitManager::CHAMP_PRODUIT_TYPE .
						"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
						"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
						", ((" . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " - " . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . ") + 1) AS " . StockManager::CHAMP_STOCK_QUANTITE .
						", sum(" . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT .") AS " . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT
						. " FROM ((("
								. ProduitManager::TABLE_PRODUIT	.
								" JOIN " . NomProduitManager::TABLE_NOMPRODUIT . " ON ((" . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .")))
				 LEFT JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " ON ((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID .")))
				 LEFT JOIN " . DetailOperationManager::TABLE_DETAILOPERATION . " ON (((" . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . DetailOperationManager::CHAMP_DETAILOPERATION_ID_DETAIL_COMMANDE .") and (" . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0))))
			WHERE "
					 		. ProduitManager::CHAMP_PRODUIT_ID . " = " . $pIdProduit
					 		. " AND " . ProduitManager::CHAMP_PRODUIT_ETAT . " = 0 "
					 				. " AND " . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " = -(1) "
					 						. " AND " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ETAT . " = 0 "
					 								. " AND ( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . " = 0 "
					 										. " OR ISNULL( " . DetailOperationManager::CHAMP_DETAILOPERATION_TYPE_PAIEMENT . "))
			GROUP BY " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . ");";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lListeStockProduitReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitReservation,
				$this->remplirStockProduitReservation(
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
				$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
				$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
				$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT]));
			}
		} else {
			$lListeStockProduitReservation[0] = new StockProduitReservationVO();
		}
		return $lListeStockProduitReservation;
	}
	
	/**
	 * @name remplirStockProduitReservation($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pProType, $pNproNumero, $pNproNom, $pStoQuantite, $pDopeMontant, $pDcomId, $pDcomTaille, $pDcomPrix)
	 * @param int(11)
	 * @param int(11)
	 * @param int(11)
	 * @param tinyint(4)
	 * @param varchar(20)
	 * @param varchar(50)
	 * @param varchar(50)
	 * @param decimal(33,2)
	 * @param decimal(32,2)
	 * @param int(11)
	 * @param decimal(10,2)
	 * @param decimal(10,2)
	 * @return StockProduitReservationVO
	 * @desc Retourne une StockProduitReservationVO remplie
	 */
	private function remplirStockProduitReservation($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pProType, $pNproNumero, $pNproNom, $pStoQuantite, $pDopeMontant, $pDcomId, $pDcomTaille, $pDcomPrix) {
		$lStockProduitReservation = new StockProduitReservationVO();
		$lStockProduitReservation->setProIdCommande($pProIdCommande);
		$lStockProduitReservation->setProIdCompteFerme($pProIdCompteFerme);
		$lStockProduitReservation->setProId($pProId);
		$lStockProduitReservation->setProUniteMesure($pProUniteMesure);
		$lStockProduitReservation->setProType($pProType);
		$lStockProduitReservation->setNproNumero($pNproNumero);
		$lStockProduitReservation->setNproNom($pNproNom);
		$lStockProduitReservation->setStoQuantite($pStoQuantite);
		$lStockProduitReservation->setDopeMontant($pDopeMontant);
		$lStockProduitReservation->setDcomId($pDcomId);
		$lStockProduitReservation->setDcomTaille($pDcomTaille);
		$lStockProduitReservation->setDcomPrix($pDcomPrix);
		return $lStockProduitReservation;
	}
	
	/**
	 * @name getStockProduitFerme($pIdCompteFerme)
	 * @param integer
	 * @return array(StockProduitFermeVO)
	 * @desc Retourne le stock des produits d'une ferme
	 */
	public function getStockProduitFerme($pIdCompteFerme) {	
		return NomProduitManager::selectStockProduitFerme($pIdCompteFerme);
	}
	
	/**
	 * @name setStockQuantite($pStockQuantite)
	 * @param StockSolidaireVO
	 * @return bool
	 * @desc Ajoute ou modifie le stock quantite
	 */
	public function setStockQuantite($pStockQuantite) {
		$lStockValid = new StockValid();
		if($lStockValid->inputStockQuantite($pStockQuantite)) {
			if($lStockValid->insertStockQuantite($pStockQuantite)) {
				return $this->insertStockQuantite($pStockQuantite);
			} else if($lStockValid->updateStockQuantite($pStockQuantite)) {
				return $this->updateStockQuantite($pStockQuantite);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * @name insertStockQuantite($pStockQuantite)
	 * @param StockQuantiteVO
	 * @return integer
	 * @desc Ajoute un stock quantite
	 */
	private function insertStockQuantite($pStockQuantite) {
		$pStockQuantite->setDateCreation(StringUtils::dateTimeAujourdhuiDb());
		$pStockQuantite->setIdLogin($_SESSION[DROIT_ID]);
		$pStockQuantite->setEtat(0);
		return StockQuantiteManager::insert($pStockQuantite); // Ajout du stock quantite retour l'Id
	}
	
	/**
	 * @name updateStockQuantite($pStockQuantite)
	 * @param StockQuantiteVO
	 * @return integer
	 * @desc Met à jour un stock quantite
	 */
	private function updateStockQuantite($pStockQuantite) {
		
		$lStockActuel = $this->getStockQuantite($pStockQuantite->getId());
		$pStockQuantite->setIdNomProduit($lStockActuel->getIdNomProduit());
		$pStockQuantite->setUnite($lStockActuel->getUnite());
		$pStockQuantite->setDateCreation($lStockActuel->getDateCreation());
		$pStockQuantite->setDateModification(StringUtils::dateTimeAujourdhuiDb());
		$pStockQuantite->setIdLogin($_SESSION[DROIT_ID]);
		//$pStock->setEtat($lStockActuel->getEtat());
		
		return StockQuantiteManager::update($pStockQuantite); // update
	}
	
	/**
	 * @name deleteStockQuantite($pId)
	 * @param integer
	 * @desc Supprime le stock quantite
	 */
	public function deleteStockQuantite($pId) {
		$lStockValid = new StockValid();
		if($lStockValid->deleteStockQuantite($pId)){
			$lStockQuantite = $this->getStockQuantite($pId);
			$lStockQuantite->setEtat(1);
			return $this->updateStockQuantite($lStockQuantite);
		} else {
			return false;
		}
	}
	
	/**
	 * @name getStockQuantite($pId)
	 * @param integer
	 * @return array(StockQuantiteVO) ou StockQuantiteVO
	 * @desc Retourne une liste de StockQuantite
	 */
	public function getStockQuantite($pId = null) {
		if($pId != null) {
			return $this->selectQuantite($pId);
		} else {
			return $this->selectQuantiteAll();
		}
	}
	
	/**
	 * @name selectQuantite($pId)
	 * @param integer
	 * @return StockQuantiteVO
	 * @desc Retourne une ligne de Stock Quantite
	 */
	public function selectQuantite($pId) {
		return StockQuantiteManager::select($pId);
	}
	
	/**
	 * @name selectQuantiteAll()
	 * @return array(StockQuantiteVO)
	 * @desc Retourne une liste de Stock Quantite
	 */
	public function selectQuantiteAll() {
		return StockQuantiteManager::selectAll();
	}
	
	/**
	 * @name selectQuantiteByIdNomProduitUnite($pIdNomProduit,$pUnite)
	 * @return array(StockQuantiteVO)
	 * @desc Retourne une liste de Stock Quantite
	 */
	public function selectQuantiteByIdNomProduitUnite($pIdNomProduit,$pUnite) {
		return StockQuantiteManager::recherche(
				array(StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT, StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT, StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE),
				array('=','=','='),
				array(0,$pIdNomProduit,$pUnite),
				array(''),
				array(''));
	}
	
	/**
	 * @name selectQuantiteAllActif()
	 * @return array(StockQuantiteVO)
	 * @desc Retourne une liste de Stock Quantite
	 */
	public function selectQuantiteAllActif() {
		return StockQuantiteManager::recherche(
				array(StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT),
				array('='),
				array(0),
				array(''),
				array(''));
	}
}
?>