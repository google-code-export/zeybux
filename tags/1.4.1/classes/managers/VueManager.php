<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : VueManager.php
//
// Description : Classe de gestion des Vues
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "VueVO.php");

define("TABLE_VUE", MYSQL_DB_PREFIXE . "vue_vues");
/**
 * @name VueManager
 * @author Julien PIERRE
 * @since 01/02/2010
 * 
 * @desc Classe permettant l'accès aux données des Vues
 */
class VueManager
{
	const TABLE_VUE = TABLE_VUE;
	const CHAMP_VUE_ID = "vue_id";
	const CHAMP_VUE_ID_MODULE = "vue_id_module";
	const CHAMP_VUE_NOM = "vue_nom";
	const CHAMP_VUE_LABEL = "vue_label";
	const CHAMP_VUE_ORDRE = "vue_ordre";
	const CHAMP_VUE_VISIBLE = "vue_visible";

	/**
	* @name select($pId)
	* @param integer
	* @return VueVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé un VueVO contenant les informations et le renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . VueManager::CHAMP_VUE_ID . 
			"," . VueManager::CHAMP_VUE_ID_MODULE . 
			"," . VueManager::CHAMP_VUE_NOM . 
			"," . VueManager::CHAMP_VUE_LABEL . 
			"," . VueManager::CHAMP_VUE_ORDRE . 
			"," . VueManager::CHAMP_VUE_VISIBLE . "
			FROM " . VueManager::TABLE_VUE . " 
			WHERE " . VueManager::CHAMP_VUE_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return VueManager::remplirVue(
				$pId,
				$lLigne[VueManager::CHAMP_VUE_ID_MODULE],
				$lLigne[VueManager::CHAMP_VUE_NOM],
				$lLigne[VueManager::CHAMP_VUE_LABEL],
				$lLigne[VueManager::CHAMP_VUE_ORDRE],
				$lLigne[VueManager::CHAMP_VUE_VISIBLE]);
		} else {
			return new VueVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(VueVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de VueVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . VueManager::CHAMP_VUE_ID . 
			"," . VueManager::CHAMP_VUE_ID_MODULE . 
			"," . VueManager::CHAMP_VUE_NOM . 
			"," . VueManager::CHAMP_VUE_LABEL . 
			"," . VueManager::CHAMP_VUE_ORDRE . 
			"," . VueManager::CHAMP_VUE_VISIBLE . "
			FROM " . VueManager::TABLE_VUE;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeVue = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeVue,
					VueManager::remplirVue(
					$lLigne[VueManager::CHAMP_VUE_ID],
					$lLigne[VueManager::CHAMP_VUE_ID_MODULE],
					$lLigne[VueManager::CHAMP_VUE_NOM],
					$lLigne[VueManager::CHAMP_VUE_LABEL],
					$lLigne[VueManager::CHAMP_VUE_ORDRE],
					$lLigne[VueManager::CHAMP_VUE_VISIBLE]));
			}
		} else {
			$lListeVue[0] = new VueVO();
		}
		return $lListeVue;
	}

	/**
	* @name selectByIdModule($pId)
	* @param integer
	* @return array(VueVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdModule $pId et les renvoie sous forme d'une collection de VueVO
	*/
	public static function selectByIdModule($pId) {		
		return VueManager::recherche(
					array(VueManager::CHAMP_VUE_ID_MODULE), 
					array('='), 
					array($pId),
					array(VueManager::CHAMP_VUE_ORDRE),
					array('ASC'));
	}
	
	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(VueVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de VueVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
				VueManager::CHAMP_VUE_ID .
			"," . VueManager::CHAMP_VUE_ID_MODULE .
			"," . VueManager::CHAMP_VUE_NOM .
			"," . VueManager::CHAMP_VUE_LABEL .
			"," . VueManager::CHAMP_VUE_ORDRE .
			"," . VueManager::CHAMP_VUE_VISIBLE		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(VueManager::TABLE_VUE, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeVue = array();

		if($lRequete !== false) {

			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);

			if( mysql_num_rows($lSql) > 0 ) {

				while ( $lLigne = mysql_fetch_assoc($lSql) ) {

					array_push($lListeVue,
						VueManager::remplirVue(
						$lLigne[VueManager::CHAMP_VUE_ID],
						$lLigne[VueManager::CHAMP_VUE_ID_MODULE],
						$lLigne[VueManager::CHAMP_VUE_NOM],
						$lLigne[VueManager::CHAMP_VUE_LABEL],
						$lLigne[VueManager::CHAMP_VUE_ORDRE],
						$lLigne[VueManager::CHAMP_VUE_VISIBLE]));
				}
			} else {
				$lListeVue[0] = new VueVO();
			}	
			return $lListeVue;
		}
		
		$lListeVue[0] = new VueVO();
		return $lListeVue;
	}

	/**
	* @name remplirVue($pId, $pIdModule, $pNom, $pLabel, $pOrdre, $pVisible)
	* @param int(11)
	* @param int(11)
	* @param varchar(50)
	* @param varchar(80)
	* @param int(11)
	* @param tinyint(1)
	* @return VueVO
	* @desc Retourne une VueVO remplie
	*/
	private static function remplirVue($pId, $pIdModule, $pNom, $pLabel, $pOrdre, $pVisible) {
		$lVue = new VueVO();
		$lVue->setId($pId);
		$lVue->setIdModule($pIdModule);
		$lVue->setNom($pNom);
		$lVue->setLabel($pLabel);
		$lVue->setOrdre($pOrdre);
		$lVue->setVisible($pVisible);
		return $lVue;
	}

	/**
	* @name insert($pVo)
	* @param VueVO
	* @desc Insère une nouvelle ligne dans la table, à partir des informations du VueVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"INSERT INTO " . VueManager::TABLE_VUE . "
				(" . VueManager::CHAMP_VUE_ID . "
				," . VueManager::CHAMP_VUE_ID_MODULE . "
				," . VueManager::CHAMP_VUE_NOM . "
				," . VueManager::CHAMP_VUE_LABEL . "
				," . VueManager::CHAMP_VUE_ORDRE . "
				," . VueManager::CHAMP_VUE_VISIBLE . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getIdModule() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getLabel() ) . "'
				,'" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				,'" . StringUtils::securiser( $pVo->getVisible() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		return Dbutils::executerRequeteInsertRetourId($lRequete);
	}

	/**
	* @name update($pVo)
	* @param VueVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du VueVO, avec les informations du VueVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete = 
			"UPDATE " . VueManager::TABLE_VUE . "
			 SET
				 " . VueManager::CHAMP_VUE_ID_MODULE . " = '" . StringUtils::securiser( $pVo->getIdModule() ) . "'
				," . VueManager::CHAMP_VUE_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . VueManager::CHAMP_VUE_LABEL . " = '" . StringUtils::securiser( $pVo->getLabel() ) . "'
				," . VueManager::CHAMP_VUE_ORDRE . " = '" . StringUtils::securiser( $pVo->getOrdre() ) . "'
				," . VueManager::CHAMP_VUE_VISIBLE . " = '" . StringUtils::securiser( $pVo->getVisible() ) . "'
			 WHERE " . VueManager::CHAMP_VUE_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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
		
		$lRequete = 	"DELETE FROM " . VueManager::TABLE_VUE . " 
				WHERE " . VueManager::CHAMP_VUE_ID . " = '" . StringUtils::securiser($pId) . "'" ;
		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}

}
?>
