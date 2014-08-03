<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : ListeProducteurViewManager.php
//
// Description : Classe de gestion des ListeProducteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ListeProducteurViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");

define("VUE_LISTEPRODUCTEUR", MYSQL_DB_PREFIXE . "view_liste_producteur");
/**
 * @name ListeProducteurViewManager
 * @author Julien PIERRE
 * @since 31/10/2011
 * 
 * @desc Classe permettant l'accès aux données des ListeProducteur
 */
class ListeProducteurViewManager
{
	const VUE_LISTEPRODUCTEUR = VUE_LISTEPRODUCTEUR;

	/**
	* @name select($pId)
	* @param integer
	* @return ListeProducteurViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ListeProducteurViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . "
			FROM " . ListeProducteurViewManager::VUE_LISTEPRODUCTEUR . " 
			WHERE " . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteur,
					ListeProducteurViewManager::remplir(
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL]));
			}
		} else {
			$lListeListeProducteur[0] = new ListeProducteurViewVO();
		}
		return $lListeListeProducteur;
	}

	/**
	* @name selectAll()
	* @return array(ListeProducteurViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ListeProducteurViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . "
			FROM " . ListeProducteurViewManager::VUE_LISTEPRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeListeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeListeProducteur,
					ListeProducteurViewManager::remplir(
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL]));
			}
		} else {
			$lListeListeProducteur[0] = new ListeProducteurViewVO();
		}
		return $lListeListeProducteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ListeProducteurViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ListeProducteurViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ListeProducteurViewManager::VUE_LISTEPRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeListeProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeListeProducteur,
						ListeProducteurViewManager::remplir(
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL]));
				}
			} else {
				$lListeListeProducteur[0] = new ListeProducteurViewVO();
			}

			return $lListeListeProducteur;
		}

		$lListeListeProducteur[0] = new ListeProducteurViewVO();
		return $lListeListeProducteur;
	}

	/**
	* @name remplir($pPrdtIdFerme, $pPrdtId, $pPrdtNumero, $pPrdtNom, $pPrdtPrenom, $pPrdtCourrielPrincipal, $pPrdtTelephonePrincipal)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(100)
	* @param varchar(20)
	* @return ListeProducteurViewVO
	* @desc Retourne une ListeProducteurViewVO remplie
	*/
	private static function remplir($pPrdtIdFerme, $pPrdtId, $pPrdtNumero, $pPrdtNom, $pPrdtPrenom, $pPrdtCourrielPrincipal, $pPrdtTelephonePrincipal) {
		$lListeProducteur = new ListeProducteurViewVO();
		$lListeProducteur->setPrdtIdFerme($pPrdtIdFerme);
		$lListeProducteur->setPrdtId($pPrdtId);
		$lListeProducteur->setPrdtNumero($pPrdtNumero);
		$lListeProducteur->setPrdtNom($pPrdtNom);
		$lListeProducteur->setPrdtPrenom($pPrdtPrenom);
		$lListeProducteur->setPrdtCourrielPrincipal($pPrdtCourrielPrincipal);
		$lListeProducteur->setPrdtTelephonePrincipal($pPrdtTelephonePrincipal);
		return $lListeProducteur;
	}
}
?>