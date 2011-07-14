<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier : VirementService.php
//
// Description : Classe VirementService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_SERVICE . "CompteService.php");
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_MANAGERS . "OperationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "VirementValid.php");

/**
 * @name VirementService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un Virement
 */
class VirementService
{		
	/**
	* @name set($pVirement)
	* @param VirementVO
	* @return integer
	* @desc Ajoute ou modifie un virement
	*/
	public function set($pVirement) {
		$lVirementValid = new VirementValid();
		if($lVirementValid->insert($pVirement)) {
			return $this->insert($pVirement);			
		} else if($lVirementValid->update($pVirement)) {
			return $this->update($pVirement);
		} else {
			return false;
		}
	}
		
	/**
	* @name insert($pVirement)
	* @param VirementVO
	* @return IdVirementVO
	* @desc Ajoute un virement
	*/
	private function insert($pVirement) {
		$lOperationService = new OperationService();	
	
		// Operation de débit
		$lOperationDebit = new OperationVO();
		$lOperationDebit->setIdCompte($pVirement->getCptDebit());
		$lOperationDebit->setMontant($pVirement->getMontant() * -1);
		if($pVirement->getType() == 1) {
			$lOperationDebit->setLibelle("Virement");
			$lOperationDebit->setTypePaiement(3);
		} else if($pVirement->getType() == 2) {			
			$lOperationDebit->setLibelle("Virement Solidaire");
			$lOperationDebit->setTypePaiement(9);
		}		
		$lOperationDebit->setTypePaiementChampComplementaire('');
		$lOperationDebit->setType(1);
		$lOperationDebit->setIdCommande(0);
		$lIdDebit = $lOperationService->set($lOperationDebit);
		
		// Operation de crédit
		$lOperationCredit = new OperationVO();
		$lOperationCredit->setIdCompte($pVirement->getCptCredit());
		$lOperationCredit->setMontant($pVirement->getMontant());
		if($pVirement->getType() == 1) {
			$lOperationCredit->setLibelle("Virement");
			$lOperationCredit->setTypePaiement(4);
		} else if($pVirement->getType() == 2) {			
			$lOperationCredit->setLibelle("Virement Solidaire");
			$lOperationCredit->setTypePaiement(10);
		}				
		$lOperationCredit->setTypePaiementChampComplementaire($lIdDebit);
		$lOperationCredit->setType(1);
		$lOperationCredit->setIdCommande(0);
		
		$lIdCredit = $lOperationService->set($lOperationCredit);
		
		// Maj Operation de débit
		$lOperationDebit->setId($lIdDebit);
		$lOperationDebit->setTypePaiementChampComplementaire($lIdCredit);
		$lOperationService->set($lOperationDebit);
		
		$pIdVirement = new IdVirementVO();
		$pIdVirement->setIdDebit($lIdDebit);
		$pIdVirement->setIdCredit($lIdCredit);
    	return $pIdVirement;
	}
	
	/**
	* @name update($pVirement)
	* @param VirementVO
	* @return IdVirementVO
	* @desc Mise à jour d'un virement
	*/
	private function update($pVirement) {
		$lIdVirementValid = new IdVirementValid();

		// Si il n'y a qu'un des deux id donné on recherche l'id correspondant
		if(	!$lIdVirementValid->estDebit($pVirement->getId()->getIdDebit()) ||
			!$lIdVirementValid->estCredit($pVirement->getId()->getIdCredit()) ) {				
				$pVirement->setId($this->getIdVirement($pVirement)->getId());
		}
		
		$lVirement = $this->get($pVirement->getId()->getIdDebit());
		$this->delete($lVirement->getId());
		$lVirement->setMontant($pVirement->getMontant());
		return $this->insert($lVirement);
	}
	
	/**
	* @name delete($pId)
	* @param IdVirementVO
	* @return IdVirementVO
	* @desc Supprime un virement
	*/
	public function delete($pId) {
		$lVirementValid = new VirementValid();
		if($lVirementValid->delete($pId)) {
			$lOperationService = new OperationService();
			// Créer une opération (débit Annulation)
			$lOperationDebit = $lOperationService->get($pId->getIdDebit());
			
			// Mise au statut d'annulation du virement initial
			$lOperationDebit->setTypePaiement($this->getTypeAnnulation($lOperationDebit->getTypePaiement()));
			$lOperationService->set($lOperationDebit);
						
			$lOperationDebit->setId('');
    		$lOperationDebit->setMontant($lOperationDebit->getMontant() * -1);
			$lOperationDebit->setLibelle("Annulation Virement");
			$lOperationService->set($lOperationDebit);
   
			// Créer une opération (crédit Annulation)
			$lOperationCredit = $lOperationService->get($pId->getIdCredit());
			
			// Mise au statut d'annulation du virement initial
			$lOperationCredit->setTypePaiement($this->getTypeAnnulation($lOperationCredit->getTypePaiement()));
			$lOperationService->set($lOperationCredit);
			
			$lOperationCredit->setId('');
    		$lOperationCredit->setMontant($lOperationCredit->getMontant() * -1);
			$lOperationCredit->setLibelle("Annulation Virement");
			$lOperationService->set($lOperationCredit);
			
			// Les Id sont inversés
			$pIdVirement = new IdVirementVO();
			$pIdVirement->setIdDebit($lOperationCredit->getId());
			$pIdVirement->setIdCredit($lOperationDebit->getId());
	    	return $pIdVirement;
			
		} else {
			return false;
		}
	}
	
	/**
	* @name getTypeAnnulation($pType)
	* @param integer
	* @return integer
	* @desc retourne le type correpondant à l'annulation
	*/
	private function getTypeAnnulation($pType) {
		switch($pType) {
			case 3:
				return 11;
				break;
				
			case 4:
				return 12;
				break;
				
			case 9:
				return 13;
				break;
				
			case 10:
				return 14;
				break;
		}
	}
	
	/**
	* @name getIdVirement($pVirement)
	* @param VirementVO
	* @return VirementVO ou false en erreur
	* @desc Complète l'id du VirementVO en peramètre
	*/
	public function getIdVirement($pVirement) {		
		$lIdVirementValid = new IdVirementValid();
		if(	$lIdVirementValid->estDebit($pVirement->getId()->getIdDebit()) ) {
			$lOperationService = new OperationService();
			$lOperation = $lOperationService->get($pVirement->getId()->getIdDebit());
			$pVirement->getId()->setIdCredit($lOperation->getTypePaiementChampComplementaire());
			return $pVirement;			
		} else if ($lIdVirementValid->estCredit($pVirement->getId->getIdCredit()) ) {
			$lOperationService = new OperationService();			
			$lOperation = $lOperationService->get($pVirement->getId->getIdCredit);
			$pVirement->getId()->setIdDebit($lOperation->getTypePaiementChampComplementaire());
			return $pVirement;			
		} else {
			return false;			
		}	
	}
	
	/**
	* @name get($pId)
	* @param integer
	* @return array(VirementVO) ou false en erreur
	* @desc Retourne une liste de virement
	*/
	public function get($pId = null) {
		if($pId != null) {
			return $this->select($pId);
		} else {
			return false;
		}
	}

	/**
	* @name select($pId)
	* @param integer
	* @return VirementVO ou false en erreur
	* @desc Retourne un virement
	*/
	private function select($pId) {		
		$lOperation = OperationManager::select($pId);
		$lOperationSoeur = OperationManager::select($lOperation->getTypePaiementChampComplementaire());		
		
		$lVirement = new VirementVO();
		$lIdVirement = new IdVirementVO();
		$lVirement->setId($lIdVirement);
		switch($lOperation->getTypePaiement()) {
			case 3:				
				$lVirement->getId()->setIdDebit($pId);
				$lVirement->getId()->setIdCredit($lOperationSoeur->getId());
				$lVirement->setCptDebit($lOperation->getIdCompte());
				$lVirement->setCptCredit($lOperationSoeur->getIdCompte());
				$lVirement->setMontant($lOperation->getMontant() * -1);
				$lVirement->setType(1);				
				break;
				
			case 4:				
				$lVirement->getId()->setIdDebit($lOperationSoeur->getId());
				$lVirement->getId()->setIdCredit($pId);
				$lVirement->setCptDebit($lOperationSoeur->getIdCompte());
				$lVirement->setCptCredit($lOperation->getIdCompte());
				$lVirement->setMontant($lOperation->getMontant());
				$lVirement->setType(1);				
				break;
				
			case 9:
				$lVirement->getId()->setIdDebit($pId);
				$lVirement->getId()->setIdCredit($lOperationSoeur->getId());
				$lVirement->setCptDebit($lOperation->getIdCompte());
				$lVirement->setCptCredit($lOperationSoeur->getIdCompte());
				$lVirement->setMontant($lOperation->getMontant() * -1);
				$lVirement->setType(2);				
				break;
				
			case 10:				
				$lVirement->getId()->setIdDebit($lOperationSoeur->getId());
				$lVirement->getId()->setIdCredit($pId);
				$lVirement->setCptDebit($lOperationSoeur->getIdCompte());
				$lVirement->setCptCredit($lOperation->getIdCompte());
				$lVirement->setMontant($lOperation->getMontant());
				$lVirement->setType(2);				
				break;
		}		
		return $lVirement;
	}

	/**
	* @name getByCompte($pCpt,$pType)
	* @param integer
	* @param integer
	* @return array(OperationVO) ou false en erreur
	* @desc Retourne une liste de virement
	*/
	public function getByCompte($pCpt = null,$pType = null) {
		if($pCpt != null) {
			return $this->selectByCompte($pCpt,$pType);
		} else {
			return $this->selectByCompteAll($pType);
		}
	}
	
	/**
	* @name selectByCompte($pCpt,$pType)
	* @param integer
	* @param integer
	* @return array(OperationVO) ou false en erreur
	* @desc Retourne une liste de virement
	*/
	private function selectByCompte($pCpt,$pType = null) {
		$lCompteService = new CompteService();
		if($lCompteService->existe($pCpt)) {
			if($pType != null) {
				$lVirementValid = new VirementValid();
				if($lVirementValid->typeVirement($pType)) {			
					return OperationManager::recherche(
						array(OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
						array('=','='),
						array($pCpt, $pType),
						array(OperationManager::CHAMP_OPERATION_DATE),
						array('DESC'));
				} else {
					return false;
				}
			} else {
				return OperationManager::recherche(
					array(OperationManager::CHAMP_OPERATION_ID_COMPTE,OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
					array('=','in'),
					array($pCpt, array(3,4,9,10)),
					array(OperationManager::CHAMP_OPERATION_DATE),
					array('DESC'));
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name selectByCompteAll($pType)
	* @param integer
	* @return array(OperationVO) ou false en erreur
	* @desc Retourne l'ensemble des virements
	*/
	private function selectByCompteAll($pType = null) {
		if($pType != null) {
			$lVirementValid = new VirementValid();
			if($lVirementValid->typeVirement($pType)) {			
				return OperationManager::recherche(
					array(OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
					array('='),
					array( $pType),
					array(OperationManager::CHAMP_OPERATION_DATE),
					array('DESC'));
			} else {
				return false;
			}
		} else {
			return OperationManager::recherche(
				array(OperationManager::CHAMP_OPERATION_TYPE_PAIEMENT),
				array('in'),
				array(array(3,4,9,10)),
				array(OperationManager::CHAMP_OPERATION_DATE),
				array('DESC'));
		}
	}
}
?>