<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/01/2010
// Fichier : AutorisationManager.php
//
// Description : Classe de gestion des Autorisation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AutorisationVO.php");

define("TABLE_AUTORISATION", MYSQL_DB_PREFIXE . "aut_autorisation");
/**
 * @name AutorisationManager
 * @author Julien PIERRE
 * @since 27/01/2010
 * 
 * @desc Classe permettant l'accès aux données des Autorisations
 */
class AutorisationManager
{
	const TABLE_AUTORISATION = TABLE_AUTORISATION;
	const CHAMP_AUT_ID = "aut_id";
	const CHAMP_AUT_ID_ADHERENT = "aut_id_adherent";
	const CHAMP_AUT_ID_MODULE = "aut_id_module";

	/**
	* @name select($pId)
	* @param integer
	* @return AutorisationVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé un AutorisationVO contenant les informations et le renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = 	"SELECT " . AutorisationManager::CHAMP_AUT_ID_ADHERENT . "," . AutorisationManager::CHAMP_AUT_ID_MODULE . "  
						FROM " . AutorisationManager::TABLE_AUTORISATION . " 
						WHERE " . AutorisationManager::CHAMP_AUT_ID . " = '". StringUtils::securiser($pId) . "'";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		
		$lSql = Dbutils::executerRequete($lRequete);
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AutorisationManager::remplirAutorisation($pId, $lLigne[AutorisationManager::CHAMP_AUT_ID_ADHERENT], $lLigne[AutorisationManager::CHAMP_AUT_ID_MODULE]);
		} else {
			return new AutorisationVO();
		}
	}

	/**
	* @name selectAll
	* @return array(AutorisationVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection d'AutorisationVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = "SELECT " . AutorisationManager::CHAMP_AUT_ID . "," . AutorisationManager::CHAMP_AUT_ID_ADHERENT . "," . AutorisationManager::CHAMP_AUT_ID_MODULE . "  
					FROM " . AutorisationManager::TABLE_AUTORISATION;
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeAutorisation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAutorisation,AutorisationManager::remplirAutorisation($lLigne[AutorisationManager::CHAMP_AUT_ID], $lLigne[AutorisationManager::CHAMP_AUT_ID_ADHERENT], $lLigne[AutorisationManager::CHAMP_AUT_ID_MODULE]));
			}
		} else {
			$lListeAutorisation[0] = new AutorisationVO();
		}

		return $lListeAutorisation;
	}

	/**
	* @name selectByIdAdherent($pId)
	* @param integer
	* @return array(AutorisationVO)
	* @desc Récupères toutes les lignes de la table avec l'Id adherent $pId et les renvoie sous forme d'une collection d'AutorisationVO
	*/
	public static function selectByIdAdherent($pId) {
		return AutorisationManager::rechercheAutorisation(
			array(AutorisationManager::CHAMP_AUT_ID_ADHERENT),
			array('='),
			array($pId),
			array(AutorisationManager::CHAMP_AUT_ID_ADHERENT),
			array('ASC'));
	}
	
	/**
	* @name rechercheAutorisation($pTypeRecherche, $pCritereRecherche, $pTypeTri, $pCritereTri)
	* @param string nom de la table
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @param integer
	* @return array(AutorisationVO)
	* @desc Recherche les autorisations selon les critères et les renvoie sous forme d'une collection de AutorisationVO
	*/
	public static function rechercheAutorisation($pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		// Préparation de la requète
		$lChamps = array(
				AutorisationManager::CHAMP_AUT_ID .
			"," . AutorisationManager::CHAMP_AUT_ID_ADHERENT .
			"," . AutorisationManager::CHAMP_AUT_ID_MODULE );
		
		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AutorisationManager::TABLE_AUTORISATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAutorisation = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
			
			if( mysql_num_rows($lSql) > 0 ) {
				while ($lLigne = mysql_fetch_assoc($lSql)) {
					array_push($lListeAutorisation,
						AutorisationManager::remplirAutorisation(
						$lLigne[AutorisationManager::CHAMP_AUT_ID],
						$lLigne[AutorisationManager::CHAMP_AUT_ID_ADHERENT],
						$lLigne[AutorisationManager::CHAMP_AUT_ID_MODULE]));
				}
			} else {
				$lListeAutorisation[0] = new AutorisationVO();
			}
			return $lListeAutorisation;
		}
		
		$lListeAutorisation[0] = new AutorisationVO();
		return $lListeAutorisation;
	}

	/**
	* @name remplirAutorisation($pId, $pIdAdherent, $pIdModule)
	* @param interger
	* @param integer
	* @param integer
	* @return AutorisationVO
	* @desc Retourne un AutorisationVO rempli
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
	* @desc Insère une nouvelle ligne dans la table, à partir des informations du AutorisationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete = 	"INSERT INTO " . AutorisationManager::TABLE_AUTORISATION . " 
					(" . AutorisationManager::CHAMP_AUT_ID . "
					," . AutorisationManager::CHAMP_AUT_ID_ADHERENT . "
					," . AutorisationManager::CHAMP_AUT_ID_MODULE . ") 
				VALUES (NULL
					,'" . StringUtils::securiser( $pVo->getIdAdherent() ) ."'
					,'" . StringUtils::securiser( $pVo->getIdModule() ) ."')";
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	 * @name insertByArray($pVo)
	 * @param array(AutorisationVO)
	 * @desc Insère une nouvelle ligne dans la table, à partir des informations de la AutorisationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	 */
	public static function insertByArray($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
	
		if(is_array($pVo)) {
			$lRequete =
			"INSERT INTO " . AutorisationManager::TABLE_AUTORISATION . " 
					(" . AutorisationManager::CHAMP_AUT_ID . "
					," . AutorisationManager::CHAMP_AUT_ID_ADHERENT . "
					," . AutorisationManager::CHAMP_AUT_ID_MODULE . ") 
			VALUES ";
			$lTaille = count($pVo);
			foreach($pVo as $lAutorisation) {
				$lTaille--;
				if($lTaille > 0) {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $lAutorisation->getIdAdherent() ) ."'
					,'" . StringUtils::securiser( $lAutorisation->getIdModule() ) ."'),";
				} else {
					$lRequete .= "(NULL
					,'" . StringUtils::securiser( $lAutorisation->getIdAdherent() ) ."'
					,'" . StringUtils::securiser( $lAutorisation->getIdModule() ) ."');";
				}
			}
	
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			return Dbutils::executerRequete($lRequete);
		}
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
		
		$lRequete = 	"UPDATE " . AutorisationManager::TABLE_AUTORISATION . " 
				SET " . AutorisationManager::CHAMP_AUT_ID_ADHERENT . " = '" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				," .  AutorisationManager::CHAMP_AUT_ID_MODULE . " = '" . StringUtils::securiser( $pVo->getIdModule() ) . "' 
				WHERE " . AutorisationManager::CHAMP_AUT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";
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
		
		$lRequete = 	"DELETE FROM " . AutorisationManager::TABLE_AUTORISATION . " 
				WHERE " . AutorisationManager::CHAMP_AUT_ID . " = '". StringUtils::securiser($pId) . "'";
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
	
	/**
	* @name deleteByArray($pIds)
	* @param array(integer)
	* @desc Supprime la ligne de la table correspondant aux id en paramètre
	*/
	public static function deleteByArray($pIds) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		if(is_array($pIds)) {
			$lRequete = 
				"DELETE FROM " . AutorisationManager::TABLE_AUTORISATION . " 
				WHERE " . AutorisationManager::CHAMP_AUT_ID . " in (";
			
			$lTaille = count($pIds);
			foreach($pIds as $lId) {
				$lTaille--;
				if($lTaille > 0) {
				 	$lRequete .= "'" . StringUtils::securiser( $lId ) . "',";
				} else {			
				 	$lRequete .= "'" . StringUtils::securiser( $lId ) . "'";
				}
			}
			$lRequete .= ");";
	
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			Dbutils::executerRequete($lRequete);
		}
	}
}
?>
