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
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueStockManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "StockValid.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

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
				
			case 4 : // Reservation				
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
		
		$this->insertHistorique($pStock); // Ajout historique
		
		$lStockActuel = $this->get($pStock->getId());
		$pStock->setDate(StringUtils::dateTimeAujourdhuiDb());
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
			
			case 4 : // Reservation				
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
}
?>