<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : AdhesionAdherentManager.php
//
// Description : Classe de gestion des AdhesionAdherent
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "AdhesionAdherentVO.php");

define("TABLE_ADHESIONADHERENT", MYSQL_DB_PREFIXE ."adad_adhesion_adherent");
/**
 * @name AdhesionAdherentManager
 * @author Julien PIERRE
 * @since 22/07/2012
 * 
 * @desc Classe permettant l'accès aux données des AdhesionAdherent
 */
class AdhesionAdherentManager
{
	const TABLE_ADHESIONADHERENT = TABLE_ADHESIONADHERENT;
	const CHAMP_ADHESIONADHERENT_ID = "adad_id";
	const CHAMP_ADHESIONADHERENT_ID_ADHERENT = "adad_id_adherent";
	const CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION = "adad_id_type_adhesion";
	const CHAMP_ADHESIONADHERENT_ID_OPERATION = "adad_id_operation";
	const CHAMP_ADHESIONADHERENT_ETAT = "adad_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return AdhesionAdherentVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une AdhesionAdherentVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . "
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . " 
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return AdhesionAdherentManager::remplirAdhesionAdherent(
				$pId,
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
				$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]);
		} else {
			return new AdhesionAdherentVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(AdhesionAdherentVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de AdhesionAdherentVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . 
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . "
			FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeAdhesionAdherent = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeAdhesionAdherent,
					AdhesionAdherentManager::remplirAdhesionAdherent(
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
					$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]));
			}
		} else {
			$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
		}
		return $lListeAdhesionAdherent;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(AdhesionAdherentVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de AdhesionAdherentVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION .
			"," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(AdhesionAdherentManager::TABLE_ADHESIONADHERENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeAdhesionAdherent = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeAdhesionAdherent,
						AdhesionAdherentManager::remplirAdhesionAdherent(
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION],
						$lLigne[AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT]));
				}
			} else {
				$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
			}

			return $lListeAdhesionAdherent;
		}

		$lListeAdhesionAdherent[0] = new AdhesionAdherentVO();
		return $lListeAdhesionAdherent;
	}

	/**
	* @name remplirAdhesionAdherent($pId, $pIdAdherent, $pIdTypeAdhesion, $pIdOperation, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @return AdhesionAdherentVO
	* @desc Retourne une AdhesionAdherentVO remplie
	*/
	private static function remplirAdhesionAdherent($pId, $pIdAdherent, $pIdTypeAdhesion, $pIdOperation, $pEtat) {
		$lAdhesionAdherent = new AdhesionAdherentVO();
		$lAdhesionAdherent->setId($pId);
		$lAdhesionAdherent->setIdAdherent($pIdAdherent);
		$lAdhesionAdherent->setIdTypeAdhesion($pIdTypeAdhesion);
		$lAdhesionAdherent->setIdOperation($pIdOperation);
		$lAdhesionAdherent->setEtat($pEtat);
		return $lAdhesionAdherent;
	}

	/**
	* @name insert($pVo)
	* @param AdhesionAdherentVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la AdhesionAdherentVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
				(" . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . "
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param AdhesionAdherentVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du AdhesionAdherentVO, avec les informations du AdhesionAdherentVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			 SET
				 " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_ADHERENT . " = '" . StringUtils::securiser( $pVo->getIdAdherent() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_TYPE_ADHESION . " = '" . StringUtils::securiser( $pVo->getIdTypeAdhesion() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID_OPERATION . " = '" . StringUtils::securiser( $pVo->getIdOperation() ) . "'
				," . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . AdhesionAdherentManager::TABLE_ADHESIONADHERENT . "
			WHERE " . AdhesionAdherentManager::CHAMP_ADHESIONADHERENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>