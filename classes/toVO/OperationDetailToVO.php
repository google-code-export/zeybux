<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 17/08/2013
// Fichier : OperationDetailToVO.php
//
// Description : Classe OperationDetailToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "OperationDetailVO.php" );
include_once(CHEMIN_CLASSES_TOVO . "OperationChampComplementaireToVO.php" );

/**
 * @name OperationDetailToVO
 * @author Julien PIERRE
 * @since 17/08/2013
 * @desc Classe représentant une OperationDetailToVO
 */
class OperationDetailToVO
{
	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet OperationDetailVO
	*/
	public static function convertFromArray($pArray) {
		if(isset($pArray['id'])) { $lId = $pArray['id']; } else { $lId = NULL; }
		if(isset($pArray['idCompte'])) { $lIdCompte = $pArray['idCompte']; } else { $lIdCompte = NULL; }
		if(isset($pArray['montant'])) {	$lMontant = $pArray['montant']; } else { $lMontant = NULL; }
		if(isset($pArray['libelle'])) {	$lLibelle = $pArray['libelle']; } else { $lLibelle = NULL; }
		if(isset($pArray['date'])) { $lDate = $pArray['date']; } else { $lDate = NULL; }
		if(isset($pArray['typePaiement'])) { $lTypePaiement = $pArray['typePaiement']; } else { $lTypePaiement = NULL; }
		if(isset($pArray['type'])) { $lType = $pArray['type']; } else { $lType = NULL; }
		if(isset($pArray['dateMaj'])) {	$lDateMaj = $pArray['dateMaj']; } else { $lDateMaj = NULL; }
		if(isset($pArray['idLogin'])) {	$lIdLogin = $pArray['idLogin']; } else { $lIdLogin = NULL; }
		if(isset($pArray['tppId'])) {	$lTppId = $pArray['tppId']; } else { $lTppId = NULL; }
		if(isset($pArray['tppType'])) {	$lTppType = $pArray['tppType']; } else { $lTppType = NULL; }
		if(isset($pArray['tppChampComplementaire'])) {	$lTppChampComplementaire = $pArray['tppChampComplementaire']; } else { $lTppChampComplementaire = NULL; }
		if(isset($pArray['tppVisible'])) {	$lTppVisible = $pArray['tppVisible']; } else { $lTppVisible = NULL; }

		if(isset($pArray['champComplementaire'])) {	
			$lChampComplementaire = array();
			foreach($pArray['champComplementaire'] as $lChamp) {
				if(!is_null($lChamp)) {
					$lChampVo = OperationChampComplementaireToVO::convertFromArray($lChamp);
					$lChampComplementaire[$lChampVo->getChcpId()] = $lChampVo;
				}
			} 
		} else { $lChampComplementaire = array(); }
		
		return new OperationDetailVO($lId, $lIdCompte, $lMontant, $lLibelle, $lDate, $lTypePaiement, $lType, $lDateMaj, $lIdLogin, $lTppId, $lTppType, $lTppChampComplementaire, $lTppVisible, $lChampComplementaire);		
	}
}
?>