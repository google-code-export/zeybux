<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/12/2010
// Fichier : ProduitManager.php
//
// Description : Classe de gestion des Produit
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ProduitVO.php");

/**
 * @name ProduitManager
 * @author Julien PIERRE
 * @since 25/12/2010
 * 
 * @desc Classe permettant l'accès aux données des Produit
 */
class ProduitManager
{
	const TABLE_PRODUIT = "pro_produit";
	const CHAMP_PRODUIT_ID = "pro_id";
	const CHAMP_PRODUIT_ID_COMMANDE = "pro_id_commande";
	const CHAMP_PRODUIT_ID_NOM_PRODUIT = "pro_id_nom_produit";
	const CHAMP_PRODUIT_UNITE_MESURE = "pro_unite_mesure";
	const CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE = "pro_max_produit_commande";
	const CHAMP_PRODUIT_ID_PRODUCTEUR = "pro_id_producteur";

	/**
	* @name select($pId)
	* @param integer
	* @return ProduitVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ProduitVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . "
			FROM " . ProduitManager::TABLE_PRODUIT . " 
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ProduitManager::remplirProduit(
				$pId,
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
				$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
				$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR]);
		} else {
			return new ProduitVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ProduitVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ProduitVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProduitManager::CHAMP_PRODUIT_ID . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . 
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . 
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . 
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . "
			FROM " . ProduitManager::TABLE_PRODUIT;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProduit = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProduit,
					ProduitManager::remplirProduit(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR]));
			}
		} else {
			$lListeProduit[0] = new ProduitVO();
		}
		return $lListeProduit;
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ProduitVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ProduitVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProduitManager::CHAMP_PRODUIT_ID .
			"," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT .
			"," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE .
			"," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE .
			"," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR		);

		if(is_array($pTypeRecherche) && is_array($pCritereRecherche)) {
			$lFiltres = array();
			$i = 0;
			foreach($pTypeRecherche as $lTypeRecherche) {
				$lLigne = array();
				$lLigne['champ'] = StringUtils::securiser($lTypeRecherche);
				$lLigne['valeur'] = StringUtils::securiser($pCritereRecherche[$i]);
				array_push($lFiltres,$lLigne);
				$i++;
			}
		} else {
			$lFiltres = array(array( 'champ' => StringUtils::securiser($pTypeRecherche), 'valeur' => StringUtils::securiser($pCritereRecherche) ));
		}

		if(is_array($pTypeCritere)) {
			$lTypeFiltre = $pTypeCritere;
		} else {
			$lTypeFiltre = array($pTypeCritere);
		}

		// Protection du critère de tri
		if($pCritereTri != 'ASC' && $pCritereTri != 'DESC') {
			$pCritereTri = 'ASC';
		}

		// Protection du type de tri
		if($pTypeTri == '') {
			$pTypeTri = ProduitManager::CHAMP_PRODUIT_ID;
		}

		$lTris = array( array('champ' => StringUtils::securiser($pTypeTri), 'sens'=> StringUtils::securiser($pCritereTri)) );

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ProduitManager::TABLE_PRODUIT, $lChamps, $lFiltres, $lTypeFiltre, $lTris);

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProduit = array();

		if( mysql_num_rows($lSql) > 0 ) {

			while ( $lLigne = mysql_fetch_assoc($lSql) ) {

				array_push($lListeProduit,
					ProduitManager::remplirProduit(
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT],
					$lLigne[ProduitManager::CHAMP_PRODUIT_UNITE_MESURE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE],
					$lLigne[ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR]));
			}
		} else {
			$lListeProduit[0] = new ProduitVO();
		}

		return $lListeProduit;
	}

	/**
	* @name remplirProduit($pId, $pIdCommande, $pIdNomProduit, $pUniteMesure, $pMaxProduitCommande, $pIdProducteur)
	* @param int(11)
	* @param int(11)
	* @param int(11)
	* @param varchar(20)
	* @param decimal(10,2)
	* @param int(11)
	* @return ProduitVO
	* @desc Retourne une ProduitVO remplie
	*/
	private static function remplirProduit($pId, $pIdCommande, $pIdNomProduit, $pUniteMesure, $pMaxProduitCommande, $pIdProducteur) {
		$lProduit = new ProduitVO();
		$lProduit->setId($pId);
		$lProduit->setIdCommande($pIdCommande);
		$lProduit->setIdNomProduit($pIdNomProduit);
		$lProduit->setUniteMesure($pUniteMesure);
		$lProduit->setMaxProduitCommande($pMaxProduitCommande);
		$lProduit->setIdProducteur($pIdProducteur);
		return $lProduit;
	}

	/**
	* @name insert($pVo)
	* @param ProduitVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ProduitVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . ProduitManager::TABLE_PRODUIT . "
				(" . ProduitManager::CHAMP_PRODUIT_ID . "
				," . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . "
				," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . "
				," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . "
				," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . "
				," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				,'" . StringUtils::securiser( $pVo->getUniteMesure() ) . "'
				,'" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdProducteur() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param ProduitVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ProduitVO, avec les informations du ProduitVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . ProduitManager::TABLE_PRODUIT . "
			 SET
				 " . ProduitManager::CHAMP_PRODUIT_ID_COMMANDE . " = '" . StringUtils::securiser( $pVo->getIdCommande() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_ID_NOM_PRODUIT . " = '" . StringUtils::securiser( $pVo->getIdNomProduit() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_UNITE_MESURE . " = '" . StringUtils::securiser( $pVo->getUniteMesure() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_MAX_PRODUIT_COMMANDE . " = '" . StringUtils::securiser( $pVo->getMaxProduitCommande() ) . "'
				," . ProduitManager::CHAMP_PRODUIT_ID_PRODUCTEUR . " = '" . StringUtils::securiser( $pVo->getIdProducteur() ) . "'
			 WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ProduitManager::TABLE_PRODUIT . "
			WHERE " . ProduitManager::CHAMP_PRODUIT_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>