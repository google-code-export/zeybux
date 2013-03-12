<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/01/2011
// Fichier : StockProduitReservationViewManager.php
//
// Description : Classe de gestion des StockProduitReservation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "StockProduitReservationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailCommandeManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "DetailOperationManager.php");

define("VUE_STOCKPRODUITRESERVATION", MYSQL_DB_PREFIXE . "view_stock_produit_reservation");
/**
 * @name StockProduitReservationViewManager
 * @author Julien PIERRE
 * @since 09/01/2011
 * 
 * @desc Classe permettant l'accès aux données des StockProduitReservation
 */
class StockProduitReservationViewManager
{
	const VUE_STOCKPRODUITRESERVATION = VUE_STOCKPRODUITRESERVATION;

	/**
	* @name select($pId)
	* @param integer
	* @return StockProduitReservationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockProduitReservationViewVO contenant les informations et la renvoie
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
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_TYPE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT . "
			FROM " . StockProduitReservationViewManager::VUE_STOCKPRODUITRESERVATION . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitReservation,
					StockProduitReservationViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_TYPE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE],
					$lLigne[DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT]));
			}
		} else {
			$lListeStockProduitReservation[0] = new StockProduitReservationViewVO();
		}
		return $lListeStockProduitReservation;
	}

	/**
	* @name selectAll()
	* @return array(StockProduitReservationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockProduitReservationViewVO
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
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_TYPE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . 
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT ."
			FROM " . StockProduitReservationViewManager::VUE_STOCKPRODUITRESERVATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockProduitReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockProduitReservation,
					StockProduitReservationViewManager::remplir(
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
			$lListeStockProduitReservation[0] = new StockProduitReservationViewVO();
		}
		return $lListeStockProduitReservation;
	}
	
	/**
	* @name selectInfoBonCommande($pIdCommande, $pIdCompteProducteur)
	* @param integer
	* @param integer
	* @return array(StockProduitReservationViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCommande $pIdCommande et IdCompteProducteur $pIdCompteProducteur . Puis les renvoie sous forme d'une collection de StockProduitReservationViewVO
	*/
	/*public static function selectInfoBonCommande($pIdCommande, $pIdCompteProducteur) {
		return StockProduitReservationViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME),
			array('=','='),
			array($pIdCommande, $pIdCompteProducteur),
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE),
			array('ASC'));
	}*/
	public static function selectInfoBonCommande($pIdCommande, $pIdCompteProducteur) {
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
				 	. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = " . $pIdCommande
				. " AND " . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . " = " . $pIdCompteProducteur
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
					. ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = " . $pIdCommande
				. " AND " . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . " = " . $pIdCompteProducteur
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
				StockProduitReservationViewManager::remplir(
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
			$lListeStockProduitReservation[0] = new StockProduitReservationViewVO();
		}
		return $lListeStockProduitReservation;
	}
	
	
	/**
	* @name selectByIdProduit($pIdProduit)
	* @param integer
	* @return array(StockProduitReservationViewVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdProduit $pIdProduit. Puis les renvoie sous forme d'une collection de StockProduitReservationViewVO
	*/
	public static function selectByIdProduit($pIdProduit) {
		return StockProduitReservationViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID),
			array('='),
			array($pIdProduit),
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
	* @return array(StockProduitReservationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockProduitReservationViewVO
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
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . ProduitManager::CHAMP_PRODUIT_TYPE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . StockManager::CHAMP_STOCK_QUANTITE	.
			"," . DetailOperationManager::CHAMP_DETAILOPERATION_MONTANT	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockProduitReservationViewManager::VUE_STOCKPRODUITRESERVATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockProduitReservation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockProduitReservation,
						StockProduitReservationViewManager::remplir(
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
				$lListeStockProduitReservation[0] = new StockProduitReservationViewVO();
			}

			return $lListeStockProduitReservation;
		}

		$lListeStockProduitReservation[0] = new StockProduitReservationViewVO();
		return $lListeStockProduitReservation;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pProType, $pNproNumero, $pNproNom, $pStoQuantite, $pDopeMontant)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(4)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(33,2)
	* @param decimal(32,2)
	* @return StockProduitReservationViewVO
	* @desc Retourne une StockProduitReservationViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pProType, $pNproNumero, $pNproNom, $pStoQuantite, $pDopeMontant) {
		$lStockProduitReservation = new StockProduitReservationViewVO();
		$lStockProduitReservation->setProIdCommande($pProIdCommande);
		$lStockProduitReservation->setProIdCompteFerme($pProIdCompteFerme);
		$lStockProduitReservation->setProId($pProId);
		$lStockProduitReservation->setProUniteMesure($pProUniteMesure);
		$lStockProduitReservation->setProType($pProType);
		$lStockProduitReservation->setNproNumero($pNproNumero);
		$lStockProduitReservation->setNproNom($pNproNom);
		$lStockProduitReservation->setStoQuantite($pStoQuantite);
		$lStockProduitReservation->setDopeMontant($pDopeMontant);
		return $lStockProduitReservation;
	}
}
?>