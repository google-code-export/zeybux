<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/10/2011
// Fichier : FermeProducteurManager.php
//
// Description : Classe de gestion des FermeProducteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "FermeProducteurVO.php");

/**
 * @name FermeProducteurManager
 * @author Julien PIERRE
 * @since 22/10/2011
 * 
 * @desc Classe permettant l'accès aux données des FermeProducteur
 */
class FermeProducteurManager
{
	const TABLE_FERMEPRODUCTEUR = "fepr_ferme_producteur";
	const CHAMP_FERMEPRODUCTEUR_ID = "fepr_id";
	const CHAMP_FERMEPRODUCTEUR_ID_FERME = "fepr_id_ferme";
	const CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR = "fepr_id_producteur";
	const CHAMP_FERMEPRODUCTEUR_ETAT = "fepr_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return FermeProducteurVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une FermeProducteurVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT . "
			FROM " . FermeProducteurManager::TABLE_FERMEPRODUCTEUR . " 
			WHERE " . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return FermeProducteurManager::remplirFermeProducteur(
				$pId,
				$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME],
				$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR],
				$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT]);
		} else {
			return new FermeProducteurVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(FermeProducteurVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de FermeProducteurVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR . 
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT . "
			FROM " . FermeProducteurManager::TABLE_FERMEPRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFermeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFermeProducteur,
					FermeProducteurManager::remplirFermeProducteur(
					$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID],
					$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME],
					$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR],
					$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT]));
			}
		} else {
			$lListeFermeProducteur[0] = new FermeProducteurVO();
		}
		return $lListeFermeProducteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(FermeProducteurVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de FermeProducteurVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID .
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME .
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR .
			"," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(FermeProducteurManager::TABLE_FERMEPRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeFermeProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeFermeProducteur,
						FermeProducteurManager::remplirFermeProducteur(
						$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID],
						$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME],
						$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR],
						$lLigne[FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT]));
				}
			} else {
				$lListeFermeProducteur[0] = new FermeProducteurVO();
			}

			return $lListeFermeProducteur;
		}

		$lListeFermeProducteur[0] = new FermeProducteurVO();
		return $lListeFermeProducteur;
	}

	/**
	* @name remplirFermeProducteur($pId, $pIdFerme, $pIdProducteur, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @return FermeProducteurVO
	* @desc Retourne une FermeProducteurVO remplie
	*/
	private static function remplirFermeProducteur($pId, $pIdFerme, $pIdProducteur, $pEtat) {
		$lFermeProducteur = new FermeProducteurVO();
		$lFermeProducteur->setId($pId);
		$lFermeProducteur->setIdFerme($pIdFerme);
		$lFermeProducteur->setIdProducteur($pIdProducteur);
		$lFermeProducteur->setEtat($pEtat);
		return $lFermeProducteur;
	}

	/**
	* @name insert($pVo)
	* @param FermeProducteurVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la FermeProducteurVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . FermeProducteurManager::TABLE_FERMEPRODUCTEUR . "
				(" . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . "
				," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME . "
				," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR . "
				," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProducteur() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param FermeProducteurVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du FermeProducteurVO, avec les informations du FermeProducteurVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . FermeProducteurManager::TABLE_FERMEPRODUCTEUR . "
			 SET
				 " . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_FERME . " = '" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID_PRODUCTEUR . " = '" . StringUtils::securiser( $pVo->getIdProducteur() ) . "'
				," . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . FermeProducteurManager::TABLE_FERMEPRODUCTEUR . "
			WHERE " . FermeProducteurManager::CHAMP_FERMEPRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>