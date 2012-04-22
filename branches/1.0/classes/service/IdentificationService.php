<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier :IdentificationService.php
//
// Description : Classe IdentificationService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . "IdentificationValid.php" );

/**
 * @name IdentificationService
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe Service d'Identification
 */
class IdentificationService
{	
	/**
	* @name set($pIdentification)
	* @param IdentificationVO
	* @return integer
	* @desc Ajoute ou modifie une Identification
	*/
	public function set($pIdentification) {
		$lIdentificationValid = new IdentificationValid();
		if($lIdentificationValid->input($pIdentification)) {
			if($lIdentificationValid->insert($pIdentification)) {
				return $this->insert($pIdentification);			
			} else if($lIdentificationValid->update($pIdentification)) {
				return $this->update($pIdentification);
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	/**
	* @name insert($pCompte)
	* @param IdentificationVO
	* @return integer
	* @desc Ajoute une Identification
	*/
	private function insert($pIdentification) {		
		return IdentificationManager::insert($pIdentification);
	}
	
	/**
	* @name update($pCompte)
	* @param IdentificationVO
	* @return integer
	* @desc Met à jour une Identification
	*/
	private function update($pIdentification) {		
		return IdentificationManager::update($pIdentification);
	}
	
	/**
	* @name delete($pId)
	* @param integer
	* @desc Supprime une Identification
	*/
	public function delete($pId) {
		$lIdentificationValid = new IdentificationValid();
		if($lIdentificationValid->delete($pId)){	
			$lIdentificationVO = $this->get($pId);
			$lIdentificationVO->setAutorise(0);
			$this->update($lIdentificationVO);
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
	/*public function existe($pCompte) {
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
	* @return array(IdentificationVO) ou IdentificationVO
	* @desc Retourne une liste d'Identification
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
	* @return IdentificationVO
	* @desc Retourne une Identification
	*/
	public function select($pId) {
		return IdentificationManager::select($pId);
	}
	
	/**
	* @name selectByType($pId)
	* @param integer
	* @return array(IdentificationVO)
	* @desc Retourne une Identification de Type $pId
	*/
	public function selectByType($pId) {
		return IdentificationManager::selectByType($pId);
	}
	
	/**
	* @name selectByLabel($pLabel)
	* @param string
	* @return CompteVO
	* @desc Retourne un compte
	*/
	/*public function selectByLabel($pLabel) {
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
	* @return array(IdentificationVO)
	* @desc Retourne une liste d'Identification
	*/
	public function selectAll() {		
		return IdentificationManager::selectAllToDisplay();
	}
}
?>