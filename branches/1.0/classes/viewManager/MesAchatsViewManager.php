<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/10/2011
// Fichier : MesAchatsViewManager.php
//
// Description : Classe de gestion des MesAchats
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "MesAchatsViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name MesAchatsViewManager
 * @author Julien PIERRE
 * @since 03/10/2011
 * 
 * @desc Classe permettant l'accès aux données des MesAchats
 */
class MesAchatsViewManager
{
	const VUE_MESACHATS = "view_mes_achats";

	/**
	* @name select($pId)
	* @param integer
	* @return MesAchatsViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une MesAchatsViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . MesAchatsViewManager::VUE_MESACHATS . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'
			ORDER BY " . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . " DESC
			LIMIT 0 , 20";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMesAchats = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeMesAchats,
					MesAchatsViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeMesAchats[0] = new MesAchatsViewVO();
		}
		return $lListeMesAchats;
	}

	/**
	* @name selectAll()
	* @return array(MesAchatsViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de MesAchatsViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . OperationManager::CHAMP_OPERATION_ID_COMPTE . 
			"," . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . "
			FROM " . MesAchatsViewManager::VUE_MESACHATS;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMesAchats = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeMesAchats,
					MesAchatsViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
			}
		} else {
			$lListeMesAchats[0] = new MesAchatsViewVO();
		}
		return $lListeMesAchats;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(MesAchatsViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de MesAchatsViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    OperationManager::CHAMP_OPERATION_ID_COMPTE .
			"," . CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(MesAchatsViewManager::VUE_MESACHATS, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeMesAchats = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeMesAchats,
						MesAchatsViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT]));
				}
			} else {
				$lListeMesAchats[0] = new MesAchatsViewVO();
			}

			return $lListeMesAchats;
		}

		$lListeMesAchats[0] = new MesAchatsViewVO();
		return $lListeMesAchats;
	}

	/**
	* @name remplir($pOpeIdCompte, $pComId, $pComNumero, $pComDateMarcheDebut)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @return MesAchatsViewVO
	* @desc Retourne une MesAchatsViewVO remplie
	*/
	private static function remplir($pOpeIdCompte, $pComId, $pComNumero, $pComDateMarcheDebut) {
		$lMesAchats = new MesAchatsViewVO();
		$lMesAchats->setOpeIdCompte($pOpeIdCompte);
		$lMesAchats->setComId($pComId);
		$lMesAchats->setComNumero($pComNumero);
		$lMesAchats->setComDateMarcheDebut($pComDateMarcheDebut);
		return $lMesAchats;
	}
}
?>