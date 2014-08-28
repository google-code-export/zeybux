<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 04/05/2014
// Fichier : RemiseChequeManager.php
//
// Description : Classe de gestion des RemiseCheque
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "RemiseChequeVO.php");

define("TABLE_REMISECHEQUE", MYSQL_DB_PREFIXE ."rec_remise_cheque");
/**
 * @name RemiseChequeManager
 * @author Julien PIERRE
 * @since 04/05/2014
 * 
 * @desc Classe permettant l'accès aux données des RemiseCheque
 */
class RemiseChequeManager
{
	const TABLE_REMISECHEQUE = TABLE_REMISECHEQUE;
	const CHAMP_REMISECHEQUE_ID = "rec_id";
	const CHAMP_REMISECHEQUE_NUMERO = "rec_numero";
	const CHAMP_REMISECHEQUE_ID_COMPTE = "rec_id_compte";
	const CHAMP_REMISECHEQUE_MONTANT = "rec_montant";
	const CHAMP_REMISECHEQUE_DATE_CREATION = "rec_date_creation";
	const CHAMP_REMISECHEQUE_DATE_MODIFICATION = "rec_date_modification";
	const CHAMP_REMISECHEQUE_ETAT = "rec_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return RemiseChequeVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une RemiseChequeVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT . "
			FROM " . RemiseChequeManager::TABLE_REMISECHEQUE . " 
			WHERE " . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return RemiseChequeManager::remplirRemiseCheque(
				$pId,
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO],
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE],
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT],
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION],
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION],
				$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT]);
		} else {
			return new RemiseChequeVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(RemiseChequeVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de RemiseChequeVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION . 
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT . "
			FROM " . RemiseChequeManager::TABLE_REMISECHEQUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeRemiseCheque = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeRemiseCheque,
					RemiseChequeManager::remplirRemiseCheque(
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ID],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION],
					$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT]));
			}
		} else {
			$lListeRemiseCheque[0] = new RemiseChequeVO();
		}
		return $lListeRemiseCheque;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(RemiseChequeVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de RemiseChequeVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    RemiseChequeManager::CHAMP_REMISECHEQUE_ID .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION .
			"," . RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(RemiseChequeManager::TABLE_REMISECHEQUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeRemiseCheque = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeRemiseCheque,
						RemiseChequeManager::remplirRemiseCheque(
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ID],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION],
						$lLigne[RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT]));
				}
			} else {
				$lListeRemiseCheque[0] = new RemiseChequeVO();
			}

			return $lListeRemiseCheque;
		}

		$lListeRemiseCheque[0] = new RemiseChequeVO();
		return $lListeRemiseCheque;
	}

	/**
	* @name remplirRemiseCheque($pId, $pNumero, $pIdCompte, $pMontant, $pDateCreation, $pDateModification, $pEtat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param decimal(10,0)
	* @param datetime
	* @param datetime
	* @param tinyint(1)
	* @return RemiseChequeVO
	* @desc Retourne une RemiseChequeVO remplie
	*/
	private static function remplirRemiseCheque($pId, $pNumero, $pIdCompte, $pMontant, $pDateCreation, $pDateModification, $pEtat) {
		$lRemiseCheque = new RemiseChequeVO();
		$lRemiseCheque->setId($pId);
		$lRemiseCheque->setNumero($pNumero);
		$lRemiseCheque->setIdCompte($pIdCompte);
		$lRemiseCheque->setMontant($pMontant);
		$lRemiseCheque->setDateCreation($pDateCreation);
		$lRemiseCheque->setDateModification($pDateModification);
		$lRemiseCheque->setEtat($pEtat);
		return $lRemiseCheque;
	}

	/**
	* @name insert($pVo)
	* @param RemiseChequeVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la RemiseChequeVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . RemiseChequeManager::TABLE_REMISECHEQUE . "
				(" . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_CREATION . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION . "
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNumero() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getMontant() ) . "'
				, now()
				,'" . StringUtils::securiser( $pVo->getDateModification() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "');";
		
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param RemiseChequeVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du RemiseChequeVO, avec les informations du RemiseChequeVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . RemiseChequeManager::TABLE_REMISECHEQUE . "
			 SET
				 " . RemiseChequeManager::CHAMP_REMISECHEQUE_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_MONTANT . " = '" . StringUtils::securiser( $pVo->getMontant() ) . "'
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_DATE_MODIFICATION . " = now()
				," . RemiseChequeManager::CHAMP_REMISECHEQUE_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . RemiseChequeManager::TABLE_REMISECHEQUE . "
			WHERE " . RemiseChequeManager::CHAMP_REMISECHEQUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequete($lRequete);
	}
}
?>