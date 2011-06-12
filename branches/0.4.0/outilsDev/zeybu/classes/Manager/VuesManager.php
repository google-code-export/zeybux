<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/06/2010
// Fichier : VuesManager.php
//
// Description : Classe de gestion des Vues
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "VuesVO.php");

/**
 * @name Vues
 * @author Julien PIERRE
 * @since 10/06/2010
 * 
 * @desc Classe permettant l'accès aux données des Vues
 */
class VuesManager
{
	const TABLE_VUES = "vue_vues";
	const CHAMP_VUES_ID = "vue_id";
	const CHAMP_VUES_ID_MODULE = "vue_id_module";
	const CHAMP_VUES_NOM = "vue_nom";
	const CHAMP_VUES_LABEL = "vue_label";
	const CHAMP_VUES_ORDRE = "vue_ordre";

	/**
	* @name select($pId)
	* @param integer
	* @return VuesVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une VuesVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . VuesManager::CHAMP_VUES_ID . 
			"," . VuesManager::CHAMP_VUES_ID_MODULE . 
			"," . VuesManager::CHAMP_VUES_NOM . 
			"," . VuesManager::CHAMP_VUES_LABEL . 
			"," . VuesManager::CHAMP_VUES_ORDRE . "
			FROM " . VuesManager::TABLE_VUES . " 
			WHERE " . VuesManager::CHAMP_VUES_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return VuesManager::remplirVues(
				$pId,
				$lLigne[VuesManager::CHAMP_VUES_ID_MODULE],
				$lLigne[VuesManager::CHAMP_VUES_NOM],
				$lLigne[VuesManager::CHAMP_VUES_LABEL],
				$lLigne[VuesManager::CHAMP_VUES_ORDRE]);
		} else {
			return new VuesVO();
		}
	}

	/**
	* @name selectAll
	* @return array(VuesVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de VuesVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . VuesManager::CHAMP_VUES_ID . 
			"," . VuesManager::CHAMP_VUES_ID_MODULE . 
			"," . VuesManager::CHAMP_VUES_NOM . 
			"," . VuesManager::CHAMP_VUES_LABEL . 
			"," . VuesManager::CHAMP_VUES_ORDRE . "
			FROM " . VuesManager::TABLE_VUES;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeVues = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeVues,
					VuesManager::remplirVues(
					$lLigne[VuesManager::CHAMP_VUES_ID],
					$lLigne[VuesManager::CHAMP_VUES_ID_MODULE],
					$lLigne[VuesManager::CHAMP_VUES_NOM],
					$lLigne[VuesManager::CHAMP_VUES_LABEL],
					$lLigne[VuesManager::CHAMP_VUES_ORDRE]));
			}
		} else {
			$lListeVues = new VuesVO();
		}
		return $lListeVues;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(VuesVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de VuesVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    VuesManager::CHAMP_VUES_ID .
			"," . VuesManager::CHAMP_VUES_ID_MODULE .
			"," . VuesManager::CHAMP_VUES_NOM .
			"," . VuesManager::CHAMP_VUES_LABEL .
			"," . VuesManager::CHAMP_VUES_ORDRE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = VuesManager::CHAMP_VUES_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(VuesManager::TABLE_VUES, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeVues = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeVues,
					VuesManager::remplirVues(
					$lLigne[VuesManager::CHAMP_VUES_ID],
					$lLigne[VuesManager::CHAMP_VUES_ID_MODULE],
					$lLigne[VuesManager::CHAMP_VUES_NOM],
					$lLigne[VuesManager::CHAMP_VUES_LABEL],
					$lLigne[VuesManager::CHAMP_VUES_ORDRE]));
			}
		} else {
			$lListeVues[0] = new VuesVO();
		}

		return $lListeVues;
	}

	/**
	* @name remplirVues($pId, $pIdModule, $pNom, $pLabel, $pOrdre)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(80)
	* @param int(11)
	* @return VuesVO
	* @desc Retourne une VuesVO remplie
	*/
	private static function remplirVues($pId, $pIdModule, $pNom, $pLabel, $pOrdre) {
		$lVues = new VuesVO();
		$lVues->setId($pId);
		$lVues->setIdModule($pIdModule);
		$lVues->setNom($pNom);
		$lVues->setLabel($pLabel);
		$lVues->setOrdre($pOrdre);
		return $lVues;
	}

	/**
	* @name insert($pVo)
	* @param VuesVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la VuesVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . VuesManager::TABLE_VUES . "
				(" . VuesManager::CHAMP_VUES_ID . "
				," . VuesManager::CHAMP_VUES_ID_MODULE . "
				," . VuesManager::CHAMP_VUES_NOM . "
				," . VuesManager::CHAMP_VUES_LABEL . "
				," . VuesManager::CHAMP_VUES_ORDRE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdModule() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getOrdre() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param VuesVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du VuesVO, avec les informations du VuesVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . VuesManager::TABLE_VUES . "
			 SET
				 " . VuesManager::CHAMP_VUES_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'
				," . VuesManager::CHAMP_VUES_ID_MODULE . " = '" . StringUtils::securiser( $pVo->getIdModule() ) . "'
				," . VuesManager::CHAMP_VUES_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . VuesManager::CHAMP_VUES_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . VuesManager::CHAMP_VUES_ORDRE . " = '" . StringUtils::securiser( $pVo->getOrdre() ) . "'
			 WHERE " . VuesManager::CHAMP_VUES_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . VuesManager::TABLE_VUES . "
			WHERE " . VuesManager::CHAMP_VUES_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>