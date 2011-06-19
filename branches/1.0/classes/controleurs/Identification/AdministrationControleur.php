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
include_once(CHEMIN_CLASSES_RESPONSE . "MenuResponse.php" );
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
	* @name getMenu($pParam)
	* @return MenuResponse
	* @desc Retourne le menu d'administration d'un adhérent
	*/
	public function getMenu($pParam) {		
		$lIdAdherent = $pParam["id_adherent"];
		$lListeModule = MenuViewManager::select($lIdAdherent);
		
		$lMenu = new MenuVO();
		if($lListeModule[0]->getAdhSuperZeybu() == 1) {
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
		} else {
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
		}		

		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		
		return $lResponse;
	}
	
}
?>