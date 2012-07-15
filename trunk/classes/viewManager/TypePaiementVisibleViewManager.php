<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2011
// Fichier : TypePaiementVisibleViewManager.php
//
// Description : Classe de gestion des TypePaiementVisible
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "TypePaiementVisibleViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");

define("VUE_TYPEPAIEMENTVISIBLE", MYSQL_DB_PREFIXE . "view_type_paiement_visible");
/**
 * @name TypePaiementVisibleViewManager
 * @author Julien PIERRE
 * @since 25/01/2011
 * 
 * @desc Classe permettant l'accès aux données des TypePaiementVisible
 */
class TypePaiementVisibleViewManager
{
	const VUE_TYPEPAIEMENTVISIBLE = VUE_TYPEPAIEMENTVISIBLE;

	/**
	* @name select($pId)
	* @param integer
	* @return TypePaiementVisibleViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une TypePaiementVisibleViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE . "
			FROM " . TypePaiementVisibleViewManager::VUE_TYPEPAIEMENTVISIBLE . " 
			WHERE " . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypePaiementVisible = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeTypePaiementVisible,
					TypePaiementVisibleViewManager::remplir(
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE]));
			}
		} else {
			$lListeTypePaiementVisible[0] = new TypePaiementVisibleViewVO();
		}
		return $lListeTypePaiementVisible;
	}

	/**
	* @name selectAll()
	* @return array(TypePaiementVisibleViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de TypePaiementVisibleViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE . "
			FROM " . TypePaiementVisibleViewManager::VUE_TYPEPAIEMENTVISIBLE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypePaiementVisible = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeTypePaiementVisible,
					TypePaiementVisibleViewManager::remplir(
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE]));
			}
		} else {
			$lListeTypePaiementVisible[0] = new TypePaiementVisibleViewVO();
		}
		return $lListeTypePaiementVisible;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(TypePaiementVisibleViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de TypePaiementVisibleViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    TypePaiementManager::CHAMP_TYPEPAIEMENT_ID .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(TypePaiementVisibleViewManager::VUE_TYPEPAIEMENTVISIBLE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeTypePaiementVisible = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeTypePaiementVisible,
						TypePaiementVisibleViewManager::remplir(
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_VISIBLE]));
				}
			} else {
				$lListeTypePaiementVisible[0] = new TypePaiementVisibleViewVO();
			}

			return $lListeTypePaiementVisible;
		}

		$lListeTypePaiementVisible[0] = new TypePaiementVisibleViewVO();
		return $lListeTypePaiementVisible;
	}

	/**
	* @name remplir($pTppId, $pTppType, $pTppChampComplementaire, $pTppLabelChampComplementaire, $pTppVisible)
	* @param int(11)
	* @param varchar(100)
	* @param tinyint(4)
	* @param varchar(30)
	* @param tinyint(1)
	* @return TypePaiementVisibleViewVO
	* @desc Retourne une TypePaiementVisibleViewVO remplie
	*/
	private static function remplir($pTppId, $pTppType, $pTppChampComplementaire, $pTppLabelChampComplementaire, $pTppVisible) {
		$lTypePaiementVisible = new TypePaiementVisibleViewVO();
		$lTypePaiementVisible->setTppId($pTppId);
		$lTypePaiementVisible->setTppType($pTppType);
		$lTypePaiementVisible->setTppChampComplementaire($pTppChampComplementaire);
		$lTypePaiementVisible->setTppLabelChampComplementaire($pTppLabelChampComplementaire);
		$lTypePaiementVisible->setTppVisible($pTppVisible);
		return $lTypePaiementVisible;
	}
}
?>