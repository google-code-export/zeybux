<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/11/2011
// Fichier : ModeleLotViewManager.php
//
// Description : Classe de gestion des ModeleLot
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ModeleLotViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModeleLotManager.php");

define("VUE_MODELELOT", MYSQL_DB_PREFIXE . "view_modele_lot");
/**
 * @name ModeleLotViewManager
 * @author Julien PIERRE
 * @since 03/11/2011
 * 
 * @desc Classe permettant l'accès aux données des ModeleLot
 */
class ModeleLotViewManager
{
	const VUE_MODELELOT = VUE_MODELELOT;

	/**
	* @name select($pId)
	* @param integer
	* @return ModeleLotViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ModeleLotViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . ModeleLotViewManager::VUE_MODELELOT . " 
			WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModeleLot = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModeleLot,
					ModeleLotViewManager::remplir(
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeModeleLot[0] = new ModeleLotViewVO();
		}
		return $lListeModeleLot;
	}

	/**
	* @name selectAll()
	* @return array(ModeleLotViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ModeleLotViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . ModeleLotViewManager::VUE_MODELELOT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModeleLot = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModeleLot,
					ModeleLotViewManager::remplir(
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeModeleLot[0] = new ModeleLotViewVO();
		}
		return $lListeModeleLot;
	}
	
	/**
	* @name selectByIdNomProduit($pId)
	* @param integer
	* @return array(ModeleLotViewVO)
	* @desc Récupères toutes les lignes correspondant à l'IdNomProduit et les renvoie sous forme d'une collection de ModeleLotViewVO
	*/
	public static function selectByIdNomProduit($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . ModeleLotViewManager::VUE_MODELELOT . " 
			WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'";
			    
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModeleLot = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModeleLot,
					ModeleLotViewManager::remplir(
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeModeleLot[0] = new ModeleLotViewVO();
		}
		return $lListeModeleLot;
	}
	
	/**
	* @name selectUnite($pId)
	* @param integer
	* @return array(ModeleLotViewVO)
	* @desc Récupères toutes les lignes correspondant à l'IdNomProduit et les renvoie sous forme d'une collection de ModeleLotViewVO
	*/
	public static function selectUnite($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ModeleLotManager::CHAMP_MODELELOT_ID . 
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . 
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . 
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX . "
			FROM " . ModeleLotViewManager::VUE_MODELELOT . " 
			WHERE " . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser($pId) . "'
			GROUP BY " . ModeleLotManager::CHAMP_MODELELOT_UNITE . "
			ORDER BY " . ModeleLotManager::CHAMP_MODELELOT_UNITE;
			    
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeModeleLot = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeModeleLot,
					ModeleLotViewManager::remplir(
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
					$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
			}
		} else {
			$lListeModeleLot[0] = new ModeleLotViewVO();
		}
		return $lListeModeleLot;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ModeleLotViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ModeleLotViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ModeleLotManager::CHAMP_MODELELOT_ID .
			"," . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT .
			"," . ModeleLotManager::CHAMP_MODELELOT_QUANTITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_UNITE .
			"," . ModeleLotManager::CHAMP_MODELELOT_PRIX		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ModeleLotViewManager::VUE_MODELELOT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeModeleLot = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeModeleLot,
						ModeleLotViewManager::remplir(
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_QUANTITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE],
						$lLigne[ModeleLotManager::CHAMP_MODELELOT_PRIX]));
				}
			} else {
				$lListeModeleLot[0] = new ModeleLotViewVO();
			}

			return $lListeModeleLot;
		}

		$lListeModeleLot[0] = new ModeleLotViewVO();
		return $lListeModeleLot;
	}

	/**
	* @name remplir($pMLotId, $pMLotIdNomProduit, $pMLotQuantite, $pMLotUnite, $pMLotPrix)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(20)
	* @param decimal(10,2)
	* @return ModeleLotViewVO
	* @desc Retourne une ModeleLotViewVO remplie
	*/
	private static function remplir($pMLotId, $pMLotIdNomProduit, $pMLotQuantite, $pMLotUnite, $pMLotPrix) {
		$lModeleLot = new ModeleLotViewVO();
		$lModeleLot->setMLotId($pMLotId);
		$lModeleLot->setMLotIdNomProduit($pMLotIdNomProduit);
		$lModeleLot->setMLotQuantite($pMLotQuantite);
		$lModeleLot->setMLotUnite($pMLotUnite);
		$lModeleLot->setMLotPrix($pMLotPrix);
		return $lModeleLot;
	}
}
?>