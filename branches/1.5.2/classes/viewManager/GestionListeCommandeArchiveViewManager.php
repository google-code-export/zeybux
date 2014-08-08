<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/10/2010
// Fichier : GestionListeCommandeArchiveViewManager.php
//
// Description : Classe de gestion des GestionListeCommandeArchive
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "GestionListeCommandeArchiveViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

define("VUE_LISTECOMMANDEARCHIVE", MYSQL_DB_PREFIXE . "view_gestion_liste_commande_archive");
/**
 * @name GestionListeCommandeArchiveViewManager
 * @author Julien PIERRE
 * @since 17/10/2010 
 * @desc Classe permettant l'accès aux données des GestionListeCommandeArchive
 */
class GestionListeCommandeArchiveViewManager
{
	const VUE_LISTECOMMANDEARCHIVE = VUE_LISTECOMMANDEARCHIVE;

	/**
	* @name select($pId)
	* @param integer
	* @return GestionListeCommandeArchiveViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une GestionListeCommandeArchiveViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . GestionListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE . " 
			WHERE " . CommandeManager::CHAMP_COMMANDE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return GestionListeCommandeArchiveViewManager::remplir(
				$pId,
				$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
				$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
				$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]);
		} else {
			return new GestionListeCommandeArchiveViewVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(GestionListeCommandeArchiveViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de GestionListeCommandeArchiveViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CommandeManager::CHAMP_COMMANDE_ID . 
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . GestionListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeGestionListeCommandeArchive = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeGestionListeCommandeArchive,
					GestionListeCommandeArchiveViewManager::remplir(
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
			}
		} else {
			$lListeGestionListeCommandeArchive[0] = new GestionListeCommandeArchiveViewVO();
		}
		return $lListeGestionListeCommandeArchive;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(GestionListeCommandeArchiveViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de GestionListeCommandeArchiveViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CommandeManager::CHAMP_COMMANDE_ID .
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_NUMERO .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(GestionListeCommandeArchiveViewManager::VUE_LISTECOMMANDEARCHIVE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeGestionListeCommandeArchive = array();
		
		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeGestionListeCommandeArchive,
						GestionListeCommandeArchiveViewManager::remplir(
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
				}
			} else {
				$lListeGestionListeCommandeArchive[0] = new GestionListeCommandeArchiveViewVO();
			}
	
			return $lListeGestionListeCommandeArchive;
		}
	
		$lListeGestionListeCommandeArchive[0] = new GestionListeCommandeArchiveViewVO();
		return $lListeGestionListeCommandeArchive;
	}

	/**
	* @name remplir($pComId, $pComNom, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin)
	* @param int(11)
	* @param varchar(100)
	* @param int(11)
	* @param datetime
	* @param datetime
	* @param datetime
	* @return GestionListeCommandeArchiveViewVO
	* @desc Retourne une GestionListeCommandeArchiveViewVO remplie
	*/
	private static function remplir($pComId, $pComNom, $pComNumero, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin) {
		$lGestionListeCommandeArchive = new GestionListeCommandeArchiveViewVO();
		$lGestionListeCommandeArchive->setComId($pComId);
		$lGestionListeCommandeArchive->setComNom($pComNom);
		$lGestionListeCommandeArchive->setComNumero($pComNumero);
		$lGestionListeCommandeArchive->setComDateFinReservation($pComDateFinReservation);
		$lGestionListeCommandeArchive->setComDateMarcheDebut($pComDateMarcheDebut);
		$lGestionListeCommandeArchive->setComDateMarcheFin($pComDateMarcheFin);
		return $lGestionListeCommandeArchive;
	}
}
?>