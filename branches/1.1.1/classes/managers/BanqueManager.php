<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/01/2013
// Fichier : BanqueManager.php
//
// Description : Classe de gestion des Banque
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "BanqueVO.php");

define("TABLE_BANQUE", MYSQL_DB_PREFIXE ."ban_banque");
/**
 * @name BanqueManager
 * @author Julien PIERRE
 * @since 12/01/2013
 * 
 * @desc Classe permettant l'accès aux données des Banque
 */
class BanqueManager
{
	const TABLE_BANQUE = TABLE_BANQUE;
	const CHAMP_BANQUE_ID = "ban_id";
	const CHAMP_BANQUE_NOM_COURT = "ban_nom_court";
	const CHAMP_BANQUE_NOM = "ban_nom";
	const CHAMP_BANQUE_DESCRIPTION = "ban_description";
	const CHAMP_BANQUE_ETAT = "ban_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return BanqueVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une BanqueVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . BanqueManager::CHAMP_BANQUE_ID . 
			"," . BanqueManager::CHAMP_BANQUE_NOM_COURT . 
			"," . BanqueManager::CHAMP_BANQUE_NOM . 
			"," . BanqueManager::CHAMP_BANQUE_DESCRIPTION . 
			"," . BanqueManager::CHAMP_BANQUE_ETAT . "
			FROM " . BanqueManager::TABLE_BANQUE . " 
			WHERE " . BanqueManager::CHAMP_BANQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return BanqueManager::remplirBanque(
				$pId,
				$lLigne[BanqueManager::CHAMP_BANQUE_NOM_COURT],
				$lLigne[BanqueManager::CHAMP_BANQUE_NOM],
				$lLigne[BanqueManager::CHAMP_BANQUE_DESCRIPTION],
				$lLigne[BanqueManager::CHAMP_BANQUE_ETAT]);
		} else {
			return new BanqueVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(BanqueVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de BanqueVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . BanqueManager::CHAMP_BANQUE_ID . 
			"," . BanqueManager::CHAMP_BANQUE_NOM_COURT . 
			"," . BanqueManager::CHAMP_BANQUE_NOM . 
			"," . BanqueManager::CHAMP_BANQUE_DESCRIPTION . 
			"," . BanqueManager::CHAMP_BANQUE_ETAT . "
			FROM " . BanqueManager::TABLE_BANQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeBanque = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeBanque,
					BanqueManager::remplirBanque(
					$lLigne[BanqueManager::CHAMP_BANQUE_ID],
					$lLigne[BanqueManager::CHAMP_BANQUE_NOM_COURT],
					$lLigne[BanqueManager::CHAMP_BANQUE_NOM],
					$lLigne[BanqueManager::CHAMP_BANQUE_DESCRIPTION],
					$lLigne[BanqueManager::CHAMP_BANQUE_ETAT]));
			}
		} else {
			$lListeBanque[0] = new BanqueVO();
		}
		return $lListeBanque;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(BanqueVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de BanqueVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    BanqueManager::CHAMP_BANQUE_ID .
			"," . BanqueManager::CHAMP_BANQUE_NOM_COURT .
			"," . BanqueManager::CHAMP_BANQUE_NOM .
			"," . BanqueManager::CHAMP_BANQUE_DESCRIPTION .
			"," . BanqueManager::CHAMP_BANQUE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(BanqueManager::TABLE_BANQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeBanque = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeBanque,
						BanqueManager::remplirBanque(
						$lLigne[BanqueManager::CHAMP_BANQUE_ID],
						$lLigne[BanqueManager::CHAMP_BANQUE_NOM_COURT],
						$lLigne[BanqueManager::CHAMP_BANQUE_NOM],
						$lLigne[BanqueManager::CHAMP_BANQUE_DESCRIPTION],
						$lLigne[BanqueManager::CHAMP_BANQUE_ETAT]));
				}
			} else {
				$lListeBanque[0] = new BanqueVO();
			}

			return $lListeBanque;
		}

		$lListeBanque[0] = new BanqueVO();
		return $lListeBanque;
	}

	/**
	* @name remplirBanque($pId, $pNomCourt, $pNom, $pDescription, $pEtat)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(200)
	* @param text
	* @param tinyint(4)
	* @return BanqueVO
	* @desc Retourne une BanqueVO remplie
	*/
	private static function remplirBanque($pId, $pNomCourt, $pNom, $pDescription, $pEtat) {
		$lBanque = new BanqueVO();
		$lBanque->setId($pId);
		$lBanque->setNomCourt($pNomCourt);
		$lBanque->setNom($pNom);
		$lBanque->setDescription($pDescription);
		$lBanque->setEtat($pEtat);
		return $lBanque;
	}

	/**
	* @name insert($pVo)
	* @param BanqueVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la BanqueVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . BanqueManager::TABLE_BANQUE . "
				(" . BanqueManager::CHAMP_BANQUE_ID . "
				," . BanqueManager::CHAMP_BANQUE_NOM_COURT . "
				," . BanqueManager::CHAMP_BANQUE_NOM . "
				," . BanqueManager::CHAMP_BANQUE_DESCRIPTION . "
				," . BanqueManager::CHAMP_BANQUE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getNomCourt() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getNomCourt() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param BanqueVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du BanqueVO, avec les informations du BanqueVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . BanqueManager::TABLE_BANQUE . "
			 SET
				 " . BanqueManager::CHAMP_BANQUE_NOM_COURT . " = '" . StringUtils::securiser( $pVo->getNomCourt() ) . "'
				," . BanqueManager::CHAMP_BANQUE_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . BanqueManager::CHAMP_BANQUE_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "'
				," . BanqueManager::CHAMP_BANQUE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . BanqueManager::CHAMP_BANQUE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
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

		$lRequete = "DELETE FROM " . BanqueManager::TABLE_BANQUE . "
			WHERE " . BanqueManager::CHAMP_BANQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>