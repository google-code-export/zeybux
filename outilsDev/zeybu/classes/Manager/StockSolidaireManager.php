<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/05/2012
// Fichier : StockSolidaireManager.php
//
// Description : Classe de gestion des StockSolidaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "StockSolidaireVO.php");

define("TABLE_STOCKSOLIDAIRE", MYSQL_DB_PREFIXE ."stosol_stock_solidaire");
/**
 * @name StockSolidaireManager
 * @author Julien PIERRE
 * @since 12/05/2012
 * 
 * @desc Classe permettant l'accès aux données des StockSolidaire
 */
class StockSolidaireManager
{
	const TABLE_STOCKSOLIDAIRE = TABLE_STOCKSOLIDAIRE;
	const CHAMP_STOCKSOLIDAIRE_ID = "stosol_id";
	const CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT = "stosol_id_nom_produit";
	const CHAMP_STOCKSOLIDAIRE_QUANTITE = "stosol_quantite";
	const CHAMP_STOCKSOLIDAIRE_UNITE = "stosol_unite";
	const CHAMP_STOCKSOLIDAIRE_DATE_CEATION = "stosol_date_ceation";
	const CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION = "stosol_date_modification";
	const CHAMP_STOCKSOLIDAIRE_ETAT = "stosol_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return StockSolidaireVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une StockSolidaireVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT . "
			FROM " . StockSolidaireManager::TABLE_STOCKSOLIDAIRE . " 
			WHERE " . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return StockSolidaireManager::remplirStockSolidaire(
				$pId,
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT],
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE],
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE],
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION],
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION],
				$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT]);
		} else {
			return new StockSolidaireVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(StockSolidaireVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de StockSolidaireVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION . 
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT . "
			FROM " . StockSolidaireManager::TABLE_STOCKSOLIDAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeStockSolidaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeStockSolidaire,
					StockSolidaireManager::remplirStockSolidaire(
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION],
					$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT]));
			}
		} else {
			$lListeStockSolidaire[0] = new StockSolidaireVO();
		}
		return $lListeStockSolidaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(StockSolidaireVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de StockSolidaireVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION .
			"," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(StockSolidaireManager::TABLE_STOCKSOLIDAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeStockSolidaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeStockSolidaire,
						StockSolidaireManager::remplirStockSolidaire(
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION],
						$lLigne[StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT]));
				}
			} else {
				$lListeStockSolidaire[0] = new StockSolidaireVO();
			}

			return $lListeStockSolidaire;
		}

		$lListeStockSolidaire[0] = new StockSolidaireVO();
		return $lListeStockSolidaire;
	}

	/**
	* @name remplirStockSolidaire($pId, $pIdNomProduit, $pQuantite, $pUnite, $pDateCeation, $pDateModification, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return StockSolidaireVO
	* @desc Retourne une StockSolidaireVO remplie
	*/
	private static function remplirStockSolidaire($pId, $pIdNomProduit, $pQuantite, $pUnite, $pDateCeation, $pDateModification, $pEtat) {
		$lStockSolidaire = new StockSolidaireVO();
		$lStockSolidaire->setId($pId);
		$lStockSolidaire->setIdNomProduit($pIdNomProduit);
		$lStockSolidaire->setQuantite($pQuantite);
		$lStockSolidaire->setUnite($pUnite);
		$lStockSolidaire->setDateCeation($pDateCeation);
		$lStockSolidaire->setDateModification($pDateModification);
		$lStockSolidaire->setEtat($pEtat);
		return $lStockSolidaire;
	}

	/**
	* @name insert($pVo)
	* @param StockSolidaireVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la StockSolidaireVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . StockSolidaireManager::TABLE_STOCKSOLIDAIRE . "
				(" . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION . "
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $pVo->getUnite() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCeation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param StockSolidaireVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du StockSolidaireVO, avec les informations du StockSolidaireVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . StockSolidaireManager::TABLE_STOCKSOLIDAIRE . "
			 SET
				 " . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_QUANTITE . " = '" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_UNITE . " = '" . StringUtils::securiser( $pVo->getUnite() ) . "'
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_CEATION . " = '" . StringUtils::securiser( $pVo->getDateCeation() ) . "'
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_DATE_MODIFICATION . " = '" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				," . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . StockSolidaireManager::TABLE_STOCKSOLIDAIRE . "
			WHERE " . StockSolidaireManager::CHAMP_STOCKSOLIDAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>