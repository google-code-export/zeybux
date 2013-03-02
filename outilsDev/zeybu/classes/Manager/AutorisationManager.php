<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : AutorisationManager.php
//
// Description : Classe de gestion des Autorisation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");

/**
 * @name Autorisation
 * @author Julien PIERRE
 * @since 10/06/2010
 * 
 * @desc Classe permettant l'accès aux données des Autorisation
 */
class AutorisationManager
{
	const TABLE_AUTORISATION = "aut_autorisation";
	const CHAMP_AUTORISATION_ID = "aut_id";
	const CHAMP_AUTORISATION_ID_ADHERENT = "aut_id_adherent";
	const CHAMP_AUTORISATION_ID_MODULE = "aut_id_module";

	/**
	* @name select($pId)
	* @param integer
	* @return AutorisationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AutorisationVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AutorisationManager::CHAMP_AUTORISATION_ID . 
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT . 
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_MODULE . "
			FROM " . AutorisationManager::TABLE_AUTORISATION . " 
			WHERE " . AutorisationManager::CHAMP_AUTORISATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AutorisationManager::remplirAutorisation(
				$pId,
				$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT],
				$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_MODULE]);
		} else {
			return new AutorisationVO();
		}
	}

	/**
	* @name selectAll
	* @return array(AutorisationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AutorisationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AutorisationManager::CHAMP_AUTORISATION_ID . 
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT . 
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_MODULE . "
			FROM " . AutorisationManager::TABLE_AUTORISATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAutorisation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAutorisation,
					AutorisationManager::remplirAutorisation(
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID],
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT],
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_MODULE]));
			}
		} else {
			$lListeAutorisation = new AutorisationVO();
		}
		return $lListeAutorisation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AutorisationVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AutorisationVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AutorisationManager::CHAMP_AUTORISATION_ID .
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT .
			"," . AutorisationManager::CHAMP_AUTORISATION_ID_MODULE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = AutorisationManager::CHAMP_AUTORISATION_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AutorisationManager::TABLE_AUTORISATION, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAutorisation = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeAutorisation,
					AutorisationManager::remplirAutorisation(
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID],
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT],
					$lLigne[AutorisationManager::CHAMP_AUTORISATION_ID_MODULE]));
			}
		} else {
			$lListeAutorisation[0] = new AutorisationVO();
		}

		return $lListeAutorisation;
	}

	/**
	* @name remplirAutorisation($pId, $pIdAdherent, $pIdModule)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return AutorisationVO
	* @desc Retourne une AutorisationVO remplie
	*/
	private static function remplirAutorisation($pId, $pIdAdherent, $pIdModule) {
		$lAutorisation = new AutorisationVO();
		$lAutorisation->setId($pId);
		$lAutorisation->setIdAdherent($pIdAdherent);
		$lAutorisation->setIdModule($pIdModule);
		return $lAutorisation;
	}

	/**
	* @name insert($pVo)
	* @param AutorisationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AutorisationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . AutorisationManager::TABLE_AUTORISATION . "
				(" . AutorisationManager::CHAMP_AUTORISATION_ID . "
				," . AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT . "
				," . AutorisationManager::CHAMP_AUTORISATION_ID_MODULE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdModule() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param AutorisationVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AutorisationVO, avec les informations du AutorisationVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AutorisationManager::TABLE_AUTORISATION . "
			 SET
				 " . AutorisationManager::CHAMP_AUTORISATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'
				," . AutorisationManager::CHAMP_AUTORISATION_ID_ADHERENT . " = '" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				," . AutorisationManager::CHAMP_AUTORISATION_ID_MODULE . " = '" . StringUtils::securiser( $pVo->getIdModule() ) . "'
			 WHERE " . AutorisationManager::CHAMP_AUTORISATION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . AutorisationManager::TABLE_AUTORISATION . "
			WHERE " . AutorisationManager::CHAMP_AUTORISATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>