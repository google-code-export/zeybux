<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 09/06/2014
// Fichier : OperationRemiseChequeToVO.php
//
// Description : Classe OperationRemiseChequeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "OperationRemiseChequeVO.php" );

/**
 * @name OperationRemiseChequeToVO
 * @author Julien PIERRE
 * @since 09/06/2014
 * @desc Classe représentant une OperationRemiseChequeToVO
 */
class OperationRemiseChequeToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet OperationRemiseChequeVO
	*/
	public static function convertFromArray($pArray) {	
		if(isset($pArray['idRemiseCheque'])) { $lIdRemiseCheque = $pArray['idRemiseCheque']; } else { $lIdRemiseCheque = NULL; }			
		if(isset($pArray['idOperation'])) { $lIdOperation = $pArray['idOperation']; } else { $lIdOperation = NULL; }
		
		return new OperationRemiseChequeVO($lIdRemiseCheque, $lIdOperation);
	}
}
?>