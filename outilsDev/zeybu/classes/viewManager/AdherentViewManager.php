<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/09/2010
// Fichier : AdherentViewManager.php
//
// Description : Classe de gestion des Adherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "AdherentViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name AdherentViewManager
 * @author Julien PIERRE
 * @since 09/09/2010
 * 
 * @desc Classe permettant l'accès aux données des Adherent
 */
class AdherentViewManager
{
	const VUE_ADHERENT = "view_adherent";

	/**
	* @name select($pId)
	* @param integer
	* @return AdherentViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdherentViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . AdherentViewManager::VUE_ADHERENT . " 
			WHERE " . CompteManager::CHAMP_COMPTE_LABEL . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AdherentViewManager::remplir(
				$pId);
		} else {
			return new AdherentViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdherentViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdherentViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteManager::CHAMP_COMPTE_LABEL . "
			FROM " . AdherentViewManager::VUE_ADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdherent,
					AdherentViewManager::remplir(
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeAdherent[0] = new AdherentViewVO();
		}
		return $lListeAdherent;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdherentViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdherentViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteManager::CHAMP_COMPTE_LABEL		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = CompteManager::CHAMP_COMPTE_LABEL;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdherentViewManager::VUE_ADHERENT, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdherent = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeAdherent,
					AdherentViewManager::remplir(
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL]));
			}
		} else {
			$lListeAdherent[0] = new AdherentViewVO();
		}

		return $lListeAdherent;
	}

	/**
	* @name remplirAdherent($pCptLabel)
	* @param varchar(30)
	* @return AdherentViewVO
	* @desc Retourne une AdherentViewVO remplie
	*/
	private static function remplir($pCptLabel) {
		$lAdherent = new AdherentViewVO();
		$lAdherent->setCptLabel($pCptLabel);
		return $lAdherent;
	}
}
?>