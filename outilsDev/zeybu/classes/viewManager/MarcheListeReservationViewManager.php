<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 13/07/2011
// Fichier : MarcheListeReservationViewManager.php
//
// Description : Classe de gestion des MarcheListeReservation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "MarcheListeReservationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CommandeManager.php");

/**
 * @name MarcheListeReservationViewManager
 * @author Julien PIERRE
 * @since 13/07/2011
 * 
 * @desc Classe permettant l'accès aux données des MarcheListeReservation
 */
class MarcheListeReservationViewManager
{
	const VUE_MARCHELISTERESERVATION = "view_marche_liste_reservation";

	/**
	* @name select($pId)
	* @param integer
	* @return MarcheListeReservationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une MarcheListeReservationViewVO contenant les informations et la renvoie
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
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . MarcheListeReservationViewManager::VUE_MARCHELISTERESERVATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMarcheListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeMarcheListeReservation,
					MarcheListeReservationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
			}
		} else {
			$lListeMarcheListeReservation[0] = new MarcheListeReservationViewVO();
		}
		return $lListeMarcheListeReservation;
	}

	/**
	* @name selectAll()
	* @return array(MarcheListeReservationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de MarcheListeReservationViewVO
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
			"," . CommandeManager::CHAMP_COMMANDE_NOM . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT . 
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN . "
			FROM " . MarcheListeReservationViewManager::VUE_MARCHELISTERESERVATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeMarcheListeReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeMarcheListeReservation,
					MarcheListeReservationViewManager::remplir(
					$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
					$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
					$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
					$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
			}
		} else {
			$lListeMarcheListeReservation[0] = new MarcheListeReservationViewVO();
		}
		return $lListeMarcheListeReservation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(MarcheListeReservationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de MarcheListeReservationViewVO
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
			"," . CommandeManager::CHAMP_COMMANDE_NOM .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT .
			"," . CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(MarcheListeReservationViewManager::VUE_MARCHELISTERESERVATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeMarcheListeReservation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeMarcheListeReservation,
						MarcheListeReservationViewManager::remplir(
						$lLigne[OperationManager::CHAMP_OPERATION_ID_COMPTE],
						$lLigne[CommandeManager::CHAMP_COMMANDE_ID],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NUMERO],
						$lLigne[CommandeManager::CHAMP_COMMANDE_NOM],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_FIN_RESERVATION],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_DEBUT],
						$lLigne[CommandeManager::CHAMP_COMMANDE_DATE_MARCHE_FIN]));
				}
			} else {
				$lListeMarcheListeReservation[0] = new MarcheListeReservationViewVO();
			}

			return $lListeMarcheListeReservation;
		}

		$lListeMarcheListeReservation[0] = new MarcheListeReservationViewVO();
		return $lListeMarcheListeReservation;
	}

	/**
	* @name remplir($pOpeIdCompte, $pComId, $pComNumero, $pComNom, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(100)
	* @param datetime
	* @param datetime
	* @param datetime
	* @return MarcheListeReservationViewVO
	* @desc Retourne une MarcheListeReservationViewVO remplie
	*/
	private static function remplir($pOpeIdCompte, $pComId, $pComNumero, $pComNom, $pComDateFinReservation, $pComDateMarcheDebut, $pComDateMarcheFin) {
		$lMarcheListeReservation = new MarcheListeReservationViewVO();
		$lMarcheListeReservation->setOpeIdCompte($pOpeIdCompte);
		$lMarcheListeReservation->setComId($pComId);
		$lMarcheListeReservation->setComNumero($pComNumero);
		$lMarcheListeReservation->setComNom($pComNom);
		$lMarcheListeReservation->setComDateFinReservation($pComDateFinReservation);
		$lMarcheListeReservation->setComDateMarcheDebut($pComDateMarcheDebut);
		$lMarcheListeReservation->setComDateMarcheFin($pComDateMarcheFin);
		return $lMarcheListeReservation;
	}
}
?>