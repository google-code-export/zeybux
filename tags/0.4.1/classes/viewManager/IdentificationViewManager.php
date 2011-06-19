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
	* @name select($pNumero)
	* @param string
	* @return IdentificationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une IdentificationView contenant les informations et la renvoie
	*/
	public static function select($pNumero) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdherentManager::CHAMP_ADHERENT_ID . 
			"," . AdherentManager::CHAMP_ADHERENT_ID_COMPTE . 
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_MOT_PASSE . 
			"," . ModuleManager::CHAMP_MOD_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . "
			FROM " . IdentificationViewManager::VUE_IDENTIFICATION. " 
			WHERE " . AdherentManager::CHAMP_ADHERENT_NUMERO . " = '" . StringUtils::securiser($pNumero) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeIdentification = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeIdentification,
					IdentificationViewManager::remplir(
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID],
						$lLigne[AdherentManager::CHAMP_ADHERENT_ID_COMPTE],
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_MOT_PASSE],
						$lLigne[ModuleManager::CHAMP_MOD_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU]));
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
			"," . AdherentManager::CHAMP_ADHERENT_NUMERO . 
			"," . AdherentManager::CHAMP_ADHERENT_MOT_PASSE . 
			"," . ModuleManager::CHAMP_MOD_NOM . 
			"," . AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU . "
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
						$lLigne[AdherentManager::CHAMP_ADHERENT_NUMERO],
						$lLigne[AdherentManager::CHAMP_ADHERENT_MOT_PASSE],
						$lLigne[ModuleManager::CHAMP_MOD_NOM],
						$lLigne[AdherentManager::CHAMP_ADHERENT_SUPER_ZEYBU]));
			}
		} else {
			$lListeIdentification[0] = new IdentificationViewVO();
		}
		return $lListeIdentification;
	}
	
	/**
	* @name remplir($pAdhId, $pAdhIdCompte, $pAdhNumero, $pAdhMotPasse, $pModNom, $pAdhSuperZeybu)
	* @param int(11)
	* @param int(11)
	* @param varchar(5)
	* @param varchar(100)
	* @param varchar(5)
	* @param tinyint(1)
	* @return IdentificationViewVO
	* @desc Retourne une IdentificationViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhIdCompte, $pAdhNumero, $pAdhMotPasse, $pModNom, $pAdhSuperZeybu) {
		$lIdentification = new IdentificationViewVO();
		$lIdentification->setAdhId($pAdhId);
		$lIdentification->setAdhIdCompte($pAdhIdCompte);
		$lIdentification->setAdhNumero($pAdhNumero);
		$lIdentification->setAdhMotPasse($pAdhMotPasse);
		$lIdentification->setModNom($pModNom);
		$lIdentification->setAdhSuperZeybu($pAdhSuperZeybu);
		return $lIdentification;
	}
}
?>