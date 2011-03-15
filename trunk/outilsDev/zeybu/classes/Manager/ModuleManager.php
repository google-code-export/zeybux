<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : ModuleManager.php
//
// Description : Classe de gestion des Module
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ModuleVO.php");

/**
 * @name ModuleManager
 * @author Julien PIERRE
 * @since 22/12/2010
 * 
 * @desc Classe permettant l'accès aux données des Module
 */
class ModuleManager
{
	const TABLE_MODULE = "mod_module";
	const CHAMP_MODULE_ID = "mod_id";
	const CHAMP_MODULE_NOM = "mod_nom";
	const CHAMP_MODULE_LABEL = "mod_label";
	const CHAMP_MODULE_DEFAUT = "mod_defaut";
	const CHAMP_MODULE_ORDRE = "mod_ordre";
	const CHAMP_MODULE_ADMIN = "mod_admin";

	/**
	* @name select($pId)
	* @param integer
	* @return ModuleVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ModuleVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ModuleManager::CHAMP_MODULE_ID . 
			"," . ModuleManager::CHAMP_MODULE_NOM . 
			"," . ModuleManager::CHAMP_MODULE_LABEL . 
			"," . ModuleManager::CHAMP_MODULE_DEFAUT . 
			"," . ModuleManager::CHAMP_MODULE_ORDRE . 
			"," . ModuleManager::CHAMP_MODULE_ADMIN . "
			FROM " . ModuleManager::TABLE_MODULE . " 
			WHERE " . ModuleManager::CHAMP_MODULE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ModuleManager::remplirModule(
				$pId,
				$lLigne[ModuleManager::CHAMP_MODULE_NOM],
				$lLigne[ModuleManager::CHAMP_MODULE_LABEL],
				$lLigne[ModuleManager::CHAMP_MODULE_DEFAUT],
				$lLigne[ModuleManager::CHAMP_MODULE_ORDRE],
				$lLigne[ModuleManager::CHAMP_MODULE_ADMIN]);
		} else {
			return new ModuleVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ModuleVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ModuleVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ModuleManager::CHAMP_MODULE_ID . 
			"," . ModuleManager::CHAMP_MODULE_NOM . 
			"," . ModuleManager::CHAMP_MODULE_LABEL . 
			"," . ModuleManager::CHAMP_MODULE_DEFAUT . 
			"," . ModuleManager::CHAMP_MODULE_ORDRE . 
			"," . ModuleManager::CHAMP_MODULE_ADMIN . "
			FROM " . ModuleManager::TABLE_MODULE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModule = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModule,
					ModuleManager::remplirModule(
					$lLigne[ModuleManager::CHAMP_MODULE_ID],
					$lLigne[ModuleManager::CHAMP_MODULE_NOM],
					$lLigne[ModuleManager::CHAMP_MODULE_LABEL],
					$lLigne[ModuleManager::CHAMP_MODULE_DEFAUT],
					$lLigne[ModuleManager::CHAMP_MODULE_ORDRE],
					$lLigne[ModuleManager::CHAMP_MODULE_ADMIN]));
			}
		} else {
			$lListeModule[0] = new ModuleVO();
		}
		return $lListeModule;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ModuleVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ModuleVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ModuleManager::CHAMP_MODULE_ID .
			"," . ModuleManager::CHAMP_MODULE_NOM .
			"," . ModuleManager::CHAMP_MODULE_LABEL .
			"," . ModuleManager::CHAMP_MODULE_DEFAUT .
			"," . ModuleManager::CHAMP_MODULE_ORDRE .
			"," . ModuleManager::CHAMP_MODULE_ADMIN		);

		if(is_array($pTypeRecherche) && is_array($pCritereRecherche)) {
			$lFiltres = array();
			$i = 0;
			foreach($pTypeRecherche as $lTypeRecherche) {
				$lLigne = array();
				$lLigne['champ'] = StringUtils::securiser($lTypeRecherche);
				$lLigne['valeur'] = StringUtils::securiser($pCritereRecherche[$i]);
				array_push($lFiltres,$lLigne);
				$i++;
			}
		} else {
			$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));
		}

		if(is_array($pTypeCritere)) {
			$lTypeFiltre = $pTypeCritere;
		} else {
			$lTypeFiltre = array($pTypeCritere);
		}

		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = ModuleManager::CHAMP_MODULE_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ModuleManager::TABLE_MODULE, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModule = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeModule,
					ModuleManager::remplirModule(
					$lLigne[ModuleManager::CHAMP_MODULE_ID],
					$lLigne[ModuleManager::CHAMP_MODULE_NOM],
					$lLigne[ModuleManager::CHAMP_MODULE_LABEL],
					$lLigne[ModuleManager::CHAMP_MODULE_DEFAUT],
					$lLigne[ModuleManager::CHAMP_MODULE_ORDRE],
					$lLigne[ModuleManager::CHAMP_MODULE_ADMIN]));
			}
		} else {
			$lListeModule[0] = new ModuleVO();
		}

		return $lListeModule;
	}

	/**
	* @name remplirModule($pId, $pNom, $pLabel, $pDefaut, $pOrdre, $pAdmin)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(80)
	* @param tinyint(1)
	* @param int(11)
	* @param tinyint(1)
	* @return ModuleVO
	* @desc Retourne une ModuleVO remplie
	*/
	private static function remplirModule($pId, $pNom, $pLabel, $pDefaut, $pOrdre, $pAdmin) {
		$lModule = new ModuleVO();
		$lModule->setId($pId);
		$lModule->setNom($pNom);
		$lModule->setLabel($pLabel);
		$lModule->setDefaut($pDefaut);
		$lModule->setOrdre($pOrdre);
		$lModule->setAdmin($pAdmin);
		return $lModule;
	}

	/**
	* @name insert($pVo)
	* @param ModuleVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ModuleVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ModuleManager::TABLE_MODULE . "
				(" . ModuleManager::CHAMP_MODULE_ID . "
				," . ModuleManager::CHAMP_MODULE_NOM . "
				," . ModuleManager::CHAMP_MODULE_LABEL . "
				," . ModuleManager::CHAMP_MODULE_DEFAUT . "
				," . ModuleManager::CHAMP_MODULE_ORDRE . "
				," . ModuleManager::CHAMP_MODULE_ADMIN . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getDefaut() ) . "'
				,'" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				,'" . StringUtils::securiser( $pVo->getAdmin() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ModuleVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ModuleVO, avec les informations du ModuleVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ModuleManager::TABLE_MODULE . "
			 SET
				 " . ModuleManager::CHAMP_MODULE_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . ModuleManager::CHAMP_MODULE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . ModuleManager::CHAMP_MODULE_DEFAUT . " = '" . StringUtils::securiser( $pVo->getDefaut() ) . "'
				," . ModuleManager::CHAMP_MODULE_ORDRE . " = '" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				," . ModuleManager::CHAMP_MODULE_ADMIN . " = '" . StringUtils::securiser( $pVo->getAdmin() ) . "'
			 WHERE " . ModuleManager::CHAMP_MODULE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ModuleManager::TABLE_MODULE . "
			WHERE " . ModuleManager::CHAMP_MODULE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>