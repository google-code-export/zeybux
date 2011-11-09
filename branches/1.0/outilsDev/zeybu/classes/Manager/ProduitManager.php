<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : ProduitManager.php
//
// Description : Classe de gestion des Produit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ProduitVO.php");

/**
 * @name ProduitManager
 * @author Julien PIERRE
 * @since 08/11/2011
 * 
 * @desc Classe permettant l'accès aux données des Produit
 */
class ProduitManager
{
	const TABLE_PRODUIT = "pro_produit";
	const CHAMP_PRODUIT_ID = "pro_id";
	const CHAMP_PRODUIT_ID_COMMANDE = "pro_id_commande";
	const CHAMP_PRODUIT_ID_NOM_PRODUIT = "pro_id_nom_produit";
	const CHAMP_PRODUIT_UNITE_MESURE = "pro_unite_mesure";
	const CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE = "pro_max_produit_commande";
	const CHAMP_PRODUIT_ID_COMPTE_FERME = "pro_id_compte_ferme";
	const CHAMP_PRODUIT_STOCK_RESERVATION = "pro_stock_reservation";
	const CHAMP_PRODUIT_STOCK_INITIAL = "pro_stock_initial";
	const CHAMP_PRODUIT_ETAT = "pro_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ProduitVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ProduitVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . 
			"," . ProduitManager::CHAMP_PRODUIT_ETAT . "
			FROM " . ProduitManager::TABLE_PRODUIT . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ProduitManager::remplirProduit(
				$pId,
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
				$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
				$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
				$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT]);
		} else {
			return new ProduitVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ProduitVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ProduitVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . 
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . 
			"," . ProduitManager::CHAMP_PRODUIT_ETAT . "
			FROM " . ProduitManager::TABLE_PRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProduit,
					ProduitManager::remplirProduit(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
					$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT]));
			}
		} else {
			$lListeProduit[0] = new ProduitVO();
		}
		return $lListeProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ProduitVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ProduitVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME .
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION .
			"," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL .
			"," . ProduitManager::CHAMP_PRODUIT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ProduitManager::TABLE_PRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeProduit,
						ProduitManager::remplirProduit(
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
						$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME],
						$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION],
						$lLigne[ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL],
						$lLigne[ProduitManager::CHAMP_PRODUIT_ETAT]));
				}
			} else {
				$lListeProduit[0] = new ProduitVO();
			}

			return $lListeProduit;
		}

		$lListeProduit[0] = new ProduitVO();
		return $lListeProduit;
	}

	/**
	* @name remplirProduit($pId, $pIdCommande, $pIdNomProduit, $pUniteMesure, $pMaxProduitCommande, $pIdCompteFerme, $pStockReservation, $pStockInitial, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param int(11)
	* @return ProduitVO
	* @desc Retourne une ProduitVO remplie
	*/
	private static function remplirProduit($pId, $pIdCommande, $pIdNomProduit, $pUniteMesure, $pMaxProduitCommande, $pIdCompteFerme, $pStockReservation, $pStockInitial, $pEtat) {
		$lProduit = new ProduitVO();
		$lProduit->setId($pId);
		$lProduit->setIdCommande($pIdCommande);
		$lProduit->setIdNomProduit($pIdNomProduit);
		$lProduit->setUniteMesure($pUniteMesure);
		$lProduit->setMaxProduitCommande($pMaxProduitCommande);
		$lProduit->setIdCompteFerme($pIdCompteFerme);
		$lProduit->setStockReservation($pStockReservation);
		$lProduit->setStockInitial($pStockInitial);
		$lProduit->setEtat($pEtat);
		return $lProduit;
	}

	/**
	* @name insert($pVo)
	* @param ProduitVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ProduitVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ProduitManager::TABLE_PRODUIT . "
				(" . ProduitManager::CHAMP_PRODUIT_ID . "
				," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . "
				," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . "
				," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . "
				," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . "
				," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . "
				," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . "
				," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . "
				," . ProduitManager::CHAMP_PRODUIT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getUniteMesure() ) . "'
				,'" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompteFerme() ) . "'
				,'" . StringUtils::securiser( $pVo->getStockReservation() ) . "'
				,'" . StringUtils::securiser( $pVo->getStockInitial() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ProduitVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ProduitVO, avec les informations du ProduitVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ProduitManager::TABLE_PRODUIT . "
			 SET
				 " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . " = '" . StringUtils::securiser( $pVo->getUniteMesure() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . " = '" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_ID_COMPTE_FERME . " = '" . StringUtils::securiser( $pVo->getIdCompteFerme() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_STOCK_RESERVATION . " = '" . StringUtils::securiser( $pVo->getStockReservation() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_STOCK_INITIAL . " = '" . StringUtils::securiser( $pVo->getStockInitial() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre
	*/
	public static function delete($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = "DELETE FROM " . ProduitManager::TABLE_PRODUIT . "
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>