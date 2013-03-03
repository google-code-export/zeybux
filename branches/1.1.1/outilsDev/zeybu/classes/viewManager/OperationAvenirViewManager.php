<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/09/2010
// Fichier : OperationAvenirViewManager.php
//
// Description : Classe de gestion des OperationAvenir
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationAvenirViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name OperationAvenirViewManager
 * @author Julien PIERRE
 * @since 09/09/2010
 * 
 * @desc Classe permettant l'accès aux données des OperationAvenir
 */
class OperationAvenirViewManager
{
	const VUE_OPERATIONAVENIR = "view_operation_avenir";

	/**
	* @name select($pId)
	* @param integer
	* @return OperationAvenirViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationAvenirViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . OperationAvenirViewManager::VUE_OPERATIONAVENIR . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return OperationAvenirViewManager::remplir(
				$pId);
		} else {
			return new OperationAvenirViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(OperationAvenirViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationAvenirViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . OperationAvenirViewManager::VUE_OPERATIONAVENIR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAvenir = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAvenir,
					OperationAvenirViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeOperationAvenir[0] = new OperationAvenirViewVO();
		}
		return $lListeOperationAvenir;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationAvenirViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationAvenirViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationAvenirViewManager::VUE_OPERATIONAVENIR, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAvenir = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeOperationAvenir,
					OperationAvenirViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeOperationAvenir[0] = new OperationAvenirViewVO();
		}

		return $lListeOperationAvenir;
	}

	/**
	* @name remplirOperationAvenir($pComDateMarche)
	* @param datetime
	* @return OperationAvenirViewVO
	* @desc Retourne une OperationAvenirViewVO remplie
	*/
	private static function remplir($pComDateMarche) {
		$lOperationAvenir = new OperationAvenirViewVO();
		$lOperationAvenir->setComDateMarche($pComDateMarche);
		return $lOperationAvenir;
	}
}
?>