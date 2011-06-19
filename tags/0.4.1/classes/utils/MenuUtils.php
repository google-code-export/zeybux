<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 01/02/2010
// Fichier : MenuUtils.php
//
// Description : Classe statique permettant de générer le menu
//
//****************************************************************

// Inclusion des classes
include_once(CHEMIN_CLASSES_UTILS . "Template.php");
include_once(CHEMIN_CLASSES_MANAGERS . "ModuleManager.php");
include_once(CHEMIN_CLASSES_MANAGERS . "VueManager.php");

/**
 * @name MenuUtils
 * @author Julien PIERRE
 * @since 01/02/2010
 * 
 * @desc Classe statique permettant de générer le menu
 */
/****************************************************************   Classe à Supprimer ***************************************/
class MenuUtils
{
	/**
	* @name afficherMenu()
	* @desc 
	*/
	public static function afficherMenu($pTemplate) {
		// Récupère la liste des modules déjà triées
/*		$lListeModule = ModuleManager::selectAll();
		
		// Réalise un tri des modules selon l'ordre défini en paramètre dans la BDD
		$lModulesAutorises = array();
		foreach( $lListeModule as $lModule ) {
			if( isset( $_SESSION[$lModule->getNom()] ) || isset($_SESSION[DROIT_SUPER_ZEYBU]) ) {
				array_push($lModulesAutorises,  $lModule);
			}
		}
		
		// Préparation de l'affichage
		//$lTemplate = new Template(CHEMIN_TEMPLATE . COMMUN_TEMPLATE);
		$pTemplate->set_filenames( array('menu' => COMMUN_TEMPLATE . 'Menu.html') );
		
		// Récupère la liste des vues déjà triées
		$lListeVues  = VueManager::selectAll();

		foreach( $lModulesAutorises as $lModule) {
			$pTemplate->assign_block_vars( 'modules', array (
									'MODULE_NOM' => $lModule->getNom(),
									'MODULE_LABEL' => $lModule->getLabel()) );
			if ( !empty($lListeVues) ) {
				$lVuesAutorises = array();
				foreach( $lListeVues as $lVue ) {
					if ( $lVue->getIdModule() == $lModule->getId() ) {				
						array_push($lVuesAutorises,$lVue);
					}
				}
				foreach( $lVuesAutorises as $lVue) {
					$pTemplate->assign_block_vars('modules.vues', array(
									'NOM' => $lVue->getNom(),
									'LABEL' => $lVue->getLabel() ));
				}
			}
		}

		// Ajout du lien de déconnexion
		$pTemplate->assign_vars( array( 'LIEN_DECONNEXION' => '"./index.php?m=' . MOD_IDENTIFICATION . '&amp;v=Deconnexion"') );
*/
		// Affichage du template
		//$lTemplate->pparse('Menu');
		//return $pTemplate;
	}
}
?>
