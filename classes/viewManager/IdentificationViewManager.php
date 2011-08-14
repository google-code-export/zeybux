<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/09/2010
// Fichier : IdentificationViewManager.php
//
// Description : Classe d'accès à la vue view_identification
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "IdentificationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");

/**
 * @name IdentificationViewManager
 * @author Julien PIERRE
 * @since 03/09/2010
 * 
 * @desc Classe permettant l'accès à la vue view_identification
 */
class IdentificationViewManager
{
	const VUE_IDENTIFICATION = "view_identification";
	
	/**
	* @name select($pId)
	* @param string
	* @return IdentificationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une IdentificationView contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE .
			"," . ModuleManager::CHAMP_MOD_NOM . "
			FROM " . IdentificationViewManager::VUE_IDENTIFICATION. " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeIdentification = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeIdentification,
					IdentificationViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[ModuleManager::CHAMP_MOD_NOM]));
			}
		} else {
			$lListeIdentification[0] = new IdentificationViewVO();
		}
		return $lListeIdentification;
	}

	/**
	* @name selectAll()
	* @return array(IdentificationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de IdentificationViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . ModuleManager::CHAMP_MOD_NOM . "
			FROM " . IdentificationViewManager::VUE_IDENTIFICATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeIdentification = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeIdentification,
					IdentificationViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[ModuleManager::CHAMP_MOD_NOM]));
			}
		} else {
			$lListeIdentification[0] = new IdentificationViewVO();
		}
		return $lListeIdentification;
	}
	
	/**
	* @name remplir($pAdhId, $pAdhMotPasse, $pModNom)
	* @param int(11)
	* @param int(11)
	* @param varchar(5)
	* @return IdentificationViewVO
	* @desc Retourne une IdentificationViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhIdCompte, $pModNom) {
		$lIdentification = new IdentificationViewVO();
		$lIdentification->setAdhId($pAdhId);
		$lIdentification->setAdhIdCompte($pAdhIdCompte);
		$lIdentification->setModNom($pModNom);
		return $lIdentification;
	}
}
?>