<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/09/2010
// Fichier : TypePaiementManager.php
//
// Description : Classe de gestion des TypePaiement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "TypePaiementVO.php");

/**
 * @name TypePaiementManager
 * @author Julien PIERRE
 * @since 02/09/2010
 * 
 * @desc Classe permettant l'accès aux données des TypePaiement
 */
class TypePaiementManager
{
	const TABLE_TYPE_PAIEMENT = "tpp_TypePaiement";
	const CHAMP_TYPE_PAIEMENT_ID = "tpp_id";
	const CHAMP_TYPE_PAIEMENT_TYPE = "tpp_type";
	const CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE = "tpp_champ_complementaire";
	const CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE = "tpp_label_champ_complementaire";

	/**
	* @name select($pId)
	* @param integer
	* @return TypePaiementVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une TypePaiementVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . "
			FROM " . TypePaiementManager::TABLE_TYPE_PAIEMENT . " 
			WHERE " . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return TypePaiementManager::remplirTypePaiement(
				$pId,
				$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE],
				$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
				$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE]);
		} else {
			return new TypePaiementVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(TypePaiementVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de TypePaiementVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . "
			FROM " . TypePaiementManager::TABLE_TYPE_PAIEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypePaiement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeTypePaiement,
					TypePaiementManager::remplirTypePaiement(
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE]));
			}
		} else {
			$lListeTypePaiement[0] = new TypePaiementVO();
		}
		return $lListeTypePaiement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(TypePaiementVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de TypePaiementVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID .
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE .
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .
			"," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE		);

		$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));

		$lTypeFiltre = array($pTypeCritere);
		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(TypePaiementManager::TABLE_TYPE_PAIEMENT, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypePaiement = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeTypePaiement,
					TypePaiementManager::remplirTypePaiement(
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE]));
			}
		} else {
			$lListeTypePaiement[0] = new TypePaiementVO();
		}

		return $lListeTypePaiement;
	}

	/**
	* @name remplirTypePaiement($pId, $pType, $pChampComplementaire, $pLabelChampComplementaire)
	* @param int(11)
	* @param varchar(100)
	* @param tinyint(4)
	* @param varchar(30)
	* @return TypePaiementVO
	* @desc Retourne une TypePaiementVO remplie
	*/
	private static function remplirTypePaiement($pId, $pType, $pChampComplementaire, $pLabelChampComplementaire) {
		$lTypePaiement = new TypePaiementVO();
		$lTypePaiement->setId($pId);
		$lTypePaiement->setType($pType);
		$lTypePaiement->setChampComplementaire($pChampComplementaire);
		$lTypePaiement->setLabelChampComplementaire($pLabelChampComplementaire);
		return $lTypePaiement;
	}

	/**
	* @name insert($pVo)
	* @param TypePaiementVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la TypePaiementVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . TypePaiementManager::TABLE_TYPE_PAIEMENT . "
				(" . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . "
				," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE . "
				," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . "
				," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getType() ) . "'
				,'" . StringUtils::securiser( $pVo->getChampComplementaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabelChampComplementaire() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param TypePaiementVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du TypePaiementVO, avec les informations du TypePaiementVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . TypePaiementManager::TABLE_TYPE_PAIEMENT . "
			 SET
				 " . TypePaiementManager::CHAMP_TYPE_PAIEMENT_TYPE . " = '" . StringUtils::securiser( $pVo->getType() ) . "'
				," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . " = '" . StringUtils::securiser( $pVo->getChampComplementaire() ) . "'
				," . TypePaiementManager::CHAMP_TYPE_PAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . " = '" . StringUtils::securiser( $pVo->getLabelChampComplementaire() ) . "'
			 WHERE " . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . TypePaiementManager::TABLE_TYPE_PAIEMENT . "
			WHERE " . TypePaiementManager::CHAMP_TYPE_PAIEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>