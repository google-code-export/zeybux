<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 28/10/2010
// Fichier : MenuControleur.php
//
// Description : Classe MenuControleur
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
 * @name MenuControleur
 * @author Julien PIERRE
 * @since 28/10/2010
 * @desc Classe controleur d'une MenuControleur
 */
class MenuControleur
{
	/**
	* @name getMenu($pParam)
	* @return MenuResponse
	* @desc Retourne le menu d'un adhérent
	*/
	public function getMenu($pParam) {		
		$lIdAdherent = $pParam["id_adherent"];
		$lListeModule = MenuViewManager::select($lIdAdherent);
		
		$lMenu = new MenuVO();
		$lAdmin = false;
		
		
		if($lListeModule[0]->getAdhSuperZeybu() == 1) {
			$lListeModule = ModuleManager::selectAll();
			$lAdmin = true;
			foreach($lListeModule as $lModule) {
				if($lModule->getAdmin() != 1) {
					// Si c'est le module non admin -> traitement spécial
					if($lModule->getId() == 1 || $lModule->getId() == 3) {
						$lVues = VueManager::selectByIdModule($lModule->getId());
						foreach($lVues as $lVue) {
							$lMenuModule = new MenuModuleVO();
							$lMenuModule->setModuleNom($lModule->getNom());
							$lMenuModule->setNom($lVue->getNom());
							$lMenuModule->setLabel($lVue->getLabel());						
							$lMenu->addModules($lMenuModule);
						}			
					} else {
						$lMenuModule = new MenuModuleVO();
						
						$lMenuModule->setModuleNom($lModule->getNom());
						$lMenuModule->setNom($lModule->getNom());
						$lMenuModule->setLabel($lModule->getLabel());							
						$lMenuModule->setVues(VueManager::selectByIdModule($lModule->getId()));
									
						$lMenu->addModules($lMenuModule);
					}
				}	
			}
			
		} else {
			foreach($lListeModule as $lModule) {	
				// N'affiche que les modules non admin		
				if($lModule->getModAdmin() == 1) {
					$lAdmin = true;
				} else {
					// Si c'est le module non admin -> traitement spécial
					if($lModule->getModId() == 1 || $lModule->getModId() == 3) {
						$lVues = VueManager::selectByIdModule($lModule->getModId());
						foreach($lVues as $lVue) {
							$lMenuModule = new MenuModuleVO();
							$lMenuModule->setModuleNom($lModule->getModNom());
							$lMenuModule->setNom($lVue->getNom());
							$lMenuModule->setLabel($lVue->getLabel());						
							$lMenu->addModules($lMenuModule);
						}			
					} else {
						$lMenuModule = new MenuModuleVO();
						
						$lMenuModule->setModuleNom($lModule->getModNom());
						$lMenuModule->setNom($lModule->getModNom());
						$lMenuModule->setLabel($lModule->getModLabel());							
						$lMenuModule->setVues(VueManager::selectByIdModule($lModule->getModId()));
									
						$lMenu->addModules($lMenuModule);
					}
				}			
			}
		}

		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		if($lAdmin) {
			$lResponse->setAdmin(true);
		}
		return $lResponse;
	}
	
}
?>