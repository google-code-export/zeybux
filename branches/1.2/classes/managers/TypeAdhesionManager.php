<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : TypeAdhesionManager.php
//
// Description : Classe de gestion des TypeAdhesion
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "TypeAdhesionVO.php");

define("TABLE_TYPEADHESION", MYSQL_DB_PREFIXE ."tpa_type_adhesion");
/**
 * @name TypeAdhesionManager
 * @author Julien PIERRE
 * @since 22/07/2012
 * 
 * @desc Classe permettant l'accès aux données des TypeAdhesion
 */
class TypeAdhesionManager
{
	const TABLE_TYPEADHESION = TABLE_TYPEADHESION;
	const CHAMP_TYPEADHESION_ID = "tpa_id";
	const CHAMP_TYPEADHESION_ID_ADHESION = "tpa_id_adhesion";
	const CHAMP_TYPEADHESION_LABEL = "tpa_label";
	const CHAMP_TYPEADHESION_PERIMETRE = "tpa_perimetre";
	const CHAMP_TYPEADHESION_MONTANT = "tpa_montant";
	const CHAMP_TYPEADHESION_ETAT = "tpa_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return TypeAdhesionVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une TypeAdhesionVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . "
			FROM " . TypeAdhesionManager::TABLE_TYPEADHESION . " 
			WHERE " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return TypeAdhesionManager::remplirTypeAdhesion(
				$pId,
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT],
				$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT]);
		} else {
			return new TypeAdhesionVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(TypeAdhesionVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de TypeAdhesionVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT . 
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . "
			FROM " . TypeAdhesionManager::TABLE_TYPEADHESION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypeAdhesion = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeTypeAdhesion,
					TypeAdhesionManager::remplirTypeAdhesion(
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID],
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION],
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL],
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE],
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT],
					$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT]));
			}
		} else {
			$lListeTypeAdhesion[0] = new TypeAdhesionVO();
		}
		return $lListeTypeAdhesion;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(TypeAdhesionVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de TypeAdhesionVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    TypeAdhesionManager::CHAMP_TYPEADHESION_ID .
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION .
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL .
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE .
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT .
			"," . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(TypeAdhesionManager::TABLE_TYPEADHESION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeTypeAdhesion = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeTypeAdhesion,
						TypeAdhesionManager::remplirTypeAdhesion(
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID],
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION],
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL],
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE],
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT],
						$lLigne[TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT]));
				}
			} else {
				$lListeTypeAdhesion[0] = new TypeAdhesionVO();
			}

			return $lListeTypeAdhesion;
		}

		$lListeTypeAdhesion[0] = new TypeAdhesionVO();
		return $lListeTypeAdhesion;
	}

	/**
	* @name remplirTypeAdhesion($pId, $pIdAdhesion, $pLabel, $pPerimetre, $pMontant, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param varchar(45)
	* @param tinyint(1)
	* @param decimal(10,2)
	* @param tinyint(1)
	* @return TypeAdhesionVO
	* @desc Retourne une TypeAdhesionVO remplie
	*/
	private static function remplirTypeAdhesion($pId, $pIdAdhesion, $pLabel, $pPerimetre, $pMontant, $pEtat) {
		$lTypeAdhesion = new TypeAdhesionVO();
		$lTypeAdhesion->setId($pId);
		$lTypeAdhesion->setIdAdhesion($pIdAdhesion);
		$lTypeAdhesion->setLabel($pLabel);
		$lTypeAdhesion->setPerimetre($pPerimetre);
		$lTypeAdhesion->setMontant($pMontant);
		$lTypeAdhesion->setEtat($pEtat);
		return $lTypeAdhesion;
	}

	/**
	* @name insert($pVo)
	* @param TypeAdhesionVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la TypeAdhesionVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . TypeAdhesionManager::TABLE_TYPEADHESION . "
				(" . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . "
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . "
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL . "
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE . "
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT . "
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getIdAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getPerimetre() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getPerimetre() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param TypeAdhesionVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du TypeAdhesionVO, avec les informations du TypeAdhesionVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . TypeAdhesionManager::TABLE_TYPEADHESION . "
			 SET
				 " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID_ADHESION . " = '" . StringUtils::securiser( $pVo->getIdAdhesion() ) . "'
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_PERIMETRE . " = '" . StringUtils::securiser( $pVo->getPerimetre() ) . "'
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . TypeAdhesionManager::CHAMP_TYPEADHESION_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . TypeAdhesionManager::TABLE_TYPEADHESION . "
			WHERE " . TypeAdhesionManager::CHAMP_TYPEADHESION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>