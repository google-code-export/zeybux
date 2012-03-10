<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 11/02/2012
// Fichier : DetailCompteAbonnementViewManager.php
//
// Description : Classe de gestion des DetailCompteAbonnement
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "DetailCompteAbonnementViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteAbonnementManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");

define("VUE_DETAILCOMPTEABONNEMENT", MYSQL_DB_PREFIXE . "view_detail_compte_abonnement");
/**
 * @name DetailCompteAbonnementViewManager
 * @author Julien PIERRE
 * @since 11/02/2012
 * 
 * @desc Classe permettant l'accès aux données des DetailCompteAbonnement
 */
class DetailCompteAbonnementViewManager
{
	const VUE_DETAILCOMPTEABONNEMENT = VUE_DETAILCOMPTEABONNEMENT;

	/**
	* @name select($pId)
	* @param integer
	* @return DetailCompteAbonnementViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une DetailCompteAbonnementViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . DetailCompteAbonnementViewManager::VUE_DETAILCOMPTEABONNEMENT . " 
			WHERE " . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailCompteAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailCompteAbonnement,
					DetailCompteAbonnementViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeDetailCompteAbonnement[0] = new DetailCompteAbonnementViewVO();
		}
		return $lListeDetailCompteAbonnement;
	}

	/**
	* @name selectAll()
	* @return array(DetailCompteAbonnementViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de DetailCompteAbonnementViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID . 
			"," . CompteManager::CHAMP_COMPTE_LABEL . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION . 
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION . "
			FROM " . DetailCompteAbonnementViewManager::VUE_DETAILCOMPTEABONNEMENT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeDetailCompteAbonnement = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeDetailCompteAbonnement,
					DetailCompteAbonnementViewManager::remplir(
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
					$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
			}
		} else {
			$lListeDetailCompteAbonnement[0] = new DetailCompteAbonnementViewVO();
		}
		return $lListeDetailCompteAbonnement;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(DetailCompteAbonnementViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de DetailCompteAbonnementViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID .
			"," . CompteManager::CHAMP_COMPTE_LABEL .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION .
			"," . CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(DetailCompteAbonnementViewManager::VUE_DETAILCOMPTEABONNEMENT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeDetailCompteAbonnement = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeDetailCompteAbonnement,
						DetailCompteAbonnementViewManager::remplir(
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_ID],
						$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_QUANTITE],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_DEBUT_SUSPENSION],
						$lLigne[CompteAbonnementManager::CHAMP_COMPTEABONNEMENT_DATE_FIN_SUSPENSION]));
				}
			} else {
				$lListeDetailCompteAbonnement[0] = new DetailCompteAbonnementViewVO();
			}

			return $lListeDetailCompteAbonnement;
		}

		$lListeDetailCompteAbonnement[0] = new DetailCompteAbonnementViewVO();
		return $lListeDetailCompteAbonnement;
	}

	/**
	* @name remplir($pCptAboId, $pCptLabel, $pNproNom, $pCptAboQuantite, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension)
	* @param int(11)
	* @param varchar(30)
	* @param varchar(50)
	* @param decimal(10,2)
	* @param datetime
	* @param datetime
	* @return DetailCompteAbonnementViewVO
	* @desc Retourne une DetailCompteAbonnementViewVO remplie
	*/
	private static function remplir($pCptAboId, $pCptLabel, $pNproNom, $pCptAboQuantite, $pCptAboDateDebutSuspension, $pCptAboDateFinSuspension) {
		$lDetailCompteAbonnement = new DetailCompteAbonnementViewVO();
		$lDetailCompteAbonnement->setCptAboId($pCptAboId);
		$lDetailCompteAbonnement->setCptLabel($pCptLabel);
		$lDetailCompteAbonnement->setNproNom($pNproNom);
		$lDetailCompteAbonnement->setCptAboQuantite($pCptAboQuantite);
		$lDetailCompteAbonnement->setCptAboDateDebutSuspension($pCptAboDateDebutSuspension);
		$lDetailCompteAbonnement->setCptAboDateFinSuspension($pCptAboDateFinSuspension);
		return $lDetailCompteAbonnement;
	}
}
?>