<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/05/2014
// Fichier : InformationBancaireManager.php
//
// Description : Classe de gestion des InformationBancaire
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "InformationBancaireVO.php");

define("TABLE_INFORMATIONBANCAIRE", MYSQL_DB_PREFIXE ."inb_information_bancaire");
/**
 * @name InformationBancaireManager
 * @author Julien PIERRE
 * @since 11/05/2014
 * 
 * @desc Classe permettant l'accès aux données des InformationBancaire
 */
class InformationBancaireManager
{
	const TABLE_INFORMATIONBANCAIRE = TABLE_INFORMATIONBANCAIRE;
	const CHAMP_INFORMATIONBANCAIRE_ID = "inb_id";
	const CHAMP_INFORMATIONBANCAIRE_ID_COMPTE = "inb_id_compte";
	const CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE = "inb_numero_compte";
	const CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE = "inb_raison_sociale";
	const CHAMP_INFORMATIONBANCAIRE_DATE_CREATION = "inb_date_creation";
	const CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION = "inb_date_modification";
	const CHAMP_INFORMATIONBANCAIRE_ETAT = "inb_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return InformationBancaireVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une InformationBancaireVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT . "
			FROM " . InformationBancaireManager::TABLE_INFORMATIONBANCAIRE . " 
			WHERE " . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return InformationBancaireManager::remplirInformationBancaire(
				$pId,
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE],
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE],
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE],
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION],
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION],
				$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT]);
		} else {
			return new InformationBancaireVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(InformationBancaireVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de InformationBancaireVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION . 
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT . "
			FROM " . InformationBancaireManager::TABLE_INFORMATIONBANCAIRE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeInformationBancaire = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeInformationBancaire,
					InformationBancaireManager::remplirInformationBancaire(
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION],
					$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT]));
			}
		} else {
			$lListeInformationBancaire[0] = new InformationBancaireVO();
		}
		return $lListeInformationBancaire;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(InformationBancaireVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de InformationBancaireVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION .
			"," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(InformationBancaireManager::TABLE_INFORMATIONBANCAIRE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeInformationBancaire = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeInformationBancaire,
						InformationBancaireManager::remplirInformationBancaire(
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION],
						$lLigne[InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT]));
				}
			} else {
				$lListeInformationBancaire[0] = new InformationBancaireVO();
			}

			return $lListeInformationBancaire;
		}

		$lListeInformationBancaire[0] = new InformationBancaireVO();
		return $lListeInformationBancaire;
	}

	/**
	* @name remplirInformationBancaire($pId, $pIdCompte, $pNumeroCompte, $pRaisonSociale, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(100)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return InformationBancaireVO
	* @desc Retourne une InformationBancaireVO remplie
	*/
	private static function remplirInformationBancaire($pId, $pIdCompte, $pNumeroCompte, $pRaisonSociale, $pDateCreation, $pDateModification, $pEtat) {
		$lInformationBancaire = new InformationBancaireVO();
		$lInformationBancaire->setId($pId);
		$lInformationBancaire->setIdCompte($pIdCompte);
		$lInformationBancaire->setNumeroCompte($pNumeroCompte);
		$lInformationBancaire->setRaisonSociale($pRaisonSociale);
		$lInformationBancaire->setDateCreation($pDateCreation);
		$lInformationBancaire->setDateModification($pDateModification);
		$lInformationBancaire->setEtat($pEtat);
		return $lInformationBancaire;
	}

	/**
	* @name insert($pVo)
	* @param InformationBancaireVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la InformationBancaireVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . InformationBancaireManager::TABLE_INFORMATIONBANCAIRE . "
				(" . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_CREATION . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION . "
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT . ")
			VALUES ";

		if(is_array($pVo)) {
			$lNbVO = count($pVo);
			$lI = 1;
			foreach($pVo as $lVo) {
				$lRequete .= "(NULL
				,'" . StringUtils::securiser( $lVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $lVo->getNumeroCompte() ) . "'
				,'" . StringUtils::securiser( $lVo->getRaisonSociale() ) . "'
				, now()
				,'" . StringUtils::securiser( $lVo->getDateModification() ) . "'
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
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getNumeroCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getRaisonSociale() ) . "'
				, now()
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		}

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param InformationBancaireVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du InformationBancaireVO, avec les informations du InformationBancaireVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . InformationBancaireManager::TABLE_INFORMATIONBANCAIRE . "
			 SET
				 " . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_NUMERO_COMPTE . " = '" . StringUtils::securiser( $pVo->getNumeroCompte() ) . "'
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_RAISON_SOCIALE . " = '" . StringUtils::securiser( $pVo->getRaisonSociale() ) . "'
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_DATE_MODIFICATION . " = now()
				," . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . InformationBancaireManager::TABLE_INFORMATIONBANCAIRE . "
			WHERE " . InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>