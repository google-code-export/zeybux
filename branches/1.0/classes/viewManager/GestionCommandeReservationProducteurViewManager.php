<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/07/2011
// Fichier : GestionCommandeReservationProducteurViewManager.php
//
// Description : Classe de gestion des GestionCommandeReservationProducteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "GestionCommandeReservationProducteurViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockManager.php");

define("VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR", MYSQL_DB_PREFIXE . "view_gestion_commande_reservation_producteur");
/**
 * @name GestionCommandeReservationProducteurViewManager
 * @author Julien PIERRE
 * @since 31/07/2011
 * 
 * @desc Classe permettant l'accès aux données des GestionCommandeReservationProducteur
 */
class GestionCommandeReservationProducteurViewManager
{
	const VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR = VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR;

	/**
	* @name select($pId)
	* @param integer
	* @return GestionCommandeReservationProducteurViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une GestionCommandeReservationProducteurViewVO contenant les informations et la renvoie
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
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . GestionCommandeReservationProducteurViewManager::VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeGestionCommandeReservationProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeGestionCommandeReservationProducteur,
					GestionCommandeReservationProducteurViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
			}
		} else {
			$lListeGestionCommandeReservationProducteur[0] = new GestionCommandeReservationProducteurViewVO();
		}
		return $lListeGestionCommandeReservationProducteur;
	}

	/**
	* @name selectAll()
	* @return array(GestionCommandeReservationProducteurViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de GestionCommandeReservationProducteurViewVO
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
			"," . StockManager::CHAMP_STOCK_ID . "
			FROM " . GestionCommandeReservationProducteurViewManager::VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeGestionCommandeReservationProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeGestionCommandeReservationProducteur,
					GestionCommandeReservationProducteurViewManager::remplir(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[StockManager::CHAMP_STOCK_ID]));
			}
		} else {
			$lListeGestionCommandeReservationProducteur[0] = new GestionCommandeReservationProducteurViewVO();
		}
		return $lListeGestionCommandeReservationProducteur;
	}

	/**
	* @name getStockReservationProducteur($pIdCompteProducteur,$pIdProduit)
	* @param integer
	* @param integer
	* @return array(GestionCommandeReservationProducteurViewVO)
	* @desc 
	*/
	public static function getStockReservationProducteur($pIdCompteProducteur,$pIdProduit) {		
		return GestionCommandeReservationProducteurViewManager::recherche(
				array(ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME,ProduitManager::CHAMP_PRODUIT_ID),
				array('=', '='),
				array($pIdCompteProducteur,$pIdProduit),
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
	* @return array(GestionCommandeReservationProducteurViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de GestionCommandeReservationProducteurViewVO
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
			"," . StockManager::CHAMP_STOCK_ID		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(GestionCommandeReservationProducteurViewManager::VUE_GESTIONCOMMANDERESERVATIONPRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeGestionCommandeReservationProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeGestionCommandeReservationProducteur,
						GestionCommandeReservationProducteurViewManager::remplir(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[StockManager::CHAMP_STOCK_ID]));
				}
			} else {
				$lListeGestionCommandeReservationProducteur[0] = new GestionCommandeReservationProducteurViewVO();
			}

			return $lListeGestionCommandeReservationProducteur;
		}

		$lListeGestionCommandeReservationProducteur[0] = new GestionCommandeReservationProducteurViewVO();
		return $lListeGestionCommandeReservationProducteur;
	}

	/**
	* @name remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pStoId)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return GestionCommandeReservationProducteurViewVO
	* @desc Retourne une GestionCommandeReservationProducteurViewVO remplie
	*/
	private static function remplir($pProIdCommande, $pProIdCompteFerme, $pProId, $pStoId) {
		$lGestionCommandeReservationProducteur = new GestionCommandeReservationProducteurViewVO();
		$lGestionCommandeReservationProducteur->setProIdCommande($pProIdCommande);
		$lGestionCommandeReservationProducteur->setProIdCompteFerme($pProIdCompteFerme);
		$lGestionCommandeReservationProducteur->setProId($pProId);
		$lGestionCommandeReservationProducteur->setStoId($pStoId);
		return $lGestionCommandeReservationProducteur;
	}
}
?>