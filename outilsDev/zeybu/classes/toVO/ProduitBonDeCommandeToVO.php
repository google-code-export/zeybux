<?php
//****************************************************************
//
// Createur : Julien PIERRE
// Date de creation : 18/01/2011
// Fichier : ProduitBonDeCommandeToVO.php
//
// Description : Classe ProduitBonDeCommandeToVO
//
//****************************************************************
// Inclusion des classes
include_once(CHEMIN_CLASSES_VO . "ProduitBonDeCommandeVO.php" );

/**
 * @name ProduitBonDeCommandeToVO
 * @author Julien PIERRE
 * @since 18/01/2011
 * @desc Classe représentant une ProduitBonDeCommandeToVO
 */
class ProduitBonDeCommandeToVO
{
	/**
	* @name convertFromJson($pJson)
	* @param json
	* @desc Convertit le json en objet ProduitBonDeCommandeVO
	*/
	public static function convertFromJson($pJson) {
		$lJson = json_decode($pJson);

		$lValid = isset($lJson->id)
			&& isset($lJson->quantite)
			&& isset($lJson->prix);

		if($lValid) {
			$lVo = new ProduitBonDeCommandeVO();
			$lVo->setId($lJson->id);
			$lVo->setQuantite($lJson->quantite);
			$lVo->setPrix($lJson->prix);
			return $lVo;
		}
		return NULL;
	}

	/**
	* @name convertFromArray($pArray)
	* @param array()
	* @desc Convertit le array en objet ProduitBonDeCommandeVO
	*/
	public static function convertFromArray($pArray) {
		$lValid = isset($pArray['id'])
			&& isset($pArray['quantite'])
			&& isset($pArray['prix']);

		if($lValid) {
			$lVo = new ProduitBonDeCommandeVO();
			$lVo->setId($pArray['id']);
			$lVo->setQuantite($pArray['quantite']);
			$lVo->setPrix($pArray['prix']);
			return $lVo;
		}
		return NULL;
	}
}
?>