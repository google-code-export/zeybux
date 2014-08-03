<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : AdhesionAdherentToVO.php
//
// Description : Classe AdhesionAdherentToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AdhesionAdherentVO.php" );

/**
 * @name AdhesionAdherentToVO
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une AdhesionAdherentToVO
 */
class AdhesionAdherentToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AdhesionAdherentVO
	*/
	public static function convertFromArray($pArray) {	
		if(isset($pArray['id'])) { $lId = $pArray['id']; } else { $lId = NULL; }			
		if(isset($pArray['idAdherent'])) { $lIdAdherent = $pArray['idAdherent']; } else { $lIdAdherent = NULL; }	
		if(isset($pArray['idTypeAdhesion'])) { $lIdTypeAdhesion = $pArray['idTypeAdhesion']; } else { $lIdTypeAdhesion = NULL; }	
		if(isset($pArray['idOperation'])) { $lIdOperation = $pArray['idOperation']; } else { $lIdOperation = NULL; }
		if(isset($pArray['statutFormulaire'])) { $lStatutFormulaire = $pArray['statutFormulaire']; } else { $lStatutFormulaire = NULL; }		
		
		return new AdhesionAdherentVO($lId, $lIdAdherent, $lIdTypeAdhesion, $lIdOperation, $lStatutFormulaire);
	}
}
?>