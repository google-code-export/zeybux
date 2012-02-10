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
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
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
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
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
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . StockManager::CHAMP_STOCK_QUANTITE . "
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
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
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
	public static function selectInfoBonCommande($pIdCommande, $pIdCompteProducteur) {
		return StockProduitReservationViewManager::recherche(
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE,ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME),
			array('=','='),
			array($pIdCommande, $pIdCompteProducteur),
			array(ProduitManager::CHAMP_PRODUIT_ID_COMMANDE),
			array('ASC'));
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
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . StockManager::CHAMP_STOCK_QUANTITE		);

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
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[StockManager::CHAMP_STOCK_QUANTITE]));
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
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pNproNumero, $pNproNom, $pStoQuantite)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(33,2)
	* @return StockProduitReservationViewVO
	* @desc Retourne une StockProduitReservationViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pProUniteMesure, $pNproNumero, $pNproNom, $pStoQuantite) {
		$lStockProduitReservation = new StockProduitReservationViewVO();
		$lStockProduitReservation->setProIdCommande($pProIdCommande);
		$lStockProduitReservation->setProIdCompteFerme($pProIdCompteFerme);
		$lStockProduitReservation->setProId($pProId);
		$lStockProduitReservation->setProUniteMesure($pProUniteMesure);
		$lStockProduitReservation->setNproNumero($pNproNumero);
		$lStockProduitReservation->setNproNom($pNproNom);
		$lStockProduitReservation->setStoQuantite($pStoQuantite);
		return $lStockProduitReservation;
	}
}
?>