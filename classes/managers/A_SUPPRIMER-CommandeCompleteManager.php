<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2010
// Fichier : CommandeCompleteManager.php
//
// Description : Classe de gestion des Commandes
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CommandeCompleteVO.php");
include_once(CHEMIN_CLASSES_VO . "ProduitCommandeVO.php");
include_once(CHEMIN_CLASSES_VO . "DetailCommandeVO.php");

include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");

include_once(CHEMIN_CLASSES_VIEW_MANAGER . "StockProduitInitiauxViewManager.php");

/**
 * @name CommandeCompleteManager
 * @author Julien PIERRE
 * @since 04/05/2010
 * 
 * @desc Classe permettant l'accès aux données des Commande
 */
class CommandeCompleteManager
{
	/**
	* @name select($pId)
	* @param integer
	* @return CommandeCompleteVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CommandeCompleteVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =		
		"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DESCRIPTION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_ARCHIVE .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .  		    
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX . "  
		FROM " . CommandeManager::TABLE_COMMANDE . "
			JOIN " .  ProduitManager::TABLE_PRODUIT . "
				ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " 
			JOIN " . DetailCommandeManager::TABLE_DETAILCOMMANDE . " 
				ON " . ProduitManager::CHAMP_PRODUIT_ID . " = " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " 
			JOIN " .  NomProduitManager::TABLE_NOMPRODUIT . "
				ON " . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID . "			
			JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
				ON " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . " = " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . "
		WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		if( mysql_num_rows($lSql) > 0 ) {
			
			$lLigne = mysql_fetch_assoc($lSql);
			
			$lCommandecomplete = new CommandeCompleteVO();
			
			/* Commande */
			$lCommandecomplete->setId($lLigne[CommandeManager::CHAMP_COMMANDE_ID]);
			$lCommandecomplete->setNumero($lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO]);
			$lCommandecomplete->setNom($lLigne[CommandeManager::CHAMP_COMMANDE_NOM]);
			$lCommandecomplete->setDescription($lLigne[CommandeManager::CHAMP_COMMANDE_DESCRIPTION]);
			$lCommandecomplete->setDateMarcheDebut($lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]);
			$lCommandecomplete->setDateMarcheFin($lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]);
			$lCommandecomplete->setDateFinReservation($lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION]);
			$lCommandecomplete->setArchive($lLigne[CommandeManager::CHAMP_COMMANDE_ARCHIVE]);
	
			$lCommandecompleteProduit = array();
			
			/* Produits */
			$lProduitCommande = new ProduitCommandeVO();
			
			$lProduitCommande->setId($lLigne[ProduitManager::CHAMP_PRODUIT_ID]);
			$lProduitCommande->setIdProducteur($lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR]);
			$lProduitCommande->setIdNom($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID]);
			$lProduitCommande->setNom($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]);
			$lProduitCommande->setDescription($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION]);
			$lProduitCommande->setIdCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]);
			$lProduitCommande->setCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]);
			$lProduitCommande->setDescriptionCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]);
			$lProduitCommande->setUnite($lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE]);
			$lProduitCommande->setQteMaxCommande($lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE]);
			
			$lProduitCommandeLots = array();
			
			/* Lots */
			$lLot = new DetailCommandeVO();
			$lLot->setId($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID]);
			$lLot->setIdProduit($lLigne[ProduitManager::CHAMP_PRODUIT_ID]);
			$lLot->setTaille($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE]);
			$lLot->setPrix($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]);
			
			$lProduitCommandeLots[$lLot->getId()] = $lLot;
			$lProduitCommande->setLots($lProduitCommandeLots);

			$lCommandecompleteProduit[$lProduitCommande->getId()] = $lProduitCommande;

			// Si il il y d'autres lots ou produits
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				
				// Preparation du Lot
				$lLot = new DetailCommandeVO();
				$lLot->setId($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID]);
				$lLot->setIdProduit($lLigne[ProduitManager::CHAMP_PRODUIT_ID]);
				$lLot->setTaille($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE]);
				$lLot->setPrix($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]);
								
				// Nouveau Produit
				if( !isset($lCommandecompleteProduit[$lLigne[ProduitManager::CHAMP_PRODUIT_ID]]) ) {
					/* Produits */
					$lProduitCommande = new ProduitCommandeVO();
				
					$lProduitCommande->setId($lLigne[ProduitManager::CHAMP_PRODUIT_ID]);
					$lProduitCommande->setIdProducteur($lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR]);
					$lProduitCommande->setIdNom($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID]);
					$lProduitCommande->setNom($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM]);
					$lProduitCommande->setDescription($lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION]);
					$lProduitCommande->setIdCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID]);
					$lProduitCommande->setCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM]);
					$lProduitCommande->setDescriptionCategorie($lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_DESCRIPTION]);
					$lProduitCommande->setUnite($lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE]);
					$lProduitCommande->setQteMaxCommande($lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE]);
					
					$lProduitCommandeLots = array();
					
					/* Lots */
					$lLot = new DetailCommandeVO();
					$lLot->setId($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID]);
					$lLot->setIdProduit($lLigne[ProduitManager::CHAMP_PRODUIT_ID]);
					$lLot->setTaille($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_TAILLE]);
					$lLot->setPrix($lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_PRIX]);
					
					$lProduitCommandeLots[$lLot->getId()] = $lLot;
					$lProduitCommande->setLots($lProduitCommandeLots);
		
					$lCommandecompleteProduit[$lProduitCommande->getId()] = $lProduitCommande;
				}
				// Nouveau Lot
				else {
					$lProduitCommandeLots = $lCommandecompleteProduit[$lLigne[ProduitManager::CHAMP_PRODUIT_ID]]->getLots();
					$lProduitCommandeLots[$lLot->getId()] = $lLot;
					$lCommandecompleteProduit[$lProduitCommande->getId()]->setLots($lProduitCommandeLots);
				}
			}			
						
			// Récupération des stocks
			$lRequete =	
			"SELECT "
					. ProduitManager::CHAMP_PRODUIT_ID .
				", sum(" . StockManager::CHAMP_STOCK_QUANTITE . ") AS STOCK_QUANTITE
			FROM " . CommandeManager::TABLE_COMMANDE . "
				JOIN " .  ProduitManager::TABLE_PRODUIT . "
					ON " . CommandeManager::CHAMP_COMMANDE_ID . " = " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " 
				JOIN " .  DetailCommandeManager::TABLE_DETAILCOMMANDE . "
					ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID_PRODUIT . " = " . ProduitManager::CHAMP_PRODUIT_ID . " 
				JOIN " . StockManager::TABLE_STOCK . "
					ON " . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . " = " . StockManager::CHAMP_STOCK_ID_DETAIL_COMMANDE . "
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'
			GROUP BY " . ProduitManager::CHAMP_PRODUIT_ID;
			
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
					
			if( mysql_num_rows($lSql) > 0 ) {		
				while ($lLigne = mysql_fetch_assoc($lSql)) {					
					$lCommandecompleteProduit[$lLigne[ProduitManager::CHAMP_PRODUIT_ID]]->setQteRestante($lLigne["STOCK_QUANTITE"]);
				}
					
				$lCommandecomplete->setProduits($lCommandecompleteProduit);
				return $lCommandecomplete;
			} else {			
				$lLots = new DetailCommandeVO();
				$lProduitCommande = new ProduitCommandeVO();
				$lProduitCommande->setLots( array($lLots) );
				$lCommandecomplete = new CommandeCompleteVO();
				$lCommandecomplete->setProduits( array($lProduitCommande) );
				
				return $lCommandecomplete;
			}
			
		} else {			
			$lLots = new DetailCommandeVO();
			$lProduitCommande = new ProduitCommandeVO();
			$lProduitCommande->setLots( array($lLots) );
			$lCommandecomplete = new CommandeCompleteVO();
			$lCommandecomplete->setProduits( array($lProduitCommande) );
			
			return $lCommandecomplete;
		}
	}
	
	/**
	* @name insert($pVo)
	* @param CommandeCompleteVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lCommande = new CommandeVO();
			
		$lCommande->setNom($pVo->getNom());
		$lCommande->setDescription($pVo->getDescription());
		$lCommande->setDateMarcheDebut($pVo->getDateMarcheDebut());
		$lCommande->setDateMarcheFin($pVo->getDateMarcheFin());
		$lCommande->setDateFinReservation($pVo->getDateFinReservation());
		$lCommande->setArchive($pVo->getArchive());
		
		//Insertion de la commande
		$lIdCommande = CommandeManager::insert($lCommande);
		$lCommande->setId($lIdCommande);
		$lCommande->setNumero($lIdCommande);
		CommandeManager::update($lCommande);

		if($lIdCommande != null) {
			foreach($pVo->getProduits() as $lNouveauProduit) {
				// Insertion du produit
				$lProduit = new ProduitVO();
				$lProduit->setIdCommande($lIdCommande);
				$lProduit->setIdNomProduit($lNouveauProduit->getIdNom());
				$lProduit->setUniteMesure($lNouveauProduit->getUnite());
				$lProduit->setMaxProduitCommande($lNouveauProduit->getQteMaxCommande());
				$lProduit->setIdProducteur($lNouveauProduit->getIdProducteur());
				$lIdProduit = ProduitManager::insert($lProduit);

				//Insertion des lots
				foreach($lNouveauProduit->getLots() as $lNouveauLot) {
					$lDetailCommande = new DetailCommandeVO();
					$lDetailCommande->setIdProduit($lIdProduit);
					$lDetailCommande->setTaille($lNouveauLot->getTaille());
					$lDetailCommande->setPrix($lNouveauLot->getPrix());
					$lDcomId = DetailCommandeManager::insert($lDetailCommande);
				}
				
				//Insertion du stock
				$lStock = new StockVO();
				$lStock->setDate(date('Y-m-d H:i:s'));
				$lStock->setQuantite($lNouveauProduit->getQteRestante());
				$lStock->setType(0);
				$lStock->setIdCompte(0);
				$lStock->setIdDetailCommande($lDcomId);
				$lStock->setIdCommande($lIdCommande);
				StockManager::insert($lStock);
			}	
		}
		$lLogger->log("Enregistrement de la commande : " . $lIdCommande,PEAR_LOG_DEBUG); // Maj des logs
		return $lIdCommande;
	}
	
	/**
	* @name update($pVo)
	* @param CommandeCompleteVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CommandeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lIdCommande = $pVo->getId();
		
		$lCommande = new CommandeVO();
		$lCommande->setId($lIdCommande);
		$lCommande->setNumero($pVo->getNumero());
		$lCommande->setNom($pVo->getNom());
		$lCommande->setDescription($pVo->getDescription());
		$lCommande->setDateMarcheDebut($pVo->getDateMarcheDebut());
		$lCommande->setDateMarcheFin($pVo->getDateMarcheFin());
		$lCommande->setDateFinReservation($pVo->getDateFinReservation());
		$lCommande->setArchive($pVo->getArchive());
		
		CommandeManager::update($lCommande); // Maj des infos de la commande

		$lCommandeActuelle = CommandeCompleteManager::select($lIdCommande);
		if($lIdCommande != null && $lCommandeActuelle->getId() != null) {
			
			foreach($lCommandeActuelle->getProduits() as $lProduitActuel) {	
				$lMaj = true;							
				// Produits Modifiés
				foreach($pVo->getProduits() as $lProduitNv) {
					if($lProduitActuel->getId() == $lProduitNv->getId()) {
						$lMaj = false;
						
						$lProduit = new ProduitVO();
						$lProduit->setId($lProduitActuel->getId());
						$lProduit->setIdCommande($lIdCommande);
						$lProduit->setIdNomProduit($lProduitNv->getIdNom());
						$lProduit->setUniteMesure($lProduitNv->getUnite());
						$lProduit->setMaxProduitCommande($lProduitNv->getQteMaxCommande());
						$lProduit->setIdProducteur($lProduitNv->getIdProducteur());
						ProduitManager::update($lProduit);
												
						//Les lots
						foreach($lProduitActuel->getLots() as $lLotActuel) {
							$lMajLot = true;
							foreach($lProduitNv->getLots() as $lLotNv) {								
								// Maj Lot
								if($lLotActuel->getId() == $lLotNv->getId()) {
									$lDcomId = $lLotActuel->getId();
									
									$lMajLot = false;
									$lDetailCommande = new DetailCommandeVO();
									$lDetailCommande->setId($lLotActuel->getId());
									$lDetailCommande->setIdProduit($lProduitActuel->getId());
									$lDetailCommande->setTaille($lLotNv->getTaille());
									$lDetailCommande->setPrix($lLotNv->getPrix());
									DetailCommandeManager::update($lDetailCommande);
								}																
							}
							// Supprimer Lot
							if($lMajLot) {
								DetailCommandeManager::delete($lLotActuel->getId());
							}
						}
						
						// Nouveau Lot
						foreach($lProduitNv->getLots() as $lLotNv) {
							$lAjout = true;
							foreach($lProduitActuel->getLots() as $lLotActuel) {
								if($lLotActuel->getId() == $lLotNv->getId()) {
									$lAjout = false;
								}
							}
							if($lAjout) {
								$lDetailCommande = new DetailCommandeVO();
								$lDetailCommande->setIdProduit($lProduitActuel->getId());
								$lDetailCommande->setTaille($lLotNv->getTaille());
								$lDetailCommande->setPrix($lLotNv->getPrix());
								DetailCommandeManager::insert($lDetailCommande);
							}
						}
						
						//Insertion du stock
						$lStocksActuel = StockProduitInitiauxViewManager::selectByIdCommande($lIdCommande);
						foreach( $lStocksActuel as $lStockActu) {
							if($lStockActu->getIdProduit() == $lProduitActuel->getId()) {
								$lStock = new StockVO();
								$lStock->setId($lStockActu->getId());
								$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
								$lStock->setQuantite($lProduitNv->getQteRestante());
								$lStock->setType(0);
								$lStock->setIdCompte(0);
								$lStock->setIdDetailCommande($lDcomId);
								$lStock->setIdCommande($lIdCommande);
								StockManager::update($lStock);
							}
						}
					}
				}	
				// Produits supprimés
				if($lMaj) {						
					// Suppression des lots
					$lLots = DetailCommandeManager::selectByIdProduit($lProduitActuel->getId());
					foreach($lLots as $lLot) {
						DetailCommandeManager::delete($lLot->getId());
					}
					
					ProduitManager::delete($lProduitActuel->getId());						
				}			
			}
			
			// Les nouveaux produits
			foreach($pVo->getProduits() as $lProduitNv) {
				$lAjout = true;
				foreach($lCommandeActuelle->getProduits() as $lProduitActuel) {
					if($lProduitActuel->getId() == $lProduitNv->getId()) { 
						$lAjout = false;
					}
				}
				if($lAjout) {
				// Insertion du produit
					$lProduit = new ProduitVO();
					$lProduit->setIdCommande($lIdCommande);
					$lProduit->setIdNomProduit($lProduitNv->getIdNom());
					$lProduit->setUniteMesure($lProduitNv->getUnite());
					$lProduit->setMaxProduitCommande($lProduitNv->getQteMaxCommande());
					$lProduit->setIdProducteur($lProduitNv->getIdProducteur());
					$lIdProduit = ProduitManager::insert($lProduit);
					
					//Insertion des lots
					foreach($lProduitNv->getLots() as $lNouveauLot) {
						$lDetailCommande = new DetailCommandeVO();
						$lDetailCommande->setIdProduit($lIdProduit);
						$lDetailCommande->setTaille($lNouveauLot->getTaille());
						$lDetailCommande->setPrix($lNouveauLot->getPrix());
						$lDcomId = DetailCommandeManager::insert($lDetailCommande);
					}
					
					//Insertion du stock
					$lStock = new StockVO();
					$lStock->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lStock->setQuantite($lProduitNv->getQteRestante());
					$lStock->setType(0);
					$lStock->setIdCompte(0);
					$lStock->setIdDetailCommande($lDcomId);
					$lStock->setIdCommande($lIdCommande);
					StockManager::insert($lStock);										
				}
			}
		}		
		$lLogger->log("Modification de la commande : " . $lIdCommande,PEAR_LOG_DEBUG); // Maj des logs
		return $lIdCommande;
	}	
}
?>