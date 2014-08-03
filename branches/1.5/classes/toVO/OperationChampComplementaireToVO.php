<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : OperationChampComplementaireToVO.php
//
// Description : Classe OperationChampComplementaireToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "OperationChampComplementaireVO.php" );

/**
 * @name OperationChampComplementaireToVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une OperationChampComplementaireToVO
 */
class OperationChampComplementaireToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet OperationChampComplementaireVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['opeId'])) { $lOpeId = $pArray['opeId']; } else { $lOpeId = NULL; }
		if(isset($pArray['id'])) { $lChcpId = $pArray['id']; } else { $lChcpId = NULL; }
		if(isset($pArray['valeur'])) {	$lValeur = $pArray['valeur']; } else { $lValeur = NULL; }
		
		return new OperationChampComplementaireVO($lOpeId, $lChcpId, $lValeur);		
	}
}
?>