<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 14/04/2012
// Fichier : CompteAbonnementManager.php
//
// Description : Classe de gestion des CompteAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CompteAbonnementVO.php");

define("TABLE_COMPTEABONNEMENT", MYSQL_DB_PREFIXE ."cptabo_compte_abonnement");
/**
 * @name CompteAbonnementManager
 * @author Julien PIERRE
 * @since 14/04/2012
 * 
 * @desc Classe permettant l'accès aux données des CompteAbonnement
 */
class CompteAbonnementManager
{
	const TABLE_COMPTEABONNEMENT = TABLE_COMPTEABONNEMENT;
	const CHAMP_COMPTEABONNEMENT_ID = "cptabo_id";
	const CHAMP_COMPTEABONNEMENT_ID_COMPTE = "cptabo_id_compte";
	const CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT = "cptabo_id_produit_abonnement";
	const CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT = "cptabo_id_lot_abonnement";
	const CHAMP_COMPTEABONNEMENT_QUANTITE = "cptabo_quantite";
	const CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION = "cptabo_date_debut_suspension";
	const CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION = "cptabo_date_fin_suspension";
	const CHAMP_COMPTEABONNEMENT_ETAT = "cptabo_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteAbonnementVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteAbonnementVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . "
			FROM " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . " 
			WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CompteAbonnementManager::remplirCompteAbonnement(
				$pId,
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION],
				$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT]);
		} else {
			return new CompteAbonnementVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CompteAbonnementVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteAbonnementVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . "
			FROM " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteAbonnement,
					CompteAbonnementManager::remplirCompteAbonnement(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT]));
			}
		} else {
			$lListeCompteAbonnement[0] = new CompteAbonnementVO();
		}
		return $lListeCompteAbonnement;
	}
	
	
	/**
	* @name selectActifByIdCompte($pIdCompte)
	* @param string
	* @return array(CompteAbonnementVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pIdCompte et les renvoie sous forme d'une collection de CompteAbonnementVO
	*/
	public static function selectActifByIdCompte($pIdCompte) {		
		return CompteAbonnementManager::recherche(
			array(CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE,CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT),
			array('=','='),
			array($pIdCompte,0),
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
	* @return array(CompteAbonnementVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteAbonnementVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteAbonnementManager::TABLE_COMPTEABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteAbonnement,
						CompteAbonnementManager::remplirCompteAbonnement(
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT]));
				}
			} else {
				$lListeCompteAbonnement[0] = new CompteAbonnementVO();
			}

			return $lListeCompteAbonnement;
		}

		$lListeCompteAbonnement[0] = new CompteAbonnementVO();
		return $lListeCompteAbonnement;
	}

	/**
	* @name remplirCompteAbonnement($pId, $pIdCompte, $pIdProduitAbonnement, $pIdLotAbonnement, $pQuantite, $pDateDebutSuspension, $pDateFinSuspension, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param datetime
	* @param datetime
	* @param tinyint(4)
	* @return CompteAbonnementVO
	* @desc Retourne une CompteAbonnementVO remplie
	*/
	private static function remplirCompteAbonnement($pId, $pIdCompte, $pIdProduitAbonnement, $pIdLotAbonnement, $pQuantite, $pDateDebutSuspension, $pDateFinSuspension, $pEtat) {
		$lCompteAbonnement = new CompteAbonnementVO();
		$lCompteAbonnement->setId($pId);
		$lCompteAbonnement->setIdCompte($pIdCompte);
		$lCompteAbonnement->setIdProduitAbonnement($pIdProduitAbonnement);
		$lCompteAbonnement->setIdLotAbonnement($pIdLotAbonnement);
		$lCompteAbonnement->setQuantite($pQuantite);
		$lCompteAbonnement->setDateDebutSuspension($pDateDebutSuspension);
		$lCompteAbonnement->setDateFinSuspension($pDateFinSuspension);
		$lCompteAbonnement->setEtat($pEtat);
		return $lCompteAbonnement;
	}

	/**
	* @name insert($pVo)
	* @param CompteAbonnementVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CompteAbonnementVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . "
				(" . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdLotAbonnement() ) . "'
				,'" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateDebutSuspension() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateFinSuspension() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CompteAbonnementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CompteAbonnementVO, avec les informations du CompteAbonnementVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . "
			 SET
				 " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_PRODUIT_ABONNEMENT . " = '" . StringUtils::securiser( $pVo->getIdProduitAbonnement() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_LOT_ABONNEMENT . " = '" . StringUtils::securiser( $pVo->getIdLotAbonnement() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . " = '" . StringUtils::securiser( $pVo->getQuantite() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateDebutSuspension() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateFinSuspension() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
	
	/**
	* @name suspendreCompte($pVo)
	* @param CompteAbonnementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CompteAbonnementVO, avec les informations du CompteAbonnementVO
	*/
	public static function suspendreCompte($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . "
			 SET
				 " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateDebutSuspension() ) . "'
				," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . " = '" . StringUtils::securiser( $pVo->getDateFinSuspension() ) . "'
			 WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
			 AND " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ETAT . " = 0";

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

		$lRequete = "DELETE FROM " . CompteAbonnementManager::TABLE_COMPTEABONNEMENT . "
			WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>