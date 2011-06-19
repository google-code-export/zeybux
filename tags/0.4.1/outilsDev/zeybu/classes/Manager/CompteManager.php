<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : CompteManager.php
//
// Description : Classe de gestion des Compte
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CompteVO.php");

/**
 * @name Compte
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Compte
 */
class CompteManager
{
	const TABLE_COMPTE = "cpt_compte";
	const CHAMP_COMPTE_ID = "cpt_id";
	const CHAMP_COMPTE_LABEL = "cpt_label";
	const CHAMP_COMPTE_MONTANT = "cpt_montant";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_MONTANT . "
			FROM " . CompteManager::TABLE_COMPTE . " 
			WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CompteManager::remplirCompte(
				$pId,
				$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
				$lLigne[CompteManager::CHAMP_COMPTE_MONTANT]);
		} else {
			return new CompteVO();
		}
	}

	/**
	* @name selectAll
	* @return array(CompteVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . CompteManager::CHAMP_COMPTE_MONTANT . "
			FROM " . CompteManager::TABLE_COMPTE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompte = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompte,
					CompteManager::remplirCompte(
					$lLigne[CompteManager::CHAMP_COMPTE_ID],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_MONTANT]));
			}
		} else {
			$lListeCompte = new CompteVO();
		}
		return $lListeCompte;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteManager::CHAMP_COMPTE_ID .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . CompteManager::CHAMP_COMPTE_MONTANT		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = CompteManager::CHAMP_COMPTE_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteManager::TABLE_COMPTE, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompte = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeCompte,
					CompteManager::remplirCompte(
					$lLigne[CompteManager::CHAMP_COMPTE_ID],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[CompteManager::CHAMP_COMPTE_MONTANT]));
			}
		} else {
			$lListeCompte[0] = new CompteVO();
		}

		return $lListeCompte;
	}

	/**
	* @name remplirCompte($pId, $pLabel, $pMontant)
	* @param int(11)
	* @param varchar(30)
	* @param decimal(10,2)
	* @return CompteVO
	* @desc Retourne une CompteVO remplie
	*/
	private static function remplirCompte($pId, $pLabel, $pMontant) {
		$lCompte = new CompteVO();
		$lCompte->setId($pId);
		$lCompte->setLabel($pLabel);
		$lCompte->setMontant($pMontant);
		return $lCompte;
	}

	/**
	* @name insert($pVo)
	* @param CompteVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CompteVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CompteManager::TABLE_COMPTE . "
				(" . CompteManager::CHAMP_COMPTE_ID . "
				," . CompteManager::CHAMP_COMPTE_LABEL . "
				," . CompteManager::CHAMP_COMPTE_MONTANT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CompteVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CompteVO, avec les informations du CompteVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CompteManager::TABLE_COMPTE . "
			 SET
				 " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'
				," . CompteManager::CHAMP_COMPTE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . CompteManager::CHAMP_COMPTE_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
			 WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . CompteManager::TABLE_COMPTE . "
			WHERE " . CompteManager::CHAMP_COMPTE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>