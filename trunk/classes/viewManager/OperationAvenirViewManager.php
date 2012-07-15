<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationAvenirViewManager.php
//
// Description : Classe de gestion des OperationAvenir
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationAvenirViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

define("VUE_OPERATIONAVENIR", MYSQL_DB_PREFIXE . "view_operation_avenir");
/**
 * @name OperationAvenirViewManager
 * @author Julien PIERRE
 * @since 08/09/2010
 * 
 * @desc Classe permettant l'accès aux données des OperationAvenir
 */
class OperationAvenirViewManager
{
	const VUE_OPERATIONAVENIR = VUE_OPERATIONAVENIR;

	/**
	* @name select($pId)
	* @param integer
	* @return OperationAvenirViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationAvenirViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . OperationAvenirViewManager::VUE_OPERATIONAVENIR . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAvenir = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAvenir,
					OperationAvenirViewManager::remplir(
					$pId,
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeOperationAvenir[0] = new OperationAvenirViewVO();
		}
		return $lListeOperationAvenir;
	}

	/**
	* @name selectAll()
	* @return array(OperationAvenirViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationAvenirViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . OperationAvenirViewManager::VUE_OPERATIONAVENIR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationAvenir = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationAvenir,
					OperationAvenirViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeOperationAvenir[0] = new OperationAvenirViewVO();
		}
		return $lListeOperationAvenir;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationAvenirViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationAvenirViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationManager::CHAMP_OPERATION_ID_COMPTE .
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_LIBELLE .
			"," . OperationManager::CHAMP_OPERATION_DATE .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT 		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationAvenirViewManager::VUE_OPERATIONAVENIR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationAvenir = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeOperationAvenir,
						OperationAvenirViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
						$lLigne[OperationManager::CHAMP_OPERATION_DATE],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
				}
			} else {
				$lListeOperationAvenir[0] = new OperationAvenirViewVO();
			}
	
			return $lListeOperationAvenir;
		}

		$lListeOperationAvenir[0] = new OperationAvenirViewVO();
		return $lListeOperationAvenir;
	}

	/**
	* @name remplir($pOpeIdCompte, $pOpeMontant, $pOpeLibelle, $pOpeDate, $pComDateMarche)
	* @param int(11)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param datetime
	* @return OperationAvenirViewVO
	* @desc Retourne une OperationAvenirViewVO remplie
	*/
	private static function remplir($pOpeIdCompte, $pOpeMontant, $pOpeLibelle, $pOpeDate, $pComDateMarche) {
		$lOperationAvenir = new OperationAvenirViewVO();
		$lOperationAvenir->setOpeIdCompte($pOpeIdCompte);
		$lOperationAvenir->setOpeMontant($pOpeMontant);
		$lOperationAvenir->setOpeLibelle($pOpeLibelle);
		$lOperationAvenir->setOpeDate($pOpeDate);		
		$lOperationAvenir->setComDateMarche($pComDateMarche);
		return $lOperationAvenir;
	}
}
?>