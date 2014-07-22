<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/06/2014
// Fichier : InformationBancaireService.php
//
// Description : Classe InformationBancaireService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "/InformationBancaireManager.php");


/**
 * @name InformationBancaireService
 * @author Julien PIERRE
 * @since 18/06/2014
 * @desc Classe Service des Informations bancaire
 */
class InformationBancaireService
{	
	/**
	 * @name set($pInformationBancaire)
	 * @param InformationBancaireVO
	 * @return integer
	 * @desc Ajoute ou met à jour une Information Bancaire
	 */
	public function set($pInformationBancaire) {
		$lId = $pInformationBancaire->getId();
		if(empty($lId)) { // Ajout
			return $this->insert($pInformationBancaire);
		} else { // Update
			return $this->update($pInformationBancaire);
		}
	}
	
	/**
	 * @name insert($pInformationBancaire)
	 * @param InformationBancaireVO
	 * @return integer
	 * @desc Ajoute une Information Bancaire
	 */
	private function insert($pInformationBancaire) {	
		// Création de l'Information Bancaire
		return InformationBancaireManager::insert($pInformationBancaire);
	}
	
	/**
	 * @name update($pInformationBancaire)
	 * @param InformationBancaireVO
	 * @return integer
	 * @desc Met à jour une Information Bancaire
	 */
	private function update($pInformationBancaire) {
		// Mise à jour de l'Information Bancaire
		return InformationBancaireManager::update($pInformationBancaire);
	}
	
	/**
	 * @name delete($pIdInformationBancaire)
	 * @param integer
	 * @desc Supprime une Information Bancaire
	 */
	public function delete($pIdInformationBancaire) {
		// Récupère l'information bancaire
		$lInformationBancaire = $this->get($pIdInformationBancaire);
		// Met à jour l'état
		$lInformationBancaire->setEtat(1);
		// Enregistrement
		$this->update($lInformationBancaire);
	}
	
	/**
	 * @name get($pIdInformationBancaire)
	 * @param integer
	 * @return InformationBancaireVO
	 * @desc Retourne une Information Bancaire
	 */
	public function get($pIdInformationBancaire) {
		return $this->select($pIdInformationBancaire);
	}
	
	/**
	 * @name select($pIdInformationBancaire)
	 * @param integer
	 * @return InformationBancaireVO
	 * @desc Retourne une Information Bancaire
	 */
	private function select($pIdInformationBancaire) {
		return InformationBancaireManager::select($pIdInformationBancaire);
	}

	/**
	 * @name getByIdCompte($pIdCompte)
	 * @param integer
	 * @return InformationBancaireVO
	 * @desc Retourne une Information Bancaire correpondant au compte zeybux
	 */
	public function getByIdCompte($pIdCompte) {
		 $lInformationBancaire = InformationBancaireManager::recherche(
				array(InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ID_COMPTE, InformationBancaireManager::CHAMP_INFORMATIONBANCAIRE_ETAT), 
				array('=','='), 
				array($pIdCompte, 0), 
				array(''), 
				array(''));
		 
		 return $lInformationBancaire[0];
	}
}
?>