<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 12/09/2010
// Fichier : ListeCommandeArchiveViewManager.php
//
// Description : Classe de gestion des ListeCommandeArchive
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeCommandeArchiveViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name ListeCommandeArchiveViewManager
 * @author Julien PIERRE
 * @since 12/09/2010
 * 
 * @desc Classe permettant l'accès aux données des ListeCommandeArchive
 */
class ListeCommandeArchiveViewManager
{
	const VUE_LISTECOMMANDEARCHIVE = "view_liste_commande_archive";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeCommandeArchiveViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeCommandeArchiveViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . ListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ListeCommandeArchiveViewManager::remplir(
				$pId,
				$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]);
		} else {
			return new ListeCommandeArchiveViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ListeCommandeArchiveViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeCommandeArchiveViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . ListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeCommandeArchive = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeCommandeArchive,
					ListeCommandeArchiveViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
			}
		} else {
			$lListeListeCommandeArchive[0] = new ListeCommandeArchiveViewVO();
		}
		return $lListeListeCommandeArchive;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeCommandeArchiveViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeCommandeArchiveViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeCommandeArchive = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeListeCommandeArchive,
						ListeCommandeArchiveViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
				}
			} else {
				$lListeListeCommandeArchive[0] = new ListeCommandeArchiveViewVO();
			}
	
			return $lListeListeCommandeArchive;
		}

		$lListeListeCommandeArchive[0] = new ListeCommandeArchiveViewVO();
		return $lListeListeCommandeArchive;
	}

	/**
	* @name remplir($pComId, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin)
	* @param int(11)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param datetime
	* @return ListeCommandeArchiveViewVO
	* @desc Retourne une ListeCommandeArchiveViewVO remplie
	*/
	private static function remplir($pComId, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin) {
		$lListeCommandeArchive = new ListeCommandeArchiveViewVO();
		$lListeCommandeArchive->setComId($pComId);
		$lListeCommandeArchive->setComNumero($pComNumero);
		$lListeCommandeArchive->setComDateFinReservation($pComDateFinReservation);
		$lListeCommandeArchive->setComDateMarcheDebut($pComDateMarcheDebut);
		$lListeCommandeArchive->setComDateMarcheFin($pComDateMarcheFin);
		return $lListeCommandeArchive;
	}
}
?>