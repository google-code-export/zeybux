<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 03/08/2011
// Fichier : ListeAchatReservationViewManager.php
//
// Description : Classe de gestion des ListeAchatReservation
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeAchatReservationViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "Test.php");
include_once(CHEMIN_CLASSES_MANAGERS . "S.php");
include_once(CHEMIN_CLASSES_MANAGERS . "2.php");

/**
 * @name ListeAchatReservationViewManager
 * @author Julien PIERRE
 * @since 03/08/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeAchatReservation
 */
class ListeAchatReservationViewManager
{
	const VUE_LISTEACHATRESERVATION = "view_test";

	/**
	* @name select($pId)
	* @param integer
	* @return ListeAchatReservationViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeAchatReservationViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . Test::test . 
			"," . S::s . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . "
			FROM " . ListeAchatReservationViewManager::VUE_LISTEACHATRESERVATION . " 
			WHERE " . Test::test . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAchatReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAchatReservation,
					ListeAchatReservationViewManager::remplir(
					$lLigne[Test::test],
					$lLigne[S::s],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2]));
			}
		} else {
			$lListeListeAchatReservation[0] = new ListeAchatReservationViewVO();
		}
		return $lListeListeAchatReservation;
	}

	/**
	* @name selectAll()
	* @return array(ListeAchatReservationViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeAchatReservationViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . Test::test . 
			"," . S::s . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . 
			"," . 2::2 . "
			FROM " . ListeAchatReservationViewManager::VUE_LISTEACHATRESERVATION;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeAchatReservation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeAchatReservation,
					ListeAchatReservationViewManager::remplir(
					$lLigne[Test::test],
					$lLigne[S::s],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2],
					$lLigne[2::2]));
			}
		} else {
			$lListeListeAchatReservation[0] = new ListeAchatReservationViewVO();
		}
		return $lListeListeAchatReservation;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeAchatReservationViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeAchatReservationViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    Test::test .
			"," . S::s .
			"," . 2::2 .
			"," . 2::2 .
			"," . 2::2 .
			"," . 2::2 .
			"," . 2::2 .
			"," . 2::2		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeAchatReservationViewManager::VUE_LISTEACHATRESERVATION, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeAchatReservation = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeAchatReservation,
						ListeAchatReservationViewManager::remplir(
						$lLigne[Test::test],
						$lLigne[S::s],
						$lLigne[2::2],
						$lLigne[2::2],
						$lLigne[2::2],
						$lLigne[2::2],
						$lLigne[2::2],
						$lLigne[2::2]));
				}
			} else {
				$lListeListeAchatReservation[0] = new ListeAchatReservationViewVO();
			}

			return $lListeListeAchatReservation;
		}

		$lListeListeAchatReservation[0] = new ListeAchatReservationViewVO();
		return $lListeListeAchatReservation;
	}

	/**
	* @name remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pOpeMontantReservation, $pOpeMontantAchat)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(30)
	* @param varchar(50)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param decimal(10,2)
	* @return ListeAchatReservationViewVO
	* @desc Retourne une ListeAchatReservationViewVO remplie
	*/
	private static function remplir($pAdhId, $pAdhNumero, $pAdhIdCompte, $pCptLabel, $pAdhNom, $pAdhPrenom, $pOpeMontantReservation, $pOpeMontantAchat) {
		$lListeAchatReservation = new ListeAchatReservationViewVO();
		$lListeAchatReservation->setAdhId($pAdhId);
		$lListeAchatReservation->setAdhNumero($pAdhNumero);
		$lListeAchatReservation->setAdhIdCompte($pAdhIdCompte);
		$lListeAchatReservation->setCptLabel($pCptLabel);
		$lListeAchatReservation->setAdhNom($pAdhNom);
		$lListeAchatReservation->setAdhPrenom($pAdhPrenom);
		$lListeAchatReservation->setOpeMontantReservation($pOpeMontantReservation);
		$lListeAchatReservation->setOpeMontantAchat($pOpeMontantAchat);
		return $lListeAchatReservation;
	}
}
?>