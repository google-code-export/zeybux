<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 06/02/2012
// Fichier : NomProduitManager.php
//
// Description : Classe de gestion des NomProduit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "NomProduitVO.php");
include_once(CHEMIN_CLASSES_VO . "UniteNomProduitVO.php");
include_once(CHEMIN_CLASSES_VO . "StockProduitFermeVO.php");
include_once(CHEMIN_CLASSES_MANAGERS . "StockQuantiteManager.php");

define("TABLE_NOMPRODUIT", MYSQL_DB_PREFIXE . "npro_nom_produit");
/**
 * @name NomProduitManager
 * @author Julien PIERRE
 * @since 06/02/2012
 * 
 * @desc Classe permettant l'accès aux données des NomProduit
 */
class NomProduitManager
{
	const TABLE_NOMPRODUIT = TABLE_NOMPRODUIT;
	const CHAMP_NOMPRODUIT_ID = "npro_id";
	const CHAMP_NOMPRODUIT_NUMERO = "npro_numero";
	const CHAMP_NOMPRODUIT_NOM = "npro_nom";
	const CHAMP_NOMPRODUIT_DESCRIPTION = "npro_description";
	const CHAMP_NOMPRODUIT_ID_CATEGORIE = "npro_id_categorie";
	const CHAMP_NOMPRODUIT_ID_FERME = "npro_id_ferme";
	const CHAMP_NOMPRODUIT_ETAT = "npro_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return NomProduitVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une NomProduitVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . "
			FROM " . NomProduitManager::TABLE_NOMPRODUIT . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return NomProduitManager::remplirNomProduit(
				$pId,
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT]);
		} else {
			return new NomProduitVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(NomProduitVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de NomProduitVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . "
			FROM " . NomProduitManager::TABLE_NOMPRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduit,
					NomProduitManager::remplirNomProduit(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT]));
			}
		} else {
			$lListeNomProduit[0] = new NomProduitVO();
		}
		return $lListeNomProduit;
	}
	
	/**
	* @name selectByIdCategorie($pIdCategorie)
	* @param integer
	* @return NomProduitVO
	* @desc Récupère la ligne correspondant à l'idCategorie en paramètre, créé une collection de NomProduitVO contenant les informations et la renvoie
	*/
	public static function selectByIdCategorie($pIdCategorie) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . NomProduitManager::CHAMP_NOMPRODUIT_ID . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . 
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . "
			FROM " . NomProduitManager::TABLE_NOMPRODUIT . " 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . " = '" . StringUtils::securiser($pIdCategorie) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduit,
					NomProduitManager::remplirNomProduit(
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT]));
			}
		} else {
			$lListeNomProduit[0] = new NomProduitVO();
		}
		return $lListeNomProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(NomProduitVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de NomProduitVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    NomProduitManager::CHAMP_NOMPRODUIT_ID .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME .
			"," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(NomProduitManager::TABLE_NOMPRODUIT, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeNomProduit = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeNomProduit,
						NomProduitManager::remplirNomProduit(
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME],
						$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ETAT]));
				}
			} else {
				$lListeNomProduit[0] = new NomProduitVO();
			}

			return $lListeNomProduit;
		}

		$lListeNomProduit[0] = new NomProduitVO();
		return $lListeNomProduit;
	}

	/**
	* @name remplirNomProduit($pId, $pNumero, $pNom, $pDescription, $pIdCategorie, $pIdFerme, $pEtat)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(50)
	* @param text
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @return NomProduitVO
	* @desc Retourne une NomProduitVO remplie
	*/
	private static function remplirNomProduit($pId, $pNumero, $pNom, $pDescription, $pIdCategorie, $pIdFerme, $pEtat) {
		$lNomProduit = new NomProduitVO();
		$lNomProduit->setId($pId);
		$lNomProduit->setNumero($pNumero);
		$lNomProduit->setNom($pNom);
		$lNomProduit->setDescription($pDescription);
		$lNomProduit->setIdCategorie($pIdCategorie);
		$lNomProduit->setIdFerme($pIdFerme);
		$lNomProduit->setEtat($pEtat);
		return $lNomProduit;
	}

	/**
	 * @name selectUniteNomProduit($pIdNomProduit)
	 * @return array(NomProduitVO)
	 * @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de NomProduitVO
	 */
	public static function selectUniteNomProduit($pIdNomProduit) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
		"SELECT "
					. CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
				","	. CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_ID .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
				"," . ModeleLotManager::CHAMP_MODELELOT_UNITE . "
			FROM " . NomProduitManager::TABLE_NOMPRODUIT . "
			JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . "
				ON " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . "
			JOIN " . ModeleLotManager::TABLE_MODELELOT . "
				ON " . ModeleLotManager::CHAMP_MODELELOT_ID_NOM_PRODUIT . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID . "
				AND " . ModeleLotManager::CHAMP_MODELELOT_ETAT . " = 0 
			WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . " = 0 
				AND " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser($pIdNomProduit) . "'
			GROUP BY " . ModeleLotManager::CHAMP_MODELELOT_UNITE;
	
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lUniteNomProduit = new UniteNomProduitVO();
		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			
			$lUniteNomProduit = new UniteNomProduitVO(
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
					$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
					$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
					array($lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE]));
			
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				$lUniteNomProduit->addMLotUnite($lLigne[ModeleLotManager::CHAMP_MODELELOT_UNITE]);
			}
		}
		return $lUniteNomProduit;
	}
	
	/**
	* @name insert($pVo)
	* @param NomProduitVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la NomProduitVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . NomProduitManager::TABLE_NOMPRODUIT . "
				(" . NomProduitManager::CHAMP_NOMPRODUIT_ID . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . "
				," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getNumero() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getDescription() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCategorie() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param NomProduitVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du NomProduitVO, avec les informations du NomProduitVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . NomProduitManager::TABLE_NOMPRODUIT . "
			 SET
				 " . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . NomProduitManager::CHAMP_NOMPRODUIT_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . NomProduitManager::CHAMP_NOMPRODUIT_DESCRIPTION . " = '" . StringUtils::securiser( $pVo->getDescription() ) . "'
				," . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE . " = '" . StringUtils::securiser( $pVo->getIdCategorie() ) . "'
				," . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME . " = '" . StringUtils::securiser( $pVo->getIdFerme() ) . "'
				," . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime la ligne de la table correspondant à l'id en paramètre
	*/
	public static function delete($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . NomProduitManager::TABLE_NOMPRODUIT . "
			 SET " . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . " = '1'
			 WHERE " . NomProduitManager::CHAMP_NOMPRODUIT_ID . " = '" . StringUtils::securiser( $pId ) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
	
	/**
	 * @name selectStockProduitFerme($pIdCompteFerme)
	 * @return array(StockProduitFermeVO)
	 * @desc Récupères le stock de produit pour une ferme
	 */
	public static function selectStockProduitFerme($pIdCompteFerme) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
		"SELECT " 
				. NomProduitManager::CHAMP_NOMPRODUIT_ID .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NUMERO .
				"," . NomProduitManager::CHAMP_NOMPRODUIT_NOM .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID .
				"," . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM .
				"," . FermeManager::CHAMP_FERME_ID .
				"," . FermeManager::CHAMP_FERME_NUMERO .
				"," . FermeManager::CHAMP_FERME_NOM .
				"," . FermeManager::CHAMP_FERME_ID_COMPTE .
				"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID .
				"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE .
				"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE .
				"," . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE .
		" FROM " . NomProduitManager::TABLE_NOMPRODUIT .
		" JOIN " . CategorieProduitManager::TABLE_CATEGORIEPRODUIT . 
			" ON " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID_CATEGORIE .
		" JOIN " . FermeManager::TABLE_FERME .  
			" ON " . FermeManager::CHAMP_FERME_ID . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID_FERME .
		" LEFT JOIN " . StockQuantiteManager::TABLE_STOCKQUANTITE .
			" ON " . StockQuantiteManager::CHAMP_STOCKQUANTITE_ID_NOM_PRODUIT . " = " . NomProduitManager::CHAMP_NOMPRODUIT_ID .
		" WHERE ".
			" (" . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . " = 0 " .
			" OR ISNULL(" . StockQuantiteManager::CHAMP_STOCKQUANTITE_ETAT . ") )" .
		" AND " .  FermeManager::CHAMP_FERME_ETAT . " = 0 " .
		" AND " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ETAT . " = 0 " .
		" AND " . NomProduitManager::CHAMP_NOMPRODUIT_ETAT . " = 0 " .
		" AND " . FermeManager::CHAMP_FERME_ID_COMPTE . " = '" . StringUtils::securiser($pIdCompteFerme) . "'" .
		" ORDER BY " . CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM . ", " . NomProduitManager::CHAMP_NOMPRODUIT_NOM . ", " . StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE . ";";
			
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
	
		$lListeNomProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeNomProduit,
				NomProduitManager::remplirStockFerme(
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_ID],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NUMERO],
				$lLigne[NomProduitManager::CHAMP_NOMPRODUIT_NOM],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_ID],
				$lLigne[CategorieProduitManager::CHAMP_CATEGORIEPRODUIT_NOM],
				$lLigne[FermeManager::CHAMP_FERME_ID],
				$lLigne[FermeManager::CHAMP_FERME_NUMERO],
				$lLigne[FermeManager::CHAMP_FERME_NOM],
				$lLigne[FermeManager::CHAMP_FERME_ID_COMPTE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_ID],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_QUANTITE_SOLIDAIRE],
				$lLigne[StockQuantiteManager::CHAMP_STOCKQUANTITE_UNITE]));
			}
		} else {
			$lListeNomProduit[0] = new NomProduitVO();
		}
		return $lListeNomProduit;
	}
	
	/**
	 * @name remplirStockFerme($pNproId, $pNproNumero, $pNproNom, $pCproId, $pCproNom, $pFerId, $pFerNumero, $pFerNom, $pFerIdCompte, $pStoQteId, $pStoQteQuantite, $pStoQteQuantiteSolidaire, $pStoQteUnite)
	 * @param int(11)
	 * @param varchar(50)
	 * @param varchar(50)
	 * @param int(11)
	 * @param varchar(50)
	 * @param int(11)
	 * @param varchar(50)
	 * @param varchar(50)
	 * @param int(11)
	 * @param int(11)
	 * @param decimal(10,2)
	 * @param decimal(10,2)
	 * @param varchar(20)
	 * @return StockProduitFermeVO
	 * @desc Retourne une StockProduitFermeVO remplie
	 */
	private static function remplirStockFerme($pNproId, $pNproNumero, $pNproNom, $pCproId, $pCproNom, $pFerId, $pFerNumero, $pFerNom, $pFerIdCompte, $pStoQteId, $pStoQteQuantite, $pStoQteQuantiteSolidaire, $pStoQteUnite) {
		$lStockProduitFerme = new StockProduitFermeVO();
		$lStockProduitFerme->setNproId($pNproId);
		$lStockProduitFerme->setNproNumero($pNproNumero);
		$lStockProduitFerme->setNproNom($pNproNom);
		$lStockProduitFerme->setCproId($pCproId);
		$lStockProduitFerme->setCproNom($pCproNom);
		$lStockProduitFerme->setFerId($pFerId);
		$lStockProduitFerme->setFerNumero($pFerNumero);
		$lStockProduitFerme->setFerNom($pFerNom);
		$lStockProduitFerme->setFerIdCompte($pFerIdCompte);
		$lStockProduitFerme->setStoQteId($pStoQteId);
		$lStockProduitFerme->setStoQteQuantite($pStoQteQuantite);
		$lStockProduitFerme->setStoQteQuantiteSolidaire($pStoQteQuantiteSolidaire);
		$lStockProduitFerme->setStoQteUnite($pStoQteUnite);
		return $lStockProduitFerme;
	}
}
?>