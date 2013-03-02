<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 23/10/2011
// Fichier : FermeManager.php
//
// Description : Classe de gestion des Ferme
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "FermeVO.php");

/**
 * @name FermeManager
 * @author Julien PIERRE
 * @since 23/10/2011
 * 
 * @desc Classe permettant l'accès aux données des Ferme
 */
class FermeManager
{
	const TABLE_FERME = "fer_ferme";
	const CHAMP_FERME_ID = "fer_id";
	const CHAMP_FERME_NUMERO = "fer_numero";
	const CHAMP_FERME_NOM = "fer_nom";
	const CHAMP_FERME_ID_COMPTE = "fer_id_compte";
	const CHAMP_FERME_SIREN = "fer_siren";
	const CHAMP_FERME_ADRESSE = "fer_adresse";
	const CHAMP_FERME_CODE_POSTAL = "fer_code_postal";
	const CHAMP_FERME_VILLE = "fer_ville";
	const CHAMP_FERME_DATE_ADHESION = "fer_date_adhesion";
	const CHAMP_FERME_DESCRIPTION = "fer_description";
	const CHAMP_FERME_ETAT = "fer_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return FermeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une FermeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . 
			"," . FermeManager::CHAMP_FERME_SIREN . 
			"," . FermeManager::CHAMP_FERME_ADRESSE . 
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL . 
			"," . FermeManager::CHAMP_FERME_VILLE . 
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION . 
			"," . FermeManager::CHAMP_FERME_DESCRIPTION . 
			"," . FermeManager::CHAMP_FERME_ETAT . "
			FROM " . FermeManager::TABLE_FERME . " 
			WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return FermeManager::remplirFerme(
				$pId,
				$lLigne[FermeManager::CHAMP_FERME_NUMERO],
				$lLigne[FermeManager::CHAMP_FERME_NOM],
				$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
				$lLigne[FermeManager::CHAMP_FERME_SIREN],
				$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
				$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
				$lLigne[FermeManager::CHAMP_FERME_VILLE],
				$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
				$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
				$lLigne[FermeManager::CHAMP_FERME_ETAT]);
		} else {
			return new FermeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(FermeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de FermeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_NUMERO . 
			"," . FermeManager::CHAMP_FERME_NOM . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . 
			"," . FermeManager::CHAMP_FERME_SIREN . 
			"," . FermeManager::CHAMP_FERME_ADRESSE . 
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL . 
			"," . FermeManager::CHAMP_FERME_VILLE . 
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION . 
			"," . FermeManager::CHAMP_FERME_DESCRIPTION . 
			"," . FermeManager::CHAMP_FERME_ETAT . "
			FROM " . FermeManager::TABLE_FERME;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeFerme = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeFerme,
					FermeManager::remplirFerme(
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_NUMERO],
					$lLigne[FermeManager::CHAMP_FERME_NOM],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
					$lLigne[FermeManager::CHAMP_FERME_SIREN],
					$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
					$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
					$lLigne[FermeManager::CHAMP_FERME_VILLE],
					$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
					$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
					$lLigne[FermeManager::CHAMP_FERME_ETAT]));
			}
		} else {
			$lListeFerme[0] = new FermeVO();
		}
		return $lListeFerme;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(FermeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de FermeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    FermeManager::CHAMP_FERME_ID .
			"," . FermeManager::CHAMP_FERME_NUMERO .
			"," . FermeManager::CHAMP_FERME_NOM .
			"," . FermeManager::CHAMP_FERME_ID_COMPTE .
			"," . FermeManager::CHAMP_FERME_SIREN .
			"," . FermeManager::CHAMP_FERME_ADRESSE .
			"," . FermeManager::CHAMP_FERME_CODE_POSTAL .
			"," . FermeManager::CHAMP_FERME_VILLE .
			"," . FermeManager::CHAMP_FERME_DATE_ADHESION .
			"," . FermeManager::CHAMP_FERME_DESCRIPTION .
			"," . FermeManager::CHAMP_FERME_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(FermeManager::TABLE_FERME, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeFerme = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeFerme,
						FermeManager::remplirFerme(
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_NUMERO],
						$lLigne[FermeManager::CHAMP_FERME_NOM],
						$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
						$lLigne[FermeManager::CHAMP_FERME_SIREN],
						$lLigne[FermeManager::CHAMP_FERME_ADRESSE],
						$lLigne[FermeManager::CHAMP_FERME_CODE_POSTAL],
						$lLigne[FermeManager::CHAMP_FERME_VILLE],
						$lLigne[FermeManager::CHAMP_FERME_DATE_ADHESION],
						$lLigne[FermeManager::CHAMP_FERME_DESCRIPTION],
						$lLigne[FermeManager::CHAMP_FERME_ETAT]));
				}
			} else {
				$lListeFerme[0] = new FermeVO();
			}

			return $lListeFerme;
		}

		$lListeFerme[0] = new FermeVO();
		return $lListeFerme;
	}

	/**
	* @name remplirFerme($pId, $pNumero, $pNom, $pIdCompte, $pSiren, $pAdresse, $pCodePostal, $pVille, $pDateAdhesion, $pDescription, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param text
	* @param int(11)
	* @param int(9)
	* @param varchar(300)
	* @param varchar(10)
	* @param varchar(100)
	* @param date
	* @param text
	* @param tinyint(1)
	* @return FermeVO
	* @desc Retourne une FermeVO remplie
	*/
	private static function remplirFerme($pId, $pNumero, $pNom, $pIdCompte, $pSiren, $pAdresse, $pCodePostal, $pVille, $pDateAdhesion, $pDescription, $pEtat) {
		$lFerme = new FermeVO();
		$lFerme->setId($pId);
		$lFerme->setNumero($pNumero);
		$lFerme->setNom($pNom);
		$lFerme->setIdCompte($pIdCompte);
		$lFerme->setSiren($pSiren);
		$lFerme->setAdresse($pAdresse);
		$lFerme->setCodePostal($pCodePostal);
		$lFerme->setVille($pVille);
		$lFerme->setDateAdhesion($pDateAdhesion);
		$lFerme->setDescription($pDescription);
		$lFerme->setEtat($pEtat);
		return $lFerme;
	}

	/**
	* @name insert($pVo)
	* @param FermeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la FermeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . FermeManager::TABLE_FERME . "
				(" . FermeManager::CHAMP_FERME_ID . "
				," . FermeManager::CHAMP_FERME_NUMERO . "
				," . FermeManager::CHAMP_FERME_NOM . "
				," . FermeManager::CHAMP_FERME_ID_COMPTE . "
				," . FermeManager::CHAMP_FERME_SIREN . "
				," . FermeManager::CHAMP_FERME_ADRESSE . "
				," . FermeManager::CHAMP_FERME_CODE_POSTAL . "
				," . FermeManager::CHAMP_FERME_VILLE . "
				," . FermeManager::CHAMP_FERME_DATE_ADHESION . "
				," . FermeManager::CHAMP_FERME_DESCRIPTION . "
				," . FermeManager::CHAMP_FERME_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNumero() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getSiren() ) . "'
				,'" . StringUtils::securiser( $pVo->getAdresse() ) . "'
				,'" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
				,'" . StringUtils::securiser( $pVo->getVille() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateAdhesion() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param FermeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du FermeVO, avec les informations du FermeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . FermeManager::TABLE_FERME . "
			 SET
				 " . FermeManager::CHAMP_FERME_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . FermeManager::CHAMP_FERME_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . FermeManager::CHAMP_FERME_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . FermeManager::CHAMP_FERME_SIREN . " = '" . StringUtils::securiser( $pVo->getSiren() ) . "'
				," . FermeManager::CHAMP_FERME_ADRESSE . " = '" . StringUtils::securiser( $pVo->getAdresse() ) . "'
				," . FermeManager::CHAMP_FERME_CODE_POSTAL . " = '" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
				," . FermeManager::CHAMP_FERME_VILLE . " = '" . StringUtils::securiser( $pVo->getVille() ) . "'
				," . FermeManager::CHAMP_FERME_DATE_ADHESION . " = '" . StringUtils::securiser( $pVo->getDateAdhesion() ) . "'
				," . FermeManager::CHAMP_FERME_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "'
				," . FermeManager::CHAMP_FERME_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . FermeManager::TABLE_FERME . "
			WHERE " . FermeManager::CHAMP_FERME_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>