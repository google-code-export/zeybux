<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : OperationService.php
//
// Description : Classe OperationService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationChampComplementaireManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueOperationManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "InfoOperationLivraisonManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "TypePaiementChampComplementaireManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "OperationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");
include_once(CHEMIN_CLASSES_VO . "CompteZeybuOperationVO.php");

/**
 * @name OperationService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un Operation
 */
class OperationService
{		
	/**
	* @name set($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Ajoute ou modifie une opération
	*/
	public function set($pOperation) {
		$lOperationValid = new OperationValid();
		if($lOperationValid->insert($pOperation)) {
			return $this->insert($pOperation);			
		} else if($lOperationValid->update($pOperation)) {
			return $this->update($pOperation);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Ajoute une opération
	*/
	private function insert($pOperation) {
		
		$pOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
		$pOperation->setIdLogin($_SESSION[DROIT_ID]);
		
		$lId = OperationManager::insert($pOperation); // Ajout de l'opération
		$pOperation->setId($lId);
		$this->insertHistorique($pOperation); // Ajout historique

		// Ajout du champ complementaire
		$lChampComplementaire = $pOperation->getChampComplementaire();
		if(!empty($lChampComplementaire)) {
			foreach($pOperation->getChampComplementaire() as $lChamp) {
				$lChamp->setOpeId($lId);
			}
			OperationChampComplementaireManager::insert($pOperation->getChampComplementaire());
		}
		// Selon le type on met à jour le solde du compte
		$lTypeModificationSolde = array(1,2,3,4,7,8,9,10,11,12,13,14);
		if(in_array($pOperation->getTypePaiement(), $lTypeModificationSolde)) {
			$lCompteService = new CompteService(); // Mise à jour du solde
			$lCompte = $lCompteService->get($pOperation->getIdCompte());
			$lCompte->setSolde($lCompte->getSolde() + $pOperation->getMontant());
			$lCompteService->set($lCompte);
		}
		return $lId;
	}
	
	/**
	* @name update($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Met à jour une opération
	*/
	private function update($pOperation) {
		
		$pOperation->setDateMaj(StringUtils::dateTimeAujourdhuiDb());
		$pOperation->setIdLogin($_SESSION[DROIT_ID]);
		
		$this->insertHistorique($pOperation); // Ajout historique
		
		$lTypeModificationSolde = array(1,2,3,4,7,8,9,10,11,12,13,14);
		if(in_array($pOperation->getTypePaiement(), $lTypeModificationSolde)) {
			$lOperationActuelle = $this->get($pOperation->getId());			
			
			// Dans le cas la réservation devient achat. La date de création doit être mise à jour.
			if($lOperationActuelle->getTypePaiement() == 0 && $pOperation->getTypePaiement() == 7) {
				$pOperation->setDate($pOperation->getDateMaj());
			}
			
			// Mise à jour du solde
			$lCompteService = new CompteService(); 
			$lCompte = $lCompteService->get($pOperation->getIdCompte());
			// Si l'operation actuelle impacte le solde
			if(in_array($lOperationActuelle->getTypePaiement(), $lTypeModificationSolde)) {
				$lCompte->setSolde($lCompte->getSolde() - $lOperationActuelle->getMontant() + $pOperation->getMontant());
			} else {
				$lCompte->setSolde($lCompte->getSolde() + $pOperation->getMontant());
			}
			$lCompteService->set($lCompte);
		}
		// Maj des champs complémentaires
		// Suppression des champs complementaires
		OperationChampComplementaireManager::deleteByIdOpe($pOperation->getId());
		// Ajout des champs complementaires
		$lChampComplementaire = $pOperation->getChampComplementaire();
		if(!empty($lChampComplementaire)) {
			// Vérifie si le champ est autorisé en modification
			$lChampAutorise = TypePaiementChampcomplementaireManager::champAutoriseMaj($pOperation->getTypePaiement());
			$lChampAjout = array();
			foreach($pOperation->getChampComplementaire() as $lChamp) {
				if(in_array($lChamp->getChcpId(), $lChampAutorise)) {
					$lChamp->setOpeId($pOperation->getId());
					array_push($lChampAjout,$lChamp);
				}
			}
			if(!empty($lChampAjout)) {
				OperationChampComplementaireManager::insert($lChampAjout);
			}
		}
		
		// Si c'est un paiement de facture de producteur il faut mettre à jour les paiements associés
		$lOperationChampComplementaireFacture = OperationChampComplementaireManager::recherche(
				array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR), 
				array('=','='), 
				array(9,$pOperation->getId()),
				array(), array());
		
		if(!is_null($lOperationChampComplementaireFacture[0]->getOpeId())) {
			$lMontant = $pOperation->getMontant();
			
			// Maj de l'operation de facture
			$lOperationFacture = $this->getDetail($lOperationChampComplementaireFacture[0]->getOpeId());
			$lOperationFacture->setMontant($lMontant);
			$this->set($lOperationFacture);
			
			// Maj de l'operation zeybu
			$lOpeFacChampComp = $lOperationFacture->getChampComplementaire();
			if(isset($lOpeFacChampComp[10])) {
				$lOperationZeybu = $this->getDetail($lOpeFacChampComp[10]->getValeur());
				
				$lOperationZeybu->setMontant(-1 * $lMontant);
				$lOperationZeybu->setTypePaiement($pOperation->getTypePaiement());
				$lOperationZeybu->setChampComplementaire($pOperation->getChampComplementaire());
				$this->set($lOperationZeybu);
			}
		}
				
		return OperationManager::update($pOperation); // update de l'opération
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Met à jour une opération
	*/
	public function delete($pId) {
		$lOperationValid = new OperationValid();
		
		if($lOperationValid->delete($pId)){			
		
			$lOperation = $this->getDetail($pId);
			// Maj du solde du compte
			$lTypeModificationSolde = array(1,2,3,4,7,8,9,10,11,12,13,14);
			if(in_array($lOperation->getTypePaiement(), $lTypeModificationSolde)) {
				$lCompteService = new CompteService(); // Mise à jour du solde
				$lCompte = $lCompteService->get($lOperation->getIdCompte());
				$lCompte->setSolde($lCompte->getSolde() - $lOperation->getMontant());
				$lCompteService->set($lCompte);
			}
			
			// Si c'est un paiement de facture de producteur il faut mettre à jour les paiements associés
			$lOperationChampComplementaireFacture = OperationChampComplementaireManager::recherche(
					array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR),
					array('=','='),
					array(9,$pId),
					array(), array());
							
			if(!is_null($lOperationChampComplementaireFacture[0]->getOpeId())) {
				// Suppression de l'operation de facture
				$lOperationFacture = $this->getDetail($lOperationChampComplementaireFacture[0]->getOpeId());
				$this->delete($lOperationFacture->getId());	
				
				// Suppression de l'operation zeybu
				$lOpeFacChampComp = $lOperationFacture->getChampComplementaire();
				$this->delete($lOpeFacChampComp[10]->getValeur());
			}
			
			switch($lOperation->getTypePaiement()) {
				case 0 : // Annulation de la reservation
				case 22 :
					$lOperation->setTypePaiement(16);
					return $this->update($lOperation);
					break;
					
				case 1 : // Annulation achat/dépot
				case 2 : 
				case 6 : 
					$lOperation->setTypePaiement(18);
					return $this->update($lOperation);
					break;
					
				case 7 : 
					$lOperation->setTypePaiement(18);
					return $this->update($lOperation);
					break;
					
				case 8 : 
					$lOperation->setTypePaiement(20);
					return $this->update($lOperation);
					break;
					
				default:
					$lOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lOperation->setlibelle("Supression");
					$this->insertHistorique($lOperation); // Ajout historique
					//$this->insertHistorique($lDetailOperation); // Ajout historique
					return OperationManager::delete($pId); // delete de l'opération	
					break;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insertHistorique($pOperation)
	* @param OperationVO
	* @return integer
	* @desc Insère une nouvelle ligne dans la table, à partir des informations de la OperationVO en paramètre (l'id sera automatiquement calculé par la BDD)
	*/
	private function insertHistorique($pOperation) {
		$lHistoriqueOperation = new HistoriqueOperationVO();
		$lHistoriqueOperation->setIdOperation($pOperation->getId());
		$lHistoriqueOperation->setIdCompte($pOperation->getIdCompte());
		$lHistoriqueOperation->setMontant($pOperation->getMontant());
		$lHistoriqueOperation->setLibelle($pOperation->getLibelle());
		$lHistoriqueOperation->setDate($pOperation->getDate());
		$lHistoriqueOperation->setTypePaiement($pOperation->getTypePaiement()	);
		$lHistoriqueOperation->setType($pOperation->getType());
		$lHistoriqueOperation->setIdConnexion($_SESSION[ID_CONNEXION]);
		return HistoriqueOperationManager::insert($lHistoriqueOperation);
	}
	
	/**
	* @name existe($pOperation)
	* @param OperationVO ou interger
	* @return bool
	* @desc Vérifie si l'Operation existe
	*/
	public function existe($pOperation) {
		$lOperationValid = new OperationValid();
		if(	is_object($pOperation) && $lOperationValid->estOperation($pOperation)) {
			$lOperation = $this->get($pOperation);
			if($lOperation->getId() == $pOperation->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_int((int)$pOperation)){
			if($lOperationValid->id($pOperation)) {
				$lOperation = $this->get($pOperation);
				if($lOperation->getId() == $pOperation) {
					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name get($pId)
	* @param integer
	* @return array(OperationVO) ou OperationVO
	* @desc Retourne une liste d'operation
	*/
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return OperationVO
	* @desc Retourne une Operation
	*/
	public function select($pId) {
		return OperationManager::select($pId);
	}
	
	/**
	* @name selectAll()
	* @return array(OperationVO)
	* @desc Retourne une liste d'Operation
	*/
	public function selectAll() {
		return OperationManager::selectAll();
	}
	
	/**
	 * @name getDetail($pId)
	 * @param integer
	 * @return array(OperationDetailVO) ou OperationDetailVO
	 * @desc Retourne une liste d'operation avec le détail
	 */
	public function getDetail($pId = null) {
		return OperationManager::selectDetail($pId);
	}
	
	/**
	 * @name getByArray($pId)
	 * @param array(integer)
	 * @return array(OperationDetailVO)
	 * @desc Retourne une liste d'operation
	 */
	public function getByArray($pId) {
		return OperationManager::recherche(
				array(OperationManager::CHAMP_OPERATION_ID),
				array('in'),
				array($pId),
				array(''),
				array(''));
	}
	
	/**
	* @name selectByCompte($pIdCompte)
	* @param integer
	* @return array(OperationVO)
	* @desc Retourne une liste d'Operation
	*/
	public function selectByCompte($pIdCompte) {
		$lOperation = OperationManager::recherche(
				array(OperationManager::CHAMP_OPERATION_ID_COMPTE),
				array('='),
				array($pIdCompte),
				array(''),
				array(''));
				
		return $lOperation;
	}
	
	/**
	* @name getBonCommande($pIdMarche,$pIdCompteProducteur)
	* @param integer
	* @return array(OperationVO)
	* @desc Retourne une liste d'Operation
	*/
	public function getBonCommande($pIdMarche,$pIdCompteProducteur) {
		$lOperation = OperationManager::rechercheDetail(
				array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR, OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
				array('=','=','=','='),
				array(1, $pIdMarche,$pIdCompteProducteur,5),
				array(''),
				array(''));
				
		return $lOperation;
	}
	
	/**
	* @name getBonLivraison($pIdCompte, $pIdCommande)
	* @param integer
	* @param integer
	* @return array(OperationVO)
	* @desc Récupères toutes les lignes de la table ayant pour IdCompte $pId, IdCommande $pIdCommande et de type 0 ou 1. Puis les renvoie sous forme d'une collection de OperationVO
	*/
	public static function getBonLivraison($pIdCommande,$pIdCompte) {
		return OperationManager::rechercheDetail(
			array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR,OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
			array('=','=','=','='),
			array(1, $pIdCommande,$pIdCompte, 6),
			array(''),
			array(''));
	}
	
	/**
	* @name getReservationCommande($pId)
	* @param integer
	* @return array(OperationVO)
	* @desc Récupères toutes les reservations de la table ayant pour IdCommande $pId et les renvoie sous forme d'une collection de OperationVO
	*/
	public static function getReservationCommande($pId) {		
		return OperationManager::rechercheDetail(
				array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT,OperationManager::CHAMP_OPERATION_MONTANT),
				array('=', '=', '=', '<'),
				array(1, $pId, 0, 0),
				array(''),
				array(''));
	}
	
	/**
	 * @name getByIdrequete($pId)
	 * @param varchar
	 * @return array(OperationVO)
	 * @desc Récupères toutes les operations de la table ayant pour IdRequete $pId et les renvoie sous forme d'une collection de OperationVO
	 */
	public static function getByIdrequete($pId) {
		return OperationManager::rechercheDetail(
				array(OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_CHCP_ID, OperationChampComplementaireManager::CHAMP_OPERATIONCHAMPCOMPLEMENTAIRE_VALEUR),
				array('=', '='),
				array(15, $pId),
				array(''),
				array(''));
	}
	
	/**
	 * @name getOperationRechargementSurMarche($pIdCompte, $pIdMarche)
	 * @param int(11) Id Compte
	 * @param int(11) Id Marche
	 * @return array(OperationVO)
	 * @desc Récupères toutes les operations de la table ayant pour IdCompte $pIdCompte et Id Marche $pIdMarcheet les renvoie sous forme d'une collection de OperationVO
	 */
	public static function getOperationRechargementSurMarche($pIdCompte, $pIdMarche) {
		return OperationManager::selectOperationRechargementSurMarche($pIdCompte, $pIdMarche);
	}
	
	/**
	* @name getSoldeCaisse()
	* @return decimal(10,2)
	* @desc Retourne le solde de la caisse
	*/
	public static function getSoldeCaisse() {	
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
		$lRequete =
			"SELECT sum(" . OperationManager::CHAMP_OPERATION_MONTANT . ") AS " . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . OperationManager::TABLE_OPERATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = '1'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return $lLigne[OperationManager::CHAMP_OPERATION_MONTANT];
		} else {
			return NULL;
		}
	}
	
	/**
	* @name getSoldeBanque()
	* @return decimal(10,2)
	* @desc Retourne le solde en Banque
	*/
	public static function getSoldeBanque() {	
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
		$lRequete =
			"SELECT sum(" . OperationManager::CHAMP_OPERATION_MONTANT . ") AS " . OperationManager::CHAMP_OPERATION_MONTANT . "
			FROM " . OperationManager::TABLE_OPERATION . " 
			WHERE " . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = '2'";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);

		if( mysql_num_rows($lSql) > 0 ) {
			$lLigne = mysql_fetch_assoc($lSql);
			return $lLigne[OperationManager::CHAMP_OPERATION_MONTANT];
		} else {
			return NULL;
		}
	}
	
	/**
	* @name selectOperationZeybu()
	* @return array(OperationVO)
	* @desc Retourne la liste des opérations du zeybu
	*/
	/*public function selectOperationZeybu() {
		// Initialisation du Logger
		$lLogger = &Log::singleton('file', CHEMIN_FICHIER_LOGS);
		$lLogger->setMask(Log::MAX(LOG_LEVEL));
			
		$lRequete =
			"(
				SELECT
					ope1." . OperationManager::CHAMP_OPERATION_ID  . " AS " . OperationManager::CHAMP_OPERATION_ID . ",
					ope1." . OperationManager::CHAMP_OPERATION_DATE . " AS " . OperationManager::CHAMP_OPERATION_DATE . ",
					" . CompteManager::CHAMP_COMPTE_LABEL . " AS " . CompteManager::CHAMP_COMPTE_LABEL . ",
					ope1." . OperationManager::CHAMP_OPERATION_LIBELLE . " AS " . OperationManager::CHAMP_OPERATION_LIBELLE . ",
					ope1." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT . ",
					" . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . " AS " . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . "
				FROM " . OperationManager::TABLE_OPERATION . " ope1 
				LEFT JOIN " . OperationManager::TABLE_OPERATION . " ope2 ON ope1." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . " = ope2." . OperationManager::CHAMP_OPERATION_ID . "
				LEFT JOIN " . CompteManager::TABLE_COMPTE . " ON ope2." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . CompteManager::CHAMP_COMPTE_ID . "
				JOIN " . TypePaiementManager::TABLE_TYPEPAIEMENT . " ON ope1." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = " . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . "
				
				WHERE ope1." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = '-1'
					AND ope1." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " in (1,2,3,4,7,8,9,10) 
					AND ope1." . OperationManager::CHAMP_OPERATION_ID  . " NOT IN ( 
						SELECT " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . "
						FROM " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . " )
			)
				
			UNION
				
			(
				SELECT 
					LIVRAISON." . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . " AS " . OperationManager::CHAMP_OPERATION_ID . ",
					ope3." . OperationManager::CHAMP_OPERATION_DATE . " AS " . OperationManager::CHAMP_OPERATION_DATE . ",
						" . CompteManager::CHAMP_COMPTE_LABEL . " AS " . CompteManager::CHAMP_COMPTE_LABEL . ",
					`ope3`." . OperationManager::CHAMP_OPERATION_LIBELLE . " AS " . OperationManager::CHAMP_OPERATION_LIBELLE . ",
					`ope3`." . OperationManager::CHAMP_OPERATION_MONTANT . " AS " . OperationManager::CHAMP_OPERATION_MONTANT . ",
					" . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . " AS " . TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE . "				
				FROM " . OperationManager::TABLE_OPERATION . " ope3
				JOIN (
					SELECT 
						" . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . ",
						ope4." . OperationManager::CHAMP_OPERATION_ID_COMPTE . "
					FROM " . OperationManager::TABLE_OPERATION . " ope4
					JOIN " . InfoOperationLivraisonManager::TABLE_INFOOPERATIONLIVRAISON . " ON ope4." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT_CHAMP_COMPLEMENTAIRE . " = " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID . "
					WHERE ope4." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = 6 ) LIVRAISON ON ope3." . OperationManager::CHAMP_OPERATION_ID . " = LIVRAISON. " . InfoOperationLivraisonManager::CHAMP_INFOOPERATIONLIVRAISON_ID_OPE_ZEYBU . "
				
				LEFT JOIN " . CompteManager::TABLE_COMPTE . " on LIVRAISON." . OperationManager::CHAMP_OPERATION_ID_COMPTE . " = " . CompteManager::TABLE_COMPTE . "." . CompteManager::CHAMP_COMPTE_ID . "
				JOIN  " . TypePaiementManager::TABLE_TYPEPAIEMENT . " ON ope3." . OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT . " = " . TypePaiementManager::CHAMP_TYPEPAIEMENT_ID . "
			)
			ORDER BY `ope_date` desc";

		$lLogger->log("Execution de la requete : " . $lRequete,PEAR_LOG_DEBUG); // Maj des logs
		$lSql = Dbutils::executerRequete($lRequete);
		
		$lListeCompteZeybuOperation = array();
		if( mysql_num_rows($lSql) > 0 ) {
			while ($lLigne = mysql_fetch_assoc($lSql)) {
				array_push($lListeCompteZeybuOperation,
					$this->remplirOperationCompteZeybu(
					$lLigne[OperationManager::CHAMP_OPERATION_ID],
					$lLigne[OperationManager::CHAMP_OPERATION_DATE],
					$lLigne[CompteManager::CHAMP_COMPTE_LABEL],
					$lLigne[OperationManager::CHAMP_OPERATION_LIBELLE],
					$lLigne[OperationManager::CHAMP_OPERATION_MONTANT],
					$lLigne[TypePaiementManager::CHAMP_TYPEPAIEMENT_TYPE]));
			}
		} else {
			$lListeCompteZeybuOperation[0] = new CompteZeybuOperationVO();
		}
		return $lListeCompteZeybuOperation;
	}*/
	
	/**
	 * @name rechercheOperationZeybu($pDateDebut, $pDateFin, $pIdMarche) 
	 * @return array(CompteZeybuOperationVO)
	 * @desc Retourne une liste d'operation
	 */
	public function rechercheOperationZeybu($pDateDebut = null, $pDateFin = null, $pIdMarche = null) {	
		return OperationManager::rechercheOperationZeybu($pDateDebut, $pDateFin, $pIdMarche);
	}
	
	
	/**
	 * @name rechercheOperationAssociation($pDateDebut, $pDateFin)
	 * @return array(CompteZeybuOperationVO)
	 * @desc Retourne une liste d'operation
	 */
	public function rechercheOperationAssociation($pDateDebut = null, $pDateFin = null) {
		return OperationManager::rechercheOperationAssociation($pDateDebut, $pDateFin);
	}
	
		
	/**
	* @name validerPaiement($pId)
	* @param int(11)
	* @desc Passe une operation au statut validé
	*/
	public function validerPaiement($pId) {		
		$lOperation = $this->getDetail($pId);
		$lOperation->setType(1);
		$this->update($lOperation);
	}
	
	/**
	 * @name validerPaiementByArray($pId)
	 * @param array(int(11))
	 * @desc Passe les operations au statut validé
	 */
	public function validerPaiementByArray($pId) {
		OperationManager::validerByArray($pId);
	}
	
	/**
	* @name getListeEspeceAdherentNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations espèce non validées pour les comptes adhérents et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeEspeceAdherentNonEnregistre() {		
		return OperationManager::operationAttenteAdherent(1);
	}
	
	/**
	* @name getListeChequeAdherentNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations chèque non validées pour les comptes adhérents et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeChequeAdherentNonEnregistre() {				
		return OperationManager::operationAttenteAdherent(2);
	}
	
	/**
	* @name getListeEspeceInviteNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations espèce non validées pour le compte invité de la table et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeEspeceInviteNonEnregistre() {		
		return OperationManager::operationAttenteInvite(1);
	}
	
	/**
	* @name getListeChequeInviteNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations chèque non validées pour le compte invité de la table et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeChequeInviteNonEnregistre() {				
		return OperationManager::operationAttenteInvite(2);
	}
		
	/**
	* @name getListeEspeceFermeNonEnregistre()
	* @return array(OperationAttenteFermeVO)
	* @desc Récupères toutes les opérations espèce non validées pour les comptes fermes et les renvoie sous forme d'une collection de OperationAttenteFermeVO
	*/
	public static function getListeEspeceFermeNonEnregistre() {		
		return OperationManager::operationAttenteFerme(1);
	}
	
	/**
	* @name getListeChequeFermeNonEnregistre()
	* @return array(OperationAttenteFermeVO)
	* @desc Récupères toutes les opérations chèque non validées pour les comptes fermes et les renvoie sous forme d'une collection de OperationAttenteFermeVO
	*/
	public static function getListeChequeFermeNonEnregistre() {		
		return OperationManager::operationAttenteFerme(2);
	}
	
	/**
	 * @name getOperationAvenir($pIdCompte)
	 * @param integer
	 * @return array(OperationAvenirViewVO)
	 * @desc Retourne les opérations avenir pour un compte
	 */
	public function getOperationAvenir($pIdCompte) {
		return OperationManager::selectOperationAvenir( $pIdCompte );
	}
	
	/**
	 * @name getOperationPassee($pIdCompte)
	 * @param integer
	 * @return array(OperationPasseeViewVO)
	 * @desc Retourne les opérations passées d'un compte
	 */
	public function getOperationPassee($pIdCompte) {
		return OperationManager::selectOperationPassee( $pIdCompte );
	}
	
	/**
	* @name getListeEspeceAssociationNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations espèce non validées pour les comptes adhérents et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeEspeceAssociationNonEnregistre() {		
		return OperationManager::operationAttenteAssociation(1);
	}
	
	/**
	* @name getListeChequeAssociationNonEnregistre()
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations chèque non validées pour les comptes adhérents et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeChequeAssociationNonEnregistre() {				
		return OperationManager::operationAttenteAssociation(2);
	}
	
	/**
	* @name getListeEspeceCaisse($pIdMarche)
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations espèce du marché et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeEspeceCaisse($pIdMarche) {		
		return OperationManager::operationMarche($pIdMarche, 1);
	}
	
	/**
	* @name getListeChequeCaisse($pIdMarche)
	* @return array(OperationAttenteAdherentVO)
	* @desc Récupères toutes les opérations chèque du marché et les renvoie sous forme d'une collection de OperationAttenteAdherentVO
	*/
	public static function getListeChequeCaisse($pIdMarche) {				
		return OperationManager::operationMarche($pIdMarche, 2);
	}
}
?>