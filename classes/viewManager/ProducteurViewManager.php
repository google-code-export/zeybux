<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 31/10/2011
// Fichier : ProducteurViewManager.php
//
// Description : Classe de gestion des Producteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VIEW_VO . "ProducteurViewVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ProducteurManager.php");

define("VUE_PRODUCTEUR", MYSQL_DB_PREFIXE . "view_producteur");
/**
 * @name ProducteurViewManager
 * @author Julien PIERRE
 * @since 31/10/2011
 * 
 * @desc Classe permettant l'accès aux données des Producteur
 */
class ProducteurViewManager
{
	const VUE_PRODUCTEUR = VUE_PRODUCTEUR;

	/**
	* @name select($pId)
	* @param integer
	* @return ProducteurViewVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ProducteurViewVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_VILLE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . "
			FROM " . ProducteurViewManager::VUE_PRODUCTEUR . " 
			WHERE " . ProducteurManager::CHAMP_PRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProducteur,
					ProducteurViewManager::remplir(
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_VILLE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
			}
		} else {
			$lListeProducteur[0] = new ProducteurViewVO();
		}
		return $lListeProducteur;
	}

	/**
	* @name selectAll()
	* @return array(ProducteurViewVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ProducteurViewVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_VILLE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . "
			FROM " . ProducteurViewManager::VUE_PRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProducteur,
					ProducteurViewManager::remplir(
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_VILLE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
			}
		} else {
			$lListeProducteur[0] = new ProducteurViewVO();
		}
		return $lListeProducteur;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ProducteurViewVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ProducteurViewVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProducteurManager::CHAMP_PRODUCTEUR_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_VILLE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ProducteurViewManager::VUE_PRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeProducteur = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeProducteur,
						ProducteurViewManager::remplir(
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_FERME],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_PRENOM],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_VILLE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE]));
				}
			} else {
				$lListeProducteur[0] = new ProducteurViewVO();
			}

			return $lListeProducteur;
		}

		$lListeProducteur[0] = new ProducteurViewVO();
		return $lListeProducteur;
	}

	/**
	* @name remplir($pPrdtId, $pPrdtIdFerme, $pPrdtNumero, $pPrdtNom, $pPrdtPrenom, $pPrdtCourrielPrincipal, $pPrdtCourrielSecondaire, $pPrdtTelephonePrincipal, $pPrdtTelephoneSecondaire, $pPrdtAdresse, $pPrdtCodePostal, $pPrdtVille, $pPrdtDateNaissance, $pPrdtCommentaire)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param varchar(50)
	* @param varchar(50)
	* @param varchar(100)
	* @param varchar(100)
	* @param varchar(20)
	* @param varchar(20)
	* @param varchar(300)
	* @param varchar(10)
	* @param varchar(100)
	* @param date
	* @param text
	* @return ProducteurViewVO
	* @desc Retourne une ProducteurViewVO remplie
	*/
	private static function remplir($pPrdtId, $pPrdtIdFerme, $pPrdtNumero, $pPrdtNom, $pPrdtPrenom, $pPrdtCourrielPrincipal, $pPrdtCourrielSecondaire, $pPrdtTelephonePrincipal, $pPrdtTelephoneSecondaire, $pPrdtAdresse, $pPrdtCodePostal, $pPrdtVille, $pPrdtDateNaissance, $pPrdtCommentaire) {
		$lProducteur = new ProducteurViewVO();
		$lProducteur->setPrdtId($pPrdtId);
		$lProducteur->setPrdtIdFerme($pPrdtIdFerme);
		$lProducteur->setPrdtNumero($pPrdtNumero);
		$lProducteur->setPrdtNom($pPrdtNom);
		$lProducteur->setPrdtPrenom($pPrdtPrenom);
		$lProducteur->setPrdtCourrielPrincipal($pPrdtCourrielPrincipal);
		$lProducteur->setPrdtCourrielSecondaire($pPrdtCourrielSecondaire);
		$lProducteur->setPrdtTelephonePrincipal($pPrdtTelephonePrincipal);
		$lProducteur->setPrdtTelephoneSecondaire($pPrdtTelephoneSecondaire);
		$lProducteur->setPrdtAdresse($pPrdtAdresse);
		$lProducteur->setPrdtCodePostal($pPrdtCodePostal);
		$lProducteur->setPrdtVille($pPrdtVille);
		$lProducteur->setPrdtDateNaissance($pPrdtDateNaissance);
		$lProducteur->setPrdtCommentaire($pPrdtCommentaire);
		return $lProducteur;
	}
}
?>