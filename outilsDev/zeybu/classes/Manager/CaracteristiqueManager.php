<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/11/2011
// Fichier : CaracteristiqueManager.php
//
// Description : Classe de gestion des Caracteristique
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CaracteristiqueVO.php");

/**
 * @name CaracteristiqueManager
 * @author Julien PIERRE
 * @since 01/11/2011
 * 
 * @desc Classe permettant l'accès aux données des Caracteristique
 */
class CaracteristiqueManager
{
	const TABLE_CARACTERISTIQUE = "car_caracteristique";
	const CHAMP_CARACTERISTIQUE_ID = "car_id";
	const CHAMP_CARACTERISTIQUE_NOM = "car_nom";
	const CHAMP_CARACTERISTIQUE_DESCRIPTION = "car_description";
	const CHAMP_CARACTERISTIQUE_ETAT = "car_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return CaracteristiqueVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CaracteristiqueVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT . "
			FROM " . CaracteristiqueManager::TABLE_CARACTERISTIQUE . " 
			WHERE " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return CaracteristiqueManager::remplirCaracteristique(
				$pId,
				$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
				$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
				$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT]);
		} else {
			return new CaracteristiqueVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(CaracteristiqueVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CaracteristiqueVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . 
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT . "
			FROM " . CaracteristiqueManager::TABLE_CARACTERISTIQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCaracteristique = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCaracteristique,
					CaracteristiqueManager::remplirCaracteristique(
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
					$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT]));
			}
		} else {
			$lListeCaracteristique[0] = new CaracteristiqueVO();
		}
		return $lListeCaracteristique;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CaracteristiqueVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CaracteristiqueVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION .
			"," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CaracteristiqueManager::TABLE_CARACTERISTIQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCaracteristique = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCaracteristique,
						CaracteristiqueManager::remplirCaracteristique(
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION],
						$lLigne[CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT]));
				}
			} else {
				$lListeCaracteristique[0] = new CaracteristiqueVO();
			}

			return $lListeCaracteristique;
		}

		$lListeCaracteristique[0] = new CaracteristiqueVO();
		return $lListeCaracteristique;
	}

	/**
	* @name remplirCaracteristique($pId, $pNom, $pDescription, $pEtat)
	* @param int(11)
	* @param varchar(50)
	* @param text
	* @param tinyint(1)
	* @return CaracteristiqueVO
	* @desc Retourne une CaracteristiqueVO remplie
	*/
	private static function remplirCaracteristique($pId, $pNom, $pDescription, $pEtat) {
		$lCaracteristique = new CaracteristiqueVO();
		$lCaracteristique->setId($pId);
		$lCaracteristique->setNom($pNom);
		$lCaracteristique->setDescription($pDescription);
		$lCaracteristique->setEtat($pEtat);
		return $lCaracteristique;
	}

	/**
	* @name insert($pVo)
	* @param CaracteristiqueVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la CaracteristiqueVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . CaracteristiqueManager::TABLE_CARACTERISTIQUE . "
				(" . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . "
				," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . "
				," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . "
				," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param CaracteristiqueVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du CaracteristiqueVO, avec les informations du CaracteristiqueVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . CaracteristiqueManager::TABLE_CARACTERISTIQUE . "
			 SET
				 " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "'
				," . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . CaracteristiqueManager::TABLE_CARACTERISTIQUE . "
			WHERE " . CaracteristiqueManager::CHAMP_CARACTERISTIQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>