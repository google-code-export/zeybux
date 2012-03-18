<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/02/2012
// Fichier : ProduitAbonnementManager.php
//
// Description : Classe de gestion des ProduitAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ProduitAbonnementVO.php");

define("TABLE_PRODUITABONNEMENT", MYSQL_DB_PREFIXE ."proabo_produit_abonnement");
/**
 * @name ProduitAbonnementManager
 * @author Julien PIERRE
 * @since 26/02/2012
 * 
 * @desc Classe permettant l'accès aux données des ProduitAbonnement
 */
class ProduitAbonnementManager
{
	const TABLE_PRODUITABONNEMENT = TABLE_PRODUITABONNEMENT;
	const CHAMP_PRODUITABONNEMENT_ID = "proabo_id";
	const CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT = "proabo_id_nom_produit";
	const CHAMP_PRODUITABONNEMENT_UNITE = "proabo_unite";
	const CHAMP_PRODUITABONNEMENT_STOCK_INITIAL = "proabo_stock_initial";
	const CHAMP_PRODUITABONNEMENT_MAX = "proabo_max";
	const CHAMP_PRODUITABONNEMENT_FREQUENCE = "proabo_frequence";
	const CHAMP_PRODUITABONNEMENT_ETAT = "proabo_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ProduitAbonnementVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . "
			FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ProduitAbonnementManager::remplirProduitAbonnement(
				$pId,
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT]);
		} else {
			return new ProduitAbonnementVO();
		}
	}

	/**
	* @name selectByIdNom($pId)
	* @param integer
	* @return ProduitAbonnementVO
	* @desc Récupère la ligne correspondant à l'id Nom en paramètre, retourne ProduitAbonnementVO contenant les informations et la renvoie
	*/
	public static function selectByIdNom($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . "
			FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'
			AND " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . " = 0";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ProduitAbonnementManager::remplirProduitAbonnement(
				$pId,
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
				$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT]);
		} else {
			return new ProduitAbonnementVO();
		}
	}
	
	/**
	* @name selectAll()
	* @return array(ProduitAbonnementVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ProduitAbonnementVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . "
			FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProduitAbonnement,
					ProduitAbonnementManager::remplirProduitAbonnement(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT]));
			}
		} else {
			$lListeProduitAbonnement[0] = new ProduitAbonnementVO();
		}
		return $lListeProduitAbonnement;
	}
	
	/**
	* @name selectByIdNomProduit($pIdNomProduit)
	* @return array(ProduitAbonnementVO)
	* @desc Récupères toutes les lignes ayant pour IdNomProduit $pIdNomProduit et les renvoie sous forme d'une collection de ProduitAbonnementVO
	*/
	public static function selectByIdNomProduit($pIdNomProduit) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . 
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . "
			FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . " 
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pIdNomProduit) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProduitAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProduitAbonnement,
					ProduitAbonnementManager::remplirProduitAbonnement(
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
					$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT]));
			}
		} else {
			$lListeProduitAbonnement[0] = new ProduitAbonnementVO();
		}
		return $lListeProduitAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ProduitAbonnementVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ProduitAbonnementVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE .
			"," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ProduitAbonnementManager::TABLE_PRODUITABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeProduitAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeProduitAbonnement,
						ProduitAbonnementManager::remplirProduitAbonnement(
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE],
						$lLigne[ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT]));
				}
			} else {
				$lListeProduitAbonnement[0] = new ProduitAbonnementVO();
			}

			return $lListeProduitAbonnement;
		}

		$lListeProduitAbonnement[0] = new ProduitAbonnementVO();
		return $lListeProduitAbonnement;
	}

	/**
	* @name remplirProduitAbonnement($pId, $pIdNomProduit, $pUnite, $pStockInitial, $pMax, $pFrequence, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param varchar(200)
	* @param tinyint(4)
	* @return ProduitAbonnementVO
	* @desc Retourne une ProduitAbonnementVO remplie
	*/
	private static function remplirProduitAbonnement($pId, $pIdNomProduit, $pUnite, $pStockInitial, $pMax, $pFrequence, $pEtat) {
		$lProduitAbonnement = new ProduitAbonnementVO();
		$lProduitAbonnement->setId($pId);
		$lProduitAbonnement->setIdNomProduit($pIdNomProduit);
		$lProduitAbonnement->setUnite($pUnite);
		$lProduitAbonnement->setStockInitial($pStockInitial);
		$lProduitAbonnement->setMax($pMax);
		$lProduitAbonnement->setFrequence($pFrequence);
		$lProduitAbonnement->setEtat($pEtat);
		return $lProduitAbonnement;
	}

	/**
	* @name insert($pVo)
	* @param ProduitAbonnementVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ProduitAbonnementVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . "
				(" . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . "
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getUnite() ) . "'
				,'" . StringUtils::securiser( $pVo->getStockInitial() ) . "'
				,'" . StringUtils::securiser( $pVo->getMax() ) . "'
				,'" . StringUtils::securiser( $pVo->getFrequence() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ProduitAbonnementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ProduitAbonnementVO, avec les informations du ProduitAbonnementVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . "
			 SET
				 " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_UNITE . " = '" . StringUtils::securiser( $pVo->getUnite() ) . "'
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_STOCK_INITIAL . " = '" . StringUtils::securiser( $pVo->getStockInitial() ) . "'
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_MAX . " = '" . StringUtils::securiser( $pVo->getMax() ) . "'
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_FREQUENCE . " = '" . StringUtils::securiser( $pVo->getFrequence() ) . "'
				," . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ProduitAbonnementManager::TABLE_PRODUITABONNEMENT . "
			WHERE " . ProduitAbonnementManager::CHAMP_PRODUITABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>