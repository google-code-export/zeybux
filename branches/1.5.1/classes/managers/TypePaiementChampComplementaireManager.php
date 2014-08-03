<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 27/08/2013
// Fichier : TypePaiementChampComplementaireManager.php
//
// Description : Classe de gestion des TypePaiementChampComplementaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "TypePaiementChampComplementaireVO.php");

define("TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE", MYSQL_DB_PREFIXE ."tppcp_type_paiement_champ_complementaire");
/**
 * @name TypePaiementChampComplementaireManager
 * @author Julien PIERRE
 * @since 27/08/2013
 * 
 * @desc Classe permettant l'accès aux données des TypePaiementChampComplementaire
 */
class TypePaiementChampComplementaireManager
{
	const TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE = TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE;
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID = "tppcp_tpp_id";
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID = "tppcp_chcp_id";
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE = "tppcp_maj_autorise";
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE = "tppcp_ordre";
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE = "tppcp_visible";
	const CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT = "tppcp_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return TypePaiementChampComplementaireVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une TypePaiementChampComplementaireVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT . "
			FROM " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . " 
			WHERE " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return TypePaiementChampComplementaireManager::remplirTypePaiementChampComplementaire(
				$pId,
				$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID],
				$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE],
				$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE],
				$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE],
				$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT]);
		} else {
			return new TypePaiementChampComplementaireVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(TypePaiementChampComplementaireVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de TypePaiementChampComplementaireVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE . 
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT . "
			FROM " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeTypePaiementChampComplementaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeTypePaiementChampComplementaire,
					TypePaiementChampComplementaireManager::remplirTypePaiementChampComplementaire(
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID],
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID],
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE],
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE],
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE],
					$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT]));
			}
		} else {
			$lListeTypePaiementChampComplementaire[0] = new TypePaiementChampComplementaireVO();
		}
		return $lListeTypePaiementChampComplementaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(TypePaiementChampComplementaireVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de TypePaiementChampComplementaireVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID .
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID .
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE .
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE .
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE .
			"," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeTypePaiementChampComplementaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeTypePaiementChampComplementaire,
						TypePaiementChampComplementaireManager::remplirTypePaiementChampComplementaire(
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID],
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID],
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE],
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE],
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE],
						$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT]));
				}
			} else {
				$lListeTypePaiementChampComplementaire[0] = new TypePaiementChampComplementaireVO();
			}

			return $lListeTypePaiementChampComplementaire;
		}

		$lListeTypePaiementChampComplementaire[0] = new TypePaiementChampComplementaireVO();
		return $lListeTypePaiementChampComplementaire;
	}

	/**
	* @name remplirTypePaiementChampComplementaire($pTppId, $pChcpId, $pMajAutorise, $pOrdre, $pVisible, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param tinyint(1)
	* @param int(11)
	* @param tinyint(1)
	* @param tinyint(1)
	* @return TypePaiementChampComplementaireVO
	* @desc Retourne une TypePaiementChampComplementaireVO remplie
	*/
	private static function remplirTypePaiementChampComplementaire($pTppId, $pChcpId, $pMajAutorise, $pOrdre, $pVisible, $pEtat) {
		$lTypePaiementChampComplementaire = new TypePaiementChampComplementaireVO();
		$lTypePaiementChampComplementaire->setTppId($pTppId);
		$lTypePaiementChampComplementaire->setChcpId($pChcpId);
		$lTypePaiementChampComplementaire->setMajAutorise($pMajAutorise);
		$lTypePaiementChampComplementaire->setOrdre($pOrdre);
		$lTypePaiementChampComplementaire->setVisible($pVisible);
		$lTypePaiementChampComplementaire->setEtat($pEtat);
		return $lTypePaiementChampComplementaire;
	}
	
	/**
	* @name champAutoriseMaj($pIdTypePaiement)
	* @param integer
	* @return array(int)
	* @desc Recherche la liste des champ qui sont autorisé en maj pour le type de paiement
	*/
	public static function champAutoriseMaj($pIdTypePaiement) {		
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		$lRequete =
			"SELECT "
				. TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . "
			FROM " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . "
			WHERE " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . " = '" . StringUtils::securiser($pIdTypePaiement) . "'
				AND " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . " = 1
				AND " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT . " = 0;";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeChamp = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ( $lLigne = mysql_fetch_assoc($lSql) ) {
				array_push($lListeChamp,$lLigne[TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID]);
			}
		}
		return $lListeChamp;
	}

	/**
	* @name insert($pVo)
	* @param TypePaiementChampComplementaireVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la TypePaiementChampComplementaireVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . "
				(" . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . "
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . "
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . "
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE . "
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE . "
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getChcpId() ) . "'
				,'" . StringUtils::securiser( $lVo->getMajAutorise() ) . "'
				,'" . StringUtils::securiser( $lVo->getOrdre() ) . "'
				,'" . StringUtils::securiser( $lVo->getVisible() ) . "'
				,'" . StringUtils::securiser( $lVo->getEtat() ) . "')";

				if($lNbVO == $lI) {
					$lRequete .= ";";
				} else {
					$lRequete .= ",";
				}
				$lI++;
			}
		} else{
			$lRequete .= "(NULL
				,'" . StringUtils::securiser( $pVo->getChcpId() ) . "'
				,'" . StringUtils::securiser( $pVo->getMajAutorise() ) . "'
				,'" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				,'" . StringUtils::securiser( $pVo->getVisible() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param TypePaiementChampComplementaireVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du TypePaiementChampComplementaireVO, avec les informations du TypePaiementChampComplementaireVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . "
			 SET
				 " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_CHCP_ID . " = '" . StringUtils::securiser( $pVo->getChcpId() ) . "'
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_MAJ_AUTORISE . " = '" . StringUtils::securiser( $pVo->getMajAutorise() ) . "'
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ORDRE . " = '" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_VISIBLE . " = '" . StringUtils::securiser( $pVo->getVisible() ) . "'
				," . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . " = '" . StringUtils::securiser( $pVo->getTppId() ) . "'";

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

		$lRequete = "DELETE FROM " . TypePaiementChampComplementaireManager::TABLE_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE . "
			WHERE " . TypePaiementChampComplementaireManager::CHAMP_TYPEPAIEMENTCHAMPCOMPLEMENTAIRE_TPP_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>