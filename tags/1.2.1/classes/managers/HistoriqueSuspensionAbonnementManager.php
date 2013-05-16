<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : HistoriqueSuspensionAbonnementManager.php
//
// Description : Classe de gestion des HistoriqueSuspensionAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "HistoriqueSuspensionAbonnementVO.php");

define("TABLE_HISTORIQUESUSPENSIONABONNEMENT", MYSQL_DB_PREFIXE ."hsusabo_historique_suspension_abonnement");
/**
 * @name HistoriqueSuspensionAbonnementManager
 * @author Julien PIERRE
 * @since 11/02/2012
 * 
 * @desc Classe permettant l'accès aux données des HistoriqueSuspensionAbonnement
 */
class HistoriqueSuspensionAbonnementManager
{
	const TABLE_HISTORIQUESUSPENSIONABONNEMENT = TABLE_HISTORIQUESUSPENSIONABONNEMENT;
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID = "hsusabo_id";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION = "hsusabo_date_debut_suspension";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION = "hsusabo_date_fin_suspension";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT = "hsusabo_id_produit_abonnement";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE = "hsusabo_id_compte";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE = "hsusabo_date";
	const CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION = "hsusabo_id_connexion";

	/**
	* @name select($pId)
	* @param integer
	* @return HistoriqueSuspensionAbonnementVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une HistoriqueSuspensionAbonnementVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION . "
			FROM " . HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT . " 
			WHERE " . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return HistoriqueSuspensionAbonnementManager::remplirHistoriqueSuspensionAbonnement(
				$pId,
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION],
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION],
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT],
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE],
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE],
				$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION]);
		} else {
			return new HistoriqueSuspensionAbonnementVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(HistoriqueSuspensionAbonnementVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de HistoriqueSuspensionAbonnementVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE . 
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION . "
			FROM " . HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeHistoriqueSuspensionAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeHistoriqueSuspensionAbonnement,
					HistoriqueSuspensionAbonnementManager::remplirHistoriqueSuspensionAbonnement(
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE],
					$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION]));
			}
		} else {
			$lListeHistoriqueSuspensionAbonnement[0] = new HistoriqueSuspensionAbonnementVO();
		}
		return $lListeHistoriqueSuspensionAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(HistoriqueSuspensionAbonnementVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de HistoriqueSuspensionAbonnementVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE .
			"," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeHistoriqueSuspensionAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeHistoriqueSuspensionAbonnement,
						HistoriqueSuspensionAbonnementManager::remplirHistoriqueSuspensionAbonnement(
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE],
						$lLigne[HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION]));
				}
			} else {
				$lListeHistoriqueSuspensionAbonnement[0] = new HistoriqueSuspensionAbonnementVO();
			}

			return $lListeHistoriqueSuspensionAbonnement;
		}

		$lListeHistoriqueSuspensionAbonnement[0] = new HistoriqueSuspensionAbonnementVO();
		return $lListeHistoriqueSuspensionAbonnement;
	}

	/**
	* @name remplirHistoriqueSuspensionAbonnement($pId, $pDateDebutSuspension, $pDateFinSuspension, $pIdProduitAbonnement, $pIdCompte, $pDate, $pIdConnexion)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @param int(11)
	* @return HistoriqueSuspensionAbonnementVO
	* @desc Retourne une HistoriqueSuspensionAbonnementVO remplie
	*/
	private static function remplirHistoriqueSuspensionAbonnement($pId, $pDateDebutSuspension, $pDateFinSuspension, $pIdProduitAbonnement, $pIdCompte, $pDate, $pIdConnexion) {
		$lHistoriqueSuspensionAbonnement = new HistoriqueSuspensionAbonnementVO();
		$lHistoriqueSuspensionAbonnement->setId($pId);
		$lHistoriqueSuspensionAbonnement->setDateDebutSuspension($pDateDebutSuspension);
		$lHistoriqueSuspensionAbonnement->setDateFinSuspension($pDateFinSuspension);
		$lHistoriqueSuspensionAbonnement->setIdProduitAbonnement($pIdProduitAbonnement);
		$lHistoriqueSuspensionAbonnement->setIdCompte($pIdCompte);
		$lHistoriqueSuspensionAbonnement->setDate($pDate);
		$lHistoriqueSuspensionAbonnement->setIdConnexion($pIdConnexion);
		return $lHistoriqueSuspensionAbonnement;
	}

	/**
	* @name insert($pVo)
	* @param HistoriqueSuspensionAbonnementVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la HistoriqueSuspensionAbonnementVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT . "
				(" . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE . "
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getDateDebutSuspension() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateFinSuspension() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getDate() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdConnexion() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param HistoriqueSuspensionAbonnementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du HistoriqueSuspensionAbonnementVO, avec les informations du HistoriqueSuspensionAbonnementVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT . "
			 SET
				 " . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_DEBUT_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateDebutSuspension() ) . "'
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE_FIN_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateFinSuspension() ) . "'
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_PRODUIT_ABONNEMENT . " = '" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_DATE . " = '" . StringUtils::securiser( $pVo->getDate() ) . "'
				," . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID_CONNEXION . " = '" . StringUtils::securiser( $pVo->getIdConnexion() ) . "'
			 WHERE " . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . HistoriqueSuspensionAbonnementManager::TABLE_HISTORIQUESUSPENSIONABONNEMENT . "
			WHERE " . HistoriqueSuspensionAbonnementManager::CHAMP_HISTORIQUESUSPENSIONABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>