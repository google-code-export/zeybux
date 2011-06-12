<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/01/2011
// Fichier : totoViewManager.php
//
// Description : Classe de gestion des toto
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "totoViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "Rien.php");

/**
 * @name totoViewManager
 * @author Julien PIERRE
 * @since 02/01/2011
 * 
 * @desc Classe permettant l'accès aux données des toto
 */
class totoViewManager
{
	const VUE_TOTO = "test";

	/**
	* @name select($pId)
	* @param integer
	* @return totoViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une totoViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . Rien::ALPHA . "
			FROM " . totoViewManager::VUE_TOTO . " 
			WHERE " . Rien::ALPHA . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListetoto = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListetoto,
					totoViewManager::remplir(
					$lLigne[Rien::ALPHA]));
			}
		} else {
			$lListetoto[0] = new totoViewVO();
		}
		return $lListetoto;
	}

	/**
	* @name selectAll()
	* @return array(totoViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de totoViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . Rien::ALPHA . "
			FROM " . totoViewManager::VUE_TOTO;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListetoto = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListetoto,
					totoViewManager::remplir(
					$lLigne[Rien::ALPHA]));
			}
		} else {
			$lListetoto[0] = new totoViewVO();
		}
		return $lListetoto;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(totoViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de totoViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    Rien::ALPHA		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(totoViewManager::VUE_TOTO, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListetoto = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListetoto,
						totoViewManager::remplir(
						$lLigne[Rien::ALPHA]));
				}
			} else {
				$lListetoto[0] = new totoViewVO();
			}

			return $lListetoto;
		}

		$lListetoto[0] = new totoViewVO();
		return $lListetoto;
	}

	/**
	* @name remplirtoto($palpha)
	* @param entier
	* @return totoViewVO
	* @desc Retourne une totoViewVO remplie
	*/
	private static function remplir($palpha) {
		$ltoto = new totoViewVO();
		$ltoto->setalpha($palpha);
		return $ltoto;
	}
}
?>