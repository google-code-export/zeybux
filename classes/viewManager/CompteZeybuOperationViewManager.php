<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/08/2011
// Fichier : CompteZeybuOperationViewManager.php
//
// Description : Classe de gestion des CompteZeybuOperation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CompteZeybuOperationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");

/**
 * @name CompteZeybuOperationViewManager
 * @author Julien PIERRE
 * @since 11/08/2011
 * 
 * @desc Classe permettant l'accès aux données des CompteZeybuOperation
 */
class CompteZeybuOperationViewManager
{
	const VUE_COMPTEZEYBUOPERATION = "view_compte_zeybu_operation";

	/**
	* @name select($pId)
	* @param integer
	* @return CompteZeybuOperationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteZeybuOperationViewVO contenant les informations et la renvoie
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
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . "
			FROM " . CompteZeybuOperationViewManager::VUE_COMPTEZEYBUOPERATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteZeybuOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteZeybuOperation,
					CompteZeybuOperationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE]));
			}
		} else {
			$lListeCompteZeybuOperation[0] = new CompteZeybuOperationViewVO();
		}
		return $lListeCompteZeybuOperation;
	}

	/**
	* @name selectAll()
	* @return array(CompteZeybuOperationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteZeybuOperationViewVO
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
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . "
			FROM " . CompteZeybuOperationViewManager::VUE_COMPTEZEYBUOPERATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteZeybuOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteZeybuOperation,
					CompteZeybuOperationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE]));
			}
		} else {
			$lListeCompteZeybuOperation[0] = new CompteZeybuOperationViewVO();
		}
		return $lListeCompteZeybuOperation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteZeybuOperationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteZeybuOperationViewVO
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
			"," . OperationManager::CHAMP_OPERATION_LIBELLE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteZeybuOperationViewManager::VUE_COMPTEZEYBUOPERATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteZeybuOperation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteZeybuOperation,
						CompteZeybuOperationViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID],
						$lLigne[OperationManager::CHAMP_OPERATION_DATE],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE]));
				}
			} else {
				$lListeCompteZeybuOperation[0] = new CompteZeybuOperationViewVO();
			}

			return $lListeCompteZeybuOperation;
		}

		$lListeCompteZeybuOperation[0] = new CompteZeybuOperationViewVO();
		return $lListeCompteZeybuOperation;
	}

	/**
	* @name remplir($pOpeId, $pOpeDate, $pCptLabel, $pOpeLibelle, $pOpeMontant, $pTppType)
	* @param int(11)
	* @param datetime
	* @param varchar(30)
	* @param varchar(100)
	* @param decimal(10,2)
	* @param varchar(100)
	* @return CompteZeybuOperationViewVO
	* @desc Retourne une CompteZeybuOperationViewVO remplie
	*/
	private static function remplir($pOpeId, $pOpeDate, $pCptLabel, $pOpeLibelle, $pOpeMontant, $pTppType) {
		$lCompteZeybuOperation = new CompteZeybuOperationViewVO();
		$lCompteZeybuOperation->setOpeId($pOpeId);
		$lCompteZeybuOperation->setOpeDate($pOpeDate);
		$lCompteZeybuOperation->setCptLabel($pCptLabel);
		$lCompteZeybuOperation->setOpeLibelle($pOpeLibelle);
		$lCompteZeybuOperation->setOpeMontant($pOpeMontant);
		$lCompteZeybuOperation->setTppType($pTppType);
		return $lCompteZeybuOperation;
	}
}
?>