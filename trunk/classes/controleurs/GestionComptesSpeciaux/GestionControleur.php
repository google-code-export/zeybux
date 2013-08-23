<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 25/01/2012
// Fichier : GestionControleur.php
//
// Description : Classe GestionControleur des comptes spéciaux
//
//****************************************************************
// Inclusion des classes

include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_GESTION_COMPTES_SPECIAUX . "/CompteSpecialValid.php");
include_once(CHEMIN_CLASSES_SERVICE . "IdentificationService.php" );
include_once(CHEMIN_CLASSES_VO . "IdentificationVO.php");

/**
 * @name GestionControleur
 * @author Julien PIERRE
 * @since 25/01/2012
 * @desc Classe controleur d'une Gestion des comptes spéciaux
 */
class GestionControleur
{	
	/**
	* @name ajouter($pParam)
	* @return VR
	* @desc Ajoute un compte spécial
	*/
	public function ajouter($pParam) {		
		$lVr = CompteSpecialValid::validAjout($pParam);
		if($lVr->getValid()) {			
			
			
			$lIdentificationService = new IdentificationService();
			$lStatutAutorise = 1;
			
			if($pParam["type"] == 3) {
				$lIde = $lIdentificationService->selectByType(3);
				
				
				$lAutoriseActif = false;
				
				$i = 0;
				while(isset($lIde[$i]) && $lStatutAutorise == 1) {
					$lAutorise = $lIde[0]->getAutorise();
					if($lAutorise == 2) {
						$lStatutAutorise = 2;
					}
					$i++;
				}		
			}	
			
			$lIdentificationVO = new IdentificationVO();
			$lIdentificationVO->setLogin($pParam["login"]);
			$lIdentificationVO->setPass(md5($pParam["motPasse"]));
			$lIdentificationVO->setType($pParam["type"]);
			$lIdentificationVO->setAutorise($lStatutAutorise);			
			$lIdentificationService->set($lIdentificationVO);
		}
		return $lVr;
	}
	
	/**
	* @name update($pParam)
	* @return VR
	* @desc Met à jour un compte spécial
	*/
	public function update($pParam) {		
		$lVr = CompteSpecialValid::validUpdate($pParam);
		if($lVr->getValid()) {		
			$lIdentificationService = new IdentificationService();
			$lIdentificationVO = $lIdentificationService->get($pParam['id']);
			$lIdentificationVO->setLogin($pParam["login"]);			
			$lIdentificationService->set($lIdentificationVO);
		}
		return $lVr;
	}

	/**
	* @name updatePass($pParam)
	* @return VR
	* @desc Met à jour le mot de passe d'un compte spécial
	*/
	public function updatePass($pParam) {		
		$lVr = CompteSpecialValid::validUpdatePass($pParam);
		if($lVr->getValid()) {		
			$lIdentificationService = new IdentificationService();
			$lIdentificationVO = $lIdentificationService->get($pParam['id']);
			$lIdentificationVO->setPass(md5($pParam["motPasse"]));	
			$lIdentificationService->set($lIdentificationVO);
		}
		return $lVr;
	}
	
	/**
	* @name delete($pParam)
	* @return VR
	* @desc Met à jour le mot de passe d'un compte spécial
	*/
	public function delete($pParam) {		
		$lVr = CompteSpecialValid::validDelete($pParam);
		if($lVr->getValid()) {		
			$lIdentificationService = new IdentificationService();
			$lIdentificationService->delete($pParam['id']);
		}
		return $lVr;
	}
}
?>