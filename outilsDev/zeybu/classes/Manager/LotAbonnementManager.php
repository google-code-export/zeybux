<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/04/2012
// Fichier : LotAbonnementManager.php
//
// Description : Classe de gestion des LotAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "LotAbonnementVO.php");

define("TABLE_LOTABONNEMENT", MYSQL_DB_PREFIXE ."labo_lot_abonnement");
/**
 * @name LotAbonnementManager
 * @author Julien PIERRE
 * @since 12/04/2012
 * 
 * @desc Classe permettant l'accès aux données des LotAbonnement
 */
class LotAbonnementManager
{
	const TABLE_LOTABONNEMENT = TABLE_LOTABONNEMENT;
	const CHAMP_LOTABONNEMENT_ID = "labo_id";
	const CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT = "labo_id_produit_abonnement";
	const CHAMP_LOTABONNEMENT_TAILLE = "labo_taille";
	const CHAMP_LOTABONNEMENT_PRIX = "labo_prix";
	const CHAMP_LOTABONNEMENT_ETAT = "labo_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return LotAbonnementVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une LotAbonnementVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT . "
			FROM " . LotAbonnementManager::TABLE_LOTABONNEMENT . " 
			WHERE " . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return LotAbonnementManager::remplirLotAbonnement(
				$pId,
				$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
				$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
				$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX],
				$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT]);
		} else {
			return new LotAbonnementVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(LotAbonnementVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de LotAbonnementVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . 
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT . "
			FROM " . LotAbonnementManager::TABLE_LOTABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeLotAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeLotAbonnement,
					LotAbonnementManager::remplirLotAbonnement(
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX],
					$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT]));
			}
		} else {
			$lListeLotAbonnement[0] = new LotAbonnementVO();
		}
		return $lListeLotAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(LotAbonnementVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de LotAbonnementVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    LotAbonnementManager::CHAMP_LOTABONNEMENT_ID .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX .
			"," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(LotAbonnementManager::TABLE_LOTABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeLotAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeLotAbonnement,
						LotAbonnementManager::remplirLotAbonnement(
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX],
						$lLigne[LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT]));
				}
			} else {
				$lListeLotAbonnement[0] = new LotAbonnementVO();
			}

			return $lListeLotAbonnement;
		}

		$lListeLotAbonnement[0] = new LotAbonnementVO();
		return $lListeLotAbonnement;
	}

	/**
	* @name remplirLotAbonnement($pId, $pIdProduitAbonnement, $pTaille, $pPrix, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @param tinyint(1)
	* @return LotAbonnementVO
	* @desc Retourne une LotAbonnementVO remplie
	*/
	private static function remplirLotAbonnement($pId, $pIdProduitAbonnement, $pTaille, $pPrix, $pEtat) {
		$lLotAbonnement = new LotAbonnementVO();
		$lLotAbonnement->setId($pId);
		$lLotAbonnement->setIdProduitAbonnement($pIdProduitAbonnement);
		$lLotAbonnement->setTaille($pTaille);
		$lLotAbonnement->setPrix($pPrix);
		$lLotAbonnement->setEtat($pEtat);
		return $lLotAbonnement;
	}

	/**
	* @name insert($pVo)
	* @param LotAbonnementVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la LotAbonnementVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . LotAbonnementManager::TABLE_LOTABONNEMENT . "
				(" . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . "
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . "
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . "
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . "
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				,'" . StringUtils::securiser( $pVo->getTaille() ) . "'
				,'" . StringUtils::securiser( $pVo->getPrix() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param LotAbonnementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du LotAbonnementVO, avec les informations du LotAbonnementVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . LotAbonnementManager::TABLE_LOTABONNEMENT . "
			 SET
				 " . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID_PRODUIT_ABONNEMENT . " = '" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_TAILLE . " = '" . StringUtils::securiser( $pVo->getTaille() ) . "'
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_PRIX . " = '" . StringUtils::securiser( $pVo->getPrix() ) . "'
				," . LotAbonnementManager::CHAMP_LOTABONNEMENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . LotAbonnementManager::TABLE_LOTABONNEMENT . "
			WHERE " . LotAbonnementManager::CHAMP_LOTABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>