<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 26/06/2011
// Fichier :CompteService.php
//
// Description : Classe CompteService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "CompteManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "AdherentManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "CompteValid.php" );
include_once(CHEMIN_CLASSES_SERVICE . "OperationService.php");
include_once(CHEMIN_CLASSES_UTILS . "StringUtils.php" );

/**
 * @name CompteService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un Compte
 */
class CompteService
{	
	/**
	* @name set($pCompte)
	* @param CompteVO
	* @return integer
	* @desc Ajoute ou modifie un compte
	*/
	public function set($pCompte) {
		$lCompteValid = new CompteValid();
		if($lCompteValid->insert($pCompte)) {
			return $this->insert($pCompte);			
		} else if($lCompteValid->update($pCompte)) {
			return $this->update($pCompte);
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pCompte)
	* @param CompteVO
	* @return CompteVO
	* @desc Ajoute un compte
	*/
	private function insert($pCompte) {		
		$lId = CompteManager::insert($pCompte);
		// Le label est l'id du compte par défaut
		$pCompte->setId($lId);
		$pCompte->setLabel('C' . $lId);
		$this->update($pCompte);
		
		// Initialisation du compte
		$lOperation = new OperationDetailVO();
		$lOperation->setIdCompte($lId);
		$lOperation->setMontant(0);
		$lOperation->setLibelle("Création du compte");
		$lOperation->setDate(StringUtils::dateAujourdhuiDb());
		$lOperation->setTypePaiement(-1);
		
		$lOperationService = new OperationService();
		$lOperationService->set($lOperation);
		
		return $pCompte;
	}
	
	/**
	* @name update($pCompte)
	* @param CompteVO
	* @return integer
	* @desc Met à jour un compte
	*/
	private function update($pCompte) {		
		return CompteManager::update($pCompte);
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime un compte
	*/
	public function delete($pId) {
		$lOperationValid = new OperationValid();
		if($lOperationValid->delete($pId)){			
			return CompteManager::delete($pId); // delete le compte	
		} else {
			return false;
		}
	}
	
	/**
	* @name existe($pCompte)
	* @param CompteVO ou String
	* @return bool
	* @desc Vérifie si le compte existe
	*/
	public function existe($pCompte) {
		if(	is_object($pCompte) && CompteValid::estCompte($pCompte)) {
			$lCompte = $this->get($pCompte);
			if($lCompte->getId() == $pCompte->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_int((int)$pCompte)) {
			$lCompte = $this->get((int)$pCompte);
			if($lCompte->getId() == $pCompte) {
				return true;
			} else {
				return false;
			}
		} else if(is_string($pCompte)){
			$lCompte = $this->get($pCompte);
			if($lCompte->getLabel() == $pCompte) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
			
	/**
	* @name get($pId)
	* @param integer
	* @return array(CompteVO) ou CompteVO
	* @desc Retourne une liste de compte
	*/
	public function get($pId = null) {
		if($pId != null) {
			if(is_int((int)$pId)) {
				return $this->select($pId);
			} else if(is_string($pId)) {
				return $this->selectByLabel($pId);
			} else {
				return false;
			}
		} else {
			return $this->selectAll();
		}
	}
	
	/**
	* @name select($pId)
	* @param integer
	* @return CompteVO
	* @desc Retourne un compte
	*/
	public function select($pId) {
		return CompteManager::select($pId);
	}
	
	/**
	* @name selectByLabel($pLabel)
	* @param string
	* @return CompteVO
	* @desc Retourne un compte
	*/
	public function selectByLabel($pLabel) {
		$lCompte = CompteManager::recherche(
				array(CompteManager::CHAMP_COMPTE_LABEL),
				array('='),
				array($pLabel),
				array(''),
				array(''));
				
		return $lCompte[0];
	}
	
	/**
	* @name selectAll()
	* @return array(CompteVO)
	* @desc Retourne une liste de compte
	*/
	public function selectAll() {
		return CompteManager::selectAll();
	}
	
	/**
	 * @name getNombreAdherentSurCompte($pId)
	 * @param integer
	 * @return integer
	 * @desc Retourne le nombre d'adhérent sur le compte
	 */
	public function getNombreAdherentSurCompte($pId) {
		$lTabAdherent = AdherentManager::selectActifByIdCompte($pId);
		if($lTabAdherent[0]->getId() == "" ) {
			return 0;
		} else {
			return count($lTabAdherent);
		}		
	}
	
	/**
	 * @name getNombreAdherentSurCompte($pId)
	 * @param integer
	 * @return array(AdherentVO)
	 * @desc Retourne les adhérents du compte
	 */
	public function getAdherentCompte($pId) {
		return AdherentManager::selectActifByIdCompte($pId);
	}
}
?>