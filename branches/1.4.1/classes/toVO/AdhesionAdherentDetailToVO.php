<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 10/11/2013
// Fichier : AdhesionAdherentDetailToVO.php
//
// Description : Classe AdhesionAdherentDetailToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "AdhesionAdherentDetailVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "AdhesionAdherentToVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationDetailToVO.php" );

/**
 * @name AdhesionAdherentDetailToVO
 * @author Julien PIERRE
 * @since 10/11/2013
 * @desc Classe représentant une AdhesionAdherentDetailToVO
 */
class AdhesionAdherentDetailToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet AdhesionAdherentDetailVO
	*/
	public static function convertFromArray($pArray) {	
		if(isset($pArray['adhesionAdherent'])) { $lAdhestionAdherent = AdhesionAdherentToVO::convertFromArray($pArray['adhesionAdherent']); } else { $lAdhestionAdherent = NULL; }			
		if(isset($pArray['operation'])) { $lOperation = OperationDetailToVO::convertFromArray($pArray['operation']); } else { $lOperation = NULL; }		
		return new AdhesionAdherentDetailVO($lAdhestionAdherent, $lOperation, null);
	}
}
?>