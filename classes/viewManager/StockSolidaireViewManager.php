<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : StockSolidaireViewManager.php
//
// Description : Classe de gestion des StockSolidaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockSolidaireViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");

define("VUE_STOCKSOLIDAIRE", MYSQL_DB_PREFIXE . "view_stock_solidaire");
/**
 * @name StockSolidaireViewManager
 * @author Julien PIERRE
 * @since 25/01/2011
 * 
 * @desc Classe permettant l'accès aux données des StockSolidaire
 */
class StockSolidaireViewManager
{
	const VUE_STOCKSOLIDAIRE = VUE_STOCKSOLIDAIRE;

	/**
	* @name select($pId)
	* @param integer
	* @return StockSolidaireViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockSolidaireViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockSolidaireViewManager::VUE_STOCKSOLIDAIRE . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockSolidaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockSolidaire,
					StockSolidaireViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockSolidaire[0] = new StockSolidaireViewVO();
		}
		return $lListeStockSolidaire;
	}

	/**
	* @name selectAll()
	* @return array(StockSolidaireViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockSolidaireViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . StockManager::CHAMP_STOCK_ID . 
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
			FROM " . StockSolidaireViewManager::VUE_STOCKSOLIDAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockSolidaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockSolidaire,
					StockSolidaireViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID],
					$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
			}
		} else {
			$lListeStockSolidaire[0] = new StockSolidaireViewVO();
		}
		return $lListeStockSolidaire;
	}

	/**
	* @name selectByIdProduit($pIdProduit)
	* @param integer
	* @return array(StockSolidaireViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProduit $pIdProduit. Puis les renvoie sous forme d'une collection de StockSolidaireViewVO
	*/
	public static function selectByIdProduit($pIdProduit) {
		return StockSolidaireViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID),
			array('='),
			array($pIdProduit),
			array(StockManager::CHAMP_STOCK_ID),
			array('ASC'));
	}
	
	/**
	* @name selectSolidaire($pIdMarche,$pIdCompteProducteur)
	* @param integer
	* @return array(StockSolidaireViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProducteur $pIdProducteur. Puis les renvoie sous forme d'une collection de StockSolidaireViewVO
	*/
	public static function selectSolidaire($pIdMarche,$pIdCompteProducteur) {
		return StockSolidaireViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME),
			array('=','='),
			array($pIdMarche,$pIdCompteProducteur),
			array(''),
			array(''));
	}
	
	/**
	* @name selectLivraisonSolidaire($pIdMarche,$pIdCompteProducteur)
	* @param integer
	* @return array(StockSolidaireViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProducteur $pIdProducteur. Puis les renvoie sous forme d'une collection de StockSolidaireViewVO
	*/
	public static function selectLivraisonSolidaire($pIdMarche) {
		return StockSolidaireViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,StockManager::CHAMP_STOCK_QUANTITE),
			array('=','>'),
			array($pIdMarche,0),
			array(''),
			array(''));
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockSolidaireViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockSolidaireViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
			"," . ProduitManager::CHAMP_PRODUIT_ID .
			"," . StockManager::CHAMP_STOCK_ID .
			"," . DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID .
			"," . StockManager::CHAMP_STOCK_QUANTITE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockSolidaireViewManager::VUE_STOCKSOLIDAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockSolidaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockSolidaire,
						StockSolidaireViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID],
						$lLigne[DetailCommandeManager::CHAMP_DETAILCOMMANDE_ID],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
				}
			} else {
				$lListeStockSolidaire[0] = new StockSolidaireViewVO();
			}

			return $lListeStockSolidaire;
		}

		$lListeStockSolidaire[0] = new StockSolidaireViewVO();
		return $lListeStockSolidaire;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pStoId, $pDcomId, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @return StockSolidaireViewVO
	* @desc Retourne une StockSolidaireViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pStoId, $pDcomId, $pStoQuantite) {
		$lStockSolidaire = new StockSolidaireViewVO();
		$lStockSolidaire->setProIdCommande($pProIdCommande);
		$lStockSolidaire->setProIdCompteFerme($pProIdCompteFerme);
		$lStockSolidaire->setProId($pProId);
		$lStockSolidaire->setStoId($pStoId);
		$lStockSolidaire->setDcomId($pDcomId);
		$lStockSolidaire->setStoQuantite($pStoQuantite);
		return $lStockSolidaire;
	}
}
?>