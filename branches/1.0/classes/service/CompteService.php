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
include_once(CHEMIN_CLASSES_VALIDATEUR . "CompteValid.php" );

/**
 * @name CompteService
 * @author Julien PIERRE
 * @since 26/06/2011
 * @desc Classe Service d'un Compte
 */
class CompteService
{	
	/**
	* @name existe($pCompte)
	* @param CompteVO ou String
	* @return bool
	* @desc Vérifie si le compte existe
	*/
	public function existe($pCompte) {
		if(	is_object($pCompte) && CompteValid::estCompte($pCompte)) {
			$lCompte = CompteManager::select($pCompte);
			if($lCompte->getId() == $pCompte->getId()) {
				return true;
			} else {
				return false;
			}
		} else if(is_string($pCompte)){
			$lCompte = CompteManager::recherche(
				array(CompteManager::CHAMP_COMPTE_LABEL),
				array('='),
				array($pCompte),
				array(''),
				array(''));
			if($lCompte[0]->getLabel() == $pCompte) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
?>