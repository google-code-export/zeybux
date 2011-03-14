<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : StockLivraisonViewManager.php
//
// Description : Classe de gestion des StockLivraison
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockLivraisonViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name StockLivraisonViewManager
 * @author Julien PIERRE
 * @since 25/01/2011
 * 
 * @desc Classe permettant l'accès aux données des StockLivraison
 */
class StockLivraisonViewManager
{
	const VUE_STOCKLIVRAISON = "view_stock_livraison";

	/**
	* @name select($pId)
	* @param integer
	* @return StockLivraisonViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockLivraisonViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockLivraisonViewManager::VUE_STOCKLIVRAISON . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockLivraison,
					StockLivraisonViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockLivraison[0] = new StockLivraisonViewVO();
		}
		return $lListeStockLivraison;
	}

	/**
	* @name selectAll()
	* @return array(StockLivraisonViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockLivraisonViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockLivraisonViewManager::VUE_STOCKLIVRAISON;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockLivraison,
					StockLivraisonViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockLivraison[0] = new StockLivraisonViewVO();
		}
		return $lListeStockLivraison;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockLivraisonViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockLivraisonViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . StockManager::CHAMP_STOCK_ID .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . StockManager::CHAMP_STOCK_QUANTITE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockLivraisonViewManager::VUE_STOCKLIVRAISON, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockLivraison = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockLivraison,
						StockLivraisonViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
				}
			} else {
				$lListeStockLivraison[0] = new StockLivraisonViewVO();
			}

			return $lListeStockLivraison;
		}

		$lListeStockLivraison[0] = new StockLivraisonViewVO();
		return $lListeStockLivraison;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdProducteur, $pProId, $pStoId, $pDcomId, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @return StockLivraisonViewVO
	* @desc Retourne une StockLivraisonViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdProducteur, $pProId, $pStoId, $pDcomId, $pStoQuantite) {
		$lStockLivraison = new StockLivraisonViewVO();
		$lStockLivraison->setProIdCommande($pProIdCommande);
		$lStockLivraison->setProIdProducteur($pProIdProducteur);
		$lStockLivraison->setProId($pProId);
		$lStockLivraison->setStoId($pStoId);
		$lStockLivraison->setDcomId($pDcomId);
		$lStockLivraison->setStoQuantite($pStoQuantite);
		return $lStockLivraison;
	}
}
?>