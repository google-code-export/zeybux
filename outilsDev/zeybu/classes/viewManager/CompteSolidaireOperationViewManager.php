<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 02/07/2011
// Fichier : CompteSolidaireOperationViewManager.php
//
// Description : Classe de gestion des CompteSolidaireOperation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CompteSolidaireOperationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

/**
 * @name CompteSolidaireOperationViewManager
 * @author Julien PIERRE
 * @since 02/07/2011
 * 
 * @desc Classe permettant l'accès aux données des CompteSolidaireOperation
 */
class CompteSolidaireOperationViewManager
{
	const VUE_COMPTESOLIDAIREOPERATION = "view_compte_solidaire_operation";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteSolidaireOperationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteSolidaireOperationViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . "
			FROM " . CompteSolidaireOperationViewManager::VUE_COMPTESOLIDAIREOPERATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteSolidaireOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteSolidaireOperation,
					CompteSolidaireOperationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT]));
			}
		} else {
			$lListeCompteSolidaireOperation[0] = new CompteSolidaireOperationViewVO();
		}
		return $lListeCompteSolidaireOperation;
	}

	/**
	* @name selectAll()
	* @return array(CompteSolidaireOperationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteSolidaireOperationViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . "
			FROM " . CompteSolidaireOperationViewManager::VUE_COMPTESOLIDAIREOPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteSolidaireOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteSolidaireOperation,
					CompteSolidaireOperationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT]));
			}
		} else {
			$lListeCompteSolidaireOperation[0] = new CompteSolidaireOperationViewVO();
		}
		return $lListeCompteSolidaireOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteSolidaireOperationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteSolidaireOperationViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationManager::CHAMP_OPERATION_ID .
			"," . OperationManager::CHAMP_OPERATION_DATE .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteSolidaireOperationViewManager::VUE_COMPTESOLIDAIREOPERATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteSolidaireOperation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteSolidaireOperation,
						CompteSolidaireOperationViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID],
						$lLigne[OperationManager::CHAMP_OPERATION_DATE],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT]));
				}
			} else {
				$lListeCompteSolidaireOperation[0] = new CompteSolidaireOperationViewVO();
			}

			return $lListeCompteSolidaireOperation;
		}

		$lListeCompteSolidaireOperation[0] = new CompteSolidaireOperationViewVO();
		return $lListeCompteSolidaireOperation;
	}

	/**
	* @name remplir($pOpeId, $pOpeDate, $pCptLabel, $pOpeMontant, $pOpeTypePaiement)
	* @param int(11)
	* @param datetime
	* @param varchar(30)
	* @param decimal(10,2)
	* @param int(11)
	* @return CompteSolidaireOperationViewVO
	* @desc Retourne une CompteSolidaireOperationViewVO remplie
	*/
	private static function remplir($pOpeId, $pOpeDate, $pCptLabel, $pOpeMontant, $pOpeTypePaiement) {
		$lCompteSolidaireOperation = new CompteSolidaireOperationViewVO();
		$lCompteSolidaireOperation->setOpeId($pOpeId);
		$lCompteSolidaireOperation->setOpeDate($pOpeDate);
		$lCompteSolidaireOperation->setCptLabel($pCptLabel);
		$lCompteSolidaireOperation->setOpeMontant($pOpeMontant);
		$lCompteSolidaireOperation->setOpeTypePaiement($pOpeTypePaiement);
		return $lCompteSolidaireOperation;
	}
}
?>