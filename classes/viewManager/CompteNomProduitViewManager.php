<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 08/11/2011
// Fichier : CompteNomProduitViewManager.php
//
// Description : Classe de gestion des CompteNomProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "CompteNomProduitViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "NomProduitManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "FermeManager.php");

define("VUE_COMPTENOMPRODUIT", MYSQL_DB_PREFIXE . "view_compte_nom_produit");
/**
 * @name CompteNomProduitViewManager
 * @author Julien PIERRE
 * @since 08/11/2011
 * 
 * @desc Classe permettant l'accès aux données des CompteNomProduit
 */
class CompteNomProduitViewManager
{
	const VUE_COMPTENOMPRODUIT = VUE_COMPTENOMPRODUIT;

	/**
	* @name select($pId)
	* @param integer
	* @return CompteNomProduitViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une CompteNomProduitViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . CompteNomProduitViewManager::VUE_COMPTENOMPRODUIT . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteNomProduit,
					CompteNomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeCompteNomProduit[0] = new CompteNomProduitViewVO();
		}
		return $lListeCompteNomProduit;
	}

	/**
	* @name selectAll()
	* @return array(CompteNomProduitViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de CompteNomProduitViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . FermeManager::CHAMP_FERME_ID . 
			"," . FermeManager::CHAMP_FERME_ID_COMPTE . "
			FROM " . CompteNomProduitViewManager::VUE_COMPTENOMPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeCompteNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteNomProduit,
					CompteNomProduitViewManager::remplir(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[FermeManager::CHAMP_FERME_ID],
					$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
			}
		} else {
			$lListeCompteNomProduit[0] = new CompteNomProduitViewVO();
		}
		return $lListeCompteNomProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(CompteNomProduitViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de CompteNomProduitViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . FermeManager::CHAMP_FERME_ID .
			"," . FermeManager::CHAMP_FERME_ID_COMPTE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(CompteNomProduitViewManager::VUE_COMPTENOMPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeCompteNomProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeCompteNomProduit,
						CompteNomProduitViewManager::remplir(
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[FermeManager::CHAMP_FERME_ID],
						$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE]));
				}
			} else {
				$lListeCompteNomProduit[0] = new CompteNomProduitViewVO();
			}

			return $lListeCompteNomProduit;
		}

		$lListeCompteNomProduit[0] = new CompteNomProduitViewVO();
		return $lListeCompteNomProduit;
	}

	/**
	* @name remplir($pNproId, $pFerId, $pFerIdCompte)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return CompteNomProduitViewVO
	* @desc Retourne une CompteNomProduitViewVO remplie
	*/
	private static function remplir($pNproId, $pFerId, $pFerIdCompte) {
		$lCompteNomProduit = new CompteNomProduitViewVO();
		$lCompteNomProduit->setNproId($pNproId);
		$lCompteNomProduit->setFerId($pFerId);
		$lCompteNomProduit->setFerIdCompte($pFerIdCompte);
		return $lCompteNomProduit;
	}
}
?>