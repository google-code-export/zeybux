<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/09/2010
// Fichier : OperationPasseeViewManager.php
//
// Description : Classe de gestion des OperationPassee
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "OperationPasseeViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");

define("VUE_OPERATIONPASSEE", MYSQL_DB_PREFIXE . "view_operation_passee");
/**
 * @name OperationPasseeViewManager
 * @author Julien PIERRE
 * @since 08/09/2010
 * 
 * @desc Classe permettant l'accès aux données des OperationPassee
 */
class OperationPasseeViewManager
{
	const VUE_OPERATIONPASSEE = VUE_OPERATIONPASSEE;

	/**
	* @name select($pId)
	* @param integer
	* @return OperationPasseeViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une OperationPasseeViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . "
			FROM " . OperationPasseeViewManager::VUE_OPERATIONPASSEE . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeOperationPassee = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationPassee,
					OperationPasseeViewManager::remplir(
					$pId,
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID]));
			}
		} else {
			$lListeOperationPassee[0] = new OperationPasseeViewVO();
		}
		return $lListeOperationPassee;
	}

	/**
	* @name selectAll()
	* @return array(OperationPasseeViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de OperationPasseeViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE .  
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT . 
			"," . OperationManager::CHAMP_OPERATION_LIBELLE . 
			"," . OperationManager::CHAMP_OPERATION_DATE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE . 
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE . 
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE .  
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID ."
			FROM " . OperationPasseeViewManager::VUE_OPERATIONPASSEE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeOperationPassee = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeOperationPassee,
					OperationPasseeViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
					$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID]));
			}
		} else {
			$lListeOperationPassee[0] = new OperationPasseeViewVO();
		}
		return $lListeOperationPassee;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(OperationPasseeViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de OperationPasseeViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . OperationManager::CHAMP_OPERATION_MONTANT .
			"," . OperationManager::CHAMP_OPERATION_LIBELLE .
			"," . OperationManager::CHAMP_OPERATION_DATE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE .
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE .
			"," . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE	.
			"," . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID 	);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(OperationPasseeViewManager::VUE_OPERATIONPASSEE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeOperationPassee = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeOperationPassee,
						OperationPasseeViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
						$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
						$lLigne[OperationManager::CHAMP_OPERATION_DATE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_CHAMP_COMPLEMENTAIRE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_LABEL_CHAMP_COMPLEMENTAIRE],
						$lLigne[OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE],
						$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_ID]));
				}
			} else {
				$lListeOperationPassee[0] = new OperationPasseeViewVO();
			}
	
			return $lListeOperationPassee;
		}

		$lListeOperationPassee[0] = new OperationPasseeViewVO();
		return $lListeOperationPassee;
	}

	/**
	* @name remplir($pOpeIdCompte, $pCptLabel, $pOpeMontant, $pOpeLibelle, $pOpeDate, $pTppType, $pTppChampComplementaire, $pTppLabelChampComplementaire, $pOpeTypePaiementChampComplementaire, $pTppId)
	* @param int(11)
	* @param varchar(30)
	* @param decimal(10,2)
	* @param varchar(100)
	* @param datetime
	* @param varchar(100)
	* @param tinyint(4)
	* @param varchar(30)
	* @param varchar(50)
	* @param int(11)
	* @return OperationPasseeViewVO
	* @desc Retourne une OperationPasseeViewVO remplie
	*/
	private static function remplir($pOpeIdCompte, $pCptLabel, $pOpeMontant, $pOpeLibelle, $pOpeDate, $pTppType, $pTppChampComplementaire, $pTppLabelChampComplementaire, $pOpeTypePaiementChampComplementaire, $pTppId) {
		$lOperationPassee = new OperationPasseeViewVO();
		$lOperationPassee->setOpeIdCompte($pOpeIdCompte);
		$lOperationPassee->setCptLabel($pCptLabel);
		$lOperationPassee->setOpeMontant($pOpeMontant);
		$lOperationPassee->setOpeLibelle($pOpeLibelle);
		$lOperationPassee->setOpeDate($pOpeDate);
		$lOperationPassee->setTppType($pTppType);
		$lOperationPassee->setTppChampComplementaire($pTppChampComplementaire);
		$lOperationPassee->setTppLabelChampComplementaire($pTppLabelChampComplementaire);
		$lOperationPassee->setOpeTypePaiementChampComplementaire($pOpeTypePaiementChampComplementaire);
		$lOperationPassee->setTppId($pTppId);
		return $lOperationPassee;
	}
}
?>