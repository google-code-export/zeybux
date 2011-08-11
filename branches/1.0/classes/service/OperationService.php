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
include_once(CHEMIN_CLASSES_MANAGERS . "HistoriqueOperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "OperationValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php" );
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php");

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
		
		$lId = OperationManager::insert($pOperation); // Ajout de l'opération
		$pOperation->setId($lId);
		$this->insertHistorique($pOperation); // Ajout historique

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
		
		$pOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
		
		$this->insertHistorique($pOperation); // Ajout historique
		
		$lTypeModificationSolde = array(1,2,3,4,7,8,9,10,11,12,13,14);
		if(in_array($pOperation->getTypePaiement(), $lTypeModificationSolde)) {
			$lOperationActuelle = $this->get($pOperation->getId());
			
			$lCompteService = new CompteService(); // Mise à jour du solde
			$lCompte = $lCompteService->get($pOperation->getIdCompte());
			// Si l'operation actuelle impacte le solde
			if(in_array($lOperationActuelle->getTypePaiement(), $lTypeModificationSolde)) {
				$lCompte->setSolde($lCompte->getSolde() - $lOperationActuelle->getMontant() + $pOperation->getMontant());
			} else {
				$lCompte->setSolde($lCompte->getSolde() + $pOperation->getMontant());
			}
			$lCompteService->set($lCompte);
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
		
			$lOperation = $this->get($pId);
			
			// Maj du solde du compte
			$lTypeModificationSolde = array(1,2,3,4,7,8,9,10,11,12,13,14);
			if(in_array($lOperation->getTypePaiement(), $lTypeModificationSolde)) {
				$lCompteService = new CompteService(); // Mise à jour du solde
				$lCompte = $lCompteService->get($lOperation->getIdCompte());
				$lCompte->setSolde($lCompte->getSolde() - $lOperation->getMontant());
				$lCompteService->set($lCompte);
			}
			
			switch($lOperation->getTypePaiement()) {
				case 0 : // Annulation de la reservation
					$lOperation->setTypePaiement(16);
					return $this->update($lOperation);
					break;
					
				case 1 : // Annulation achat/dépot
				case 2 : 
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
					$pOperation->setDate(StringUtils::dateTimeAujourdhuiDb());
					$lOperation->setlibelle("Supression");
					$this->insertHistorique($lOperation); // Ajout historique
					$this->insertHistorique($lDetailOperation); // Ajout historique
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
		$lHistoriqueOperation->setTypePaiementChampComplementaire($pOperation->getTypePaiementChampComplementaire());
		$lHistoriqueOperation->setType($pOperation->getType());
		$lHistoriqueOperation->setIdCommande($pOperation->getIdCommande());
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
	* @desc Retourne une liste de virement
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
		$lOperation = OperationManager::recherche(
				array(OperationManager::CHAMP_OPERATION_ID_COMMANDE,OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
				array('=','=','='),
				array($pIdMarche,$pIdCompteProducteur,5),
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
		return OperationManager::recherche(
			array(OperationManager::CHAMP_OPERATION_ID_COMMANDE,OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
			array('=','=','='),
			array($pIdCommande,$pIdCompte, 6),
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
		return OperationManager::recherche(
				array(OperationManager::CHAMP_OPERATION_ID_COMMANDE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT,OperationManager::CHAMP_OPERATION_MONTANT),
				array('=', '=', '<'),
				array($pId, 0, 0),
				array(''),
				array(''));
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
}
?>