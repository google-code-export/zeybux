<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/08/2011
// Fichier : InfoOperationLivraisonManager.php
//
// Description : Classe de gestion des InfoOperationLivraison
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "InfoOperationLivraisonVO.php");

/**
 * @name InfoOperationLivraisonManager
 * @author Julien PIERRE
 * @since 12/08/2011
 * 
 * @desc Classe permettant l'accès aux données des InfoOperationLivraison
 */
class InfoOperationLivraisonManager
{
	const TABLE_INFOOPERATIONLIVRAISON = "iol_info_operation_livraison";
	const CHAMP_INFOOPERATIONLIVRAISON_ID = "iol_id";
	const CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU = "iol_id_ope_zeybu";
	const CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR = "iol_id_ope_producteur";

	/**
	* @name select($pId)
	* @param integer
	* @return InfoOperationLivraisonVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InfoOperationLivraisonVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . 
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . 
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR . "
			FROM " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . " 
			WHERE " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return InfoOperationLivraisonManager::remplirInfoOperationLivraison(
				$pId,
				$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU],
				$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR]);
		} else {
			return new InfoOperationLivraisonVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(InfoOperationLivraisonVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InfoOperationLivraisonVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . 
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . 
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR . "
			FROM " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInfoOperationLivraison = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInfoOperationLivraison,
					InfoOperationLivraisonManager::remplirInfoOperationLivraison(
					$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID],
					$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU],
					$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR]));
			}
		} else {
			$lListeInfoOperationLivraison[0] = new InfoOperationLivraisonVO();
		}
		return $lListeInfoOperationLivraison;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InfoOperationLivraisonVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InfoOperationLivraisonVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID .
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU .
			"," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInfoOperationLivraison = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInfoOperationLivraison,
						InfoOperationLivraisonManager::remplirInfoOperationLivraison(
						$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID],
						$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU],
						$lLigne[InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR]));
				}
			} else {
				$lListeInfoOperationLivraison[0] = new InfoOperationLivraisonVO();
			}

			return $lListeInfoOperationLivraison;
		}

		$lListeInfoOperationLivraison[0] = new InfoOperationLivraisonVO();
		return $lListeInfoOperationLivraison;
	}

	/**
	* @name remplirInfoOperationLivraison($pId, $pIdOpeZeybu, $pIdOpeProducteur)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return InfoOperationLivraisonVO
	* @desc Retourne une InfoOperationLivraisonVO remplie
	*/
	private static function remplirInfoOperationLivraison($pId, $pIdOpeZeybu, $pIdOpeProducteur) {
		$lInfoOperationLivraison = new InfoOperationLivraisonVO();
		$lInfoOperationLivraison->setId($pId);
		$lInfoOperationLivraison->setIdOpeZeybu($pIdOpeZeybu);
		$lInfoOperationLivraison->setIdOpeProducteur($pIdOpeProducteur);
		return $lInfoOperationLivraison;
	}

	/**
	* @name insert($pVo)
	* @param InfoOperationLivraisonVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la InfoOperationLivraisonVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . "
				(" . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . "
				," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . "
				," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdOpeZeybu() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOpeProducteur() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param InfoOperationLivraisonVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du InfoOperationLivraisonVO, avec les informations du InfoOperationLivraisonVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . "
			 SET
				 " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . " = '" . StringUtils::securiser( $pVo->getIdOpeZeybu() ) . "'
				," . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_PRODUCTEUR . " = '" . StringUtils::securiser( $pVo->getIdOpeProducteur() ) . "'
			 WHERE " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . "
			WHERE " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>