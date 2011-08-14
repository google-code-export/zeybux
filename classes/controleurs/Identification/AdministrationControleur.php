<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 29/10/2010
// Fichier : AdministrationControleur.php
//
// Description : Classe AdministrationControleur
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_VIEW_MANAGER . "MenuViewManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "VueManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_RESPONSE . MOD_IDENTIFICATION . "/MenuResponse.php" );
include_once(CHEMIN_CLASSES_VO . "MenuVO.php");
include_once(CHEMIN_CLASSES_VO . "MenuModuleVO.php");

/**
 * @name AdministrationControleur
 * @author Julien PIERRE
 * @since 29/10/2010
 * @desc Classe controleur d'une AdministrationControleur
 */
class AdministrationControleur
{
	/**
	* @name getMenu()
	* @return MenuResponse
	* @desc Retourne le menu d'administration d'un adhérent
	*/
	public function getMenu() {
		switch($_SESSION[TYPE_ID]){
			case 1 : // Adhérent
				return $this->getMenuAdherent();
				break;
			
			case 2 : // SuperZeybu
				return $this->getMenuSuperZeybu();
				break;
		}
	}

	/**
	* @name getMenuAdherent()
	* @return MenuResponse
	* @desc Retourne le menu d'un adhérent
	*/
	public function getMenuAdherent() {
		$lMenu = new MenuVO();
		
		$lListeModule = MenuViewManager::select($_SESSION[DROIT_ID]);		
		foreach($lListeModule as $lModule) {	
			// Si c'est un module admin
			if($lModule->getModAdmin() == 1) {
				$lMenuModule = new MenuModuleVO();
				
				$lMenuModule->setModuleNom($lModule->getModNom());
				$lMenuModule->setNom($lModule->getModNom());
				$lMenuModule->setLabel($lModule->getModLabel());							
				$lMenuModule->setVues(VueManager::selectByIdModule($lModule->getModId()));
							
				$lMenu->addModules($lMenuModule);
			}
		}
			
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		return $lResponse;
	}
		
	/**
	* @name getMenuSuperZeybu()
	* @return MenuResponse
	* @desc Retourne le menu d'un SuperZeybu
	*/
	public function getMenuSuperZeybu() {
		$lMenu = new MenuVO();
		$lListeModule = ModuleManager::selectAll();
		
		foreach($lListeModule as $lModule) {	
			// Si c'est un module admin
			if($lModule->getAdmin() == 1) {
				$lMenuModule = new MenuModuleVO();
				
				$lMenuModule->setModuleNom($lModule->getNom());
				$lMenuModule->setNom($lModule->getNom());
				$lMenuModule->setLabel($lModule->getLabel());							
				$lMenuModule->setVues(VueManager::selectByIdModule($lModule->getId()));
							
				$lMenu->addModules($lMenuModule);
			}
		}
		
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		return $lResponse;
	}
}
?>