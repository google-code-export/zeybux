<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 21/09/2010
// Fichier : RechargementCompteToVO.php
//
// Description : Classe RechargementCompteToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "RechargementCompteVO.php" );

/**
 * @name RechargementCompteToVO
 * @author Julien PIERRE
 * @since 21/09/2010
 * @desc Classe représentant une RechargementCompteToVO
 */
class RechargementCompteToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet RechargementCompteVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->montant)
			&& isset($lJson->typePaiement)
			&& isset($lJson->champComplementaireObligatoire)
			&& isset($lJson->champComplementaire);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setMontant($lJson->montant);
			$lVo->setTypePaiement($lJson->typePaiement);
			$lVo->setChampComplementaireObligatoire($lJson->champComplementaireObligatoire);
			$lVo->setChampComplementaire($lJson->champComplementaire);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet RechargementCompteVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['montant'])
			&& isset($pArray['typePaiement'])
			&& isset($pArray['champComplementaireObligatoire'])
			&& isset($pArray['champComplementaire']);

		if($lValid) {
			$lVo = new DetailCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setMontant($pArray['montant']);
			$lVo->setTypePaiement($pArray['typePaiement']);
			$lVo->setChampComplementaireObligatoire($pArray['champComplementaireObligatoire']);
			$lVo->setChampComplementaire($pArray['champComplementaire']);
			return $lVo;
		}
		return NULL;
	}
}
?>