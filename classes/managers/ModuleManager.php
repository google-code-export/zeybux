<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : ModuleManager.php
//
// Description : Classe de gestion des Modules
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ModuleVO.php");

/**
 * @name ModuleManager
 * @author Julien PIERRE
 * @since 27/01/2010
 * 
 * @desc Classe permettant l'accès aux données des Modules
 */
class ModuleManager
{
	const TABLE_MODULE = "mod_module";
	const CHAMP_MOD_ID = "mod_id";
	const CHAMP_MOD_NOM = "mod_nom";
	const CHAMP_MOD_LABEL = "mod_label";
	const CHAMP_MOD_DEFAUT = "mod_defaut";
	const CHAMP_MOD_ORDRE = "mod_ordre";
	const CHAMP_MOD_ADMIN = "mod_admin";
	const CHAMP_MOD_VISIBLE = "mod_visible";

	/**
	* @name select($pId)
	* @param integer
	* @return ModuleVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé un ModuleVO contenant les informations et le renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = "SELECT " . ModuleManager::CHAMP_MOD_NOM . 
						"," . ModuleManager::CHAMP_MOD_LABEL . 
						"," . ModuleManager::CHAMP_MOD_DEFAUT . 
						"," . ModuleManager::CHAMP_MOD_ORDRE .
						"," . ModuleManager::CHAMP_MOD_ADMIN .
						"," . ModuleManager::CHAMP_MOD_VISIBLE . " 
					FROM " . ModuleManager::TABLE_MODULE . " 
					WHERE " . ModuleManager::CHAMP_MOD_ID . " = '". StringUtils::securiser($pId) . "'";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ModuleManager::remplirModule($pId, 
				$lLigne[ModuleManager::CHAMP_MOD_NOM], 
				$lLigne[ModuleManager::CHAMP_MOD_LABEL], 
				$lLigne[ModuleManager::CHAMP_MOD_DEFAUT], 
				$lLigne[ModuleManager::CHAMP_MOD_ORDRE],
				$lLigne[ModuleManager::CHAMP_MOD_ADMIN],
				$lLigne[ModuleManager::CHAMP_MOD_VISIBLE]);
		} else {
			return new ModuleVO();
		}
	}

	/**
	* @name selectAll
	* @return array(ModuleVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ModuleVO selon leurs classement
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = "SELECT " . ModuleManager::CHAMP_MOD_ID . 
						"," . ModuleManager::CHAMP_MOD_NOM . 
						"," . ModuleManager::CHAMP_MOD_LABEL . 
						"," . ModuleManager::CHAMP_MOD_DEFAUT . 
						"," . ModuleManager::CHAMP_MOD_ORDRE .
						"," . ModuleManager::CHAMP_MOD_ADMIN .
						"," . ModuleManager::CHAMP_MOD_VISIBLE . " 
					FROM " . ModuleManager::TABLE_MODULE . " 
					ORDER BY `mod_module`.`mod_ordre` ASC";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeModule = array();

		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModule,ModuleManager::remplirModule($lLigne[ModuleManager::CHAMP_MOD_ID], 
				$lLigne[ModuleManager::CHAMP_MOD_NOM], 
				$lLigne[ModuleManager::CHAMP_MOD_LABEL], 
				$lLigne[ModuleManager::CHAMP_MOD_DEFAUT], 
				$lLigne[ModuleManager::CHAMP_MOD_ORDRE],
				$lLigne[ModuleManager::CHAMP_MOD_ADMIN],
				$lLigne[ModuleManager::CHAMP_MOD_VISIBLE]));
			}
		} else {
			$lListeModule[0] =  new ModuleVO();
		}

		return $lListeModule;
	}
	
	/**
	* @name selectAllVisible()
	* @return array(ModuleVO)
	* @desc Récupères toutes les lignes de la table qui ont le statut visible à 1 et les renvoie sous forme d'une collection de ModuleVO
	*/
	public static function selectAllVisible() {		
		return ModuleManager::recherche(
			array(ModuleManager::CHAMP_MOD_VISIBLE),
			array('='),
			array(1),
			array(ModuleManager::CHAMP_MOD_ORDRE),
			array('ASC'));
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
			    ModuleManager::CHAMP_MOD_ID .
			"," . ModuleManager::CHAMP_MOD_NOM .
			"," . ModuleManager::CHAMP_MOD_LABEL .
			"," . ModuleManager::CHAMP_MOD_DEFAUT .
			"," . ModuleManager::CHAMP_MOD_ORDRE .
			"," . ModuleManager::CHAMP_MOD_ADMIN	 .
			"," . ModuleManager::CHAMP_MOD_VISIBLE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ModuleManager::TABLE_MODULE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);
	
		$lListeModule = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeModule,
						ModuleManager::remplirModule(
						$lLigne[ModuleManager::CHAMP_MOD_ID],
						$lLigne[ModuleManager::CHAMP_MOD_NOM],
						$lLigne[ModuleManager::CHAMP_MOD_LABEL],
						$lLigne[ModuleManager::CHAMP_MOD_DEFAUT],
						$lLigne[ModuleManager::CHAMP_MOD_ORDRE],
						$lLigne[ModuleManager::CHAMP_MOD_ADMIN],
						$lLigne[ModuleManager::CHAMP_MOD_VISIBLE]));
				}
			} else {
				$lListeModule[0] = new ModuleVO();
			}
	
			return $lListeModule;
		}
		
		$lListeModule[0] = new ModuleVO();
		return $lListeModule;
	}
		
	/**
	* @name remplirModule($pId, $pNom, $pLabel, $pDefaut, $pOrdre, $pAdmin, $pVisible)
	* @param interger
	* @param string
	* @param string
	* @param bool
	* @param integer
	* @param integer
	* @param bool
	* @return ModuleVO
	* @desc Retourne un ModuleVO rempli
	*/
	private static function remplirModule($pId, $pNom, $pLabel, $pDefaut, $pOrdre, $pAdmin, $pVisible) {
		$lModule = new ModuleVO();

		$lModule->setId($pId);
		$lModule->setNom($pNom);
		$lModule->setLabel($pLabel);
		$lModule->setDefaut($pDefaut);
		$lModule->setOrdre($pOrdre);
		$lModule->setAdmin($pAdmin);
		$lModule->setVisible($pVisible);
		
		return $lModule;
	}
	
	/**
	* @name insert($pVo)
	* @param ModuleVO
	* @desc Insère une nouvelle ligne dans la table, à partir des informations du ModuleVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = 	"INSERT INTO " . ModuleManager::TABLE_MODULE . " 
					(" . ModuleManager::CHAMP_MOD_ID . "
					," . ModuleManager::CHAMP_MOD_NOM . "
					," . ModuleManager::CHAMP_MOD_LABEL . "
					," . ModuleManager::CHAMP_MOD_DEFAUT . "
					," . ModuleManager::CHAMP_MOD_ORDRE  . "
					," . ModuleManager::CHAMP_MOD_ADMIN . "
					," . ModuleManager::CHAMP_MOD_VISIBLE . ") 
				VALUES (NULL
					,'" . StringUtils::securiser( $pVo->getNom() ) ."'
					,'" . StringUtils::securiser( $pVo->getLabel() ) ."'
					,'" . StringUtils::securiser( $pVo->getDefaut() ) ."'
					,'" . StringUtils::securiser( $pVo->getOrdre() ) ."'
					,'" . StringUtils::securiser( $pVo->getAdmin() ) ."'
					,'" . StringUtils::securiser( $pVo->getVisible() ) ."')";
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
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
		
		$lRequete = 	"UPDATE " . ModuleManager::TABLE_MODULE . " 
				SET " . ModuleManager::CHAMP_MOD_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "' 
					," . ModuleManager::CHAMP_MOD_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
					," . ModuleManager::CHAMP_MOD_DEFAUT . " = '" . StringUtils::securiser( $pVo->getDefaut() ) . "'
					," . ModuleManager::CHAMP_MOD_ORDRE . " = '" . StringUtils::securiser( $pVo->getOrdre() ) . "'
					," . ModuleManager::CHAMP_MOD_ADMIN . " = '" . StringUtils::securiser( $pVo->getAdmin() ) . "'
					," . ModuleManager::CHAMP_MOD_VISIBLE . " = '" . StringUtils::securiser( $pVo->getVisible() ) . "'
				WHERE " . ModuleManager::CHAMP_MOD_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";
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
		
		$lRequete = 	"DELETE FROM " . ModuleManager::TABLE_MODULE . " 
				WHERE " . ModuleManager::CHAMP_MOD_ID . " = '". StringUtils::securiser($pId) . "'";
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

}
?>