<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/05/2013
// Fichier : StockProduitDisponibleViewManager.php
//
// Description : Classe de gestion des StockProduitDisponible
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockProduitDisponibleViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CategorieProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockQuantiteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModeleLotManager.php");

define("VUE_STOCKPRODUITDISPONIBLE", MYSQL_DB_PREFIXE . "view_stock_produit_disponible");
/**
 * @name StockProduitDisponibleViewManager
 * @author Julien PIERRE
 * @since 18/05/2013
 * 
 * @desc Classe permettant l'accès aux données des StockProduitDisponible
 */
class StockProduitDisponibleViewManager
{
	const VUE_STOCKPRODUITDISPONIBLE = VUE_STOCKPRODUITDISPONIBLE;

	/**
	* @name select($pId)
	* @param integer
	* @return StockProduitDisponibleViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockProduitDisponibleViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . StockProduitDisponibleViewManager::VUE_STOCKPRODUITDISPONIBLE . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitDisponible = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitDisponible,
					StockProduitDisponibleViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeStockProduitDisponible[0] = new StockProduitDisponibleViewVO();
		}
		return $lListeStockProduitDisponible;
	}

	/**
	* @name selectAll()
	* @return array(StockProduitDisponibleViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockProduitDisponibleViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . 
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . 
			"," . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE . 
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . StockProduitDisponibleViewManager::VUE_STOCKPRODUITDISPONIBLE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitDisponible = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitDisponible,
					StockProduitDisponibleViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
					$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeStockProduitDisponible[0] = new StockProduitDisponibleViewVO();
		}
		return $lListeStockProduitDisponible;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockProduitDisponibleViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockProduitDisponibleViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
			"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
			"," . FermeManager::CHAMP_FERME_ID .
			"," . FermeManager::CHAMP_FERME_NUMERO .
			"," . FermeManager::CHAMP_FERME_NOM .
			"," . FermeManager::CHAMP_FERME_ID_COMPTE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE .
			"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_ID .
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockProduitDisponibleViewManager::VUE_STOCKPRODUITDISPONIBLE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockProduitDisponible = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockProduitDisponible,
						StockProduitDisponibleViewManager::remplir(
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
						$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_NUMERO],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
						$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
				}
			} else {
				$lListeStockProduitDisponible[0] = new StockProduitDisponibleViewVO();
			}

			return $lListeStockProduitDisponible;
		}

		$lListeStockProduitDisponible[0] = new StockProduitDisponibleViewVO();
		return $lListeStockProduitDisponible;
	}

	/**
	* @name remplir($pNproId, $pNproNumero, $pNproNom, $pCproId, $pCproNom, $pFerId, $pFerNumero, $pFerNom, $pFerIdCompte, $pStoQteId, $pStoQteQuantite, $pStoQteQuantiteSolidaire, $pStoQteUnite, $pMLotId, $pMLotQuantite, $pMLotUnite, $pMLotPrix)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param int(11)
	* @param varchar(50)
	* @param int(11)
	* @param varchar(20)
	* @param text
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2) 	
	* @param decimal(10,2) 	
	* @param varchar(20)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param decimal(10,2)
	* @return StockProduitDisponibleViewVO
	* @desc Retourne une StockProduitDisponibleViewVO remplie
	*/
	private static function remplir($pNproId, $pNproNumero, $pNproNom, $pCproId, $pCproNom, $pFerId, $pFerNumero, $pFerNom, $pFerIdCompte, $pStoQteId, $pStoQteQuantite, $pStoQteQuantiteSolidaire, $pStoQteUnite, $pMLotId, $pMLotQuantite, $pMLotUnite, $pMLotPrix) {
		$lStockProduitDisponible = new StockProduitDisponibleViewVO();
		$lStockProduitDisponible->setNproId($pNproId);
		$lStockProduitDisponible->setNproNumero($pNproNumero);
		$lStockProduitDisponible->setNproNom($pNproNom);
		$lStockProduitDisponible->setCproId($pCproId);
		$lStockProduitDisponible->setCproNom($pCproNom);
		$lStockProduitDisponible->setFerId($pFerId);
		$lStockProduitDisponible->setFerNumero($pFerNumero);
		$lStockProduitDisponible->setFerNom($pFerNom);
		$lStockProduitDisponible->setFerIdCompte($pFerIdCompte);
		$lStockProduitDisponible->setStoQteId($pStoQteId);
		$lStockProduitDisponible->setStoQteQuantite($pStoQteQuantite);
		$lStockProduitDisponible->setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire);
		$lStockProduitDisponible->setStoQteUnite($pStoQteUnite);
		$lStockProduitDisponible->setMLotId($pMLotId);
		$lStockProduitDisponible->setMLotQuantite($pMLotQuantite);
		$lStockProduitDisponible->setMLotUnite($pMLotUnite);
		$lStockProduitDisponible->setMLotPrix($pMLotPrix);
		return $lStockProduitDisponible;
	}
}
?>