<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : StockCommandeViewManager.php
//
// Description : Classe de gestion des StockCommande
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockCommandeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

/**
 * @name StockCommandeViewManager
 * @author Julien PIERRE
 * @since 09/01/2011
 * 
 * @desc Classe permettant l'accès aux données des StockCommande
 */
class StockCommandeViewManager
{
	const VUE_STOCKCOMMANDE = "view_stock_commande";

	/**
	* @name select($pId)
	* @param integer
	* @return StockCommandeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockCommandeViewVO contenant les informations et la renvoie
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
			FROM " . StockCommandeViewManager::VUE_STOCKCOMMANDE . " 
			WHERE " . StockManager::CHAMP_STOCK_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockCommande,
					StockCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockCommande[0] = new StockCommandeViewVO();
		}
		return $lListeStockCommande;
	}

	/**
	* @name selectAll()
	* @return array(StockCommandeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockCommandeViewVO
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
			FROM " . StockCommandeViewManager::VUE_STOCKCOMMANDE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockCommande = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockCommande,
					StockCommandeViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockCommande[0] = new StockCommandeViewVO();
		}
		return $lListeStockCommande;
	}

	/**
	* @name selectByIdProducteur($pIdProducteur)
	* @param integer
	* @return array(StockCommandeViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProducteur $pIdProducteur. Puis les renvoie sous forme d'une collection de StockCommandeViewVO
	*/
	public static function selectByIdProducteur($pIdProducteur) {
		return StockCommandeViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR),
			array('='),
			array($pIdProducteur),
			array(StockManager::CHAMP_STOCK_ID),
			array('ASC'));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockCommandeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockCommandeViewVO
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
		$lRequete = DbUtils::prepareRequeteRecherche(StockCommandeViewManager::VUE_STOCKCOMMANDE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockCommande = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockCommande,
						StockCommandeViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
				}
			} else {
				$lListeStockCommande[0] = new StockCommandeViewVO();
			}

			return $lListeStockCommande;
		}

		$lListeStockCommande[0] = new StockCommandeViewVO();
		return $lListeStockCommande;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdProducteur, $pProId, $pStoId, $pDcomId, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @return StockCommandeViewVO
	* @desc Retourne une StockCommandeViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdProducteur, $pProId, $pStoId, $pDcomId, $pStoQuantite) {
		$lStockCommande = new StockCommandeViewVO();
		$lStockCommande->setProIdCommande($pProIdCommande);
		$lStockCommande->setProIdProducteur($pProIdProducteur);
		$lStockCommande->setProId($pProId);
		$lStockCommande->setStoId($pStoId);
		$lStockCommande->setDcomId($pDcomId);
		$lStockCommande->setStoQuantite($pStoQuantite);
		return $lStockCommande;
	}
}
?>