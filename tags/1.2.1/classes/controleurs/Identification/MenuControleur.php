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
include_once(CHEMIN_CLASSES_RESPONSE . MOD_IDENTIFICATION . "/MenuResponse.php" );
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
	* @name getMenu()
	* @return MenuResponse
	* @desc Retourne le menu
	*/
	public function getMenu() {
		switch($_SESSION[TYPE_ID]){
			case 1 : // Adhérent
				return $this->getMenuAdherent();
				break;
			
			case 2 : // SuperZeybu
				return $this->getMenuSuperZeybu();
				break;
				
			case 3 : // Caisse
				return $this->getMenuCaisse();
				break;
				
			case 4 : // Compte Solidaire
				return $this->getMenuCompteSolidaire();
				break;
		}
	}
	
	/**
	* @name getMenuAdherent()
	* @return MenuResponse
	* @desc Retourne le menu d'un adhérent
	*/
	public function getMenuAdherent() {
		$lListeModule = MenuViewManager::select($_SESSION[DROIT_ID]);
		
		$lMenu = new MenuVO();
		$lAdmin = false;
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
		
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		if($lAdmin) {
			$lResponse->setAdmin(true);
		}
		return $lResponse;
	}
	
	/**
	* @name getMenuSuperZeybu()
	* @return MenuResponse
	* @desc Retourne le menu d'un SuperZeybu
	*/
	public function getMenuSuperZeybu() {
		$lMenu = new MenuVO();
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		if(isset($_SESSION[DROIT_ID]) && isset($_SESSION[DROIT_SUPER_ZEYBU]) && $_SESSION[DROIT_ID] == $_SESSION[DROIT_SUPER_ZEYBU]) {
			$lResponse->setAdmin(true);
		}
		return $lResponse;
	}
	
	/**
	* @name getMenuCaisse()
	* @return MenuResponse
	* @desc Retourne le menu d'une Caisse
	*/
	public function getMenuCaisse() {
		$lMenu = new MenuVO();
		
		if(isset($_SESSION[MOD_CAISSE]) && $_SESSION[MOD_CAISSE]) {
			$lMenuModule = new MenuModuleVO();
			$lMenuModule->setModuleNom(MOD_CAISSE);
			$lMenuModule->setNom('CaisseListeMarche');
			$lMenuModule->setLabel('Liste des Marchés');						
			$lMenu->addModules($lMenuModule);		
		}
		
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		$lResponse->setAdmin(false);
		return $lResponse;
	}
	
	/**
	* @name getMenuCompteSolidaire()
	* @return MenuResponse
	* @desc Retourne le menu du Compte Solidaire
	*/
	public function getMenuCompteSolidaire() {
		$lMenu = new MenuVO();
		
		if(isset($_SESSION[MOD_COMPTE_SOLIDAIRE]) && $_SESSION[MOD_COMPTE_SOLIDAIRE]) {
			$lMenuModule = new MenuModuleVO();
			$lMenuModule->setModuleNom(MOD_COMPTE_SOLIDAIRE);
			$lMenuModule->setNom('CompteSolidaire');
			$lMenuModule->setLabel('Compte');						
			$lMenu->addModules($lMenuModule);		
			
			$lMenuModule = new MenuModuleVO();
			$lMenuModule->setModuleNom(MOD_COMPTE_SOLIDAIRE);
			$lMenuModule->setNom('ListeAdherent');
			$lMenuModule->setLabel('Virements');						
			$lMenu->addModules($lMenuModule);
		}
		
		$lResponse = new MenuResponse();
		$lResponse->setMenu($lMenu);
		$lResponse->setAdmin(false);
		return $lResponse;
	}
	
}
?>