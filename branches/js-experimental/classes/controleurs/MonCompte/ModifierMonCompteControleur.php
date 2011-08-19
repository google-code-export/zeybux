<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 24/01/2011
// Fichier : ModifierMonCompteControleur.php
//
// Description : Classe ModifierMonCompteControleur
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_MANAGERS . "IdentificationManager.php");
include_once(CHEMIN_CLASSES_VALIDATEUR . MOD_MON_COMPTE . "/InfoAdherentValid.php");

/**
 * @name ModifierMonCompteControleur
 * @author Julien PIERRE
 * @since 24/01/2011
 * @desc Classe controleur d'un compte
 */
class ModifierMonCompteControleur
{	
	/**
	* @name modifierAdherent($pParam)
	* @return VR
	* @desc Modification des infos de l'adhérent.
	*/
	public function modifierAdherent($pParam) {		
		$lVr = InfoAdherentValid::validAjout($pParam);

		if($lVr->getValid()) {
			$lIdentification = IdentificationManager::selectByIdType($pParam['id_adherent'],1);
			$lIdentification = $lIdentification[0];
			$lIdentification->setPass( md5( $pParam['motPasseNouveau'] ) );
			IdentificationManager::update( $lIdentification );
		}
		return $lVr;
	}
}
?>
