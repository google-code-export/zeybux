<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/12/2010
// Fichier : ProducteurManager.php
//
// Description : Classe de gestion des Producteur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "DbUtils.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "ProducteurVO.php");

/**
 * @name ProducteurManager
 * @author Julien PIERRE
 * @since 22/12/2010
 * 
 * @desc Classe permettant l'accès aux données des Producteur
 */
class ProducteurManager
{
	const TABLE_PRODUCTEUR = "prdt_producteur";
	const CHAMP_PRODUCTEUR_ID = "prdt_id";
	const CHAMP_PRODUCTEUR_MOT_PASSE = "prdt_mot_passe";
	const CHAMP_PRODUCTEUR_NUMERO = "prdt_numero";
	const CHAMP_PRODUCTEUR_ID_COMPTE = "prdt_id_compte";
	const CHAMP_PRODUCTEUR_NOM = "prdt_nom";
	const CHAMP_PRODUCTEUR_PRENOM = "prdt_prenom";
	const CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL = "prdt_courriel_principal";
	const CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE = "prdt_courriel_secondaire";
	const CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL = "prdt_telephone_principal";
	const CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE = "prdt_telephone_secondaire";
	const CHAMP_PRODUCTEUR_ADRESSE = "prdt_adresse";
	const CHAMP_PRODUCTEUR_CODE_POSTAL = "prdt_code_postal";
	const CHAMP_PRODUCTEUR_VILLE = "prdt_ville";
	const CHAMP_PRODUCTEUR_DATE_NAISSANCE = "prdt_date_naissance";
	const CHAMP_PRODUCTEUR_DATE_CREATION = "prdt_date_creation";
	const CHAMP_PRODUCTEUR_DATE_MAJ = "prdt_date_maj";
	const CHAMP_PRODUCTEUR_COMMENTAIRE = "prdt_commentaire";
	const CHAMP_PRODUCTEUR_ETAT = "prdt_etat";

	/**
	* @name select($pId)
	* @param integer
	* @return ProducteurVO
	* @desc Récupère la ligne correspondant à l'id en paramètre, créé une ProducteurVO contenant les informations et la renvoie
	*/
	public static function select($pId) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE . 
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
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ETAT . "
			FROM " . ProducteurManager::TABLE_PRODUCTEUR . " 
			WHERE " . ProducteurManager::CHAMP_PRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return ProducteurManager::remplirProducteur(
				$pId,
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE],
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE],
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
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION],
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ],
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE],
				$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ETAT]);
		} else {
			return new ProducteurVO();
		}
	}

	/**
	* @name selectAll()
	* @return array(ProducteurVO)
	* @desc Récupères toutes les lignes de la table et les renvoie sous forme d'une collection de ProducteurVO
	*/
	public static function selectAll() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		$lRequete =
			"SELECT "
			    . ProducteurManager::CHAMP_PRODUCTEUR_ID . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE . 
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
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . 
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ETAT . "
			FROM " . ProducteurManager::TABLE_PRODUCTEUR;

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		$lListeProducteur = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeProducteur,
					ProducteurManager::remplirProducteur(
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE],
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
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE],
					$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ETAT]));
			}
		} else {
			$lListeProducteur[0] = new ProducteurVO();
		}
		return $lListeProducteur;
	}
	
	/**
	* @name selectByIdCompte($pId)
	* @param integer
	* @return array(ProducteurVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId et les renvoie sous forme d'une collection de ProducteurVO
	*/
	public static function selectByIdCompte($pId) {		
		return ProducteurManager::recherche(
			array(ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE),
			array('='),
			array($pId),
			array(''),
			array(''));
	}

	/**
	* @name recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri )
	* @param string nom de la table
	* @param string Le type de critère de recherche
	* @param array(string) champs à récupérer dans la table
	* @param array(array(string, object)) Dictionnaire(champ, valeur)) contenant les champs à filtrer ainsi que la valeur du filtre
	* @param array(array(string, string)) Dictionnaire(champ, sens) contenant les tris à appliquer
	* @return array(ProducteurVO)
	* @desc Récupères les lignes de la table selon le critère de recherche puis trie et renvoie la liste de résultat sous forme d'une collection de ProducteurVO
	*/
	public static function recherche( $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri ) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Préparation de la requète
		$lChamps = array( 
			    ProducteurManager::CHAMP_PRODUCTEUR_ID .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE .
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
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE .
			"," . ProducteurManager::CHAMP_PRODUCTEUR_ETAT		);

		// Préparation de la requète de recherche
		$lRequete = DbUtils::prepareRequeteRecherche(ProducteurManager::TABLE_PRODUCTEUR, $lChamps, $pTypeRecherche, $pTypeCritere, $pCritereRecherche, $pTypeTri, $pCritereTri);

		$lListeProducteur = array();

		if($lRequete !== false) {
			$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
			$lSql = Dbutils::executerRequete($lRequete);
	
			if( mysql_num_rows($lSql) > 0 ) {
	
				while ( $lLigne = mysql_fetch_assoc($lSql) ) {
	
					array_push($lListeProducteur,
						ProducteurManager::remplirProducteur(
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_NUMERO],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE],
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
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE],
						$lLigne[ProducteurManager::CHAMP_PRODUCTEUR_ETAT]));
				}
			} else {
				$lListeProducteur[0] = new ProducteurVO();
			}
	
			return $lListeProducteur;
		}
		
		$lListeProducteur[0] = new ProducteurVO();
		return $lListeProducteur;
	}

	/**
	* @name remplirProducteur($pId, $pMotPasse, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateCreation, $pDateMaj, $pCommentaire, $pEtat)
	* @param int(11)
	* @param varchar(100)
	* @param varchar(20)
	* @param int(11)
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
	* @param date
	* @param datetime
	* @param text
	* @param tinyint(4)
	* @return ProducteurVO
	* @desc Retourne une ProducteurVO remplie
	*/
	private static function remplirProducteur($pId, $pMotPasse, $pNumero, $pIdCompte, $pNom, $pPrenom, $pCourrielPrincipal, $pCourrielSecondaire, $pTelephonePrincipal, $pTelephoneSecondaire, $pAdresse, $pCodePostal, $pVille, $pDateNaissance, $pDateCreation, $pDateMaj, $pCommentaire, $pEtat) {
		$lProducteur = new ProducteurVO();
		$lProducteur->setId($pId);
		$lProducteur->setMotPasse($pMotPasse);
		$lProducteur->setNumero($pNumero);
		$lProducteur->setIdCompte($pIdCompte);
		$lProducteur->setNom($pNom);
		$lProducteur->setPrenom($pPrenom);
		$lProducteur->setCourrielPrincipal($pCourrielPrincipal);
		$lProducteur->setCourrielSecondaire($pCourrielSecondaire);
		$lProducteur->setTelephonePrincipal($pTelephonePrincipal);
		$lProducteur->setTelephoneSecondaire($pTelephoneSecondaire);
		$lProducteur->setAdresse($pAdresse);
		$lProducteur->setCodePostal($pCodePostal);
		$lProducteur->setVille($pVille);
		$lProducteur->setDateNaissance($pDateNaissance);
		$lProducteur->setDateCreation($pDateCreation);
		$lProducteur->setDateMaj($pDateMaj);
		$lProducteur->setCommentaire($pCommentaire);
		$lProducteur->setEtat($pEtat);
		return $lProducteur;
	}

	/**
	* @name insert($pVo)
	* @param ProducteurVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la ProducteurVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	public static function insert($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
		
		// Mise en forme des données
		$pVo->setNom(StringUtils::formaterNom(trim($pVo->getNom())));
		$pVo->setPrenom(StringUtils::formaterPrenom(trim($pVo->getPrenom())));
		$pVo->setCourrielPrincipal(trim($pVo->getCourrielPrincipal()));
		$pVo->setCourrielSecondaire(trim($pVo->getCourrielSecondaire()));
		$pVo->setTelephonePrincipal(trim($pVo->getTelephonePrincipal()));
		$pVo->setTelephoneSecondaire(trim($pVo->getTelephoneSecondaire()));
		$pVo->setAdresse(trim($pVo->getAdresse()));
		$pVo->setCodePostal(trim($pVo->getCodePostal()));
		$pVo->setVille(StringUtils::formaterVille(trim($pVo->getVille())));
		$pVo->setCommentaire(trim($pVo->getCommentaire()));
		
		// Protection des dates vides
		if($pVo->getDateNaissance() == '') {
			$pVo->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pVo->getDateCreation() == '') {
			$pVo->setDateCreation(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pVo->getDateMaj() == '') {
			$pVo->getDateMaj(StringUtils::FORMAT_DATE_NULLE);
		}

		$lRequete =
			"INSERT INTO " . ProducteurManager::TABLE_PRODUCTEUR . "
				(" . ProducteurManager::CHAMP_PRODUCTEUR_ID . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_VILLE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . "
				," . ProducteurManager::CHAMP_PRODUCTEUR_ETAT . ")
			VALUES (NULL
				,'" . StringUtils::securiser( $pVo->getMotPasse() ) . "'
				,'" . StringUtils::securiser( $pVo->getNumero() ) . "'
				,'" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				,'" . StringUtils::securiser( $pVo->getNom() ) . "'
				,'" . StringUtils::securiser( $pVo->getPrenom() ) . "'
				,'" . StringUtils::securiser( $pVo->getCourrielPrincipal() ) . "'
				,'" . StringUtils::securiser( $pVo->getCourrielSecondaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getTelephonePrincipal() ) . "'
				,'" . StringUtils::securiser( $pVo->getTelephoneSecondaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getAdresse() ) . "'
				,'" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
				,'" . StringUtils::securiser( $pVo->getVille() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateNaissance() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				,'" . StringUtils::securiser( $pVo->getDateMaj() ) . "'
				,'" . StringUtils::securiser( $pVo->getCommentaire() ) . "'
				,'" . StringUtils::securiser( $pVo->getEtat() ) . "')";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		
		$lId = Dbutils::executerRequeteInsertRetourId($lRequete); // Execution de la requete et récupération de l'Id généré par la BDD
		$pVo->setId($lId);
		$pVo->setNumero('P' . $lId); // Mise à jour du numéro dans l'objet
		ProducteurManager::update($pVo); // Mise à jour de la base
		return $lId;
	}

	/**
	* @name update($pVo)
	* @param ProducteurVO
	* @desc Met à jour la ligne de la table, correspondant à l'id du ProducteurVO, avec les informations du ProducteurVO
	*/
	public static function update($pVo) {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));

		// Mise en forme des données
		$pVo->setNom(StringUtils::formaterNom(trim($pVo->getNom())));
		$pVo->setPrenom(StringUtils::formaterPrenom(trim($pVo->getPrenom())));
		$pVo->setCourrielPrincipal(trim($pVo->getCourrielPrincipal()));
		$pVo->setCourrielSecondaire(trim($pVo->getCourrielSecondaire()));
		$pVo->setTelephonePrincipal(trim($pVo->getTelephonePrincipal()));
		$pVo->setTelephoneSecondaire(trim($pVo->getTelephoneSecondaire()));
		$pVo->setAdresse(trim($pVo->getAdresse()));
		$pVo->setCodePostal(trim($pVo->getCodePostal()));
		$pVo->setVille(StringUtils::formaterVille(trim($pVo->getVille())));
		$pVo->setCommentaire(trim($pVo->getCommentaire()));
		
		// Protection des dates vides
		if($pVo->getDateNaissance() == '') {
			$pVo->setDateNaissance(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pVo->getDateCreation() == '') {
			$pVo->setDateCreation(StringUtils::FORMAT_DATE_NULLE);
		}
		if($pVo->getDateMaj() == '') {
			$pVo->getDateMaj(StringUtils::FORMAT_DATE_NULLE);
		}
		
		$lRequete = 
			"UPDATE " . ProducteurManager::TABLE_PRODUCTEUR . "
			 SET
				 " . ProducteurManager::CHAMP_PRODUCTEUR_MOT_PASSE . " = '" . StringUtils::securiser( $pVo->getMotPasse() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_NUMERO . " = '" . StringUtils::securiser( $pVo->getNumero() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_ID_COMPTE . " = '" . StringUtils::securiser( $pVo->getIdCompte() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_NOM . " = '" . StringUtils::securiser( $pVo->getNom() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_PRENOM . " = '" . StringUtils::securiser( $pVo->getPrenom() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_PRINCIPAL . " = '" . StringUtils::securiser( $pVo->getCourrielPrincipal() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_COURRIEL_SECONDAIRE . " = '" . StringUtils::securiser( $pVo->getCourrielSecondaire() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_PRINCIPAL . " = '" . StringUtils::securiser( $pVo->getTelephonePrincipal() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_TELEPHONE_SECONDAIRE . " = '" . StringUtils::securiser( $pVo->getTelephoneSecondaire() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_ADRESSE . " = '" . StringUtils::securiser( $pVo->getAdresse() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_CODE_POSTAL . " = '" . StringUtils::securiser( $pVo->getCodePostal() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_VILLE . " = '" . StringUtils::securiser( $pVo->getVille() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_NAISSANCE . " = '" . StringUtils::securiser( $pVo->getDateNaissance() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_CREATION . " = '" . StringUtils::securiser( $pVo->getDateCreation() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_DATE_MAJ . " = '" . StringUtils::securiser( $pVo->getDateMaj() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_COMMENTAIRE . " = '" . StringUtils::securiser( $pVo->getCommentaire() ) . "'
				," . ProducteurManager::CHAMP_PRODUCTEUR_ETAT . " = '" . StringUtils::securiser( $pVo->getEtat() ) . "'
			 WHERE " . ProducteurManager::CHAMP_PRODUCTEUR_ID . " = '" . StringUtils::securiser( $pVo->getId() ) . "'";

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

		$lRequete = "DELETE FROM " . ProducteurManager::TABLE_PRODUCTEUR . "
			WHERE " . ProducteurManager::CHAMP_PRODUCTEUR_ID . " = '" . StringUtils::securiser($pId) . "'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		Dbutils::executerRequete($lRequete);
	}
}
?>