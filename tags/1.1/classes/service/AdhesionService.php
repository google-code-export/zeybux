<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 22/07/2012
// Fichier : AdhesionService.php
//
// Description : Classe AdhesionService
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "ProduitAbonnementManager.php");

/**
 * @name AdhesionService
 * @author Julien PIERRE
 * @since 22/07/2012
 * @desc Classe Service d'Adhesion
 */
class AdhesionService
{	
	/**
	* @name setTypeAdhesion($pTypeAdhesion)
	* @param TypeAdhesionVO ou array(TypeAdhesionVO)
	* @return bool
	* @desc Ajoute un TypeAdhesion
	*/
	public function setTypeAdhesion($pTypeAdhesion) {
		$lAdhesionValid = new AdhesionValid();
		$lVr = $lAdhesionValid->input($pTypeAdhesion); 
		if($lVr->getValid()) {
			if($lAdhesionValid->ajout($pTypeAdhesion)) {
				if(!$this->ajoutTypeAdhesion()) {
					$lVr->setValid(false); // TODO un message d'erreur
				}
			} else {
				$lVr->setValid(false); // TODO un message d'erreur
			}
		}
		return $lVr;
	}
	
	/**
	* @name ajoutTypeAdhesion($pTypeAdhesion)
	* @param TypeAdhesionVO ou array(TypeAdhesionVO)
	* @return integer
	* @desc Ajoute un TypeAdhesion
	*/
	public function ajoutTypeAdhesion($pTypeAdhesion) {
		return TypeAdhesionManager::insert($pTypeAdhesion);
	}
	
	/**
	* @name setTypeAdhesion($pTypeAdhesion)
	* @param TypeAdhesionVO ou array(TypeAdhesionVO)
	* @return integer
	* @desc Ajoute un TypeAdhesion
	*/
	public function supprimerTypeAdhesion($pIdTypeAdhesion) {
		if(!TypeAdhesionManager::delete($pIdTypeAdhesion)) {
			$lVr->setValid(false); // TODO un message d'erreur
		}
	}
}
?>